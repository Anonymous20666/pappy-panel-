<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\SiteSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class SiteController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the site settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.designify.site', [
            'site_color' => $this->settings->get('reviactyl:site_color', '#EF5C29'),
            'site_title' => $this->settings->get('reviactyl:site_title', 'Reviactyl'),
            'site_description' => $this->settings->get('reviactyl:site_description', 'Our official control panel made better with Reviactyl.'),
            'site_image' => $this->settings->get('reviactyl:site_image', '/reviactyl/logo.png'),
            'site_favicon' => $this->settings->get('reviactyl:site_favicon', '/reviactyl/icon.png'),
        ]);
    }

    /**
     * Save the site settings.
     */
    public function store(SiteSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('reviactyl:site_color', $request->input('reviactyl:site_color'));
        $this->settings->set('reviactyl:site_title', $request->input('reviactyl:site_title'));
        $this->settings->set('reviactyl:site_description', $request->input('reviactyl:site_description'));
        $this->settings->set('reviactyl:site_image', $request->input('reviactyl:site_image'));
        $this->settings->set('reviactyl:site_favicon', $request->input('reviactyl:site_favicon'));

        $this->alert->success('Site settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.site');
    }
}