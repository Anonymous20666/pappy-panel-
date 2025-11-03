<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\ViewComposers\DesignifyComposer;

class DesignifyController extends Controller
{
    public function __construct(
        private DesignifyComposer $designifyComposer,
        private AlertsMessageBag $alert,
    ) {
    }

    /**
     * Reset Reviactyl theme settings to default.
     */
    public function resetToDefaults(): RedirectResponse
    {
        $this->designifyComposer->resetReviactylDefaults();

        $this->alert->success('All settings have been reset to defaults.')->flash();

        return redirect()->route('admin.designify');
    }
}
