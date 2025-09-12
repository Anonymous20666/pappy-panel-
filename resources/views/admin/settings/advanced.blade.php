@extends('layouts.admin', ['newLayout' => true])
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    Advanced Settings
@endsection

@section('content-header')
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-zinc-100">
            Advanced Settings
        </h1>
        <p class="text-sm text-zinc-400">
            Configure advanced settings for Pterodactyl.
        </p>
    </div>
@endsection

@section('content')
    @yield('settings::nav')

    <form action="" method="POST">
        <div class="rounded-b-2xl border border-zinc-800 bg-zinc-900 shadow-sm space-y-6 p-4">
            
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 shadow-sm">
                <div class="px-5 py-3 flex items-center justify-between cursor-pointer toggle-header">
                    <h3 class="text-lg font-medium text-zinc-100">reCAPTCHA</h3>
                    <i class="fa-solid fa-angle-down text-zinc-400 transition-transform duration-200"></i>
                </div>
                <div class="toggle-content hidden border-t border-zinc-800 px-5 py-4 grid gap-6 md:grid-cols-3">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Status</label>
                        <select name="recaptcha:enabled" class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                            <option value="true">Enabled</option>
                            <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>Disabled</option>
                        </select>
                        <p class="text-xs text-zinc-500">
                            If enabled, login and reset forms will attempt a silent captcha check.
                        </p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Site Key</label>
                        <input type="text" required name="recaptcha:website_key"
                            value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}"
                            class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Secret Key</label>
                        <input type="text" required name="recaptcha:secret_key"
                            value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}"
                            class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                        <p class="text-xs text-zinc-500">
                            Used for communication with Google. Keep this private.
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 shadow-sm">
                <div class="px-5 py-3 flex items-center justify-between cursor-pointer toggle-header">
                    <h3 class="text-lg font-medium text-zinc-100">HTTP Connections</h3>
                    <i class="fa-solid fa-angle-down text-zinc-400 transition-transform duration-200"></i>
                </div>
                <div class="toggle-content hidden border-t border-zinc-800 px-5 py-4 grid gap-6 md:grid-cols-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Connection Timeout</label>
                        <input type="number" required name="pterodactyl:guzzle:connect_timeout"
                            value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}"
                            class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                        <p class="text-xs text-zinc-500">
                            Time in seconds to wait for a connection before erroring.
                        </p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Request Timeout</label>
                        <input type="number" required name="pterodactyl:guzzle:timeout"
                            value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}"
                            class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                        <p class="text-xs text-zinc-500">
                            Time in seconds to wait for a request to complete before erroring.
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 shadow-sm">
                <div class="px-5 py-3 flex items-center justify-between cursor-pointer toggle-header">
                    <h3 class="text-lg font-medium text-zinc-100">Automatic Allocation Creation</h3>
                    <i class="fa-solid fa-angle-down text-zinc-400 transition-transform duration-200"></i>
                </div>
                <div class="toggle-content hidden border-t border-zinc-800 px-5 py-4 grid gap-6 md:grid-cols-3">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Status</label>
                        <select name="pterodactyl:client_features:allocations:enabled"
                                class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                            <option value="false">Disabled</option>
                            <option value="true" @if(old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>Enabled</option>
                        </select>
                        <p class="text-xs text-zinc-500">
                            If enabled, users can create new allocations via the frontend.
                        </p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Starting Port</label>
                        <input type="number" name="pterodactyl:client_features:allocations:range_start"
                            value="{{ old('pterodactyl:client_features:allocations:range_start', config('pterodactyl.client_features.allocations.range_start')) }}"
                            class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                        <p class="text-xs text-zinc-500">
                            Starting port in the range that can be automatically allocated.
                        </p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-zinc-300">Ending Port</label>
                        <input type="number" name="pterodactyl:client_features:allocations:range_end"
                            value="{{ old('pterodactyl:client_features:allocations:range_end', config('pterodactyl.client_features.allocations.range_end')) }}"
                            class="rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-100 text-sm px-3 py-2 focus:ring-2 focus:ring-orange-500">
                        <p class="text-xs text-zinc-500">
                            Ending port in the range that can be automatically allocated.
                        </p>
                    </div>
                </div>
            </div>

        <div class="flex justify-end">
            {{ csrf_field() }}
            <button type="submit" name="_method" value="PATCH"
                    class="px-4 py-2 rounded-lg bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium shadow-sm cursor-pointer">
                <i class="fa-solid fa-floppy-disk fa-fw mr-1"></i>Save
            </button>
        </div>

        </div>
    </form>
@endsection

@section('footer-scripts')
    @parent
<script>
document.querySelectorAll('.toggle-header').forEach(header => {
    header.addEventListener('click', () => {
        const content = header.nextElementSibling;
        const icon = header.querySelector('i');

        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180'); 
    });
});
</script>
@endsection
