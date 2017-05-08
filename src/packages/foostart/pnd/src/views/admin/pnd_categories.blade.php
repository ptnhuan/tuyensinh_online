
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pexcel::pexcel.page_categories') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            <?php $categories = !empty(@$categories) ? $categories : array(); ?>
            <?php $category_id = $request->get('category_id') ? $request->get('category_id') : @$student->pexcel_category_id?>
                
            {!! Form::label('pexcel_categories', trans('pexcel::pexcel.pexcel_categories_label')) !!}

            {!! Form::select('pexcel_category_id', $categories, $category_id, ['class' => 'form-control']) !!}
        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pexcel::pexcel.filter').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


