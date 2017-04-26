@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('phpexcel::phpexcel_admin.page_edit') }}
@stop
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <!--phpexcel TITLE-->
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($phpexcel_category->phpexcel_category_id) ? '<i class="fa fa-pencil"></i>'.trans('phpexcel::phpexcel_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('phpexcel::phpexcel_admin.form_add') !!}
                    </h3>
                </div>
                <!--/END phpexcel TITLE-->

                <!-- ERRORS NAME  -->
                {{-- model general errors from the form --}}
                @if($errors->has('phpexcel_category_name') )
                    <div class="alert alert-danger">{!! $errors->first('phpexcel_category_name') !!}</div>
                @endif
                <!-- /END ERROR NAME -->

                <!-- LENGTH NAME  -->
                @if($errors->has('name_unvalid_length') )
                    <div class="alert alert-danger">{!! $errors->first('name_unvalid_length') !!}</div>
                @endif
                <!-- /END LENGTH NAME -->

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- phpexcel CATEGORIES ID -->
                            <h4>{!! trans('phpexcel::phpexcel_admin.form_heading') !!}</h4>
                            {!! Form::open(['route'=>['admin_phpexcel_category.post', 'id' => @$phpexcel_category->phpexcel_category_id],  'files'=>true, 'method' => 'post'])  !!}

                            <!--END phpexcel CATEGORIES ID  -->

                            <!-- phpexcel NAME TEXT-->
                            @include('phpexcel::phpexcel_category.elements.text', ['name' => 'phpexcel_category_name'])
                            <!-- /END phpexcel NAME TEXT -->

                            {!! Form::hidden('id',@$phpexcel_category->phpexcel_category_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_phpexcel_category.delete',['id' => @$phpexcel_category->phpexcel_category_id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">
                                Delete
                            </a>
                            <!-- DELETE BUTTON -->

                            <!-- SAVE BUTTON -->
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--SAMLE SEARCH-->
        <div class='col-md-4'>
            @include('phpexcel::phpexcel.admin.phpexcel_search')
        </div>
        <!--/END phpexcel SEARCH-->
    </div>
</div>
@stop