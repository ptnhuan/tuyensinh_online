@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Trang nhập thông tin dữ liệu học sinh từ Excel
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($pexcel->pexcel_id) ? '<i class="fa fa-pencil"></i>'.trans('pexcel::pexcel.form_editu') : '<i class="fa fa-users"></i>'.trans('pexcel::pexcel.form_addu') !!}
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
                            <h4>{!! trans('pexcel::pexcel.form_headingu') !!}</h4>
                            <!--END SAMPLE TITLE FORM EDIT-->

                            {!! Form::open(['route'=>['admin_update_pexcel.post', 'id' => @$pexcel->pexcel_id],  'files'=>true, 'method' => 'post'])  !!}



                            <!--QUICK TABS-->
                            <ul class="nav nav-tabs">

                                <!--TAB HOME-->
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        {!! trans('pexcel::pexcel.tab_overview') !!}
                                    </a>
                                </li>
                                <!--/END TAB HOME-->

                                <!--TAB FILE-->
                                <li>
                                    <a data-toggle="tab" href="#file">
                                        {!! trans('pexcel::pexcel.tab_file') !!}
                                    </a>
                                </li>
                                <!--/END TAB FILE-->


                            </ul>
                            <!--/END QUICK TABS-->


                            <div class="tab-content">

                                <!--TAB OVERVIEW-->
                                <div id="home" class="tab-pane fade in active">
                                    <!--INPUT-->
                                    @include('pexcel::elements.pexcel_input', ['name' => 'pexcel_name', 'label' => 'Tiêu đề'])
                                    <!--/END INPUT-->

                                    <!--TEXT-->
                                    @include('pexcel::elements.text', ['name' => 'pexcel_name'])
                                    <!--/END TEXT-->
                                </div>
                                <!--/END TAB OVERVIEW-->

                                <!--TAB FILE-->
                                <div id="file" class="tab-pane fade">
                                    <!--SELECT-->
                                    @include('pexcel::elements.pexcel_select')
                                    <!--/END SELECT-->

                                    <!--FILE-->
                                    @include('pexcel::elements.image', ['name' => 'pexcel_file_path'])
                                    <!--/END FILE-->

                                    <div class="form-group" style="margin-top: 15px;">
                                        <div class="col-md-6" style="padding: 0px; padding-right: 10px;">
                                            <!--INPUT-->
                                                @include('pexcel::elements.pexcel_input', ['name' => 'pexcel_fromrow', 'label' => 'Đọc dữ liệu từ dòng'])
                                            <!--/END INPUT-->
                                        </div>

                                        <div class="col-md-6" style="padding: 0px; padding-left: 10px;">
                                            <!--INPUT-->
                                                @include('pexcel::elements.pexcel_input', ['name' => 'pexcel_torow', 'label' => 'Đọc dữ liệu đến dòng'])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-6" style="padding: 0px; padding-left: 10px;">
                                            <!--INPUT-->
                                                           @include('pnd::elements.pnd_select', ['name' => 'pexcel_update',
                                                            'categories'=> ['0'=>'Ưu tiên-Khuyến khích'],
                                                          'category_id'=> @pexcel_update])
                                            <!--/END INPUT-->
                                        </div>
                                    </div>

                                </div>
                                <!--TAB FILE-->

                            </div>

                            {!! Form::hidden('id',@$pexcel->pexcel_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_pexcel.delete',['id' => @$pexcel->pexcel_id, '_token' => csrf_token()]) !!}"
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
            @include('pexcel::admin.pexcel_search')
        </div>

    </div>
</div>
@stop

@section('footer_scripts')

{!! HTML::script('js/tinymce/tinymce.min.js') !!}
{!! HTML::script('js/tinymce/tinymce-config.js') !!}
{!! HTML::script('vendor/laravel-filemanager/js/lfm_pexcel.js') !!}

<script type='text/javascript'>
    $(document).ready(function () {
        $('#lfm').filemanager('file');
    });
</script>
@stop