
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
                <div class="col-md-6">
                    <!--SCHOOL OPTION-->
                                      
                          @include('pnd::elements.pnd_select', ['name' => 'school_option123',
                                            'categories'=> !empty(@$school_option123) ? $school_option123  : array()
                                             ])
                    
                    
                </div>
            </div>

            <!-- POST CATEGORY LIST -->
            <div class="form-group">
                <?php $pexcel_id = $request->get('pexcel_id') ? $request->get('pexcel_id') : 0 ?>

                {!! Form::label('pexcel_id', 'Đợt cập nhật:') !!}

                {!! Form::select('pexcel_id', @$pexcels, $pexcel_id, ['class' => 'form-control']) !!}
            </div>
            <!-- /END POST CATEGORY LIST -->

        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-left", 'name' => 'search']) !!}
        {!! Form::submit(trans('pexcel::pexcel.export').'', ["class" => "btn btn-info pull-right", 'name' => 'export']) !!}
        {!! Form::close() !!}
    </div>
</div>


