
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_categories') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            <?php $categories = !empty(@$categories) ? $categories : array(); ?>
            <?php $category_id = $request->get('category_id') ? $request->get('category_id') : @$student->pexcel_category_id?>
                
            {!! Form::label('pexcel_categories', trans('pnd::pnd.pnd_categories_label')) !!}

            {!! Form::select('pexcel_category_id', $categories, $category_id, ['class' => 'form-control']) !!}

            <!--SCHOOL OPTION-->
            @include ('pnd::elements.input',['name'=>'school_option'])
            <!--NAME OR EMAIL STUDENT-->
            @include ('pnd::elements.input',['name'=>'search_student'])

        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.filter').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


