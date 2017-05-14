@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
{!! trans('pnd::pnd.school_title') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($schools->school_id) ? '<i class="fa fa-pencil"></i>'.trans('pnd::pnd.form_school__edit') : '<i class="fa fa-users"></i>'.trans('pnd::pnd.form_school_add') !!}
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

                            {!! Form::open(['route'=>['admin_pnd_school.post', 'id' => @$school->school_id],  'files'=>true, 'method' => 'post'])  !!}



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
                                    @include('pnd::elements.pnd_input', ['name' => 'school_code','value'=> @$school->school_code])
                                    <!--/END INPUT-->
                                    
                                    <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_name','value'=> @$school->school_name])
                                    <!--/END INPUT-->

                                    <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_address','value'=> @$school->school_address])
                                    <!--/END INPUT-->
                                       <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_phone','value'=> @$school->school_phone])
                                    <!--/END INPUT-->
                                        <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_email','value'=> @$school->school_email])
                                    <!--/END INPUT-->
                                     <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_contact','value'=> @$school->school_contact])
                                    <!--/END INPUT-->
                                        <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_district_id','value'=> @$school->school_district_id])
                                    <!--/END INPUT-->
                                        <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_level_id','value'=> @$school->school_level_id])
                                    <!--/END INPUT-->
                                        <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_user','value'=> @$school->school_user])
                                    <!--/END INPUT-->
                                        <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_pass','value'=> @$school->school_pass])
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

                            {!! Form::hidden('id',@$schools->school_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_pnd_school.delete',['id' => @$schools->school_id, '_token' => csrf_token()]) !!}"
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
