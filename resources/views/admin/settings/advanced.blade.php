@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    @lang('admin/settings.advanced.title')
@endsection

@section('content-header')
    <h1>Advanced Settings<small>Configure advanced settings for Pterodactyl.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Settings</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="" method="POST">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">reCAPTCHA</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">@lang('admin/settings.advanced.status-label')</label>
                                <div>
                                    <select class="form-control" name="recaptcha:enabled">
                                        <option value="true">@lang('admin/settings.advanced.enabled')</option>
                                        <option value="false" @if (old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>@lang('admin/settings.advanced.disabled')
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">@lang('admin/settings.advanced.key-label')</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:website_key"
                                        value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">@lang('admin/settings.advanced.secret-label')</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:secret_key"
                                        value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}">
                                </div>
                            </div>
                        </div>
                        @if ($showRecaptchaWarning)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning no-margin">
                                        {!! __('admin/settings.advanced.recaptcha-alert', ['a' => '<a href="https://www.google.com/recaptcha/admin">','aclose' => '</a>',]) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('admin/settings.advanced.http-label')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">@lang('admin/settings.advanced.timeout-label')</label>
                                <div>
                                    <input type="number" required class="form-control"
                                        name="pterodactyl:guzzle:connect_timeout"
                                        value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">@lang('admin/settings.advanced.request-label')</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:timeout"
                                        value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('admin/settings.advanced.creation-title')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">@lang('admin/settings.advanced.status-label')</label>
                                <div>
                                    <select class="form-control" name="pterodactyl:client_features:allocations:enabled">
                                        <option value="false">@lang('admin/settings.advanced.disabled')</option>
                                        <option value="true" @if (old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>@lang('admin/settings.advanced.enabled')
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">@lang('admin/settings.advanced.starting-label')</label>
                                <div>
                                    <input type="number" class="form-control"
                                        name="pterodactyl:client_features:allocations:range_start"
                                        value="{{ old('pterodactyl:client_features:allocations:range_start', config('pterodactyl.client_features.allocations.range_start')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">@lang('admin/settings.advanced.ending-label')</label>
                                <div>
                                    <input type="number" class="form-control"
                                        name="pterodactyl:client_features:allocations:range_end"
                                        value="{{ old('pterodactyl:client_features:allocations:range_end', config('pterodactyl.client_features.allocations.range_end')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH"
                            class="btn btn-sm btn-primary pull-right">@lang('admin/settings.advanced.save-btn')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
