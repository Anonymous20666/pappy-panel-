@extends('layouts.designify', ['sideContent' => true])

@section('title')
    Site Settings
@endsection

@section('content')
<form action="{{ route('admin.designify.site') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Site settings</h1>
        <p class="text-zinc-400 text-sm">Change the meta content of your panel.</p>
    </div>
    <div class="flex-1 space-y-6 pb-[80px]">
    <div class="space-y-3">
        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="reviactyl:site_title">
            Site Title
        </label>
        <input
            type="text" 
            id="reviactyl:site_title" 
            name="reviactyl:site_title" 
            value="{{ old('reviactyl:site_title', $site_title) }}" 
            class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
            placeholder="Site name to be shown on embed"
        />
    </div>
    <div class="space-y-3">
        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="reviactyl:site_description">
            Site Description
        </label>
        <input
            type="text" 
            id="reviactyl:site_description" 
            name="reviactyl:site_description" 
            value="{{ old('reviactyl:site_description', $site_description) }}" 
            class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
            placeholder="Site description to be shown on embed"
        />
    </div>
        <div class="space-y-3">
            <label for="reviactyl:site_image" class="block text-sm font-medium text-zinc-300">
                Site Image
            </label>
            <div class="relative">
                <input
                    type="text" 
                    id="reviactyl:site_image" 
                    name="reviactyl:site_image" 
                    value="{{ old('reviactyl:site_image', $site_image) }}" 
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter Site Image URL or path"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-image text-zinc-400 text-sm"></i>
                </div>
            </div>
        </div>
        <div class="space-y-3">
            <label for="reviactyl:site_favicon" class="block text-sm font-medium text-zinc-300">
                Site Favicon
            </label>
            <div class="relative">
                <input
                    type="text" 
                    id="reviactyl:site_favicon" 
                    name="reviactyl:site_favicon" 
                    value="{{ old('reviactyl:site_favicon', $site_favicon) }}" 
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter Site Favicon URL or path"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-image text-zinc-400 text-sm"></i>
                </div>
            </div>
        </div>
        <div class="space-y-2">
                <label for="reviactyl:site_color" class="block text-sm font-medium text-zinc-300">Site Color</label>
                <div class="flex items-center space-x-2">
                    <input 
                        type="color" 
                        class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer" 
                        name="reviactyl:site_color" 
                        id="reviactyl:site_color"
                        value="{{ old('reviactyl:site_color', $site_color) }}" 
                    />
                </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[612px] rounded-xl sm:border border-zinc-700 bg-zinc-950/60 pt-2 mt-6 px-4 mb-2">
        <div class="flex items-center justify-between pb-2">
            <div class="hidden sm:block text-sm text-zinc-400">
                <i class="fas fa-info-circle mr-1"></i>
                Changes will be applied immediately after saving
            </div>
            <div class="flex items-center space-x-3">
                {!! csrf_field() !!}
                <button 
                    type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 flex items-center space-x-2"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span class="hidden sm:block">Save changes</span>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('sidecontent')
<span class="font-bold">Discord Preview:</span>
<div class="border border-zinc-600 p-4 max-w-xl rounded-lg text-white font-sans">

  <p class="text-sky-400 hover:underline text-sm block mb-2">
    {{ config('app.url') }}/auth/login
  </p>

  <div class="bg-[#2b2d31] rounded-md border-l-4 border-[{{ old('reviactyl:site_color', $site_color) }}] rounded-r-md p-3">
    <h2 class="text-sky-400 text-sm font-semibold mb-1">{{ old('reviactyl:site_title', $site_title) }}</h2>
    <p class="text-sm text-gray-200 mb-3">{{ old('reviactyl:site_description', $site_description) }}</p>
    <div class="flex items-center space-x-3">
      <img src="{{ old('reviactyl:site_image', $site_image) }}" alt="site image" class="w-auto h-20 rounded-md" />
    </div>
  </div>
</div>

@endsection
