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
            'isUnderMaintenance' => $this->settings->get('revix:isUnderMaintenance', false) ? 'true' : 'false',
            'maintenance' => $this->settings->get('revix:maintenance', 'We are currently under maintenance. Kindly check back later!'),
        ]);
    }

    /**
     * Save the general settings.
     */
    public function store(GeneralSettingsFormRequest $request): RedirectResponse
    {   
        $customCopyright = filter_var($request->input('revix:customCopyright'), FILTER_VALIDATE_BOOLEAN);
        $isUnderMaintenance = filter_var($request->input('revix:isUnderMaintenance'), FILTER_VALIDATE_BOOLEAN);
        $this->settings->set('revix:logo', $request->input('revix:logo'));
        $this->settings->set('revix:customCopyright', $customCopyright);
        $this->settings->set('revix:copyright', $request->input('revix:copyright'));
        $this->settings->set('revix:isUnderMaintenance', $isUnderMaintenance);
        $this->settings->set('revix:maintenance', $request->input('revix:maintenance'));

        $this->alert->success('General settings have been updated successfully.')->flash();

        return redirect()->route('admin.revix');
    }
}