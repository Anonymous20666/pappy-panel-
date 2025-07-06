<?php

namespace Pterodactyl\Http\Requests\Admin\Revix;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class AlertSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'revix:alertType' => 'required|string',
            'revix:alertMessage' => 'required|string',
        ];
    }
}
