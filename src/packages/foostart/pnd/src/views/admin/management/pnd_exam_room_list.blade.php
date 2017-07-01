@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('sub_page_css')
    {!! HTML::style('css/admin_tuyensinh.css') !!}
@stop

@section('title')
{!! trans('pnd::pnd.page_exam_room_list') !!}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! $request->all() ? trans('pnd::pnd.page_exam_room_list') : trans('pnd::pnd.page_exam_room_list') !!}</h3>
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
                    
                       <?php if ( $params['school_code']==9900){?>
                      @include('pnd::admin.management.pnd_exam_room_chuyen_item')
                    <?php }else{?>
                    @include('pnd::admin.management.pnd_exam_room_item')
                    <?php }?>
                    
                   
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('pnd::admin.management.pnd_exam_room_filter',['name_search'=>'_examine_point'])
            
           
            
              <?php if ( $params['school_code']==9900){?>
                 @include('pnd::admin.management.pnd_exam_room_list_chuyen_filter',['name_search'=>'_examine_point'])
                    <?php }else{?>
                @include('pnd::admin.management.pnd_exam_room_list_filter',['name_search'=>'_examine_point'])
                    <?php }?>
                    
            
            
        </div>
    </div>
</div>
@stop
    

@section('footer_scripts')
<!-- DELETE CONFIRM -->
<script>
    $(".press-room").click(function () {
        $.ajax({
            type: "GET",
            url:'{{URL::route('admin_pnd_exam_room')}}',
            success:function(){
                location.reload();
            }
            
        });
    }); 
    
  
     
</script>
<!-- /END DELETE CONFIRM -->
@stop
