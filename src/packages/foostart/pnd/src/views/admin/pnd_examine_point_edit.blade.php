@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
{!! trans('pnd::pnd.school_point_title') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                      
                        
                        {!! !empty($examinepoints->school_point_id) ? '<i class="fa fa-pencil"></i>'.trans('pnd::pnd.form_point_edit') : '<i class="fa fa-users"></i>'.trans('pnd::pnd.form_point_add') !!}
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
     
                            {!! Form::open(['route'=>['admin_pnd_examine_point.post', 'id' => @$examinepoints->school_point_id],  'files'=>true, 'method' => 'post'])  !!}


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
                                        <!--INPUT-->
                                        <div class="col-md-3">
                                       
                                    
                                    <!--INPUT-->
                                      @include('pnd::elements.pnd_select', ['name' => 'school_point_capacity',
                                                          'categories'=> ['G'=>'G','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                                          'category_id'=> @$examinepoints->school_point_capacity])
                                     
                                    <!--/END INPUT-->
                                      </div>
                                       <div class="col-md-3">
                                    <!--INPUT-->
                                        @include('pnd::elements.pnd_select', ['name' => 'school_point_conduct',
                                                          'categories'=> ['T'=>'T','K'=>'K','TB'=>'TB','Y'=>'Y'],
                                                          'category_id'=> @$examinepoints->school_point_conduct])
                                  
                                    <!--/END INPUT-->
    </div>
                                           <div class="col-md-3">
                                        <!--INPUT-->
                                    @include('pnd::elements.pnd_input', ['name' => 'school_point_point','value'=> @$examinepoints->school_point_point])
                                    <!--/END INPUT-->

                                    
                                    <!--/END INPUT-->

                                </div>
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

                            {!! Form::hidden('id',@$examinepoints->school_point_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_pnd_examine_point.delete',['id' => @$examinepoints->school_point_id, '_token' => csrf_token()]) !!}"
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
            @include('pnd::admin.pnd_search',['name_search'=>'_class_specifics'])
        </div>

<script type='text/javascript'>
    $(document).ready(function () {
        $('#lfm').filemanager('file');
    });
</script>
    </div>
</div>
@stop

@section('sub_page_scripts')

{!! HTML::script('js/tinymce/tinymce.min.js') !!}
{!! HTML::script('js/tinymce/tinymce-config.js') !!}
{!! HTML::script('vendor/laravel-filemanager/js/lfm_pnd.js') !!}

@stop
