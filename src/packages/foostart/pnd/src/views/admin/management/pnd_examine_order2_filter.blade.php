
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_examine_order2_filter') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd_examine.order2','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

                    

        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.filter_order2_examine').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


