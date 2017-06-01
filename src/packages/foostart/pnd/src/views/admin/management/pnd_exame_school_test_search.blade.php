
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_school_test_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_exame_school_test','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

            <!--KEYWORD-->
            @include ('pnd::elements.input',['name'=>'school_label', 'value' => $request->get('school_label')])


        </div>
         
        
        <div class="row">
            <div class="col-md-6">
                <!--SCHOOL OPTION-->
                @include('pnd::elements.pnd_select', ['name' => 'school_district_label',
                                            'categories'=> !empty(@$districts_search) ? $districts_search  : array(),
                                            'category_id'=>@$school->school_district_code])
            </div>
        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.filter_examine_point').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


