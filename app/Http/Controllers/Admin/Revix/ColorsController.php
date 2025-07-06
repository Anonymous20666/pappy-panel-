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
            'colorPrimary' => $this->settings->get('revix:colorPrimary', '#EF5C29'),
            'colorSuccess' => $this->settings->get('revix:colorSuccess', '#3D8F1F'),
            'colorDanger' => $this->settings->get('revix:colorDanger', '#8F1F20'),
            'colorSecondary' => $this->settings->get('revix:colorSecondary', '#2B2B40'),
            'color50' => $this->settings->get('revix:color50', '#F4F4F5'),
            'color100' => $this->settings->get('revix:color100', '#DEDEE2'),
            'color200' => $this->settings->get('revix:color200', '#D2D2DB'),
            'color300' => $this->settings->get('revix:color300', '#8282A4'),
            'color400' => $this->settings->get('revix:color400', '#5E5E7F'),
            'color500' => $this->settings->get('revix:color500', '#42425B'),
            'color600' => $this->settings->get('revix:color600', '#1B1B21'),
            'color700' => $this->settings->get('revix:color700', '#141416'),
            'color800' => $this->settings->get('revix:color800', '#070709'),
            'color900' => $this->settings->get('revix:color900', '#07070C'),
        ]);
    }

    /**
     * Save the colors settings.
     */
    public function store(ColorSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('revix:colorPrimary', $request->input('revix:colorPrimary'));
        $this->settings->set('revix:colorSuccess', $request->input('revix:colorSuccess'));
        $this->settings->set('revix:colorDanger', $request->input('revix:colorDanger'));
        $this->settings->set('revix:colorSecondary', $request->input('revix:colorSecondary'));
        $this->settings->set('revix:color50', $request->input('revix:color50'));
        $this->settings->set('revix:color100', $request->input('revix:color100'));
        $this->settings->set('revix:color200', $request->input('revix:color200'));
        $this->settings->set('revix:color300', $request->input('revix:color300'));
        $this->settings->set('revix:color400', $request->input('revix:color400'));
        $this->settings->set('revix:color500', $request->input('revix:color500'));
        $this->settings->set('revix:color600', $request->input('revix:color600'));
        $this->settings->set('revix:color700', $request->input('revix:color700'));
        $this->settings->set('revix:color800', $request->input('revix:color800'));
        $this->settings->set('revix:color900', $request->input('revix:color900'));

        $this->alert->success('Color settings have been updated successfully.')->flash();

        return redirect()->route('admin.revix.colors');
    }
}