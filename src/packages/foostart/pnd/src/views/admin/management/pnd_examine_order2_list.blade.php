@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('sub_page_css')
    {!! HTML::style('css/admin_tuyensinh.css') !!}
@stop

@section('title')
{!! trans('pnd::pnd.school_exam_examine_order') !!}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! $request->all() ? trans('pnd::pnd.page_search') : trans('pnd::pnd.page_list') !!}</h3>
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

                    @include('pnd::admin.management.pnd_examine_order2_item')

                </div>
            </div>
        </div>

        <div class="col-md-4">
            @include('pnd::admin.management.pnd_examine_order2_filter')
        </div>
    </div>
</div>
@stop


@section('footer_scripts')
<!-- DELETE CONFIRM -->
<script>
    $(".delete").click(function () {
        return confirm("{{ trans('pnd::pnd.delete_confirm') }}");
    });
</script>
<!-- /END DELETE CONFIRM -->
@stop
