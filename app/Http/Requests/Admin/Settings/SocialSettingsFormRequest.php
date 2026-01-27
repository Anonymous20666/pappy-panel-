<?php

namespace App\Http\Requests\Admin\Settings;

use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\AdminFormRequest;

class SocialSettingsFormRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'google_enabled' => 'in:true,false',
            'google_client_id' => 'required_if:google_enabled,true|nullable|string',
            'google_client_secret' => 'required_if:google_enabled,true|nullable|string',

            'discord_enabled' => 'in:true,false',
            'discord_client_id' => 'required_if:discord_enabled,true|nullable|string',
            'discord_client_secret' => 'required_if:discord_enabled,true|nullable|string',

            'github_enabled' => 'in:true,false',
            'github_client_id' => 'required_if:github_enabled,true|nullable|string',
            'github_client_secret' => 'required_if:github_enabled,true|nullable|string',
        ];
    }

    /**
     * Normalize the request data to match the setting keys.
     */
    public function normalize(?array $only = null): array
    {
        $keys = [
            'google_enabled', 'google_client_id', 'google_client_secret',
            'discord_enabled', 'discord_client_id', 'discord_client_secret',
            'github_enabled', 'github_client_id', 'github_client_secret',
        ];

        $data = [];
        foreach ($keys as $key) {
            if ($this->has($key)) {
                $data[$key] = $this->input($key);
            } else {
                 $data[$key] = $this->input($key, '');
            }
        }

        return $data;
    }
}
