@extends('templates/wrapper', [
    'css' => ['body' => 'bg-neutral-900'],
])

@section('container')
    <div id="app"></div>
@endsection

@section('scripts')
    @parent
    <script>
        window.SocialLoginConfiguration = {
            google: {{ config('pterodactyl.auth.google_enabled') ? 'true' : 'false' }},
            discord: {{ config('pterodactyl.auth.discord_enabled') ? 'true' : 'false' }},
            github: {{ config('pterodactyl.auth.github_enabled') ? 'true' : 'false' }},
        };
    </script>
@endsection
