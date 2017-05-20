@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('sub_page_css')
    {!! HTML::style('css/admin_tuyensinh.css') !!}
@stop

@section('title')
{!! trans('pnd::pnd.school_exam_identifi') !!}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! $request->all() ? trans('pnd::pnd.page_examinepoint_search') : trans('pnd::pnd.page_examinepoint_list') !!}</h3>
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
                    @include('pnd::admin.pnd_exam_room_item')
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('pnd::admin.pnd_exam_room_filter',['name_search'=>'_examine_point'])
        </div>
    </div>
</div>
@stop


@section('footer_scripts')
<!-- DELETE CONFIRM -->
<script>
    $(".press-indentifi").click(function () {
        $.ajax({
            type: "GET",
            url:'{{URL::route('admin_pnd_examine_room')}}',
            success:function(){
                location.reload();
            }
            
        });
    });
    
  
     
</script>
<!-- /END DELETE CONFIRM -->
@stop
