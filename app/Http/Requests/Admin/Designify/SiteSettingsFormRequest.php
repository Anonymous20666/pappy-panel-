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
            'designify:site_color' => 'required|string',
            'designify:site_title' => 'required|string',
            'designify:site_description' => 'required|string',
            'designify:site_image' => 'required|string',
            'designify:site_favicon' => 'required|string',
        ];
    }
}
