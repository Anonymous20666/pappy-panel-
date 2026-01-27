<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use App\Http\Controllers\Controller;
use App\Contracts\Repository\SettingsRepositoryInterface;
use App\Http\Requests\Admin\Settings\SocialSettingsFormRequest;

use App\Providers\SettingsServiceProvider;
use Illuminate\Contracts\Encryption\Encrypter;

class SocialController extends Controller
{
    /**
     * @var \Prologue\Alerts\AlertsMessageBag
     */
    private $alert;

    /**
     * @var \App\Contracts\Repository\SettingsRepositoryInterface
     */
    private $settings;

    /**
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    private $encrypter;

    /**
     * SocialController constructor.
     */
    public function __construct(
        AlertsMessageBag $alert,
        SettingsRepositoryInterface $settings,
        Encrypter $encrypter
    ) {
        $this->alert = $alert;
        $this->settings = $settings;
        $this->encrypter = $encrypter;
    }

    /**
     * Render the UI for social login settings.
     */
    public function index(): View
    {
        return view('admin.settings.social', [
            'drivers' => ['google', 'discord', 'github'],
        ]);
    }

    /**
     * Handle a request to update the social login settings.
     *
     * @throws \App\Exceptions\Model\DataValidationException
     * @throws \App\Exceptions\Repository\RecordNotFoundException
     */
    public function update(SocialSettingsFormRequest $request): RedirectResponse
    {
        foreach ($request->normalize() as $key => $value) {
            $settingKey = 'pterodactyl:auth:' . $key;

            if (in_array($settingKey, SettingsServiceProvider::getEncryptedKeys()) && !empty($value)) {
                $value = $this->encrypter->encrypt($value);
            }

            $this->settings->set('settings::' . $settingKey, $value);
        }

        $this->alert->success(trans('admin/settings.social.success'))->flash();

        return redirect()->route('admin.settings.social');
    }
}
