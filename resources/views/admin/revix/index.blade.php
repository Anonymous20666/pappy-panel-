@extends('layouts.revix', ['sideEditor' => true])

@section('title')
    General Settings
@endsection

@section('content')
<form action="{{ route('admin.revix') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">General settings</h1>
        <p class="text-gray-400 text-sm">Change the general settings of Revix Theme.</p>
    </div>
    <div class="flex-1 space-y-6">
        <div class="space-y-3">
            <label for="revix:logo" class="block text-sm font-medium text-gray-300">
                Panel logo
            </label>
            <div class="relative">
                <input
                    type="text" 
                    id="revix:logo" 
                    name="revix:logo" 
                    value="{{ old('revix:logo', $logo) }}" 
                    class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter logo URL or path"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-image text-gray-400 text-sm"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500">
                Enter the URL or file path for your panel logo
            </p>
        </div>
    <div class="space-y-3">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="revix:customCopyright">
            Custom Copyright
        </label>
        <select 
            name="revix:customCopyright" 
            id="revix:customCopyright"
            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
        >
            <option value="true" {{ old('revix:customCopyright', $customCopyright) === 'true' ? 'selected' : '' }}>
                Enabled
            </option>
            <option value="false" {{ old('revix:customCopyright', $customCopyright) === 'false' ? 'selected' : '' }}>
                Disabled
            </option>
        </select>
                <input
                    type="text" 
                    id="revix:copyright" 
                    name="revix:copyright" 
                    value="{{ old('revix:copyright', $copyright) }}" 
                    class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Powered by [Revix](https://revix.cc)"
                />
    </div>
    </div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full max-w-4xl rounded-xl sm:border border-gray-700 bg-gray-950/60 pt-2 mt-6 px-4 mb-2">
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