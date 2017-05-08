<!-- POST CATEGORY LIST -->
<div class="form-group">
    <?php $category_id = $request->get('category_id') ? $request->get('category_id') : @$pexcel->category_id ?>

    {!! Form::label('pexcel_category_id', trans('pexcel::pexcel.pexcel_categoty_name').':') !!}

    {!! Form::select('pexcel_category_id', @$categories, $category_id, ['class' => 'form-control']) !!}

</div>
<!-- /END POST CATEGORY LIST -->
