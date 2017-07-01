@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    {{trans('pexcel::pexcel.pexcel_title')}}
@stop

@section('sub_page_css')
    {!! HTML::style('css/admin_tuyensinh.css') !!}
    {!! HTML::style('css/jquery-ui.1-12-1.css') !!}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        <i class="fa fa-group"></i>
                        {!! $request->all() ? trans('pexcel::pexcel.page_search') : trans('pexcel::pexcel.page_listu') !!}
                    </h3>
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
                    @if($request->all())
                        @include('pexcel::admin.pexcel-message-search')
                    @else
                        @include('pexcel::admin.pexcel-message')
                    @endif
                    @include('pexcel::admin.update_pexcel_item')
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
    <!-- DELETE CONFIRM -->
        <script>
            $(".delete").click(function () {
                return confirm("{{ trans('pexcel::pexcel.delete_confirm') }}");
            });
        </script>
    <!-- /END DELETE CONFIRM -->
@stop