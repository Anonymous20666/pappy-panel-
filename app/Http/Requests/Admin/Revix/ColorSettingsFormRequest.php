<?php

namespace Pterodactyl\Http\Requests\Admin\Revix;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class ColorSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'revix:colorPrimary' => 'required|string',
            'revix:colorSuccess' => 'required|string',
            'revix:colorDanger' => 'required|string',
            'revix:colorSecondary' => 'required|string',
            'revix:color50' => 'required|string',
            'revix:color100' => 'required|string',
            'revix:color200' => 'required|string',
            'revix:color300' => 'required|string',
            'revix:color400' => 'required|string',
            'revix:color500' => 'required|string',
            'revix:color600' => 'required|string',
            'revix:color700' => 'required|string',
            'revix:color800' => 'required|string',
            'revix:color900' => 'required|string',
        ];
    }
}
