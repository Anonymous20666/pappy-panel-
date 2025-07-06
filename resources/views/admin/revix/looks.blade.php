@extends('layouts.revix', ['sideEditor' => true])

@section('title')
    Look & Feel
@endsection

@section('content')
<form action="{{ route('admin.revix.looks') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Look & Feel</h1>
        <p class="text-gray-400 text-sm">Change the look & feel of Revix Theme.</p>
    </div>
<div class="flex-1 space-y-6 pb-[80px]">
    <div class="space-y-3">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="revix:themeSelector">
            Theme Selector
        </label>
        <select 
            name="revix:themeSelector" 
            id="revix:themeSelector"
            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
        >
            <option value="true" {{ old('revix:themeSelector', $themeSelector) === 'true' ? 'selected' : '' }}>
                Enabled
            </option>
            <option value="false" {{ old('revix:themeSelector', $themeSelector) === 'false' ? 'selected' : '' }}>
                Disabled
            </option>
        </select>
    </div>
    <div class="border-t border-gray-700"></div>
    <div class="grid grid-cols-2 gap-4">
        <p class="block text-xl font-medium text-gray-700 dark:text-gray-300">Border Settings</p><br>
        <div class="flex flex-col">
        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300" for="revix:radius">
            Border Radius
        </label>
        <input type="text" name="revix:radius" id="revix:radius" value="{{ old('revix:radius', $radius) }}"  class="px-3 py-2 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
        </div>
    </div>
    <div class="border-t border-gray-700"></div>
    <div class="space-y-3">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="revix:allocationBlur">
            Allocation Blur
        </label>
        <select 
            name="revix:allocationBlur" 
            id="revix:allocationBlur"
            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
        >
            <option value="true" {{ old('revix:allocationBlur', $allocationBlur) === 'true' ? 'selected' : '' }}>
                Enabled
            </option>
            <option value="false" {{ old('revix:allocationBlur', $allocationBlur) === 'false' ? 'selected' : '' }}>
                Disabled
            </option>
        </select>
    </div>
    <div class="border-t border-gray-700"></div>
        <div class="space-y-3">
            <label for="revix:background" class="block text-sm font-medium text-gray-300">
                Panel Background
            </label>
            <div class="relative">
                <input
                    type="text" 
                    id="revix:background" 
                    name="revix:background" 
                    value="{{ old('revix:background', $background) }}" 
                    class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter background url or 'none' to disable"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-image text-gray-400 text-sm"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500">
                Enter the URL or file path for your panel background
            </p>
        </div>
</div>

    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full max-w-4xl rounded-xl sm:border border-gray-700 pt-2 mt-6 px-4 mb-2 bg-gray-950/60">
        <div class="flex items-center justify-between pb-2">
            <div class="hidden sm:block text-sm text-gray-400">
                <i class="fas fa-info-circle mr-1"></i>
                Changes will be applied immediately after saving
            </div>
            <div class="flex items-center space-x-3">
                {!! csrf_field() !!}
                <button 
                    type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 flex items-center space-x-2"
                >
                    <i data-lucide="save" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <span class="hidden sm:block">Save changes</span>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection