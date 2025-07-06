@extends('layouts.revix', ['sideEditor' => true])

@section('title')
    Site Settings
@endsection

@section('content')
<form action="{{ route('admin.revix.site') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Site settings</h1>
        <p class="text-gray-400 text-sm">Change the meta content of your panel.</p>
    </div>
    <div class="flex-1 space-y-6 pb-[80px]">
    <div class="space-y-3">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="revix:site_title">
            Site Title
        </label>
        <input
            type="text" 
            id="revix:site_title" 
            name="revix:site_title" 
            value="{{ old('revix:site_title', $site_title) }}" 
            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
            placeholder="Site name to be shown on embed"
        />
    </div>
    <div class="space-y-3">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="revix:site_description">
            Site Description
        </label>
        <input
            type="text" 
            id="revix:site_description" 
            name="revix:site_description" 
            value="{{ old('revix:site_description', $site_description) }}" 
            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
            placeholder="Site description to be shown on embed"
        />
    </div>
        <div class="space-y-3">
            <label for="revix:site_image" class="block text-sm font-medium text-gray-300">
                Site Image
            </label>
            <div class="relative">
                <input
                    type="text" 
                    id="revix:site_image" 
                    name="revix:site_image" 
                    value="{{ old('revix:site_image', $site_image) }}" 
                    class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter Site Image URL or path"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-image text-gray-400 text-sm"></i>
                </div>
            </div>
        </div>
        <div class="space-y-3">
            <label for="revix:site_favicon" class="block text-sm font-medium text-gray-300">
                Site Favicon
            </label>
            <div class="relative">
                <input
                    type="text" 
                    id="revix:site_favicon" 
                    name="revix:site_favicon" 
                    value="{{ old('revix:site_favicon', $site_favicon) }}" 
                    class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter Site Favicon URL or path"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-image text-gray-400 text-sm"></i>
                </div>
            </div>
        </div>
        <div class="space-y-2">
                <label for="revix:site_color" class="block text-sm font-medium text-gray-300">Site Color</label>
                <div class="flex items-center space-x-2">
                    <input 
                        type="color" 
                        class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                        name="revix:site_color" 
                        id="revix:site_color"
                        value="{{ old('revix:site_color', $site_color) }}" 
                    />
                </div>
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