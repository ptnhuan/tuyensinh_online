@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Trang quản trị bài viết
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($post->post_id) ? '<i class="fa fa-pencil"></i>'.trans('post::post_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('post::post_admin.form_add') !!}
                    </h3>
                </div>

                <!--ERRORS POST-->
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
                            <!--SAMPLE TITLE FORM EDIT-->
                            <h4>{!! trans('post::post_admin.form_heading') !!}</h4>
                            <!--END SAMPLE TITLE FORM EDIT-->

                            {!! Form::open(['route'=>['admin_post.post', 'id' => @$post->post_id],  'files'=>true, 'method' => 'post'])  !!}



                            <!--QUICK TABS-->
                            <ul class="nav nav-tabs">

                                <!--TAB HOME-->
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        {!! trans('post::post_admin.tab_overview') !!}
                                    </a>
                                </li>
                                <!--/END TAB HOME-->

                                <!--TAB ATTRIBUTES-->
                                <li>
                                    <a data-toggle="tab" href="#attributes">
                                        {!! trans('post::post_admin.tab_attributes') !!}
                                    </a>
                                </li>
                                <!--/END TAB ATTRIBUTES-->

                                <!--TAB IMAGE-->
                                <li>
                                    <a data-toggle="tab" href="#image">
                                        {!! trans('post::post_admin.tab_image') !!}
                                    </a>
                                </li>
                                <!--/END TAB IMAGE-->


                            </ul>
                            <!--/END QUICK TABS-->


                            <div class="tab-content">

                                <!--TAB OVERVIEW-->
                                <div id="home" class="tab-pane fade in active">
                                    <!--INPUT-->
                                    @include('post::post.elements.input', ['name' => 'post_name'])
                                    <!--/END INPUT-->

                                     <!--TEXT-->
                                    @include('post::post.elements.text', ['name' => 'post_name'])
                                    <!--/END TEXT-->
                                </div>
                                <!--/END TAB OVERVIEW-->

                                <!--TAB ATTRIBUTES-->
                                <div id="attributes" class="tab-pane fade">
                                    <!--SELECT-->
                                    @include('post::post.elements.select')
                                    <!--/END SELECT-->
                                </div>
                                <!--TAB ATTRIBUTES-->

                                <!--TAB IMAGE-->
                                <div id="image" class="tab-pane fade">
                                    <!--IMAGE-->
                                    @include('post::post.elements.image', ['name' => 'post_image'])
                                    <!--/END IMAGE-->
                                </div>
                                <!--TAB IMAGE-->

                            </div>

                            {!! Form::hidden('id',@$post->post_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_post.delete',['id' => @$post->post_id, '_token' => csrf_token()]) !!}"
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

        <div class='col-md-4'>
            @include('post::post.admin.post_search')
        </div>

    </div>
</div>
@stop

@section('footer_scripts_more')

{!! HTML::script('vendor/laravel-filemanager/js/tinymce.min.js') !!}
{!! HTML::script('vendor/laravel-filemanager/js/tinymce-configs.js') !!}
{!! HTML::script('vendor/laravel-filemanager/js/lfm_sample.js') !!}

<script type='text/javascript'>
    $(document).ready(function () {
        $('#lfm').filemanager('image');
    });
</script>
@stop