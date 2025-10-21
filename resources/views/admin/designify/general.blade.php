@extends('layouts.designify', ['sideEditor' => true])

@section('title')
    General Settings
@endsection

@section('content')
    <form action="{{ route('admin.designify.general') }}" method="POST" class="h-full flex flex-col">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-white mb-2">General settings</h1>
            <p class="text-zinc-400 text-sm">Change the general settings of Reviactyl Theme.</p>
        </div>
        <div class="flex-1 space-y-6">
            <div class="space-y-3">
                <label for="reviactyl:logo" class="block text-sm font-medium text-zinc-300">
                    Panel logo
                </label>
                <div class="relative">
                    <input type="text" id="reviactyl:logo" name="reviactyl:logo"
                        value="{{ old('reviactyl:logo', $logo) }}"
                        class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Enter logo URL or path" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fas fa-image text-zinc-400 text-sm"></i>
                    </div>
                </div>
                <p class="text-xs text-zinc-500">
                    Enter the URL or file path for your panel logo
                </p>
            </div>
            <div class="space-y-3">
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="reviactyl:customCopyright">
                    Custom Copyright
                </label>
                <select name="reviactyl:customCopyright" id="reviactyl:customCopyright"
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="true"
                        {{ old('reviactyl:customCopyright', $customCopyright) === 'true' ? 'selected' : '' }}>
                        Enabled
                    </option>
                    <option value="false"
                        {{ old('reviactyl:customCopyright', $customCopyright) === 'false' ? 'selected' : '' }}>
                        Disabled
                    </option>
                </select>
                <input type="text" id="reviactyl:copyright" name="reviactyl:copyright"
                    value="{{ old('reviactyl:copyright', $copyright) }}"
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Powered by [Reviactyl](https://revix.cc)" />
            </div>
            <div class="space-y-3 !mb-20">
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300"
                    for="reviactyl:isUnderMaintenance">
                    Maintenance
                </label>
                <select name="reviactyl:isUnderMaintenance" id="reviactyl:isUnderMaintenance"
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="true"
                        {{ old('reviactyl:isUnderMaintenance', $isUnderMaintenance) === 'true' ? 'selected' : '' }}>
                        Enabled
                    </option>
                    <option value="false"
                        {{ old('reviactyl:isUnderMaintenance', $isUnderMaintenance) === 'false' ? 'selected' : '' }}>
                        Disabled
                    </option>
                </select>
                <input type="text" id="reviactyl:maintenance" name="reviactyl:maintenance"
                    value="{{ old('reviactyl:maintenance', $maintenance) }}"
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Maintenance description." />
            </div>
        </div>
        @include('partials/admin.designify.save')
    </form>
@endsection
