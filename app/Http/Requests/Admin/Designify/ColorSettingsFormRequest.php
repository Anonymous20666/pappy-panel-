<?php

namespace Pterodactyl\Http\Requests\Admin\Designify;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class ColorSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'reviactyl:colorPrimary' => 'required|string',
            'reviactyl:colorSuccess' => 'required|string',
            'reviactyl:colorDanger' => 'required|string',
            'reviactyl:colorSecondary' => 'required|string',
            'reviactyl:color50' => 'required|string',
            'reviactyl:color100' => 'required|string',
            'reviactyl:color200' => 'required|string',
            'reviactyl:color300' => 'required|string',
            'reviactyl:color400' => 'required|string',
            'reviactyl:color500' => 'required|string',
            'reviactyl:color600' => 'required|string',
            'reviactyl:color700' => 'required|string',
            'reviactyl:color800' => 'required|string',
            'reviactyl:color900' => 'required|string',

            'reviactyl:theme1:name'    => 'required|string',
            'reviactyl:theme1:colorPrimary' => 'required|string',
            'reviactyl:theme1:color50' => 'required|string',
            'reviactyl:theme1:color100'=> 'required|string',
            'reviactyl:theme1:color200'=> 'required|string',
            'reviactyl:theme1:color300'=> 'required|string',
            'reviactyl:theme1:color400'=> 'required|string',
            'reviactyl:theme1:color500'=> 'required|string',
            'reviactyl:theme1:color600'=> 'required|string',
            'reviactyl:theme1:color700'=> 'required|string',
            'reviactyl:theme1:color800'=> 'required|string',
            'reviactyl:theme1:color900'=> 'required|string',

            'reviactyl:theme2:name'    => 'required|string',
            'reviactyl:theme2:colorPrimary' => 'required|string',
            'reviactyl:theme2:color50' => 'required|string',
            'reviactyl:theme2:color100'=> 'required|string',
            'reviactyl:theme2:color200'=> 'required|string',
            'reviactyl:theme2:color300'=> 'required|string',
            'reviactyl:theme2:color400'=> 'required|string',
            'reviactyl:theme2:color500'=> 'required|string',
            'reviactyl:theme2:color600'=> 'required|string',
            'reviactyl:theme2:color700'=> 'required|string',
            'reviactyl:theme2:color800'=> 'required|string',
            'reviactyl:theme2:color900'=> 'required|string',

            'reviactyl:theme3:name'    => 'required|string',
            'reviactyl:theme3:colorPrimary' => 'required|string',
            'reviactyl:theme3:color50' => 'required|string',
            'reviactyl:theme3:color100'=> 'required|string',
            'reviactyl:theme3:color200'=> 'required|string',
            'reviactyl:theme3:color300'=> 'required|string',
            'reviactyl:theme3:color400'=> 'required|string',
            'reviactyl:theme3:color500'=> 'required|string',
            'reviactyl:theme3:color600'=> 'required|string',
            'reviactyl:theme3:color700'=> 'required|string',
            'reviactyl:theme3:color800'=> 'required|string',
            'reviactyl:theme3:color900'=> 'required|string',

            'reviactyl:theme4:name'    => 'required|string',
            'reviactyl:theme4:colorPrimary' => 'required|string',
            'reviactyl:theme4:color50' => 'required|string',
            'reviactyl:theme4:color100'=> 'required|string',
            'reviactyl:theme4:color200'=> 'required|string',
            'reviactyl:theme4:color300'=> 'required|string',
            'reviactyl:theme4:color400'=> 'required|string',
            'reviactyl:theme4:color500'=> 'required|string',
            'reviactyl:theme4:color600'=> 'required|string',
            'reviactyl:theme4:color700'=> 'required|string',
            'reviactyl:theme4:color800'=> 'required|string',
            'reviactyl:theme4:color900'=> 'required|string',

            'reviactyl:theme5:name'    => 'required|string',
            'reviactyl:theme5:colorPrimary' => 'required|string',
            'reviactyl:theme5:color50' => 'required|string',
            'reviactyl:theme5:color100'=> 'required|string',
            'reviactyl:theme5:color200'=> 'required|string',
            'reviactyl:theme5:color300'=> 'required|string',
            'reviactyl:theme5:color400'=> 'required|string',
            'reviactyl:theme5:color500'=> 'required|string',
            'reviactyl:theme5:color600'=> 'required|string',
            'reviactyl:theme5:color700'=> 'required|string',
            'reviactyl:theme5:color800'=> 'required|string',
            'reviactyl:theme5:color900'=> 'required|string',

            'reviactyl:theme6:name'    => 'required|string',
            'reviactyl:theme6:colorPrimary' => 'required|string',
            'reviactyl:theme6:color50' => 'required|string',
            'reviactyl:theme6:color100'=> 'required|string',
            'reviactyl:theme6:color200'=> 'required|string',
            'reviactyl:theme6:color300'=> 'required|string',
            'reviactyl:theme6:color400'=> 'required|string',
            'reviactyl:theme6:color500'=> 'required|string',
            'reviactyl:theme6:color600'=> 'required|string',
            'reviactyl:theme6:color700'=> 'required|string',
            'reviactyl:theme6:color800'=> 'required|string',
            'reviactyl:theme6:color900'=> 'required|string',

            'reviactyl:theme7:name'    => 'required|string',
            'reviactyl:theme7:colorPrimary' => 'required|string',
            'reviactyl:theme7:color50' => 'required|string',
            'reviactyl:theme7:color100'=> 'required|string',
            'reviactyl:theme7:color200'=> 'required|string',
            'reviactyl:theme7:color300'=> 'required|string',
            'reviactyl:theme7:color400'=> 'required|string',
            'reviactyl:theme7:color500'=> 'required|string',
            'reviactyl:theme7:color600'=> 'required|string',
            'reviactyl:theme7:color700'=> 'required|string',
            'reviactyl:theme7:color800'=> 'required|string',
            'reviactyl:theme7:color900'=> 'required|string',
        ];
    }
}
