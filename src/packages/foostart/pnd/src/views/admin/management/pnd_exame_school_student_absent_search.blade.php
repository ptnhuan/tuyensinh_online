
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_sbd') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_exame_school_room_absent_list','method' => 'get']) !!}
                
        <!--TITLE-->
        <div class="form-group">

            <!--KEYWORD-->
            @include ('pnd::elements.input',['name'=>'keysbd', 'value' => $request->get('keysbd')])

                         
            <div class="row">
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_specialist',
                    'categories'=> !empty(@$school_code_level) ? $school_code_level : array(),
                    'category_id'=>$school_subject_code ])


                </div>
            </div>

         @if(($params['school_code'] == 9900 ) )
              
            
         <div class="row">
                <div class="col-md-12">
                    <!--SCHOOL OPTION-->

                    @include('pnd::elements.pnd_select', ['name' => 'school_specialist',
                    'categories'=> !empty(@$school_option_specialist) ? $school_option_specialist  : array(),
                    'category_id'=> school_specialist ])


                </div>
            </div>
                @endif


        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.insert_absent').'', ["class" => "btn btn-info pull-left", 'name' => 'insert_absent']) !!}
        {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-center", 'name' => 'search']) !!}
        {!! Form::submit(trans('pexcel::pexcel.export').'', ["class" => "btn btn-info pull-right", 'name' => 'export']) !!}
        {!! Form::close() !!}
    </div>

    
    
   
</div>


