@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
{!! trans('pnd::pnd.page_school_test_list') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty(@$school->school_test_id) ? '<i class="fa fa-pencil"></i>'.trans('pnd::pnd.form_school_test_edit') : '<i class="fa fa-users"></i>'.trans('pnd::pnd.form_school_test_add') !!}
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

                            {!! Form::open(['route'=>['admin_pnd_exame_school_test.post', 'id' => @$school->school_test_id],  'files'=>true, 'method' => 'post'])  !!}


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
                                       <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_test_code','value'=> @$school->school_test_code])
                                            <!--/END INPUT-->

                                        </div>
                                         <div class="col-md-6">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_test_name','value'=> @$school->school_test_name])
                                            <!--/END INPUT-->
                                        </div>
                                         
                                        
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_test_name_title','value'=> @$school->school_test_name_title])
                                            <!--/END INPUT-->

                                        </div>
                                         <div class="col-md-8">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_test_address','value'=> @$school->school_test_address])
                                            <!--/END INPUT-->
                                        </div>
                                        <!--INPUT-->
                                        <div class="col-md-4">

                                            @include('pnd::elements.pnd_input', ['name' => 'school_test_phone','value'=> @$school->school_test_phone])
                                            <!--/END INPUT-->
                                        </div>
                                        
                                       


                                    </div>
 
  
                                     
                                    <div class="row">  
                                     
                                         
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_test_chutich','value'=> @$school->school_test_chutich])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                             @include('pnd::elements.pnd_input', ['name' => 'school_test_phone_chutich','value'=> @$school->school_test_phone_chutich])
                                             <!--/END INPUT-->

                                        </div>
                                        
                                          <div class="col-md-4">
                                            <!--INPUT-->
                                             @include('pnd::elements.pnd_input', ['name' => 'school_test_email_chutich','value'=> @$school->school_test_email_chutich])
                                             <!--/END INPUT-->

                                        </div>
                                        <!--/END INPUT-->
                                    </div>
                                    
                                        
                                    <div class="row">  
                                     
                                         
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_test_thuky','value'=> @$school->school_test_thuky])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                             @include('pnd::elements.pnd_input', ['name' => 'school_test_phone_thuky','value'=> @$school->school_test_phone_thuky])
                                             <!--/END INPUT-->

                                        </div>
                                        
                                          <div class="col-md-4">
                                            <!--INPUT-->
                                             @include('pnd::elements.pnd_input', ['name' => 'school_test_email_thuky','value'=> @$school->school_test_email_thuky])
                                             <!--/END INPUT-->

                                        </div>
                                        <!--/END INPUT-->
                                    </div>
                                    
                                    
                                       <div class="row">  
                                     
                                         
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_number_room','value'=> @$school->school_number_room])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                             @include('pnd::elements.pnd_input', ['name' => 'school_number_room_to','value'=> @$school->school_number_room_to])
                                             <!--/END INPUT-->

                                        </div>
                                        
                                          <div class="col-md-4">
                                            <!--INPUT-->
                                             @include('pnd::elements.pnd_input', ['name' => 'school_number_room_from','value'=> @$school->school_number_room_from])
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

                            
                            {!! Form::hidden('school_code',@$school_id_test) !!}

                            <!-- DELETE BUTTON -->
                            
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

        

    </div>
</div>
@stop

@section('sub_page_scripts')

{!! HTML::script('js/tinymce/tinymce.min.js') !!}
{!! HTML::script('js/tinymce/tinymce-config.js') !!}
{!! HTML::script('vendor/laravel-filemanager/js/lfm.js') !!}

<script type='text/javascript'>
    $(document).ready(function () {
        
        $('#lfm').filemanager('file');

        get_school($('#school_district_code'));
        
        $('#school_district_code').on('change',function(){
            get_school($(this));
        });
    });
    function get_school(This){

            $.ajax({
                type: 'POST',
                url: '<?php echo URL::route('admin_pnd.school.district-test') ?>',
                data:{
                    _token: '{{csrf_token()}}',
                    school_district_code: This.val(),
                    school_current: '<?php echo @$student->school_test_code?>',
                },
                success:function(result){ 
                    $('#school_test_code').html(result);
                }
            });
    }
</script>
@stop
