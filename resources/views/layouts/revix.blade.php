<!DOCTYPE html>
<html class="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Revix Editor - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/revix/icon.png">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body id="app" class="bg-gray-950 text-gray-100 h-screen overflow-hidden">
<nav class="fixed top-0 left-0 right-0 h-20 flex items-center justify-between bg-gray-900/50 backdrop-blur-md border-b border-gray-800 p-3 md:p-4 z-50">
    <a href="{{ route('index') }}" class="flex items-center space-x-2 md:space-x-3 group">
        <div class="p-1.5 md:p-2 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg md:rounded-xl group-hover:scale-105 transition-transform duration-200">
            <img src="/revix/icon.png" alt="Revix Logo" class="h-4 w-4 md:h-6 md:w-6 filter brightness-0 invert">
        </div>
        <div class="flex flex-col">
            <span class="font-bold text-lg md:text-xl bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">Revix Editor</span>
            <span class="text-xs text-gray-400 -mt-1 hidden md:block">Release v{{ config('revix.version') }}</span>
        </div>
    </a>
    
    <div class="flex items-center space-x-2 md:space-x-6">
        <a href="https://revix.cc/discord" target="_blank" 
           class="flex items-center space-x-1 md:space-x-2 px-2 md:px-4 py-1.5 md:py-2 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/30 rounded-lg text-indigo-300 hover:text-indigo-200 transition-all duration-200">
            <i class="fa-brands fa-discord text-sm md:text-lg"></i>
            <span class="font-medium text-sm md:text-base hidden sm:inline">Discord</span>
        </a>
        <a href="{{ route('account') }}" class="flex items-center space-x-2 md:space-x-3 px-2 md:px-4 py-1.5 md:py-2 bg-gray-800/50 hover:bg-gray-700/50 border border-gray-700 rounded-lg transition-all duration-200 group">
            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=160" 
                 class="h-6 w-6 md:h-8 md:w-8 rounded-full ring-2 ring-gray-600 group-hover:ring-orange-500 transition-colors duration-200" 
                 alt="User Image">
            <div class="flex flex-col hidden md:block">
                <span class="text-sm font-medium text-gray-200">{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</span>
            </div>
        </a>
    </div>
</nav>

<div class="fixed top-20 left-0 right-0 bottom-6 flex">
    <aside class="w-16 bg-gray-900/30 backdrop-blur-md border-r border-gray-800 flex flex-col justify-between py-4 md:py-6 flex-shrink-0 z-40">
        <div class="flex flex-col space-y-3 md:space-y-4">
            <nav class="flex flex-col space-y-2 px-2">
                <a href="{{ route('admin.revix') }}" 
                   class="{{ Route::currentRouteName() !== 'admin.revix' ?: 'bg-orange-600/20 border border-orange-500/30 ring-2 ring-orange-500 bg-orange-600/30' }} group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200">
                    <i data-lucide="zap" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <span class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-100 pointer-events-none hidden md:block">
                        General Options
                    </span>
                </a>
                <a href="{{ route('admin.revix.colors') }}" 
                   class="{{ ! starts_with(Route::currentRouteName(), 'admin.revix.colors') ?: 'bg-orange-600/20 border border-orange-500/30 ring-2 ring-orange-500 bg-orange-600/30' }} group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200">
                    <i data-lucide="palette" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <span class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-100 pointer-events-none hidden md:block">
                        Color Options
                    </span>
                </a>
                <a href="{{ route('admin.revix.looks') }}" 
                   class="{{ ! starts_with(Route::currentRouteName(), 'admin.revix.looks') ?: 'bg-orange-600/20 border border-orange-500/30 ring-2 ring-orange-500 bg-orange-600/30' }} group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200">
                    <i data-lucide="sparkle" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <span class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-100 pointer-events-none hidden md:block">
                        Look 'N Feel
                    </span>
                </a>
                <a href="{{ route('admin.revix.alerts') }}" 
                   class="{{ ! starts_with(Route::currentRouteName(), 'admin.revix.alerts') ?: 'bg-orange-600/20 border border-orange-500/30 ring-2 ring-orange-500 bg-orange-600/30' }} group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200">
                    <i data-lucide="megaphone" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <span class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-100 pointer-events-none hidden md:block">
                        Alerts
                    </span>
                </a>
                <a href="{{ route('admin.revix.site') }}" 
                   class="{{ ! starts_with(Route::currentRouteName(), 'admin.revix.site') ?: 'bg-orange-600/20 border border-orange-500/30 ring-2 ring-orange-500 bg-orange-600/30' }} group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200">
                    <i data-lucide="cog" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <span class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-100 pointer-events-none hidden md:block">
                        Site Meta Settings
                    </span>
                </a>
            </nav>
        </div>
        
        <div class="flex flex-col space-y-2 px-2">
            <a href="https://docs.revix.cc" 
               class="group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl bg-gray-800/50 border border-gray-700 text-gray-400 hover:bg-gray-700/50 hover:text-gray-300 transition-all duration-200">
                <i data-lucide="book-text" class="w-4 h-4 md:w-5 md:h-5"></i>
                <div class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-50 pointer-events-none hidden md:block">
                    Documentation
                </div>
            </a>
            <a href="{{ route('admin.index') }}" 
               class="group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl bg-gray-800/50 border border-gray-700 text-gray-400 hover:bg-gray-700/50 hover:text-gray-300 transition-all duration-200">
                <i data-lucide="arrow-left" class="w-4 h-4 md:w-5 md:h-5"></i>
                <div class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-50 pointer-events-none hidden md:block">
                    Back to Admin
                </div>
            </a>
            <form action="{{ route('admin.revix.reset') }}" method="POST" onsubmit="return confirm('Are you sure you want to reset Revix settings to default?');">
                @csrf
                <button type="submit" class="group relative flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-lg md:rounded-xl bg-red-800/50 border border-red-700 text-red-400 hover:bg-red-700/50 hover:text-red-300 transition-all duration-200">
                    <i data-lucide="trash" class="w-4 h-4 md:w-5 md:h-5"></i>
                    <div class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-50 pointer-events-none hidden md:block">
                        Reset Revix to Defaults
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex overflow-hidden">
        @if($sideEditor)
            <div class="flex-1 bg-gray-900/30 backdrop-blur-md border-r border-gray-800 flex flex-col">
                <div class="flex-1 overflow-y-auto p-4 lg:p-6">
                    @if (count($errors) > 0)
                        <div class="mb-4 lg:mb-6 bg-red-900/20 border border-red-800 text-red-300 px-3 lg:px-4 py-2 lg:py-3 rounded-lg lg:rounded-xl backdrop-blur-sm">
                            <div class="flex items-center space-x-2 mb-2">
                                <i class="fas fa-exclamation-triangle text-red-400 text-sm lg:text-base"></i>
                                <p class="font-medium text-sm lg:text-base">Error</p>
                            </div>
                            <ul class="list-disc ml-5 lg:ml-6 space-y-1 text-xs lg:text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

            <div class="hidden sm:block w-auto bg-gray-900/30 backdrop-blur-md border-l border-gray-800 p-4 flex items-start justify-end">
                <div class="bg-white rounded-lg shadow-2xl resize-left overflow-hidden" style="width: 375px; height: calc(100vh - 140px); min-width: 280px; max-width: 800px;">
                    <iframe src="/" class="w-full h-full border-0" title="Preview"></iframe>
                </div>
            </div>
        @else
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <div class="max-w-7xl mx-auto">
                    @if (count($errors) > 0)
                        <div class="mb-4 lg:mb-6 bg-red-900/20 border border-red-800 text-red-300 px-4 lg:px-6 py-3 lg:py-4 rounded-xl lg:rounded-2xl backdrop-blur-sm">
                            <div class="flex items-center space-x-2 mb-2 lg:mb-3">
                                <i class="fas fa-exclamation-triangle text-red-400"></i>
                                <p class="font-medium text-base lg:text-lg">Error</p>
                            </div>
                            <ul class="list-disc ml-5 lg:ml-6 space-y-1 text-sm lg:text-base">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @foreach (Alert::getMessages() as $type => $messages)
                        @foreach ($messages as $message)
                            @php
                                $alertClass = match($type) {
                                    'danger' => 'bg-red-900/20 border-red-800 text-red-300',
                                    'success' => 'bg-green-900/20 border-green-800 text-green-300',
                                    default => 'bg-blue-900/20 border-blue-800 text-blue-300'
                                };
                                $iconClass = match($type) {
                                    'danger' => 'fas fa-times-circle text-red-400',
                                    'success' => 'fas fa-check-circle text-green-400',
                                    default => 'fas fa-info-circle text-blue-400'
                                };
                            @endphp
                            <div class="mb-4 lg:mb-6 {{ $alertClass }} border px-4 lg:px-6 py-3 lg:py-4 rounded-xl lg:rounded-2xl backdrop-blur-sm">
                                <div class="flex items-start space-x-2 lg:space-x-3">
                                    <i class="{{ $iconClass }} mt-1"></i>
                                    <div class="flex-1">{!! $message !!}</div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                    @yield('content')
                </div>
            </div>
        @endif
    </main>
</div>

@if($sideEditor)
<div class="fixed top-4 right-4 z-50 space-y-3">
    @foreach (Alert::getMessages() as $type => $messages)
        @foreach ($messages as $message)
            @php
                $alertClass = match($type) {
                    'danger' => 'bg-red-900/80 border-red-700 text-red-200',
                    'success' => 'bg-green-900/80 border-green-700 text-green-200',
                    default => 'bg-blue-900/80 border-blue-700 text-blue-200'
                };
                $iconClass = match($type) {
                    'danger' => 'fas fa-times-circle text-red-300',
                    'success' => 'fas fa-check-circle text-green-300',
                    default => 'fas fa-info-circle text-blue-300'
                };
            @endphp
            <div class="w-72 border px-4 py-3 rounded-xl shadow-lg backdrop-blur-md animate-fade-in-up {{ $alertClass }}">
                <div class="flex items-start space-x-2">
                    <i class="{{ $iconClass }} mt-1 text-sm"></i>
                    <div class="text-sm">{!! $message !!}</div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>
@endif

<footer class="fixed bottom-0 left-0 right-0 h-6 flex bg-gray-950 border-t border-gray-800 items-center justify-center text-xs text-gray-400 z-40">
    <span>&copy; Revix 2025 | Designed by DevNexLabs</span>
</footer>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>

<style>
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(15, 23, 42, 0.1);
    }
    
    ::-webkit-scrollbar-thumb {
        background: rgba(100, 116, 139, 0.4);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(100, 116, 139, 0.6);
    }
    
    .resize-left {
        resize: horizontal;
        overflow: auto;
        direction: rtl;
    }
    
    .resize-left iframe {
        direction: ltr;
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out;
    }
</style>
</body>
</html>