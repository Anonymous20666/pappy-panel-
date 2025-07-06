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
            'revix:primary' => 'required|string',
            'revix:successText' => 'required|string',
            'revix:successBorder' => 'required|string',
            'revix:successBackground' => 'required|string',
            'revix:dangerText' => 'required|string',
            'revix:dangerBorder' => 'required|string',
            'revix:dangerBackground' => 'required|string',
            'revix:secondaryText' => 'required|string',
            'revix:secondaryBorder' => 'required|string',
            'revix:secondaryBackground' => 'required|string',
            'revix:gray50' => 'required|string',
            'revix:gray100' => 'required|string',
            'revix:gray200' => 'required|string',
            'revix:gray300' => 'required|string',
            'revix:gray400' => 'required|string',
            'revix:gray500' => 'required|string',
            'revix:gray600' => 'required|string',
            'revix:gray700' => 'required|string',
            'revix:gray800' => 'required|string',
            'revix:gray900' => 'required|string',
        ];
    }
}
