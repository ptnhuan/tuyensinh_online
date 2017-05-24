
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_categories') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

            <!--KEYWORD-->
            @include ('pnd::elements.input',['name'=>'keyword', 'value' => $request->get('keyword')])

            <div class="row">
                <div class="col-md-10">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_option123',
                    'categories'=> !empty(@$school_option123) ? $school_option123  : array(),
                    'category_id'=> $school_option123_choose ])


                </div>
            </div>

            <!-- POST CATEGORY LIST -->

             <!-- @include('pnd::admin.pnd_statistics')  
            <!-- /END POST CATEGORY LIST -->

        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-left", 'name' => 'search']) !!}
        {!! Form::submit(trans('pexcel::pexcel.export').'', ["class" => "btn btn-info pull-right", 'name' => 'export']) !!}
        {!! Form::close() !!}
    </div>

    <div class="panel-body">



    </div>    

</div>


