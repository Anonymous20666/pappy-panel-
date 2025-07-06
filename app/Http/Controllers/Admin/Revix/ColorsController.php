<?php

namespace Pterodactyl\Http\Controllers\Admin\Revix;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Revix\ColorSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class ColorsController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the colors settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.revix.colors', [
            'primary' => $this->settings->get('revix:primary', '#EF5C29'),
            'successText' => $this->settings->get('revix:successText', '#E1FFD8'),
            'successBorder' => $this->settings->get('revix:successBorder', '#56AA2B'),
            'successBackground' => $this->settings->get('revix:successBackground', '#3D8F1F'),
            'dangerText' => $this->settings->get('revix:dangerText', '#FFD8D8'),
            'dangerBorder' => $this->settings->get('revix:dangerBorder', '#AA2A2A'),
            'dangerBackground' => $this->settings->get('revix:dangerBackground', '#8F1F20'),
            'secondaryText' => $this->settings->get('revix:secondaryText', '#D3D3DC'),
            'secondaryBorder' => $this->settings->get('revix:secondaryBorder', '#42425B'),
            'secondaryBackground' => $this->settings->get('revix:secondaryBackground', '#2B2B40'),
            'gray50' => $this->settings->get('revix:gray50', '#F4F4F5'),
            'gray100' => $this->settings->get('revix:gray100', '#DEDEE2'),
            'gray200' => $this->settings->get('revix:gray200', '#D2D2DB'),
            'gray300' => $this->settings->get('revix:gray300', '#8282A4'),
            'gray400' => $this->settings->get('revix:gray400', '#5E5E7F'),
            'gray500' => $this->settings->get('revix:gray500', '#42425B'),
            'gray600' => $this->settings->get('revix:gray600', '#1B1B21'),
            'gray700' => $this->settings->get('revix:gray700', '#141416'),
            'gray800' => $this->settings->get('revix:gray800', '#070709'),
            'gray900' => $this->settings->get('revix:gray900', '#07070C'),
        ]);
    }

    /**
     * Save the colors settings.
     */
    public function store(ColorSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('revix:primary', $request->input('revix:primary'));
        $this->settings->set('revix:successText', $request->input('revix:successText'));
        $this->settings->set('revix:successBorder', $request->input('revix:successBorder'));
        $this->settings->set('revix:successBackground', $request->input('revix:successBackground'));
        $this->settings->set('revix:dangerText', $request->input('revix:dangerText'));
        $this->settings->set('revix:dangerBorder', $request->input('revix:dangerBorder'));
        $this->settings->set('revix:dangerBackground', $request->input('revix:dangerBackground'));
        $this->settings->set('revix:secondaryText', $request->input('revix:secondaryText'));
        $this->settings->set('revix:secondaryBorder', $request->input('revix:secondaryBorder'));
        $this->settings->set('revix:secondaryBackground', $request->input('revix:secondaryBackground'));
        $this->settings->set('revix:gray50', $request->input('revix:gray50'));
        $this->settings->set('revix:gray100', $request->input('revix:gray100'));
        $this->settings->set('revix:gray200', $request->input('revix:gray200'));
        $this->settings->set('revix:gray300', $request->input('revix:gray300'));
        $this->settings->set('revix:gray400', $request->input('revix:gray400'));
        $this->settings->set('revix:gray500', $request->input('revix:gray500'));
        $this->settings->set('revix:gray600', $request->input('revix:gray600'));
        $this->settings->set('revix:gray700', $request->input('revix:gray700'));
        $this->settings->set('revix:gray800', $request->input('revix:gray800'));
        $this->settings->set('revix:gray900', $request->input('revix:gray900'));

        $this->alert->success('Color settings have been updated successfully.')->flash();

        return redirect()->route('admin.revix.colors');
    }
}