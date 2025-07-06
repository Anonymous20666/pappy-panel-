<?php

namespace Pterodactyl\Http\Controllers\Admin\Revix;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Revix\SiteSettingsFormRequest;
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
        return $this->view->make('admin.revix.site', [
            'site_color' => $this->settings->get('revix:site_color', '#EF5C29'),
            'site_title' => $this->settings->get('revix:site_title', 'Revix Theme'),
            'site_description' => $this->settings->get('revix:site_description', 'Our official control panel made better with Revix.'),
            'site_image' => $this->settings->get('revix:site_image', '/revix/logo.png'),
            'site_favicon' => $this->settings->get('revix:site_favicon', '/revix/icon.png'),
        ]);
    }

    /**
     * Save the site settings.
     */
    public function store(SiteSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('revix:site_color', $request->input('revix:site_color'));
        $this->settings->set('revix:site_title', $request->input('revix:site_title'));
        $this->settings->set('revix:site_description', $request->input('revix:site_description'));
        $this->settings->set('revix:site_image', $request->input('revix:site_image'));
        $this->settings->set('revix:site_favicon', $request->input('revix:site_favicon'));

        $this->alert->success('Site settings have been updated successfully.')->flash();

        return redirect()->route('admin.revix.site');
    }
}