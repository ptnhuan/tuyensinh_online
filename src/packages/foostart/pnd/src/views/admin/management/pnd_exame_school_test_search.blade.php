<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_exam_room_test_list') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_exame_school_test.order','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

                    
        </div>
        <!--/END TITLE-->

          <?php
        if ($params['keylook_test']==0) {
        ?>
                {!! Form::submit(trans('pnd::pnd.page_exam_room_test_list').'',["class" => "btn btn-info pull-left", 'name' => 'indent']) !!}
        
        <?php }?>
      
             {!! Form::submit(trans('pnd::pnd.page_exam_room_test_listk').'',["class" => "btn btn-info pull-right", 'name' => 'indentk']) !!}
        {!! Form::close() !!}
               
        
       
    </div>
</div>