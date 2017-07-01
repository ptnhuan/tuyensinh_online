
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.school_title_test') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_statistics_level_test','method' => 'get']) !!}

        <!--TITLE-->

        
        <div class="row">
            
            

         
            {!! Form::submit(trans('pexcel::pexcel.export_inde').'', ["class" => "btn btn-info pull-left", 'name' => 'export_inde']) !!}
            {!! Form::submit(trans('pexcel::pexcel.export_in').'', ["class" => "btn btn-info pull-right", 'name' => 'export_in']) !!}
            {!! Form::close() !!}

        </div> 



    </div>
</div>


