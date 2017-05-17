
<div class="panel panel-info">
    <!--TITLE SAMPLE CATEGORY SEARCH-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.pnd_category_search') ?></h3>
    </div>
    <!--/END TITLE SAMPLE CATEGORY SEARCH-->
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_category_user','method' => 'get']) !!}

        <!--SAMPLE CATEGORY SEARCH NAME-->
        <div class="form-group">
            {!! Form::label('pnd_category_name',trans('pnd::pnd.pnd_category_name_label')) !!}
            {!! Form::text('pnd_category_name', @$params['pnd_category_name'], ['class' => 'form-control', 'placeholder' => trans('pnd::pnd.pnd_category_name')]) !!}
        </div>
        <!--/SAMPLE CATEGORY SEARCH NAME-->
        {!! Form::submit(trans('pnd::pnd.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




