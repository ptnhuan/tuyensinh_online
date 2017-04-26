@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Trang quản trị thành viên theo dõi
@stop

@section('content')
@if( !empty($phpexcel) )
<div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($phpexcel->phpexcel_id) ? '<i class="fa fa-pencil"></i>'.trans('phpexcel::phpexcel_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('phpexcel::phpexcel_admin.form_add') !!}
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">

                            {!! Form::open(['route'=>['admin_phpexcel.post', 'id' => @$phpexcel->phpexcel_id],'method' => 'post'])  !!}

                            <!--INPUT-->
                            @include('phpexcel::elements.input', ['name' => 'phpexcel_name'])
                            <!--/END INPUT-->

                            <!--FILE EXCEL-->
                            <div class="form-group">
                                {!! Form::label('Upload file excel') !!}
                                {!! Form::file('phpexcel', null) !!}
                            </div>
                            <!--/END FILEXCEL-->

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