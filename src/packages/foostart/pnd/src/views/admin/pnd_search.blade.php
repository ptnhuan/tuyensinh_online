
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
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_class123',
                    'categories'=> !empty(@$school_class123) ? $school_class123  : array(),
                    'category_id'=> $school_class123_choose ])


                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_option123',
                    'categories'=> !empty(@$school_option123) ? $school_option123  : array(),
                    'category_id'=> $school_option123_choose ])


                </div>
            </div>
            
            
             <div class="row">
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_option1234',
                    'categories'=> !empty(@$school_option1234) ? $school_option1234  : array(),
                    'category_id'=> $school_option1234_choose ])


                </div>
            </div>

          <div class="row">
                <div class="col-md-3">
                    <!--SCHOOL OPTION-->

                 {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-left", 'name' => 'search']) !!}
     

                </div>
               <div class="col-md-4">
                    <!--SCHOOL OPTION-->

                  {!! Form::submit(trans('pexcel::pexcel.export').'', ["class" => "btn btn-info pull-right", 'name' => 'export']) !!}
    

                </div>
               <div class="col-md-5">
                    <!--SCHOOL OPTION-->
     {!! Form::submit(trans('pexcel::pexcel.export_id').'', ["class" => "btn btn-info pull-right", 'name' => 'exportpass']) !!}
      
                </div>
                {!! Form::close() !!}
            </div>

        </div>
        <!--/END TITLE-->

        
    </div>
   

    </div>


 

                    @include('pnd::admin.pnd_statistics')
  
</div>