@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('post::post_admin.page_edit') }}
@stop
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <!--SAMPLE TITLE-->
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($post_category->post_category_id) ? '<i class="fa fa-pencil"></i>'.trans('post::post_admin.post_category_update') : '<i class="fa fa-users"></i>'.trans('post::post_admin.post_category_new') !!}
                    </h3>
                </div>
                <!--/END SAMPLE TITLE-->

                <!--ERRORS CATEGORY-->
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{!! $error !!}</div>
                @endforeach

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- SAMPLE CATEGORIES ID -->
                            <h4>{!! trans('post::post_admin.form_heading') !!}</h4>
                            {!! Form::open(['route'=>['admin_post_category.post', 'id' => @$post_category->post_category_id],  'files'=>true, 'method' => 'post'])  !!}

                            <!--END SAMPLE CATEGORIES ID  -->

                            <!-- SAMPLE NAME TEXT-->
                            @include('post::post_category.elements.text', ['name' => 'post_category_name'])
                            <!-- /END SAMPLE NAME TEXT -->

                            {!! Form::hidden('id',@$post_category->post_category_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_post_category.delete',['id' => @$post_category->post_category_id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">
                                Xóa
                            </a>
                            <!-- DELETE BUTTON -->

                            <!-- SAVE BUTTON -->
                            {!! Form::submit('Lưu', array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--SAMLE SEARCH-->
        <div class='col-md-4'>
            @include('post::post_category.admin.post_category_search')
        </div>
        <!--/END SAMPLE SEARCH-->
    </div>
</div>
@stop