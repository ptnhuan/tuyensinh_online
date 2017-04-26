
<div class="panel panel-info">
    <!--TITLE phpexcel CATEGORY SEARCH-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('phpexcel::phpexcel_admin.page_search') ?></h3>
    </div>
    <!--/END TITLE phpexcel CATEGORY SEARCH-->
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_phpexcel_category','method' => 'get']) !!}

        <!--phpexcel CATEGORY SEARCH NAME-->
        <div class="form-group">
            {!! Form::label('phpexcel_category_name',trans('phpexcel::phpexcel_admin.phpexcel_category_name_label')) !!}
            {!! Form::text('phpexcel_category_name', @$params['phpexcel_category_name'], ['class' => 'form-control', 'placeholder' => trans('phpexcel::phpexcel_admin.phpexcel_category_name')]) !!}
        </div>
        <!--/phpexcel CATEGORY SEARCH NAME-->
        {!! Form::submit(trans('phpexcel::phpexcel_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




