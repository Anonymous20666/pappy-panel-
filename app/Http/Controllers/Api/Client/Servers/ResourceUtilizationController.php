<?php

namespace Pterodactyl\Http\Controllers\Api\Client\Servers;

use Carbon\Carbon;
use Pterodactyl\Models\Server;
use Illuminate\Cache\Repository;
use Pterodactyl\Transformers\Api\Client\StatsTransformer;
use Pterodactyl\Repositories\Wings\DaemonServerRepository;
use Pterodactyl\Http\Controllers\Api\Client\ClientApiController;
use Pterodactyl\Http\Requests\Api\Client\Servers\GetServerRequest;
use Pterodactyl\Services\Servers\MinecraftStatusService;

class ResourceUtilizationController extends ClientApiController
{
    /**
     * ResourceUtilizationController constructor.
     */
    public function __construct(private Repository $cache, private DaemonServerRepository $repository, private MinecraftStatusService $minecraftStatus)
    {
        parent::__construct();
    }

    /**
     * Return the current resource utilization for a server. This value is cached for up to
     * 20 seconds at a time to ensure that repeated requests to this endpoint do not cause
     * a flood of unnecessary API calls.
     *
     * @throws \Pterodactyl\Exceptions\Http\Connection\DaemonConnectionException
     */
    public function __invoke(GetServerRequest $request, Server $server): array
    {
        $key = "resources:$server->uuid";
        $stats = $this->cache->remember($key, Carbon::now()->addSeconds(20), function () use ($server) {
            $details = $this->repository->setServer($server)->getDetails();

            // Attempt to include Minecraft players online if reachable.
            // Use the default allocation's alias (or IP) and port.
            $allocation = $server->allocation;
            if ($allocation) {
                $host = $allocation->alias; // alias accessor returns alias or ip
                $port = $allocation->port;
                $players = $this->minecraftStatus->getPlayersCount($host, $port, 0.8);
                if ($players) {
                    $details['players'] = [
                        'online' => $players[0],
                        'max' => $players[1],
                    ];
                }
            }

            return $details;
        });

        return $this->fractal->item($stats)
            ->transformWith($this->getTransformer(StatsTransformer::class))
            ->toArray();
    }
}
