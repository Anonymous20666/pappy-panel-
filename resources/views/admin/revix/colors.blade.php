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
                        <div class="space-y-2">
                            <label for="revix:color50" class="block text-sm font-medium text-gray-300">Gray 50</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color50" 
                                    id="revix:color50"
                                    value="{{ old('revix:color50', $color50) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:color100" class="block text-sm font-medium text-gray-300">Gray 100</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color100" 
                                    id="revix:color100"
                                    value="{{ old('revix:color100', $color100) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 200 -->
                        <div class="space-y-2">
                            <label for="revix:color200" class="block text-sm font-medium text-gray-300">Gray 200</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color200" 
                                    id="revix:color200"
                                    value="{{ old('revix:color200', $color200) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 300 -->
                        <div class="space-y-2">
                            <label for="revix:color300" class="block text-sm font-medium text-gray-300">Gray 300</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color300" 
                                    id="revix:color300"
                                    value="{{ old('revix:color300', $color300) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 400 -->
                        <div class="space-y-2">
                            <label for="revix:color400" class="block text-sm font-medium text-gray-300">Gray 400</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color400" 
                                    id="revix:color400"
                                    value="{{ old('revix:color400', $color400) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 500 -->
                        <div class="space-y-2">
                            <label for="revix:color500" class="block text-sm font-medium text-gray-300">Gray 500</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color500" 
                                    id="revix:color500"
                                    value="{{ old('revix:color500', $color500) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 600 -->
                        <div class="space-y-2">
                            <label for="revix:color600" class="block text-sm font-medium text-gray-300">Gray 600</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color600" 
                                    id="revix:color600"
                                    value="{{ old('revix:color600', $color600) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 700 -->
                        <div class="space-y-2">
                            <label for="revix:color700" class="block text-sm font-medium text-gray-300">Gray 700</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color700" 
                                    id="revix:color700"
                                    value="{{ old('revix:color700', $color700) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 800 -->
                        <div class="space-y-2">
                            <label for="revix:color800" class="block text-sm font-medium text-gray-300">Gray 800</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color800" 
                                    id="revix:color800"
                                    value="{{ old('revix:color800', $color800) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 900 -->
                        <div class="space-y-2">
                            <label for="revix:color900" class="block text-sm font-medium text-gray-300">Gray 900</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:color900" 
                                    id="revix:color900"
                                    value="{{ old('revix:color900', $color900) }}" 
                                />
                            </div>
                        </div>
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
                    <i data-lucide="save" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <span class="hidden sm:block">Save changes</span>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection