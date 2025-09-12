@extends('layouts.admin', ['newLayout' => true])

@section('title', 'Overview')

@section('content-header')
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-zinc-100">
            Administrative Overview
        </h1>
        <p class="text-sm text-zinc-400">
            A quick glance at your system.
        </p>
    </div>
@endsection

@section('content')
<div class="grid gap-6">
    <div class="rounded-2xl shadow-sm border border-zinc-800 bg-zinc-900">
        <div class="px-5 py-3 border-b border-zinc-800">
            <h3 class="text-lg font-medium text-zinc-100">System Information</h3>
        </div>
        <div class="px-5 py-4 text-sm text-zinc-300">
            @if ($version->isLatestPanel())
                <p>
                    You are running Reviactyl Panel version 
                    <code class="px-1 py-0.5 bg-zinc-800 rounded text-orange-600 font-mono">
                        {{ config('app.version') }}
                    </code>. 
                    Your panel is up-to-date!
                </p>
            @else
                <p>
                    Your panel is <span class="font-semibold text-red-600">not up-to-date!</span>  
                    The latest version is 
                    <a href="https://github.com/Pterodactyl/Panel/releases/v{{ $version->getPanel() }}" 
                       target="_blank"
                       class="text-orange-600 hover:underline font-mono">
                        {{ $version->getPanel() }}
                    </a> 
                    and you are currently running version 
                    <code class="px-1 py-0.5 bg-zinc-800 rounded text-orange-600 font-mono">
                        {{ config('app.version') }}
                    </code>.
                </p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <a href="{{ $version->getDiscord() }}" class="w-full">
            <button class="w-full flex items-center justify-center gap-2 rounded-xl px-4 py-3 text-sm font-medium bg-orange-500 text-white hover:bg-orange-600 shadow-sm">
                <i class="fa-solid fa-headset fa-fw"></i> Get Help <small>(via Discord)</small>
            </button>
        </a>
        <a href="https://docs.reviactyl.dev/" class="w-full">
            <button class="w-full flex items-center justify-center gap-2 rounded-xl px-4 py-3 text-sm font-medium bg-zinc-800 text-white hover:bg-zinc-900 shadow-sm">
                <i class="fa-solid fa-link fa-fw"></i> Documentation
            </button>
        </a>
        <a href="https://github.com/reviactyl/panel/" class="w-full">
            <button class="w-full flex items-center justify-center gap-2 rounded-xl px-4 py-3 text-sm font-medium bg-zinc-800 text-white hover:bg-zinc-900 shadow-sm">
                <i class="fa-brands fa-github fa-fw"></i> Github
            </button>
        </a>
        <a href="{{ $version->getDonations() }}" class="w-full">
            <button class="w-full flex items-center justify-center gap-2 rounded-xl px-4 py-3 text-sm font-medium bg-green-600 text-white hover:bg-green-700 shadow-sm">
                <i class="fa-solid fa-sack-dollar fa-fw"></i> Support the Project
            </button>
        </a>
    </div>
</div>
@endsection
