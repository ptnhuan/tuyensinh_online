
<div class="panel panel-info">
    <!--TITLE SAMPLE CATEGORY SEARCH-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('post::post_admin.post_category_search') ?></h3>
    </div>
    <!--/END TITLE SAMPLE CATEGORY SEARCH-->
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_post_category','method' => 'get']) !!}

        <!--SAMPLE CATEGORY SEARCH NAME-->
        <div class="form-group">
            {!! Form::label('post_category_name',trans('post::post_admin.post_category_name_label')) !!}
            {!! Form::text('post_category_name', @$params['post_category_name'], ['class' => 'form-control', 'placeholder' => trans('post::post_admin.post_category_name')]) !!}
        </div>
        <!--/SAMPLE CATEGORY SEARCH NAME-->
        {!! Form::submit(trans('post::post_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




