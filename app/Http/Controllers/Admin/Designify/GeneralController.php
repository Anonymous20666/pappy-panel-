<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\GeneralSettingsFormRequest;
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
        return $this->view->make('admin.designify.general', [
            'logo' => $this->settings->get('reviactyl:logo', '/reviactyl/logo.png'),
            'customCopyright' => $this->settings->get('reviactyl:customCopyright', true) ? 'true' : 'false',
            'copyright' => $this->settings->get('reviactyl:copyright', 'Powered by [Reviactyl](https://revix.cc)'),
            'isUnderMaintenance' => $this->settings->get('reviactyl:isUnderMaintenance', false) ? 'true' : 'false',
            'maintenance' => $this->settings->get('reviactyl:maintenance', 'We are currently under maintenance. Kindly check back later!'),
        ]);
    }

    /**
     * Save the general settings.
     */
    public function store(GeneralSettingsFormRequest $request): RedirectResponse
    {   
        $customCopyright = filter_var($request->input('reviactyl:customCopyright'), FILTER_VALIDATE_BOOLEAN);
        $isUnderMaintenance = filter_var($request->input('reviactyl:isUnderMaintenance'), FILTER_VALIDATE_BOOLEAN);
        $this->settings->set('reviactyl:logo', $request->input('reviactyl:logo'));
        $this->settings->set('reviactyl:customCopyright', $customCopyright);
        $this->settings->set('reviactyl:copyright', $request->input('reviactyl:copyright'));
        $this->settings->set('reviactyl:isUnderMaintenance', $isUnderMaintenance);
        $this->settings->set('reviactyl:maintenance', $request->input('reviactyl:maintenance'));

        $this->alert->success('General settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.general');
    }
}