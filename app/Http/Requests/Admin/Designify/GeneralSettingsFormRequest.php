<?php

namespace Pterodactyl\Http\Requests\Admin\Designify;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class GeneralSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'reviactyl:logo' => 'required|string',
            'reviactyl:customCopyright' => 'required|in:true,false',
            'reviactyl:copyright' => 'required|string',
            'reviactyl:isUnderMaintenance' => 'required|in:true,false',
            'reviactyl:maintenance' => 'required|string',
        ];
    }
}
