
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_school') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_school','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

            <!--KEYWORD-->
            @include ('pnd::elements.input',['name'=>'school_label', 'value' => $request->get('school_label')])


        </div>
        <div class="row">
            <div class="col-md-6">
                <!--SCHOOL OPTION-->
                
                @include('pnd::elements.pnd_select', ['name' => 'school_level_id',
                'categories'=> [''=>'','2'=>'Cấp 2','3'=>'Cấp 3'],
                'category_id'=>$school_level_choose]) 
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <!--SCHOOL OPTION-->
                @include('pnd::elements.pnd_select', ['name' => 'districts_search',
                                            'categories'=> !empty(@$districts_search) ? $districts_search  : array(),
                                            'category_id'=>$districts_code_choose])
            </div>
        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.filter_examine_point').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


