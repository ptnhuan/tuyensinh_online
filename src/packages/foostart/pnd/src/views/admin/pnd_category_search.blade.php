
<div class="panel panel-info">
    <!--TITLE SAMPLE CATEGORY SEARCH-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pexcel::pexcel.pexcel_category_search') ?></h3>
    </div>
    <!--/END TITLE SAMPLE CATEGORY SEARCH-->
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pexcel_category','method' => 'get']) !!}

        <!--SAMPLE CATEGORY SEARCH NAME-->
        <div class="form-group">
            {!! Form::label('pexcel_category_name',trans('pexcel::pexcel.pexcel_category_name_label')) !!}
            {!! Form::text('pexcel_category_name', @$params['pexcel_category_name'], ['class' => 'form-control', 'placeholder' => trans('pexcel::pexcel.pexcel_category_name')]) !!}
        </div>
        <!--/SAMPLE CATEGORY SEARCH NAME-->
        {!! Form::submit(trans('pexcel::pexcel.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




