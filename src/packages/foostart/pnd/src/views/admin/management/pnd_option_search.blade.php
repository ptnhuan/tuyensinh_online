
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_categories') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_option','method' => 'get']) !!}
                
        <!--TITLE-->
        <div class="form-group">

            <!--KEYWORD-->
            @include ('pnd::elements.input',['name'=>'keyword', 'value' => $request->get('keyword')])

                         
            <div class="row">
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_code_level',
                    'categories'=> !empty(@$school_code_level) ? $school_code_level : array(),
                    'category_id'=> $school_level_choose ])


                </div>
            </div>

         @if(($params['school_code'] == 9900 ) )
              
            
         <div class="row">
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_option_specialist',
                    'categories'=> !empty(@$school_option_specialist) ? $school_option_specialist  : array(),
                    'category_id'=> $school_specialist_choose ])


                </div>
            </div>
                @endif


        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-left", 'name' => 'search']) !!}
        {!! Form::submit(trans('pexcel::pexcel.export').'', ["class" => "btn btn-info pull-right", 'name' => 'export']) !!}
        {!! Form::close() !!}
    </div>

    
    
   
</div>


