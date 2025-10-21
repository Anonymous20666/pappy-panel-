@extends('layouts.designify', ['sideEditor' => true])

@section('title')
    Look & Feel
@endsection

@section('content')
    <form action="{{ route('admin.designify.looks') }}" method="POST" class="h-full flex flex-col">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-white mb-2">Look & Feel</h1>
            <p class="text-zinc-400 text-sm">Change the look & feel of Reviactyl Theme.</p>
        </div>
        <div class="flex-1 space-y-6 pb-[80px]">
            <div class="space-y-3">
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="reviactyl:themeSelector">
                    Theme Selector
                </label>
                <select name="reviactyl:themeSelector" id="reviactyl:themeSelector"
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="true"
                        {{ old('reviactyl:themeSelector', $themeSelector) === 'true' ? 'selected' : '' }}>
                        Enabled
                    </option>
                    <option value="false"
                        {{ old('reviactyl:themeSelector', $themeSelector) === 'false' ? 'selected' : '' }}>
                        Disabled
                    </option>
                </select>
            </div>
            <div class="border-t border-zinc-700"></div>
            <div class="grid grid-cols-2 gap-4">
                <p class="block text-xl font-medium text-zinc-700 dark:text-zinc-300">Border Settings</p><br>
                <div class="flex flex-col">
                    <label class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="reviactyl:radius">
                        Border Radius
                    </label>
                    <input type="text" name="reviactyl:radius" id="reviactyl:radius"
                        value="{{ old('reviactyl:radius', $radius) }}"
                        class="px-3 py-2 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                </div>
            </div>
            <div class="border-t border-zinc-700"></div>
            <div class="space-y-3">
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="reviactyl:allocationBlur">
                    Allocation Blur
                </label>
                <select name="reviactyl:allocationBlur" id="reviactyl:allocationBlur"
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="true"
                        {{ old('reviactyl:allocationBlur', $allocationBlur) === 'true' ? 'selected' : '' }}>
                        Enabled
                    </option>
                    <option value="false"
                        {{ old('reviactyl:allocationBlur', $allocationBlur) === 'false' ? 'selected' : '' }}>
                        Disabled
                    </option>
                </select>
            </div>
            <div class="border-t border-zinc-700"></div>
            <div class="space-y-3">
                <label for="reviactyl:background" class="block text-sm font-medium text-zinc-300">
                    Panel Background
                </label>
                <div class="relative">
                    <input type="text" id="reviactyl:background" name="reviactyl:background"
                        value="{{ old('reviactyl:background', $background) }}"
                        class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Enter background url or 'none' to disable" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fas fa-image text-zinc-400 text-sm"></i>
                    </div>
                </div>
                <p class="text-xs text-zinc-500">
                    Enter the URL or file path for your panel background
                </p>
            </div>
        </div>

        @include('partials/admin.designify.save')
    </form>
@endsection
