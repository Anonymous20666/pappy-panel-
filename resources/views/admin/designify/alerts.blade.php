@extends('layouts.designify', ['sideEditor' => true])

@section('title')
    Alert Settings
@endsection

@section('content')
<form action="{{ route('admin.designify.alerts') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Alert settings</h1>
        <p class="text-zinc-400 text-sm">Change the alert settings of Reviactyl Theme.</p>
    </div>
    <div class="flex-1 space-y-6">
    <div class="space-y-3">
        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="reviactyl:alertType">
            Alert Type
        </label>
        <select 
            name="reviactyl:alertType" 
            id="reviactyl:alertType"
            class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
        >
            <option value="info" {{ old('reviactyl:alertType', $alertType) === 'info' ? 'selected' : '' }}>
                Info
            </option>
            <option value="announcement" {{ old('reviactyl:alertType', $alertType) === 'announcement' ? 'selected' : '' }}>
                Announcement
            </option>
            <option value="success" {{ old('reviactyl:alertType', $alertType) === 'success' ? 'selected' : '' }}>
                Success
            </option>
            <option value="warning" {{ old('reviactyl:alertType', $alertType) === 'warning' ? 'selected' : '' }}>
                Warning
            </option>
            <option value="danger" {{ old('reviactyl:alertType', $alertType) === 'danger' ? 'selected' : '' }}>
                Danger
            </option>
            <option value="disabled" {{ old('reviactyl:alertType', $alertType) === 'disabled' ? 'selected' : '' }}>
                Disabled
            </option>
        </select>
                <input
                    type="text" 
                    id="reviactyl:alertMessage" 
                    name="reviactyl:alertMessage" 
                    value="{{ old('reviactyl:alertMessage', $alertMessage) }}" 
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="**bold** [link](https://revix.cc)"
                />
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