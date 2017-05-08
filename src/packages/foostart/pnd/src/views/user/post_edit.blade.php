@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Trang quản lý bài viết
@stop
@section('content')
<div class="row post-edit">
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

                            {!! Form::open(['route'=>['user_post.post', 'id' => @$post->post_id],  'files'=>true, 'method' => 'post'])  !!}



                            <!--QUICK TABS-->
                            <ul class="nav nav-tabs">

                                <!--TAB HOME-->
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        {!! trans('post::post_admin.tab_overview') !!}
                                    </a>
                                </li>
                                <!--/END TAB HOME-->

                                <!--TAB IMAGE-->
                                <li>
                                    <a data-toggle="tab" href="#image">
                                        {!! trans('post::post_admin.tab_image') !!}
                                    </a>
                                </li>
                                <!--/END TAB IMAGE-->

                                <!--TAB ATTRIBUTES-->
                                <li>
                                    <a data-toggle="tab" href="#attributes">
                                        {!! trans('post::post_admin.tab_attributes') !!}
                                    </a>
                                </li>
                                <!--/END TAB ATTRIBUTES-->

                            </ul>
                            <!--/END QUICK TABS-->


                            <div class="tab-content">

                                <!--TAB OVERVIEW-->
                                <div id="home" class="tab-pane fade in active">
                                    <!--INPUT-->
                                    <!-- POST INPUT NAME -->
                                    <div class="form-group">
                                        <?php $post_name = $request->get('post_name') ? $request->get('post_name') : @$post->post_name ?>
                                        {!! Form::label('post_name', trans('post::post_admin.name').':') !!}
                                        {!! Form::text('post_name', $post_name, ['class' => 'form-control post_name', 'placeholder' => trans('post::post_admin.name'), 'id' => 'post_name']) !!}
                                        </div>

                                    <div class="form-group">

                                        <?php $post_slug = $request->get('post_slug') ? $request->get('post_slug') : @$post->post_slug ?>
                                        {!! Form::hidden('post_slug', $post_slug, ['id' => 'post_slug']) !!}

                                    </div>
                                    <!-- /END POST INPUT NAME -->
                                    <!--/END INPUT-->

                                    <!--TEXT-->
                                    <!-- POST DESCRIPTION -->
                                    <div class="form-group">
                                        <?php $post_description = $request->get('post_description') ? $request->get('post_description') : @$post->post_description ?>
                                        {!! Form::label('post_description', trans('post::post_admin.post_description').':') !!}
                                        {!! Form::textarea ('post_description', $post_description, ['class' => 'form-control tinymce my-editor', 'rows' => 20, 'placeholder' => "Nội dung bài viết"]) !!}
                                    </div>
                                    <!--/END POST DESCRIPTION-->
                                    <!--/END TEXT-->
                                </div>
                                <!--/END TAB OVERVIEW-->

                                <!--TAB IMAGE-->
                                <div id="image" class="tab-pane fade">
                                    <!--IMAGE-->
                                    @include('post::post.elements.image', ['name' => 'post_image'])
                                    <!--/END IMAGE-->
                                </div>
                                <!--TAB IMAGE-->

                                <!--TAB ATTRIBUTES-->
                                <div id="attributes" class="tab-pane fade">
                                    <!--SELECT-->
                                    @include('post::post.elements.select')
                                    <!--/END SELECT-->
                                </div>
                                <!--TAB ATTRIBUTES-->

                            </div>

                            {!! Form::hidden('id',@$post->post_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('user_post.delete',['id' => @$post->post_id, '_token' => csrf_token()]) !!}"
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
            @include('post::post.user.post_search')
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


@section('footer_scripts_form')
<script type='text/javascript'>
    $(document).ready(function () {

        function ChangeToSlug(title)
        {
            var slug;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            return slug;
        }

        $(".post_name").on("change paste keyup", function () {
            $('#post_slug').val(ChangeToSlug($(this).val()));
        });
    });
</script>
@stop