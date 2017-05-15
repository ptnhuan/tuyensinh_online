@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
{!! trans('pnd::pnd.pnd_title') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($students->student_id) ? '<i class="fa fa-pencil"></i>'.trans('pnd::pnd.form_edit') : '<i class="fa fa-users"></i>'.trans('pnd::pnd.form_add') !!}
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

                            {!! Form::open(['route'=>['admin_pnd.post', 'id' => @$student->student_id],  'files'=>true, 'method' => 'post'])  !!}



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
                                    <div class="row">  
                                        <!--INPUT-->
                                        <div class="col-md-3">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_first_name','value'=> @$student->student_first_name])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_last_name','value'=> @$student->student_last_name])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_sex','value'=> @$student->student_sex])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-1">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_birth_day','value'=> @$student->student_birth_day])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-1">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_birth_month','value'=> @$student->student_birth_month])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_birth_year','value'=> @$student->student_birth_year])
                                            <!--/END INPUT-->
                                        </div>
                                        <!--/END INPUT-->
                                    </div>
<div class="row">  
                                        <!--INPUT-->
                                        <div class="col-md-3">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_birth_place','value'=> @$student->student_birth_place])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-3">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_id','value'=> @$student->school_id])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-3">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_district_id','value'=> @$student->school_district_id])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-3">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_class','value'=> @$student->student_class])
                                            <!--/END INPUT-->

                                        </div>
                                        <!--/END INPUT-->
                                    </div>
                                    <div class="row">  
                                        <!--INPUT-->
                                        <div class="col-md-1" style="width: fit-content; " >
                                            <!--INPUT-->
                                             @include('pnd::elements.pnd_input', ['name' => 'student_capacity_6','value'=> @$student->student_capacity_6])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-1">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_conduct_6','value'=> @$student->student_conduct_6])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-1">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_capacity_7','value'=> @$student->student_capacity_7])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-1">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_conduct_7','value'=> @$student->student_conduct_7])
                                            <!--/END INPUT-->

                                        </div>
                                                                          
                                        <div class="col-md-1">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_capacity_8','value'=> @$student->student_capacity_8])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-1">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_conduct_8','value'=> @$student->student_conduct_8])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-1">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_capacity_9','value'=> @$student->student_capacity_9])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-1">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_conduct_9','value'=> @$student->student_conduct_9])
                                            <!--/END INPUT-->

                                        </div>
                                         
                                        <!--/END INPUT-->
                                    </div>
                                    <div class="row">  
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_average','value'=> @$student->student_average])
                                            <!--/END INPUT-->

                                        </div>
                                         <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_average_1','value'=> @$student->student_average_1])
                                            <!--/END INPUT-->

                                        </div>
                                        <!--INPUT-->
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_average_2','value'=> @$student->student_average_2])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_graduate','value'=> @$student->student_graduate])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_score_prior_comment','value'=> @$student->student_score_prior_comment])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_nominate','value'=> @$student->student_nominate])
                                            <!--/END INPUT-->

                                        </div>
                                        <!--/END INPUT-->
                                    </div>
                                    
                                     <div class="row">  
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_id_option','value'=> @$student->school_id_option])
                                            <!--/END INPUT-->

                                        </div>
                                         <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_class_code','value'=> @$student->school_class_code])
                                            <!--/END INPUT-->

                                        </div>
                                        <!--INPUT-->
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_code_option_1','value'=> @$student->school_code_option_1])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_code_option_2','value'=> @$student->school_code_option_2])
                                            <!--/END INPUT-->
                                        </div>
                                        
                                         <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_email','value'=> @$student->student_email])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_phone','value'=> @$student->student_phone])
                                            <!--/END INPUT-->

                                        </div>
                                        
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_user','value'=> @$student->student_user])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'student_pass','value'=> @$student->student_pass])
                                            <!--/END INPUT-->

                                        </div>
                                 
                                        <!--/END INPUT-->
                                    </div>
                                </div>
                                <!--/END TAB OVERVIEW-->

                                <!--TAB ATTRIBUTES-->
                                <div id="attributes" class="tab-pane fade">
                                    <!--SELECT-->

                                    <!--/END SELECT-->
                                </div>
                                <!--TAB ATTRIBUTES-->


                            </div>

                            {!! Form::hidden('id',@$students->student_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_pnd.delete',['id' => @$students->student_id, '_token' => csrf_token()]) !!}"
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
