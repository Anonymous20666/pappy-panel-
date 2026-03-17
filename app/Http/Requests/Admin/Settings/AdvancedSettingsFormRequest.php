<?php

namespace App\Http\Requests\Admin\Settings;

use App\Http\Requests\Admin\AdminFormRequest;

class AdvancedSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'panel:guzzle:timeout' => 'required|integer|between:1,60',
            'panel:guzzle:connect_timeout' => 'required|integer|between:1,60',
            'panel:client_features:allocations:enabled' => 'required|in:true,false',
            'panel:client_features:allocations:range_start' => [
                'nullable',
                'required_if:panel:client_features:allocations:enabled,true',
                'integer',
                'between:1024,65535',
            ],
            'panel:client_features:allocations:range_end' => [
                'nullable',
                'required_if:panel:client_features:allocations:enabled,true',
                'integer',
                'between:1024,65535',
                'gt:panel:client_features:allocations:range_start',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'captcha:provider' => 'CAPTCHA Provider',
            'captcha:recaptcha:secret_key' => 'reCAPTCHA Secret Key',
            'captcha:recaptcha:website_key' => 'reCAPTCHA Site Key',
            'captcha:turnstile:secret_key' => 'Turnstile Secret Key',
            'captcha:turnstile:site_key' => 'Turnstile Site Key',
            'panel:guzzle:timeout' => 'HTTP Request Timeout',
            'panel:guzzle:connect_timeout' => 'HTTP Connection Timeout',
            'panel:client_features:allocations:enabled' => 'Auto Create Allocations Enabled',
            'panel:client_features:allocations:range_start' => 'Starting Port',
            'panel:client_features:allocations:range_end' => 'Ending Port',
        ];
    }
}
