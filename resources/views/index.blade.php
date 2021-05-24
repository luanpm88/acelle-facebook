@extends('layouts.backend')

@section('title', trans('awswhitelabel::messages.aws_whitelabel_plugin'))

@section('page_script')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endsection

@section('page_header')

    <div class="page-title">				
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ action("Admin\HomeController@index") }}">{{ trans('messages.home') }}</a></li>
            <li><a href="{{ action("Admin\PluginController@index") }}">{{ trans('messages.plugins') }}</a></li>
        </ul>
        <div class="d-flex align-items-center">
            <div class="mr-4">
                <img width="80px" height="80px" src="{{ $plugin->getIconUrl() ? $plugin->getIconUrl() : url('/images/plugin.svg') }}" />
            </div>
            <div>
                <h1 class="mt-0 mb-2">
                    {{ $plugin->title }}
                </h1>
                <p class="mb-1">
                    {{ $plugin->description }}
                </p>
                <div class="text-muted">
                    {{ trans('messages.version') }}: {{ $plugin->version }}
                </div>
            </div>		
        </div>		
    </div>

@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-6">
            <form style="float:left" method="POST">
                @csrf

                <p>
                    {{ trans('facebook::messages.connection.wording') }}
                </p>
                <div class="row mb-4">
                    <div class="col-md-12 pr-0 form-groups-bottom-0">
                        @include('helpers.form_control', [
                            'type' => 'text',
                            'class' => '',
                            'label' => 'APP ID',
                            'name' => 'app_id',
                            'value' => isset($data['app_id']) ? $data['app_id'] : null,
                            'help_class' => 'app_id',
                            'rules' => ['app_id' => 'required']
                        ])
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12 pr-0 form-groups-bottom-0">
                        @include('helpers.form_control', [
                            'type' => 'text',
                            'class' => '',
                            'label' => 'APP SECRET',
                            'name' => 'app_secret',
                            'value' => isset($data['app_secret']) ? $data['app_secret'] : null,
                            'help_class' => 'app_secret',
                            'rules' => ['app_secret' => 'required']
                        ])
                    </div>
                </div>
                <div class="">
                    <input class="btn btn-mc_primary mt-4" type="submit"
                        formaction="{{ action('\Acelle\Plugin\Facebook\Controllers\MainController@activate') }}"
                        value="Save">
                </div>
            
        </div>
    </div>
@endsection
