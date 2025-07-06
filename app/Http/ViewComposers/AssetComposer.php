<?php

namespace Pterodactyl\Http\ViewComposers;

use Illuminate\View\View;
use Pterodactyl\Services\Helpers\AssetHashService;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class AssetComposer
{
    /**
     * AssetComposer constructor.
     */
    public function __construct(
        private AssetHashService $assetHashService,
        private SettingsRepositoryInterface $settings
    ) {}

    /**
     * Provide access to the asset service in the views.
     */
    public function compose(View $view): void
    {
        $view->with('asset', $this->assetHashService);
        $view->with('siteConfiguration', [
            'name' => config('app.name') ?? 'Pterodactyl',
            'locale' => config('app.locale') ?? 'en',
            'recaptcha' => [
                'enabled' => config('recaptcha.enabled', false),
                'siteKey' => config('recaptcha.website_key') ?? '',
            ],
        ]);
        $view->with('revixConfiguration', 
            $this->getRevixSettings(),
        );
    }

    private array $revixDefaults = [
        'logo' => '/revix/logo.png',
        'customCopyright' => true,
        'copyright' => 'Powered by [Revix](https://revix.cc)',
        'colorPrimary' => '#EF5C29',
        'colorSuccess' => '#3D8F1F',
        'colorDanger' => '#8F1F20',
        'colorSecondary' => '#2B2B40',
        'color50' => '#F4F4F5',
        'color100' => '#DEDEE2',
        'color200' => '#D2D2DB',
        'color300' => '#8282A4',
        'color400' => '#5E5E7F',
        'color500' => '#42425B',
        'color600' => '#1B1B21',
        'color700' => '#141416',
        'color800' => '#070709',
        'color900' => '#07070C',
        'themeSelector' => true,
        'background' => 'none',
        'radius' => '15px',
        'allocationBlur' => true,
        'alertType' => 'info',
        'alertMessage' => '**Welcome to Revix!** You can modify Theme Look & Feel at [Revix Editor](/admin/revix) at the administration area.',
        'site_color' => '#EF5C29',
        'site_title' => 'Revix Theme',
        'site_description' => 'Our official control panel made better with Revix.',
        'site_image' => '/revix/logo.png',
        'site_favicon' => '/revix/icon.png',
    ];

    private function getRevixSettings(): array
    {
        $settings = [];

        foreach ($this->revixDefaults as $key => $default) {
            $settings[$key] = $this->settings->get("revix:{$key}", $default);
        }

        return $settings;
    }

    public function resetRevixDefaults(): void
    {
        foreach ($this->revixDefaults as $key => $value) {
            $this->settings->set("revix:{$key}", $value);
        }
    }
}