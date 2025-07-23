@extends('layouts.revix', ['sideEditor' => true])

@section('title')
    Color Settings
@endsection

@section('content')
<form action="{{ route('admin.revix.colors') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Color settings</h1>
        <p class="text-gray-400 text-sm">Change the color scheme of Revix Theme.</p>
    </div>
<div class="flex-1 space-y-6 pb-[80px]">
    <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-200 mb-1">Basic Colors</h3>              
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="revix:colorPrimary" class="block text-sm font-medium text-gray-300">Primary</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                name="revix:colorPrimary" 
                                id="revix:colorPrimary"
                                value="{{ old('revix:colorPrimary', $colorPrimary) }}" 
                            />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="revix:colorSuccess" class="block text-sm font-medium text-gray-300">Success</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                name="revix:colorSuccess" 
                                id="revix:colorSuccess"
                                value="{{ old('revix:colorSuccess', $colorSuccess) }}" 
                            />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="revix:colorDanger" class="block text-sm font-medium text-gray-300">Danger</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                name="revix:colorDanger" 
                                id="revix:colorDanger"
                                value="{{ old('revix:colorDanger', $colorDanger) }}" 
                            />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="revix:colorSecondary" class="block text-sm font-medium text-gray-300">Secondary</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                name="revix:colorSecondary" 
                                id="revix:colorSecondary"
                                value="{{ old('revix:colorSecondary', $colorSecondary) }}" 
                            />
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700"></div>
                <div>
                    <h3 class="text-lg font-bold text-gray-200 mb-1">Theme colors</h3>                   
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ([50,100,200,300,400,500,600,700,800,900] as $shade)
                        <div class="space-y-2">
                            <label for="revix:color{{ $shade }}" class="block text-sm font-medium text-gray-300">Gray {{ $shade }}</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color{{ $shade }}" 
                                    id="revix:color{{ $shade }}"
                                    value="{{ old('revix:color'.$shade, ${'color'.$shade}) }}" 
                                />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
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
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span class="hidden sm:block">Save changes</span>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection