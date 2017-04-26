
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('phpexcel::phpexcel_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_phpexcel','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            
            {!! Form::label('phpexcel_name', trans('phpexcel::phpexcel_admin.phpexcel_name_label')) !!}
            {!! 
                Form::text('phpexcel_name', @$params['phpexcel_name'], 
                    ['class' => 'form-control', 'placeholder' => trans('phpexcel::phpexcel_admin.phpexcel_name_placeholder')])
            !!}
                    
        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('phpexcel::phpexcel_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


