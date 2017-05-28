@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('sub_page_css')
    {!! HTML::style('css/admin_tuyensinh.css') !!}
@stop

@section('title')
{!! trans('pnd::pnd.school_title') !!}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! $request->all() ? trans('pnd::pnd.page_school_search') : trans('pnd::pnd.page_school_list') !!}</h3>
                </div>
                <div>
                    
                    
                </div>
                
                <div style=" align-self: center">
                    <h5   >DỮ LIỆU CẤP NHẬT ĐẾN THỜI ĐIỂM <?php echo $data_update;?></h3>
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
                    @include('pnd::admin.management.pnd_statistics_level_2_item')
                </div>
            </div>
        </div>   
       <div class="col-md-4">
            @include('pnd::admin.management.pnd_statistics_level_2_search',['name_search'=>'_schools'])
        </div>
    </div>
</div>
@stop

 