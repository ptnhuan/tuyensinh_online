
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_categories') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_school_student_level_2','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

            <!--KEYWORD-->
            @include ('pnd::elements.input',['name'=>'keyword', 'value' => $request->get('keyword')])

                         
            <div class="row">
                <div class="col-md-10">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_code_level',
                    'categories'=> !empty(@$school_code_level) ? $school_code_level : array(),
                    'category_id'=> $school_code_choose ])


                </div>
            </div>

       
             <div class="row">
                <div class="col-md-10">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_option123',
                    'categories'=> !empty(@$school_option123) ? $school_option123  : array(),
                    'category_id'=> $school_option123_choose ])


                </div>
            </div>
            
            
             <div class="row">
                <div class="col-md-10">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_option1234',
                    'categories'=> !empty(@$school_option1234) ? $school_option1234  : array(),
                    'category_id'=> $school_option1234_choose ])


                </div>
            </div>


        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-left", 'name' => 'search']) !!}
        {!! Form::submit(trans('pexcel::pexcel.export').'', ["class" => "btn btn-info pull-right", 'name' => 'export']) !!}
        {!! Form::close() !!}
    </div>

   
</div>


