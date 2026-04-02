<?php

namespace App\Repositories\Wings;

use App\Exceptions\Http\Connection\DaemonConnectionException;
use App\Models\Server;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @method \App\Repositories\Wings\DaemonPowerRepository setNode(\App\Models\Node $node)
 * @method \App\Repositories\Wings\DaemonPowerRepository setServer(\App\Models\Server $server)
 */
class DaemonPowerRepository extends DaemonRepository
{
    /**
     * Sends a power action to the server instance.
     *
     * @throws DaemonConnectionException
     */
    public function send(string $action): ResponseInterface
    {
        Assert::isInstanceOf($this->server, Server::class);

        try {
            return $this->getHttpClient()->post(
                sprintf('/api/servers/%s/power', $this->server->uuid),
                ['json' => ['action' => $action]]
            );
        } catch (TransferException $exception) {
            throw new DaemonConnectionException($exception);
        }
    }
}
