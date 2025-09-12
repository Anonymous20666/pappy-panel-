@extends('layouts.admin', ['newLayout' => true])
@include('partials/admin.settings.nav', ['activeTab' => 'basic'])

@section('title')
    Settings
@endsection

@section('content-header')
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-zinc-100">
            Panel Settings
        </h1>
        <p class="text-sm text-zinc-400">
            Configure Pterodactyl to your liking.
        </p>
    </div>
@endsection

@section('content')
    <div class="mt-2">
        @yield('settings::nav')
        <div class="rounded-b-2xl border border-zinc-800 bg-zinc-900 shadow-sm">
            <form action="{{ route('admin.settings') }}" method="POST" class="px-5 py-4 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-zinc-200">Company Name</label>
                        <input type="text" name="app:name" value="{{ old('app:name', config('app.name')) }}"
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20" />
                        <p class="text-xs text-zinc-400">
                            This is the name that is used throughout the panel and in emails sent to clients.
                        </p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-zinc-200">Require 2-Factor Authentication</label>
                        @php
                            $level = old('pterodactyl:auth:2fa_required', config('pterodactyl.auth.2fa_required'));
                        @endphp

                        <div class="flex gap-2">
                            <div>
                                <input type="radio" name="pterodactyl:auth:2fa_required" value="0" id="req-0"
                                    class="hidden peer" @checked($level == 0)>
                                <label for="req-0"
                                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm cursor-pointer
                       bg-zinc-800 text-zinc-300 hover:bg-orange-700
                       peer-checked:bg-orange-600 peer-checked:text-white">
                                    Not Required
                                </label>
                            </div>

                            <div>
                                <input type="radio" name="pterodactyl:auth:2fa_required" value="1" id="req-1"
                                    class="hidden peer" @checked($level == 1)>
                                <label for="req-1"
                                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm cursor-pointer
                       bg-zinc-800 text-zinc-300 hover:bg-orange-700
                       peer-checked:bg-orange-600 peer-checked:text-white">
                                    Admin Only
                                </label>
                            </div>

                            <div>
                                <input type="radio" name="pterodactyl:auth:2fa_required" value="2" id="req-2"
                                    class="hidden peer" @checked($level == 2)>
                                <label for="req-2"
                                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm cursor-pointer
                       bg-zinc-800 text-zinc-300 hover:bg-orange-700
                       peer-checked:bg-orange-600 peer-checked:text-white">
                                    All Users
                                </label>
                            </div>
                        </div>

                        <p class="text-xs text-zinc-400">
                            If enabled, any account falling into the selected grouping will be required to have 2-Factor
                            authentication enabled to use the Panel.
                        </p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-zinc-200">Default Language</label>
                        <select name="app:locale"
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                            @foreach ($languages as $key => $value)
                                <option value="{{ $key }}" @if (config('app.locale') === $key) selected @endif>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-zinc-400">
                            The default language to use when rendering UI components.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end border-t border-zinc-800 pt-4">
                    {!! csrf_field() !!}
                    <button type="submit" name="_method" value="PATCH"
                        class="rounded-lg bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring focus:ring-orange-600/20 cursor-pointer">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
