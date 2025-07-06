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
            <meta name="title" content="{{ $revixConfiguration['site_title'] }}" />
            <meta name="description" content="{{ $revixConfiguration['site_description'] }}" />
            <link rel="icon" type="image/x-icon" href="{{ $revixConfiguration['site_favicon'] }}">
            <meta name="theme-color" content="{{ $revixConfiguration['site_color'] }}"/>
            <meta property="og:type" content="website" />
            <meta property="og:url" content="{{config('app.url', 'https://localhost')}}" />
            <meta property="og:title" content="{{ $revixConfiguration['site_title'] }}" />
            <meta property="og:description" content="{{ $revixConfiguration['site_description'] }}" />
            <meta property="og:image" content="{{ $revixConfiguration['site_image'] }}" />
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
            @if(!empty($revixConfiguration))
                <script>
                    window.RevixConfiguration = {!! json_encode($revixConfiguration) !!};
                </script>
            @endif
        @show
@php
function revix($hex) {
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

            :root{
                --radius:{{ $revixConfiguration['radius'] }};
                --color-primary:{{ revix($revixConfiguration['colorPrimary']) }};
                --color-success:{{ revix($revixConfiguration['colorSuccess']) }};
                --color-danger:{{ revix($revixConfiguration['colorDanger']) }};
                --color-secondary:{{ revix($revixConfiguration['colorSecondary']) }};
                --color-50:{{ revix($revixConfiguration['color50']) }};
                --color-100:{{ revix($revixConfiguration['color100']) }};
                --color-200:{{ revix($revixConfiguration['color200']) }};
                --color-300:{{ revix($revixConfiguration['color300']) }};
                --color-400:{{ revix($revixConfiguration['color400']) }};
                --color-500:{{ revix($revixConfiguration['color500']) }};
                --color-600:{{ revix($revixConfiguration['color600']) }};
                --color-700:{{ revix($revixConfiguration['color700']) }};
                --color-800:{{ revix($revixConfiguration['color800']) }};
                --color-900:{{ revix($revixConfiguration['color900']) }};
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
