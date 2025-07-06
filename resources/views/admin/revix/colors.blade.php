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
                <h3 class="text-lg font-bold text-gray-200 mb-1">Primary colors</h3>              
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="revix:primary" class="block text-sm font-medium text-gray-300">Theme</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                name="revix:primary" 
                                id="revix:primary"
                                value="{{ old('revix:primary', $primary) }}" 
                            />
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700"></div>
                <div>
                    <h3 class="text-lg font-bold text-gray-200 mb-1">Success colors</h3>           
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label for="revix:successText" class="block text-sm font-medium text-gray-300">Success text</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:successText" 
                                    id="revix:successText"
                                    value="{{ old('revix:successText', $successText) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:successBorder" class="block text-sm font-medium text-gray-300">Success border</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:successBorder" 
                                    id="revix:successBorder"
                                    value="{{ old('revix:successBorder', $successBorder) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:successBackground" class="block text-sm font-medium text-gray-300">Success background color</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:successBackground" 
                                    id="revix:successBackground"
                                    value="{{ old('revix:successBackground', $successBackground) }}" 
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700"></div>
                <div>
                    <h3 class="text-lg font-bold text-gray-200 mb-1">Danger colors</h3>          
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label for="revix:dangerText" class="block text-sm font-medium text-gray-300">Danger text</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:dangerText" 
                                    id="revix:dangerText"
                                    value="{{ old('revix:dangerText', $dangerText) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:dangerBorder" class="block text-sm font-medium text-gray-300">Danger border</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:dangerBorder" 
                                    id="revix:dangerBorder"
                                    value="{{ old('revix:dangerBorder', $dangerBorder) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:dangerBackground" class="block text-sm font-medium text-gray-300">Danger background color</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:dangerBackground" 
                                    id="revix:dangerBackground"
                                    value="{{ old('revix:dangerBackground', $dangerBackground) }}" 
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700"></div>
                <div>
                    <h3 class="text-lg font-bold text-gray-200 mb-1">Secondary colors</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label for="revix:secondaryText" class="block text-sm font-medium text-gray-300">Secondary text</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:secondaryText" 
                                    id="revix:secondaryText"
                                    value="{{ old('revix:secondaryText', $secondaryText) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:secondaryBorder" class="block text-sm font-medium text-gray-300">Secondary border</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:secondaryBorder" 
                                    id="revix:secondaryBorder"
                                    value="{{ old('revix:secondaryBorder', $secondaryBorder) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:secondaryBackground" class="block text-sm font-medium text-gray-300">Secondary background color</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:secondaryBackground" 
                                    id="revix:secondaryBackground"
                                    value="{{ old('revix:secondaryBackground', $secondaryBackground) }}" 
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700"></div>
                <div>
                    <h3 class="text-lg font-bold text-gray-200 mb-1">Gray colors</h3>                   
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label for="revix:gray50" class="block text-sm font-medium text-gray-300">Gray 50</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray50" 
                                    id="revix:gray50"
                                    value="{{ old('revix:gray50', $gray50) }}" 
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="revix:gray100" class="block text-sm font-medium text-gray-300">Gray 100</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray100" 
                                    id="revix:gray100"
                                    value="{{ old('revix:gray100', $gray100) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 200 -->
                        <div class="space-y-2">
                            <label for="revix:gray200" class="block text-sm font-medium text-gray-300">Gray 200</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray200" 
                                    id="revix:gray200"
                                    value="{{ old('revix:gray200', $gray200) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 300 -->
                        <div class="space-y-2">
                            <label for="revix:gray300" class="block text-sm font-medium text-gray-300">Gray 300</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray300" 
                                    id="revix:gray300"
                                    value="{{ old('revix:gray300', $gray300) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 400 -->
                        <div class="space-y-2">
                            <label for="revix:gray400" class="block text-sm font-medium text-gray-300">Gray 400</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray400" 
                                    id="revix:gray400"
                                    value="{{ old('revix:gray400', $gray400) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 500 -->
                        <div class="space-y-2">
                            <label for="revix:gray500" class="block text-sm font-medium text-gray-300">Gray 500</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray500" 
                                    id="revix:gray500"
                                    value="{{ old('revix:gray500', $gray500) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 600 -->
                        <div class="space-y-2">
                            <label for="revix:gray600" class="block text-sm font-medium text-gray-300">Gray 600</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray600" 
                                    id="revix:gray600"
                                    value="{{ old('revix:gray600', $gray600) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 700 -->
                        <div class="space-y-2">
                            <label for="revix:gray700" class="block text-sm font-medium text-gray-300">Gray 700</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray700" 
                                    id="revix:gray700"
                                    value="{{ old('revix:gray700', $gray700) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 800 -->
                        <div class="space-y-2">
                            <label for="revix:gray800" class="block text-sm font-medium text-gray-300">Gray 800</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray800" 
                                    id="revix:gray800"
                                    value="{{ old('revix:gray800', $gray800) }}" 
                                />
                            </div>
                        </div>

                        <!-- Gray 900 -->
                        <div class="space-y-2">
                            <label for="revix:gray900" class="block text-sm font-medium text-gray-300">Gray 900</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-gray-600 bg-gray-700 cursor-pointer" 
                                    name="revix:gray900" 
                                    id="revix:gray900"
                                    value="{{ old('revix:gray900', $gray900) }}" 
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