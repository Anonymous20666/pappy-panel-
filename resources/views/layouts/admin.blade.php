@if (! empty($newLayout))
    @include('layouts.dashboard')
@else
    @include('layouts.legacy')
@endif
