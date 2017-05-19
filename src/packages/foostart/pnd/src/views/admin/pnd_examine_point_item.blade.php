@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
{!! trans('pnd::pnd.pnd_title') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-9">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">
                    {{trans('pnd::pnd.student_info')}}
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

                        {!! Form::open(['route'=>['admin_pnd_examine_point.prior', 'id' => @$student->student_id],  'files'=>true, 'method' => 'post'])  !!}



                        <!--QUICK TABS-->
                        <ul class="nav nav-tabs">

                            <!--TAB HOME-->
                            <li class="active">
                                <a data-toggle="tab" href="#home">
                                    {!! trans('pnd::pnd.tab_info_main_point') !!}
                                </a>
                            </li>
                            <!--/END TAB HOME-->

                            <!--TAB ATTRIBUTES-->
                            <li>
                                <a data-toggle="tab" href="#attributes">
                                    {!! trans('pnd::pnd.tab_info_other_point') !!}
                                </a>
                            </li>
                            <!--/END TAB ATTRIBUTES-->

                        </ul>
                        <!--/END QUICK TABS-->


                        <div class="tab-content">

                            <!--TAB OVERVIEW-->
                            <div id="home" class="tab-pane fade in active">

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style='width:5%'>{{ trans('pnd::pnd.order') }}</th>
                                            <th style='width:15%'>{{ trans('pnd::pnd.school_point_capacity') }}</th>
                                            <th style='width:15%'>{{ trans('pnd::pnd.school_point_conduct') }}</th>
                                            <th style='width:15%'>{{ trans('pnd::pnd.school_point_point') }}</th>          
                                            <th style='width:20%'>{{ trans('pnd::pnd.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nav = $examinepoints->toArray();
                                        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
                                        ?>
                                        @foreach($examinepoints as $examinepoint)
                                        <tr>
                                            <td>
                                                <?php
                                                echo $counter;
                                                $counter++
                                                ?>
                                            </td>
                                            <td>{!! @$examinepoint-> school_point_capacity !!}</td>
                                            <td>{!! @$examinepoint->school_point_conduct !!}</td>
                                            <td>{!! @$examinepoint->school_point_point !!}</td>
                                            <td>
                                                <a href="{!! URL::route('admin_pnd_examine_point.edit', ['id' => $examinepoint->school_point_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                                                <a href="{!! URL::route('admin_pnd_examine_point.delete',['id' =>  $examinepoint->school_point_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                                <span class="clearfix"></span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                            <!--/END TAB OVERVIEW-->

                            <!--TAB ATTRIBUTES-->
                            <div id="attributes" class="tab-pane fade">
                               
                               
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_score_prior_1','value'=> @$student->student_score_prior]
                                        )
                                        <!--/END INPUT-->

                                    </div>
                                    <div class="col-md-4">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_score_prior_2','value'=> @$student->student_score_prior_comment
                          ])
                                        <!--/END INPUT-->

                                    </div>
                                     <div class="col-md-4">
                                        <!--INPUT-->
                                        @include('pnd::elements.pnd_input', ['name' => 'student_score_prior_3','value'=> @$student->student_score_prior_comment
                          ])
                                        <!--/END INPUT-->

                                    </div>
                                    
                                    <!--/END INPUT-->
                                </div>
                            </div>
                            <!--TAB ATTRIBUTES-->


                        </div>

                        {!! Form::hidden('id',@$students->student_id) !!}

                        <!-- SAVE BUTTON -->
                        {!! Form::submit('Lưu', array("class"=>"btn btn-info pull-right ")) !!}
                        <!-- /SAVE BUTTON -->

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>



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
