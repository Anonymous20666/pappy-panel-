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
            'reviactyl:themeSelector' => 'required|in:true,false',
            'reviactyl:background' => 'required|string',
            'reviactyl:allocationBlur' => 'required|in:true,false',
            'reviactyl:radius' => 'required|string',
        ];
    }
}
