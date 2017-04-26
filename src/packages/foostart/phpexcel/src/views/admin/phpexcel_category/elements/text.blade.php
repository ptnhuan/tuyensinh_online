<!-- phpexcel CATEGORY NAME -->
<div class="form-group"> 
    
    <?php $phpexcel_category_name = $request->get('phpexcel_category_name') ? $request->get('phpexcel_category_name') : @$phpexcel_category->phpexcel_category_name ?>

    {!! Form::label('phpexcel_category_name', trans('phpexcel::phpexcel_admin.name').':') !!}

    {!! Form::text('phpexcel_category_name', $phpexcel_category_name, ['class' => 'form-control', 'placeholder' => trans('phpexcel::phpexcel_admin.name').'']) !!}
     
</div>
<!-- /phpexcel CATEGORY NAME -->