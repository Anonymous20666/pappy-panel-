@extends('layouts.admin')
@include('partials.admin.settings.nav', ['activeTab' => 'social'])

@section('title')
    {{ trans('admin/settings.social.title') }}
@endsection

@section('content-header')
    <h1>{{ trans('admin/settings.social.title') }}<small>{{ trans('admin/settings.social.subtitle') }}</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">{{ trans('admin/navigation.home') }}</a></li>
        <li class="active">{{ trans('admin/settings.overview.title') }}</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <form action="{{ route('admin.settings.social') }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="row">
            @foreach ($drivers as $driver)
                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ ucfirst($driver) }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label">{{ trans('admin/settings.social.enabled') }}</label>
                                <div>
                                    <select name="{{ $driver }}_enabled" class="form-control">
                                        <option value="false">@lang('admin/settings.overview.disabled')</option>
                                        <option value="true" @if(old($driver . '_enabled', config('pterodactyl.auth.' . $driver . '_enabled')) == 'true') selected @endif>@lang('admin/settings.overview.enabled')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('admin/settings.social.client-id') }}</label>
                                <div>
                                    <input type="text" name="{{ $driver }}_client_id" class="form-control"
                                           value="{{ old($driver . '_client_id', config('pterodactyl.auth.' . $driver . '_client_id')) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('admin/settings.social.client-secret') }}</label>
                                <div>
                                    <input type="password" name="{{ $driver }}_client_secret" class="form-control"
                                           value="{{ old($driver . '_client_secret', config('pterodactyl.auth.' . $driver . '_client_secret')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">{{ trans('admin/settings.social.save-btn') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
