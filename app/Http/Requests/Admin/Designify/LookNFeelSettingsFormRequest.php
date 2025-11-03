<?php

namespace Pterodactyl\Http\Requests\Admin\Designify;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class LookNFeelSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'designify:themeSelector' => 'required|in:true,false',
            'designify:background' => 'required|string',
            'designify:allocationBlur' => 'required|in:true,false',
            'designify:radius' => 'required|string',
        ];
    }
}
