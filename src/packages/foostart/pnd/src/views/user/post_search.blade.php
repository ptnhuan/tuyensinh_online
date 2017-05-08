
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('post::post_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'user_post','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

            {!! Form::label('post_name', trans('post::post_admin.post_name_label')) !!}
            {!!
                Form::text('post_name', @$params['post_name'],
                    ['class' => 'form-control', 'placeholder' => trans('post::post_admin.post_name_placeholder')])
            !!}

        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('post::post_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


