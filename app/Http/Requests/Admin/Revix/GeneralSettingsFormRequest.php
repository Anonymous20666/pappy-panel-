<?php

namespace Pterodactyl\Http\Requests\Admin\Revix;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class GeneralSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'revix:logo' => 'required|string',
            'revix:customCopyright' => 'required|in:true,false',
            'revix:copyright' => 'required|string',
            'revix:isUnderMaintenance' => 'required|in:true,false',
            'revix:maintenance' => 'required|string',
        ];
    }
}
