@extends('layouts.admin', ['newLayout' => true])
@include('partials/admin.settings.nav', ['activeTab' => 'mail'])

@section('title')
    Mail Settings
@endsection

@section('content-header')
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-zinc-100">
            Mail Settings
        </h1>
        <p class="text-sm text-zinc-400">
            Configure how Pterodactyl should handle sending emails.
        </p>
    </div>
@endsection

@section('content')
    <div class="mt-2">
        @yield('settings::nav')
        <div class="rounded-b-2xl border border-zinc-800 bg-zinc-900 shadow-sm">
            <div id="mail-settings" class="px-5 space-y-6">
                @if($disabled)
                    <div class="mt-4 rounded-lg bg-blue-900/40 border border-blue-800 text-blue-200 p-4 text-sm">
                        This interface is limited to instances using SMTP as the mail driver. Please either use 
                        <code class="text-blue-300">php artisan p:environment:mail</code> 
                        command to update your email settings, or set 
                        <code class="text-blue-300">MAIL_DRIVER=smtp</code> 
                        in your environment file.
                    </div>
                @else
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-zinc-200">SMTP Host</label>
                                <input required type="text" name="mail:mailers:smtp:host" value="{{ old('mail:mailers:smtp:host', config('mail.mailers.smtp.host')) }}" class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                                <p class="text-xs text-zinc-400">Enter the SMTP server address that mail should be sent through.</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-zinc-200">SMTP Port</label>
                                <input required type="number" name="mail:mailers:smtp:port" value="{{ old('mail:mailers:smtp:port', config('mail.mailers.smtp.port')) }}" class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                                <p class="text-xs text-zinc-400">Enter the SMTP server port that mail should be sent through.</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-zinc-200">Encryption</label>
                                @php $encryption = old('mail:mailers:smtp:encryption', config('mail.mailers.smtp.encryption')); @endphp
                                <select name="mail:mailers:smtp:encryption" class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                                    <option value="" @if($encryption === '') selected @endif>None</option>
                                    <option value="tls" @if($encryption === 'tls') selected @endif>TLS</option>
                                    <option value="ssl" @if($encryption === 'ssl') selected @endif>SSL</option>
                                </select>
                                <p class="text-xs text-zinc-400">Select the type of encryption to use when sending mail.</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-zinc-200">Username</label>
                                <input type="text" name="mail:mailers:smtp:username" value="{{ old('mail:mailers:smtp:username', config('mail.mailers.smtp.username')) }}" class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                                <p class="text-xs text-zinc-400">The username to use when connecting to the SMTP server.</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-zinc-200">Password</label>
                                <input type="password" name="mail:mailers:smtp:password" class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                                <p class="text-xs text-zinc-400">Leave blank to keep the existing password. To clear it, enter <code class="text-zinc-300">!e</code>.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 border-t border-zinc-800 pt-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-zinc-200">Mail From</label>
                                <input required type="email" name="mail:from:address" value="{{ old('mail:from:address', config('mail.from.address')) }}" class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                                <p class="text-xs text-zinc-400">Outgoing emails will originate from this address.</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-zinc-200">Mail From Name</label>
                                <input type="text" name="mail:from:name" value="{{ old('mail:from:name', config('mail.from.name')) }}" class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-3 py-2 text-sm text-zinc-100 placeholder-zinc-500 focus:border-orange-600 focus:ring focus:ring-orange-600/20">
                                <p class="text-xs text-zinc-400">The name emails should appear to come from.</p>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 mt-6 mb-2">
                            {{ csrf_field() }}
                            <button type="button" id="testButton" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium shadow-sm cursor-pointer">
                                <i class="fa-solid fa-paper-plane fa-fw mr-1"></i>Test
                            </button>
                            <button type="button" id="saveButton" class="px-4 py-2 rounded-lg bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium shadow-sm cursor-pointer">
                                <i class="fa-solid fa-floppy-disk fa-fw mr-1"></i>Save
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent

    <script>
        function saveSettings() {
            return $.ajax({
                method: 'PATCH',
                url: '/admin/settings/mail',
                contentType: 'application/json',
                data: JSON.stringify({
                    'mail:mailers:smtp:host': $('input[name="mail:mailers:smtp:host"]').val(),
                    'mail:mailers:smtp:port': $('input[name="mail:mailers:smtp:port"]').val(),
                    'mail:mailers:smtp:encryption': $('select[name="mail:mailers:smtp:encryption"]').val(),
                    'mail:mailers:smtp:username': $('input[name="mail:mailers:smtp:username"]').val(),
                    'mail:mailers:smtp:password': $('input[name="mail:mailers:smtp:password"]').val(),
                    'mail:from:address': $('input[name="mail:from:address"]').val(),
                    'mail:from:name': $('input[name="mail:from:name"]').val()
                }),
                headers: { 'X-CSRF-Token': $('input[name="_token"]').val() }
            }).fail(function (jqXHR) {
                showErrorDialog(jqXHR, 'save');
            });
        }

        function testSettings() {
            swal({
                type: 'info',
                title: 'Test Mail Settings',
                text: 'Click "Test" to begin the test.',
                showCancelButton: true,
                confirmButtonText: 'Test',
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    method: 'POST',
                    url: '/admin/settings/mail/test',
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                }).fail(function (jqXHR) {
                    showErrorDialog(jqXHR, 'test');
                }).done(function () {
                    swal({
                        title: 'Success',
                        text: 'The test message was sent successfully.',
                        type: 'success'
                    });
                });
            });
        }

        function saveAndTestSettings() {
            saveSettings().done(testSettings);
        }

        function showErrorDialog(jqXHR, verb) {
            console.error(jqXHR);
            var errorText = '';
            if (!jqXHR.responseJSON) {
                errorText = jqXHR.responseText;
            } else if (jqXHR.responseJSON.error) {
                errorText = jqXHR.responseJSON.error;
            } else if (jqXHR.responseJSON.errors) {
                $.each(jqXHR.responseJSON.errors, function (i, v) {
                    if (v.detail) {
                        errorText += v.detail + ' ';
                    }
                });
            }

            swal({
                title: 'Whoops!',
                text: 'An error occurred while attempting to ' + verb + ' mail settings: ' + errorText,
                type: 'error'
            });
        }

        $(document).ready(function () {
            $('#testButton').on('click', saveAndTestSettings);
            $('#saveButton').on('click', function () {
                saveSettings().done(function () {
                    swal({
                        title: 'Success',
                        text: 'Mail settings have been updated successfully and the queue worker was restarted to apply these changes.',
                        type: 'success'
                    });
                });
            });
        });
    </script>
@endsection
