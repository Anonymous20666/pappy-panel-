@extends('layouts.admin', ['newLayout' => true])

@section('title')
    Application API
@endsection

@section('content-header')
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-zinc-100">
            Application API
        </h1>
        <p class="text-sm text-zinc-400">
            Control access credentials for managing this Panel via the API.
        </p>
    </div>
@endsection

@section('content')
    <div class="w-full">
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 shadow-sm">
            <div class="flex items-center justify-between border-b border-zinc-700 px-4 py-3">
                <h3 class="text-lg font-medium text-zinc-200">Credentials List</h3>
                <a href="{{ route('admin.api.new') }}"
                   class="px-4 py-2 rounded-lg bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium shadow-sm cursor-pointer">
                    Create New
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-zinc-800">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-zinc-300">Key</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-zinc-300">Description</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-zinc-300">Last Used</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-zinc-300">Created</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-700">
                        @foreach($keys as $key)
                            <tr class="hover:bg-zinc-800/50">
                                <td class="px-4 py-2 font-mono text-sm text-zinc-300 blur-xs hover:blur-none transition duration-300">
                                    {{ $key->identifier }}{{ decrypt($key->token) }}
                                </td>
                                <td class="px-4 py-2 text-sm text-zinc-400">{{ $key->memo }}</td>
                                <td class="px-4 py-2 text-sm text-zinc-400">
                                    @if(!is_null($key->last_used_at))
                                        @datetimeHuman($key->last_used_at)
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-zinc-400">@datetimeHuman($key->created_at)</td>
                                <td class="px-4 py-2 text-right">
                                    <a href="#"
                                       data-action="revoke-key"
                                       data-attr="{{ $key->identifier }}"
                                       class="text-red-500 hover:text-red-400">
                                        <i class="fa-solid fa-trash fa-fw"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('[data-action="revoke-key"]').click(function (event) {
                var self = $(this);
                event.preventDefault();
                swal({
                    type: 'error',
                    title: 'Revoke API Key',
                    text: 'Once this API key is revoked any applications currently using it will stop working.',
                    showCancelButton: true,
                    allowOutsideClick: true,
                    closeOnConfirm: false,
                    confirmButtonText: 'Revoke',
                    confirmButtonColor: '#ef4444',
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        method: 'DELETE',
                        url: '/admin/api/revoke/' + self.data('attr'),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).done(function () {
                        swal({
                            type: 'success',
                            title: '',
                            text: 'API Key has been revoked.'
                        });
                        self.closest('tr').remove();
                    }).fail(function (jqXHR) {
                        console.error(jqXHR);
                        swal({
                            type: 'error',
                            title: 'Whoops!',
                            text: 'An error occurred while attempting to revoke this key.'
                        });
                    });
                });
            });
        });
    </script>
@endsection
