<?php

namespace Pterodactyl\Transformers\Api\Client;

use Illuminate\Support\Arr;

class StatsTransformer extends BaseClientTransformer
{
    public function getResourceName(): string
    {
        return 'stats';
    }

    /**
     * Transform stats from the daemon into a result set that can be used in
     * the client API.
     */
    public function transform(array $data): array
    {
        $response = [
            'current_state' => Arr::get($data, 'state', 'stopped'),
            'is_suspended' => Arr::get($data, 'is_suspended', false),
            'resources' => [
                'memory_bytes' => Arr::get($data, 'utilization.memory_bytes', 0),
                'cpu_absolute' => Arr::get($data, 'utilization.cpu_absolute', 0),
                'disk_bytes' => Arr::get($data, 'utilization.disk_bytes', 0),
                'network_rx_bytes' => Arr::get($data, 'utilization.network.rx_bytes', 0),
                'network_tx_bytes' => Arr::get($data, 'utilization.network.tx_bytes', 0),
                'uptime' => Arr::get($data, 'utilization.uptime', 0),
            ],
        ];

        // Optionally include players if present in the data (from controller augmentation)
        if (isset($data['players']) && is_array($data['players'])) {
            $online = Arr::get($data, 'players.online');
            $max = Arr::get($data, 'players.max');
            if (is_int($online) && is_int($max)) {
                $response['players'] = [
                    'online' => $online,
                    'max' => $max,
                ];
            }
        }

        return $response;
    }
}
