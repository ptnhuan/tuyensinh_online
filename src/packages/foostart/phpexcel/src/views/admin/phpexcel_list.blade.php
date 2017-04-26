@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Danh sách file excel
@stop

@section('content')

<div class="row">
    <div class="col-md-12">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i>
                        Danh sách file excel
                    </h3>
                </div>

                <div class="panel-body">

                    @include('phpexcel::admin.phpexcel_item')

                    <!-- GENERATE BUTTON -->

                    <a href="{!! URL::route('admin_phpexcel.generate',['id' => @$phpexcel->phpexcel_id]) !!}" class="btn btn-info pull-right">Generate</a>

                    <!-- GENERATE BUTTON -->

                </div>


            </div>
    </div>
</div>
@stop

@section('footer_scripts')

@stop
