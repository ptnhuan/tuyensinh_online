@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
{!! trans('pnd::pnd.pnd_title') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-9">
        @if(!empty($student))
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">
                    {{trans('pnd::pnd.student_info')}}
                </h3>
            </div>
            {!! Form::open(['route'=>['user_pnd.post', 'id' => @$student->student_id, 'school_aed' => @$student->school_aed],  'files'=>true, 'method' => 'post'])  !!}
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

                        <!--QUICK TABS-->
                        <ul class="nav nav-tabs">

                            <!--TAB HOME-->
                            <li class="active">
                                <a data-toggle="tab" href="#home">
                                    {!! trans('pnd::pnd.tab_info_main') !!}
                                </a>
                            </li>
                            <!--/END TAB HOME-->

                            <!--TAB ATTRIBUTES-->
                            <li>
                                <a data-toggle="tab" href="#attributes">
                                    {!! trans('pnd::pnd.tab_info_sbd') !!}
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
                                    <div class="col-md-6">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_first_name','value'=> @$student->student_first_name])
                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-3">

                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_last_name','value'=> @$student->student_last_name])
                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-2">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_sex','value'=> @$student->student_sex])
                                        <!--/END INPUT-->

                                    </div>

                                </div>
                                <div class="row">  
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
                                    <div class="col-md-1">
                                        <!--INPUT-->
                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-2">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_birth_year','value'=> @$student->student_birth_year])
                                        <!--/END INPUT-->
                                    </div>
                                    <!--/END INPUT-->
                                    <div class="col-md-1">
                                        <!--INPUT-->
                                        <!--/END INPUT-->
                                    </div>
                                    <!--INPUT-->
                                    <div class="col-md-6">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_birth_place','value'=> @$student->student_birth_place])
                                        <!--/END INPUT-->
                                    </div>

                                    <!--/END INPUT-->
                                </div>
                                <div class="row">  
                                    <div class="col-md-3">
                                        <!--INPUT-->

                                        @include('pnd::elements.pnd_select', ['name' => 'school_district_code',
                                        'categories'=> !empty(@$districts) ? $districts  : array(),
                                        'category_id'=>@$student->school_district_code])

                                        <!--/END INPUT-->

                                    </div>

                                    <div class="col-md-6">

                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'school_code',
                                        'categories'=> !empty(@$schools) ? $schools  : array(),
                                        'category_id'=>@$student->school_code])


                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_class','value'=> @$student->student_class])
                                        <!--/END INPUT-->

                                    </div>

                                </div>

                                <div class="row">  

                                    <!--INPUT-->
                                    <div class="col-md-3"   >
                                        <!--INPUT-->

                                        @include('pnd::elements.pnd_select', ['name' => 'student_capacity_6',
                                        'categories'=> ['G'=>'G','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_capacity_6])

                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-3">

                                        <!--INPUT-->

                                        @include('pnd::elements.pnd_select', ['name' => 'student_conduct_6',
                                        'categories'=> ['T'=>'T','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_conduct_6])


                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'student_capacity_7',
                                        'categories'=> ['G'=>'G','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_capacity_7])

                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'student_conduct_7',
                                        'categories'=> ['T'=>'T','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_conduct_7])

                                        <!--/END INPUT-->

                                    </div>



                                    <!--/END INPUT-->
                                </div>
                                <div class="row">  

                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'student_capacity_8',
                                        'categories'=> ['G'=>'G','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_capacity_8])

                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-3">

                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'student_conduct_8',
                                        'categories'=> ['T'=>'T','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_conduct_8])

                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'student_capacity_9',
                                        'categories'=> ['G'=>'G','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_capacity_9])

                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'student_conduct_9',
                                        'categories'=> ['T'=>'T','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_conduct_9])

                                        <!--/END INPUT-->

                                    </div>

                                    <!--/END INPUT-->
                                </div>
                                <div class="row">  
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_average','value'=> @$student->student_average])
                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_average_1','value'=> @$student->student_average_1])
                                        <!--/END INPUT-->

                                    </div>
                                    <!--INPUT-->
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_average_2','value'=> @$student->student_average_2])
                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-3">

                                        <!--INPUT-->

                                        @include('pnd::elements.pnd_select', ['name' => 'student_graduate',
                                        'categories'=> ['G'=>'G','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                        'category_id'=> @$student->student_graduate])

                                        <!--/END INPUT-->
                                    </div>

                                    <!--/END INPUT-->
                                </div>

                                <div class="row">  
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_score_prior','value'=> @$student->student_score_prior])
                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_score_prior_comment','value'=> @$student->student_score_prior_comment])
                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-3">
                                        <!--INPUT-->

                                        @include('pnd::elements.pnd_select', ['name' => 'student_nominate',
                                        'categories'=> ['0'=>'Không','1'=>'Tuyển thẳng'],
                                        'category_id'=> @$student->student_nominate])

                                        <!--/END INPUT-->

                                    </div>
                                    <!--/END INPUT-->
                                </div>
                                <div class="row">  
                                    <div class="col-md-6">
                                        <!--INPUT-->


                                        @include('pnd::elements.pnd_select', ['name' => 'school_code_option',
                                        'categories'=> !empty(@$school_levels_specialist) ? $school_levels_specialist  : array(),
                                        'category_id'=>@$student->school_code_option])

                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-6">
                                        <!--INPUT-->

                                        @include('pnd::elements.pnd_select', ['name' => 'school_class_code',
                                        'categories'=> !empty(@$specialists) ? $specialists : array(),
                                        'category_id'=>@$student->school_class_code])


                                        <!--/END INPUT-->

                                    </div>
                                    <!--INPUT-->




                                    <!--/END INPUT-->
                                </div> 
                                <div class="row">  

                                    <!--INPUT-->
                                    <div class="col-md-6">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'school_code_option_1',
                                        'categories'=> !empty(@$school_levels_3) ? $school_levels_3  : array(),
                                        'category_id'=>@$student->school_code_option_1])

                                        <!--/END INPUT-->

                                        <!--/END INPUT-->
                                    </div>
                                    <div class="col-md-6">

                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'school_code_option_2',
                                        'categories'=> !empty(@$school_levels_3) ? $school_levels_3  : array(),
                                        'category_id'=>@$student->school_code_option_2])

                                        <!--/END INPUT-->
                                    </div>



                                    <!--/END INPUT-->
                                </div>
                                <div class="row">  

                                    <div class="col-md-6">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_email','value'=> @$student->student_email])
                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-6">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_phone','value'=> @$student->student_phone])
                                        <!--/END INPUT-->

                                    </div>

                                    <!--/END INPUT-->
                                </div>
                                <div class="row">  


                                    <div class="col-md-6">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_user','value'=> @$student->student_user])
                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-6">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_pass','value'=> @$student->student_pass])
                                        <!--/END INPUT-->

                                    </div>

                                    <!--/END INPUT-->
                                </div>
                                {!! Form::hidden('school_aed',@$students->school_aed) !!}
                                {!! Form::hidden('id',@$students->student_id) !!}

                                <!-- SAVE BUTTON -->
                                {!! Form::submit('Lưu', array("class"=>"btn btn-info pull-right ")) !!}
                                <!-- /SAVE BUTTON -->

                                {!! Form::close() !!}
                            </div>
                            <!--/END TAB OVERVIEW-->

                            <!--TAB ATTRIBUTES-->
                            <div id="attributes" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-3">                                       
                                        &nbsp;                                     

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">

                                        <b>ĐIỂM XÉT TUYỂN</b>


                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-3">

                                        &nbsp;


                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col-md-3"   >


                                        <tr>  <b>Điểm lớp 6:</b> <?php echo $student->student_point_6; ?></tr>


                                    </div>
                                    <div class="col-md-3">


                                        <tr> <b> Điểm lớp 7:</b> <?php echo $student->student_point_7; ?></tr>



                                    </div>
                                    <div class="col-md-3">

                                        <tr>  <b>Điểm lớp 8: </b><?php echo $student->student_point_8; ?></tr>

                                    </div>
                                    <div class="col-md-3">

                                        <tr>  <b>Điểm lớp 9: </b><?php echo $student->student_point_9; ?></tr>
                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">

                                        <tr>  <b>Điểm ưu tiên-khuyến khích: </b><?php echo $student->student_score_prior; ?></tr>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;
                                        <hr ></hr>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                       <b>  THÔNG TIN THI TUYỂN</b>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <TR> <b>-Đúng:</b><?php echo $info->pexcel_category_taptrung; ?><TR>

                                    </div>
                                  

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>
                                
                                  <div class="row">
                                   
                                    <div class="col-md-5">
                                        <TR> <b>-Có mặt tại:Trường </b><?php echo $info_test->school_test_name; ?><TR>
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>
                                
                                  <div class="row">
                                   
                                    <div class="col-md-5">
                                        <TR> <b>-Địa chỉ:</b><?php echo $info_test->school_test_address; ?><TR>
                                    </div>

                                </div>

                                 <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>
                                
                                  <div class="row">
                                   
                                    <div class="col-md-10">
                                        <TR> <b>-Để làm thủ tục tham dự kỳ thi: </b><?php echo $info->pexcel_category_kythi; ?><TR>
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>
                                
                                  <div class="row">
                                   
                                    <div class="col-md-10">
                                        <TR> <b>-Khóa thi ngày:</b><?php echo $info->pexcel_category_ngaythi; ?><TR>
                                    </div>

                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <TR> <b>-Số báo danh:</b><?php echo $student->student_identifi_name; ?><TR>

                                    </div>
                                    <div class="col-md-3">
                                        <TR> <b>-Phòng thi:</b><?php echo $student->student_room; ?><TR>
                                    </div>

                                </div>
                                
                                 <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-5">
                                        <TR> <b>-Nguyện vọng 1:</b> <?php echo $params['option_1'] ; ?><TR>

                                    </div>
                                    <div class="col-md-5">
                                        <TR> <b>-Nguyện vọng 2:</b><?php echo @$params['option_2'] ; ?><TR>
                                    </div>

                                </div>
                                
                                 <div class="row">
                                    <div class="col-md-3">
                                        &nbsp;

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-2">
                                        <TR><b>-Điểm thi TOÁN: </b> <TR>

                                    </div>
                                    <div class="col-md-2">
                                        <TR><b>-Điểm thi Văn:</b> <TR>
                                    </div>
                                
                                    <div class="col-md-2">
                                        <TR><b>-Điểm thi Anh văn:</b> <TR>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

        @else

        <span class="text-warning">
            <h5>
                {{ trans('pnd::pnd.message_find_failed') }}
            </h5>
        </span>

        @endif

    </div>
    <div class="col-md-3"></div>
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

        $('#school_district_code').on('change', function () {
            get_school($(this));
        });
    });
    function get_school(This) {

        $.ajax({
            type: 'POST',
            url: '<?php echo URL::route('admin_pnd.school.district') ?>',
            data: {
                _token: '{{csrf_token()}}',
                school_district_code: This.val(),
                school_current: '<?php echo @$student->school_code ?>',
            },
            success: function (result) {
                $('#school_code').html(result);
            }
        });
    }
</script>
@stop
