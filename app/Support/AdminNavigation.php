<?php

namespace Pterodactyl\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class AdminNavigation
{
    /**
     * Return core and addon navigation arrays.
     *
     * core => array (from core.json)
     * addons => array (merged arrays from other json files)
     * 
     * https://docs.revix.cc/developers/admin-navigation/
     */
    public static function get(): array
    {
        $navDir = base_path('reviactyl/admin/navigation');
        $coreFile = $navDir . '/core.json';

        $core = [];
        if (file_exists($coreFile)) {
            $decoded = json_decode(file_get_contents($coreFile), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $core = $decoded;
            } else {
                Log::warning('AdminNavigation.php: failed to decode core.json - ' . json_last_error_msg());
            }
        }

        $addonItems = [];
        if (is_dir($navDir)) {
            foreach (glob($navDir . '/*.json') as $file) {
                $basename = basename($file);

                if (in_array($basename, ['core.json', '_example.json'])) {
                    continue;
                }

                $decoded = json_decode(file_get_contents($file), true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $addonItems = array_merge($addonItems, $decoded);
                } else {
                    Log::warning("AdminNavigation: failed to decode {$basename} — " . json_last_error_msg());
                }
            }
        }

        return [
            'core'   => $core,
            'addons' => $addonItems,
        ];
    }

    /**
     * Convenience: returns the full navigation array ready for rendering.
     */
    public static function getMerged(): array
    {
        $nav = self::get();
        $items = $nav['core'] ?? [];

        if (!empty($nav['addons'])) {
            $items[] = ['header' => 'THIRD-PARTY MODS'];

            foreach ($nav['addons'] as $addonItem) {
                if (!isset($addonItem['route'], $addonItem['label'], $addonItem['icon'])) {
                    continue;
                }
                $items[] = $addonItem;
            }
        }

        return $items;
    }

    /**
     * Determine active status for each route
     */
    public static function isActive(array $item): string
    {
        $current = Route::currentRouteName();

        if (isset($item['prefix'])) {
            return str_starts_with($current, $item['prefix']) ? 'bg-orange-600/30' : '';
        }

        return ($current === ($item['route'] ?? null)) ? 'bg-orange-600/30' : '';
    }
}
