
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_school') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_statistics_level_2','method' => 'get']) !!}

        <!--TITLE-->

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <!--SCHOOL OPTION-->
                    @include('pnd::elements.pnd_select', ['name' => 'districts_search',
                    'categories'=> !empty(@$districts_search) ? $districts_search  : array(),
                    'category_id'=>$districts_code_choose])
                </div>
            </div>
            <!--/END TITLE-->
        </div>
        
        <div class="row">

            {!! Form::submit(trans('pnd::pnd.filter_examine_point').'', ["class" => "btn btn-info pull-right"]) !!}
            {!! Form::submit(trans('pexcel::pexcel.export').'', ["class" => "btn btn-info pull-right", 'name' => 'export']) !!}
            {!! Form::close() !!}

        </div> 



    </div>
</div>


