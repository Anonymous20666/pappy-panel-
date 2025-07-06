<?php

namespace Pterodactyl\Http\Controllers\Admin\Revix;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Revix\GeneralSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class GeneralController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the general settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.revix.index', [
            'logo' => $this->settings->get('revix:logo', '/revix/logo.png'),
            'customCopyright' => $this->settings->get('revix:customCopyright', true) ? 'true' : 'false',
            'copyright' => $this->settings->get('revix:copyright', 'Powered by [Revix](https://revix.cc)'),
        ]);
    }

    /**
     * Save the general settings.
     */
    public function store(GeneralSettingsFormRequest $request): RedirectResponse
    {   
        $themeSelector = filter_var($request->input('revix:customCopyright'), FILTER_VALIDATE_BOOLEAN);
        $this->settings->set('revix:logo', $request->input('revix:logo'));
        $this->settings->set('revix:customCopyright', $request->input('revix:customCopyright'));
        $this->settings->set('revix:copyright', $request->input('revix:copyright'));

        $this->alert->success('General settings have been updated successfully.')->flash();

        return redirect()->route('admin.revix');
    }
}