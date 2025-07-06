<?php

namespace Pterodactyl\Http\Requests\Admin\Revix;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class SiteSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'revix:site_color' => 'required|string',
            'revix:site_title' => 'required|string',
            'revix:site_description' => 'required|string',
            'revix:site_image' => 'required|string',
            'revix:site_favicon' => 'required|string',
        ];
    }
}
