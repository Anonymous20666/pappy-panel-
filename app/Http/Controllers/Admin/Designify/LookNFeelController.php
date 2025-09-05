<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\LookNFeelSettingsFormRequest;
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
        return $this->view->make('admin.designify.looks', [
            'themeSelector' => $this->settings->get('reviactyl:themeSelector', true) ? 'true' : 'false',
            'background' => $this->settings->get('reviactyl:background', 'none'),
            'allocationBlur' => $this->settings->get('reviactyl:allocationBlur', true) ? 'true' : 'false',
            'radius' => $this->settings->get('reviactyl:radius', '15px'),
        ]);
    }

    /**
     * Save the Looks settings.
     */
    public function store(LookNFeelSettingsFormRequest $request): RedirectResponse
    {
        $themeSelector = filter_var($request->input('reviactyl:themeSelector'), FILTER_VALIDATE_BOOLEAN);
        $allocationBlur = filter_var($request->input('reviactyl:allocationBlur'), FILTER_VALIDATE_BOOLEAN);

        $this->settings->set('reviactyl:themeSelector', $themeSelector);
        $this->settings->set('reviactyl:background', $request->input('reviactyl:background'));
        $this->settings->set('reviactyl:radius', $request->input('reviactyl:radius'));
        $this->settings->set('reviactyl:allocationBlur', $allocationBlur);

        $this->alert->success('Look & Feel settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.looks');
    }
}