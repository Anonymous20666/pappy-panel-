<?php

namespace Pterodactyl\Http\Controllers\Admin\Revix;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Revix\AlertSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class AlertController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the alert settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.revix.alerts', [
            'alertType' => $this->settings->get('revix:alertType', 'info'),
            'alertMessage' => $this->settings->get('revix:alertMessage', '**Welcome to Revix!** You can modify Theme Look & Feel at [Revix Editor](/admin/revix) at the administration area.'),
        ]);
    }

    /**
     * Save the alert settings.
     */
    public function store(AlertSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('revix:alertType', $request->input('revix:alertType'));
        $this->settings->set('revix:alertMessage', $request->input('revix:alertMessage'));

        $this->alert->success('Alert settings have been updated successfully.')->flash();

        return redirect()->route('admin.revix.alerts');
    }
}