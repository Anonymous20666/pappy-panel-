<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name', 'Pterodactyl') }}</title>

        @section('meta')
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="robots" content="noindex">
            <meta name="title" content="{{ $reviactylConfiguration['site_title'] }}" />
            <meta name="description" content="{{ $reviactylConfiguration['site_description'] }}" />
            <link rel="icon" type="image/x-icon" href="{{ $reviactylConfiguration['site_favicon'] }}">
            <meta name="theme-color" content="{{ $reviactylConfiguration['site_color'] }}"/>
            <meta property="og:type" content="website" />
            <meta property="og:url" content="{{config('app.url', 'https://localhost')}}" />
            <meta property="og:title" content="{{ $reviactylConfiguration['site_title'] }}" />
            <meta property="og:description" content="{{ $reviactylConfiguration['site_description'] }}" />
            <meta property="og:image" content="{{ $reviactylConfiguration['site_image'] }}" />
        @show

        @section('user-data')
            @if(!is_null(Auth::user()))
                <script>
                    window.PterodactylUser = {!! json_encode(Auth::user()->toVueObject()) !!};
                </script>
            @endif
            @if(!empty($siteConfiguration))
                <script>
                    window.SiteConfiguration = {!! json_encode($siteConfiguration) !!};
                </script>
            @endif
            @if(!empty($reviactylConfiguration))
                <script>
                    window.ReviactylConfiguration = {!! json_encode($reviactylConfiguration) !!};
                </script>
            @endif
        @show
@php
function reviactyl($hex) {
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) === 3) {
        $r = hexdec(str_repeat($hex[0], 2));
        $g = hexdec(str_repeat($hex[1], 2));
        $b = hexdec(str_repeat($hex[2], 2));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    return "$r $g $b";
}
@endphp
        <style>
            @import url('//fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap');
            @import url('//fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:500&display=swap');
            @import url('//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            :root{
                --background:url({{ $reviactylConfiguration['background'] }});
                --radius:{{ $reviactylConfiguration['radius'] }};
                --font-family: "Poppins", sans-serif;
                --color-primary:{{ reviactyl($reviactylConfiguration['colorPrimary']) }};
                --color-success:{{ reviactyl($reviactylConfiguration['colorSuccess']) }};
                --color-danger:{{ reviactyl($reviactylConfiguration['colorDanger']) }};
                --color-secondary:{{ reviactyl($reviactylConfiguration['colorSecondary']) }};
                --color-50:{{ reviactyl($reviactylConfiguration['color50']) }};
                --color-100:{{ reviactyl($reviactylConfiguration['color100']) }};
                --color-200:{{ reviactyl($reviactylConfiguration['color200']) }};
                --color-300:{{ reviactyl($reviactylConfiguration['color300']) }};
                --color-400:{{ reviactyl($reviactylConfiguration['color400']) }};
                --color-500:{{ reviactyl($reviactylConfiguration['color500']) }};
                --color-600:{{ reviactyl($reviactylConfiguration['color600']) }};
                --color-700:{{ reviactyl($reviactylConfiguration['color700']) }};
                --color-800:{{ reviactyl($reviactylConfiguration['color800']) }};
                --color-900:{{ reviactyl($reviactylConfiguration['color900']) }};
            }
        </style>

        @yield('assets')

        @include('layouts.scripts')
    </head>
    <body class="{{ $css['body'] ?? 'bg-neutral-50' }}">
        @section('content')
            @yield('above-container')
            @yield('container')
            @yield('below-container')
        @show
        @section('scripts')
            {!! $asset->js('main.js') !!}
        @show
    </body>
</html>
