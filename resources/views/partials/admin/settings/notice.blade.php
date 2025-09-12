@section('settings::notice')
    @if(config('pterodactyl.load_environment_only', false))
        <div class="rounded-2xl bg-red-900/50 border border-red-700 text-red-200 px-4 py-3 text-sm">
            Your Panel is currently configured to read settings from the environment only.
            You will need to set <code class="font-mono text-red-300">APP_ENVIRONMENT_ONLY=false</code>
            in your environment file in order to load settings dynamically.
        </div>
    @endif
@endsection
