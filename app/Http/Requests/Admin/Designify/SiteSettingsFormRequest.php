<?php

namespace Pterodactyl\Http\Requests\Admin\Designify;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class SiteSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'reviactyl:site_color' => 'required|string',
            'reviactyl:site_title' => 'required|string',
            'reviactyl:site_description' => 'required|string',
            'reviactyl:site_image' => 'required|string',
            'reviactyl:site_favicon' => 'required|string',
        ];
    }
}
