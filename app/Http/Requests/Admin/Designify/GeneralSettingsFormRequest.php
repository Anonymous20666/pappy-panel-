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
            'designify:customCopyright' => 'required|in:true,false',
            'designify:copyright' => 'required|string',
            'designify:isUnderMaintenance' => 'required|in:true,false',
            'designify:maintenance' => 'required|string',
        ];
    }
}
