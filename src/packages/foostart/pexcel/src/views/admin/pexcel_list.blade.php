@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('sub_page_css')
    {!! HTML::style('css/admin_tuyensinh.css') !!}
@stop

@section('title')
Trang quản trị bài viết
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! $request->all() ? trans('pexcel::pexcel.page_search') : trans('pexcel::pexcel.page_list') !!}</h3>
                </div>

                <!--MESSAGE-->
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success flash-message">{!! $message !!}</div>
                @endif
                <!--MESSAGE-->

                <!--ERRORS-->
                @if($errors && ! $errors->isEmpty() )
                @foreach($errors->all() as $error)
                <div class="alert alert-danger flash-message">{!! $error !!}</div>
                @endforeach
                @endif
                <!--ERRORS-->
                <div class="panel-body">
                    @include('pexcel::admin.pexcel-message')
                    @include('pexcel::admin.pexcel_item')
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('pexcel::admin.pexcel_search')
        </div>
    </div>
</div>
@stop

@section('footer_scripts')

@section('footer_scripts')
<!-- DELETE CONFIRM -->
<script>
    $(".delete").click(function () {
        return confirm("{{ trans('pexcel::pexcel.delete_confirm') }}");
    });
</script>
<!-- /END DELETE CONFIRM -->
@stop