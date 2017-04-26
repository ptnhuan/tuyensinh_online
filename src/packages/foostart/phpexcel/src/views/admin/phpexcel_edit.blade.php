@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Trang quản trị thành viên theo dõi
@stop

@section('content')
@if( !empty($api) )
<div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($api->api_id) ? '<i class="fa fa-pencil"></i>'.trans('api::api_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('api::api_admin.form_add') !!}
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">

                            {!! Form::open(['route'=>['admin_api.post', 'id' => @$api->api_id],'method' => 'post'])  !!}

                                <!--INPUT-->
                                @include('api::api.elements.input', ['name' => 'api_name'])
                                <!--/END INPUT-->

                                <!--RADIO-->
                                @include('api::api.elements.radio', ['name' => 'api_name'])
                                <!--/END RADIO-->

                                <!-- SAVE BUTTON -->
                                {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                                <!-- /SAVE BUTTON -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@stop