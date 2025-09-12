@include('partials/admin.settings.notice')

@section('settings::nav')
    @yield('settings::notice')

    <div class="mt-4">
        <div class="rounded-t-2xl shadow-sm border border-zinc-800 bg-zinc-900 px-3 py-2">
            <nav class="-mb-px flex space-x-4" aria-label="Settings Tabs">
                <a href="{{ route('admin.settings') }}"
                   class="px-3 py-2 font-medium text-sm rounded-lg text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200
                   @if($activeTab === 'basic')
                       bg-orange-600/30
                   @endif">
                    General
                </a>
                <a href="{{ route('admin.settings.mail') }}"
                   class="px-3 py-2 font-medium text-sm rounded-lg text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200
                   @if($activeTab === 'mail')
                       bg-orange-600/30
                   @endif">
                    Mail
                </a>
                <a href="{{ route('admin.settings.advanced') }}"
                   class="px-3 py-2 font-medium text-sm rounded-lg text-orange-500 hover:bg-orange-600/30 hover:text-orange-300 transition-all duration-200
                   @if($activeTab === 'advanced')
                       bg-orange-600/30
                   @endif">
                    Advanced
                </a>
            </nav>
        </div>
    </div>
@endsection
