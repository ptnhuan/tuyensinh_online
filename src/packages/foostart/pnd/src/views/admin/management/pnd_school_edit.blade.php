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

                            </ul>
                            <!--/END QUICK TABS-->


                            <div class="tab-content">

                                <!--TAB OVERVIEW-->
                                <div id="home" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'school_district_code',
                                            'categories'=> !empty(@$districts) ? $districts  : array(),
                                            'category_id'=>@$school->school_district_code])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_select', ['name' => 'school_level_id',
                                            'categories'=> ['2'=>'Cấp 2','3'=>'Cấp 3'],
                                            'category_id'=> @$school->school_level_id])




                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'user_id','value'=> @$school->user_id])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'pass_id','value'=> @$school->pass_id])
                                            <!--/END INPUT-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_code','value'=> @$school->school_code])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_code_room','value'=> @$school->school_code_room])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_name','value'=> @$school->school_name])
                                            <!--/END INPUT-->

                                        </div>
                                        <div class="col-md-4">

                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_address','value'=> @$school->school_address])
                                            <!--/END INPUT-->
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_name_title','value'=> @$school->school_name_title])
                                            <!--/END INPUT-->

                                        </div>
                                        <!--INPUT-->
                                        <div class="col-md-4">

                                            @include('pnd::elements.pnd_input', ['name' => 'school_phone','value'=> @$school->school_phone])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_email','value'=> @$school->school_email])
                                            <!--/END INPUT-->
                                        </div>

                                    </div>
                                   <div class="row">
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_contact_chutich','value'=> @$school->school_contact_chutich])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_contact_chutich_phone','value'=> @$school->school_contact_chutich_phone])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_contact_chutich_email','value'=> @$school->school_contact_chutich_email])
                                            <!--/END INPUT-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_contact','value'=> @$school->school_contact])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_contact_phone','value'=> @$school->school_contact_phone])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_contact_email','value'=> @$school->school_contact_email])
                                            <!--/END INPUT-->
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_index','value'=> @$school->school_index])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_index2','value'=> @$school->school_index2])
                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--INPUT-->
                                            @include('pnd::elements.pnd_input', ['name' => 'school_number_room','value'=> @$school->school_number_room])
                                            <!--/END INPUT-->
                                        </div>



                                        <div class="col-md-4">
                                            <!--SCHOOL OPTION-->
                                            @include('pnd::elements.pnd_select', ['name' => 'school_online',
                                            'categories'=> ['0'=>'Không','1'=>'Cấp lại mật khẩu']])
                                        </div>


                                    </div>
                                    <div class="row">  

                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'pexcel_edit',
                                            'categories'=> ['0'=>'Cho phép','1'=>'Không cho phép'],
                                            'category_id'=> @$school->pexcel_edit])

                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'add_level',
                                            'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                            'category_id'=> @$school->add])

                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'edit_level',
                                            'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                            'category_id'=> @$school->edit])

                                            <!--/END INPUT-->
                                        </div>
                                        
                                    </div>
                                    <div class="row">  
                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'delete_level',
                                            'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                            'category_id'=> @$school->delete])

                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'school_examination',
                                            'categories'=> ['0'=>'Xét tuyển','1'=>'Thi tuyển','2'=>'Thi tuyển-xét tuyển'],
                                            'category_id'=> @$school->school_examination])

                                            <!--/END INPUT-->
                                        </div>


                                    </div>

                                     <div class="row">  
                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'keylook_identifi',
                                            'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                            'category_id'=> @$school->keylook_identifi])

                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'keylook_room',
                                            'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                            'category_id'=> @$school->keylook_room])

                                            <!--/END INPUT-->
                                        </div>
                                        <div class="col-md-4">

                                            <!--INPUT-->

                                            @include('pnd::elements.pnd_select', ['name' => 'keylook_test',
                                            'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                            'category_id'=> @$school->keylook_test])

                                            <!--/END INPUT-->
                                        </div>
                                      


                                    </div>
                                    <div class="row">

                                    </div>

                                    <!--/END INPUT-->

                                </div>
                                <!--/END TAB OVERVIEW-->

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
            @include('pnd::admin.management.pnd_school_search',['name_search'=>'_schools'])
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
