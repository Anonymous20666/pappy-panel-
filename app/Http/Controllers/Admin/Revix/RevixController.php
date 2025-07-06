<?php

namespace Pterodactyl\Http\Controllers\Admin\Revix;

use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\ViewComposers\AssetComposer;

class RevixController extends Controller
{
    public function __construct(
        private AssetComposer $assetComposer,
        private AlertsMessageBag $alert,
    ) {}

    /**
     * Reset Revix theme settings to default.
     */
    public function resetToDefaults(): RedirectResponse
    {
        $this->assetComposer->resetRevixDefaults();

        $this->alert->success('All settings have been reset to defaults.')->flash();

        return redirect()->route('admin.revix');
    }
}