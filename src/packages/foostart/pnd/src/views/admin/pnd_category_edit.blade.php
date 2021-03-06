@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('pexcel::pexcel.page_edit') }}
@stop
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <!--SAMPLE TITLE-->
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($pexcel_category->pexcel_category_id) ? '<i class="fa fa-pencil"></i>'.trans('pexcel::pexcel.pexcel_category_update') : '<i class="fa fa-users"></i>'.trans('pexcel::pexcel.pexcel_category_new') !!}
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
                            <h4>{!! trans('pexcel::pexcel.form_heading') !!}</h4>
                            {!! Form::open(['route'=>['admin_pexcel_category.post', 'id' => @$pexcel_category->pexcel_category_id],  'files'=>true, 'method' => 'pexcel'])  !!}

                            <!--END SAMPLE CATEGORIES ID  -->

                            <!-- SAMPLE NAME TEXT-->
                             <?php $pexcel_category_name = $request->get('pexcel_category_name') ? $request->get('pexcel_category_name') : @$pexcel_category->pexcel_category_name ?>
                            @include('pexcel::elements.input', ['name' => 'pexcel_category_name', 'value' => $pexcel_category_name])
                            <!-- /END SAMPLE NAME TEXT -->

                            {!! Form::hidden('id',@$pexcel_category->pexcel_category_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_pexcel_category.delete',['id' => @$pexcel_category->pexcel_category_id, '_token' => csrf_token()]) !!}"
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
            @include('pexcel::admin.pexcel_category_search')
        </div>
        <!--/END SAMPLE SEARCH-->
    </div>
</div>
@stop