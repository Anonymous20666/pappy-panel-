<?php

namespace Pterodactyl\Http\Controllers\Admin\Revix;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Revix\LookNFeelSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class LookNFeelController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the Looks settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.revix.looks', [
            'themeSelector' => $this->settings->get('revix:themeSelector', true) ? 'true' : 'false',
            'background' => $this->settings->get('revix:background', 'none'),
            'allocationBlur' => $this->settings->get('revix:allocationBlur', true) ? 'true' : 'false',
            'radiusBox' => $this->settings->get('revix:radiusBox', '15px'),
            'radiusInput' => $this->settings->get('revix:radiusInput', '15px'),
        ]);
    }

    /**
     * Save the Looks settings.
     */
    public function store(LookNFeelSettingsFormRequest $request): RedirectResponse
    {
        $themeSelector = filter_var($request->input('revix:themeSelector'), FILTER_VALIDATE_BOOLEAN);
        $allocationBlur = filter_var($request->input('revix:allocationBlur'), FILTER_VALIDATE_BOOLEAN);

        $this->settings->set('revix:themeSelector', $themeSelector);
        $this->settings->set('revix:background', $request->input('revix:background'));
        $this->settings->set('revix:radiusBox', $request->input('revix:radiusBox'));
        $this->settings->set('revix:radiusInput', $request->input('revix:radiusInput'));
        $this->settings->set('revix:allocationBlur', $allocationBlur);

        $this->alert->success('Look & Feel settings have been updated successfully.')->flash();

        return redirect()->route('admin.revix.looks');
    }
}