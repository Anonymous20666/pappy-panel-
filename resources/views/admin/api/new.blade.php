@extends('layouts.admin', ['newLayout' => true])

@section('title')
    Application API
@endsection

@section('content-header')
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-zinc-100">Application API</h1>
        <p class="text-sm text-zinc-400">Create a new application API key.</p>
    </div>
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row gap-6">
        <form method="POST" action="{{ route('admin.api.new') }}" class="flex flex-col lg:flex-row gap-6 w-full">
            <div class="flex-1">
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 shadow-sm">
                    <div class="border-b border-zinc-700 px-4 py-3">
                        <h3 class="text-lg font-medium text-zinc-200">Select Permissions</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead class="bg-zinc-800">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-zinc-300">Resource</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-zinc-300">Read</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-zinc-300">Read &amp; Write</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-zinc-300">None</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-700">
                                @foreach($resources as $resource)
                                    <tr class="hover:bg-zinc-800/50">
                                        <td class="px-4 py-2 text-sm font-medium text-zinc-200">
                                            {{ str_replace('_', ' ', title_case($resource)) }}
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <input type="radio" id="r_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['r'] }}"
                                                   class="h-4 w-4 text-zinc-600 focus:ring-zinc-500 border-zinc-700 bg-zinc-900">
                                            <label for="r_{{ $resource }}" class="ml-1 text-sm text-zinc-300">Read</label>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <input type="radio" id="rw_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['rw'] }}"
                                                   class="h-4 w-4 text-zinc-600 focus:ring-zinc-500 border-zinc-700 bg-zinc-900">
                                            <label for="rw_{{ $resource }}" class="ml-1 text-sm text-zinc-300">Read &amp; Write</label>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <input type="radio" id="n_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['n'] }}" checked
                                                   class="h-4 w-4 text-zinc-600 focus:ring-zinc-500 border-zinc-700 bg-zinc-900">
                                            <label for="n_{{ $resource }}" class="ml-1 text-sm text-zinc-300">None</label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 shadow-sm flex flex-col h-full">
                    <div class="p-4 flex-1">
                        <div class="mb-4">
                            <label for="memoField" class="block text-sm font-medium text-zinc-200">Description</label>
                            <input id="memoField" type="text" name="memo"
                                   class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                        </div>
                        <p class="text-xs text-zinc-400">
                            Once you have assigned permissions and created this set of credentials you will be unable to come back and edit it.
                            If you need to make changes down the road you will need to create a new set of credentials.
                        </p>
                    </div>
                    <div class="border-t border-zinc-700 px-4 py-3">
                        {{ csrf_field() }}
                        <button type="submit"
                                class="ml-auto inline-flex px-4 py-2 rounded-lg bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium shadow-sm cursor-pointer">
                            Create Credentials
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    </script>
@endsection
