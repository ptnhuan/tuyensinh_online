
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.school_number_room_test') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_exame_school_room_list','method' => 'get']) !!}
                
        <!--TITLE-->
        <div class="form-group">

        
            <div class="row">
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_test_name',
                    'categories'=> !empty(@$school_code_level) ? $school_code_level : array(),
                    'category_id'=> $school_level_choose ])


                </div>
            </div>

        
              
            
         <div class="row">
                <div class="col-md-5">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_number_room_list',
                    'categories'=> !empty(@$school_option_specialist) ? $school_option_specialist  : array(),
                    'category_id'=> $school_specialist_choose ])


                </div>
            </div>
           
         <div class="row">
                <div class="col-md-5">
                    <!--SCHOOL OPTION-->

                    {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-left", 'name' => 'search']) !!}

                </div>
            </div>
            
  <div class="row">
                <div class="col-md-5">
                    <!--SCHOOL OPTION-->

                    {!! Form::submit(trans('pexcel::pexcel.export_ny').'', ["class" => "btn btn-info pull-left", 'name' => 'export']) !!}

                </div>
            </div>
            
            <div class="row">
                <div class="col-md-5">
                    <!--SCHOOL OPTION-->

                     {!! Form::submit(trans('pexcel::pexcel.export_gt').'', ["class" => "btn btn-info pull-left", 'name' => 'export_gt']) !!}

                </div>
            </div>
            
            <div class="row">
                <div class="col-md-5">
                    <!--SCHOOL OPTION-->

                   {!! Form::submit(trans('pexcel::pexcel.export_tb').'', ["class" => "btn btn-info pull-left", 'name' => 'export_tb']) !!}

                </div>
            </div>
            
           
            
              <div class="row">
                <div class="col-md-5">
                   
                    {!! Form::submit(trans('pexcel::pexcel.export_gbt').'', ["class" => "btn btn-info pull-left", 'name' => 'export_gbt']) !!}

                </div>
            </div>
            
              <div class="row">
                <div class="col-md-5">
                   
                    {!! Form::submit(trans('pexcel::pexcel.export_indentifi').'', ["class" => "btn btn-info pull-left", 'name' => 'export_indentifi']) !!}

                </div>
            </div>
        </div>
        <!--/END TITLE-->

       
      
        
      
    
      
     
      
        {!! Form::close() !!}
    </div>

    
    
   
</div>


