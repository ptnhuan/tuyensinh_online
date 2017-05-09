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
                        {!! !empty($specialists->school_specialist_id) ? '<i class="fa fa-pencil"></i>'.trans('pnd::pnd.form_class_edit') : '<i class="fa fa-users"></i>'.trans('pnd::pnd.form_class_add') !!}
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
                            <h4>{!! trans('pnd::pnd.form_heading') !!}</h4>
                            <!--END SAMPLE TITLE FORM EDIT-->

                            {!! Form::open(['route'=>['admin_pnd_specialist.post', 'id' => @$specialist->school_class_id],  'files'=>true, 'method' => 'post'])  !!}



                            <!--QUICK TABS-->
                            <ul class="nav nav-tabs">

                                <!--TAB HOME-->
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        {!! trans('pnd::pnd.tab_overview') !!}
                                    </a>
                                </li>
                                <!--/END TAB HOME-->

                                <!--TAB ATTRIBUTES-->
                                <li>
                                    <a data-toggle="tab" href="#attributes">
                                        {!! trans('pnd::pnd.tab_attributes') !!}
                                    </a>
                                </li>
                                <!--/END TAB ATTRIBUTES-->
 
                            </ul>
                            <!--/END QUICK TABS-->


                            <div class="tab-content">

                                <!--TAB OVERVIEW-->
                                <div id="home" class="tab-pane fade in active">
                                                                     
                                    <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_specialist_code','value'=> @$specialist->school_class_code])
                                    <!--/END INPUT-->
                                    
                                    <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_specialist_name','value'=> @$specialist->school_class_name])
                                    <!--/END INPUT-->

                                      
                                    
                                    <!--/END INPUT-->

                                </div>
                                <!--/END TAB OVERVIEW-->

                                <!--TAB ATTRIBUTES-->
                                <div id="attributes" class="tab-pane fade">
                                    <!--SELECT-->
                                     @include('pnd::elements.pnd_select')
                                    <!--/END SELECT-->
                                </div>
                                <!--TAB ATTRIBUTES-->
 

                            </div>

                            {!! Form::hidden('id',@$schools->school_specialist_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_pnd_specialist.delete',['id' => @$specialists->school_class_id, '_token' => csrf_token()]) !!}"
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
            @include('pnd::admin.pnd_search')
        </div>

    </div>
</div>
@stop

@section('sub_page_scripts')

{!! HTML::script('js/tinymce/tinymce.min.js') !!}
{!! HTML::script('js/tinymce/tinymce-config.js') !!}
{!! HTML::script('vendor/laravel-filemanager/js/lfm_pnd.js') !!}

<script type='text/javascript'>
    $(document).ready(function () {
        $('#lfm').filemanager('file');
    });
</script>
@stop
