<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_exam_identification') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_exam_identifi','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

                    
        </div>
        <!--/END TITLE-->

        <?php
        if ($params['keylook_identifi']==0) {
        ?>
                {!! Form::submit(trans('pnd::pnd.page_exam_indentifi_filter').'',["class" => "btn btn-info pull-left", 'name' => 'indent']) !!}
        
        <?php }?>
        {!! Form::submit(trans('pnd::pnd.page_exam_indentifi_filterk').'',["class" => "btn btn-info pull-right", 'name' => 'indentk']) !!}
        {!! Form::close() !!}
               
           
    </div>
    
       <div class="panel-body">

       
        <div class="form-group">

                    
        </div> 
        <!--/END TITLE-->

        <?php
        if ($params['keylook_identifi']==0) {
        ?>
               Chú ý: Hệ thống chưa Khóa đánh số báo danh.
        
        <?php }?>
       
           <?php
        if ($params['keylook_identifi']==1) {
        ?>
               Chú ý: Hệ thống Đã Khóa đánh số báo danh. Nếu đánh lại số báo danh, Liên hệ quản trị Hệ thống Cấp Sở.
        
        <?php }?>
    </div>
</div>