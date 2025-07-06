<?php

namespace Pterodactyl\Http\Requests\Admin\Revix;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class LookNFeelSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'revix:themeSelector' => 'required|in:true,false',
            'revix:background' => 'required|string',
            'revix:allocationBlur' => 'required|in:true,false',
            'revix:radius' => 'required|string',
        ];
    }
}
