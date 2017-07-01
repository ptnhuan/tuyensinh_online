<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_exam_room_list') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_exam_room','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

                    
        </div>
        <!--/END TITLE-->

          <?php
        if ($params['keylook_room']==0) {
        ?>
                {!! Form::submit(trans('pnd::pnd.page_exam_room_list').'',["class" => "btn btn-info pull-left", 'name' => 'indent']) !!}
        
        <?php }?>
      

        {!! Form::submit(trans('pnd::pnd.page_exam_room_listk').'',["class" => "btn btn-info pull-right", 'name' => 'indentk']) !!}
        {!! Form::close() !!}
               
        
       
    </div>
    
     <div class="panel-body">

       
        <div class="form-group">

                    
        </div> 
        <!--/END TITLE-->

        <?php
        if ($params['keylook_room']==0) {
        ?>
               Chú ý: Hệ thống chưa Khóa Xếp phòng thi.
        
        <?php }?>
       
           <?php
        if ($params['keylook_room']==1) {
        ?>
               Chú ý: Hệ thống Đã Khóa Xếp phòng thi. Nếu thực hiện lại, Liên hệ quản trị Hệ thống Cấp Sở.
        
        <?php }?>
    </div>
</div>