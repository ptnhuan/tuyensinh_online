<!-- phpexcel CATEGORY LIST -->
<div class="form-group">
    <?php $category_id = $request->get('category_id') ? $request->get('category_id') : @$phpexcel->category_id ?>

    {!! Form::label('category_id', trans('phpexcel::phpexcel_admin.phpexcel_categoty_name').':') !!}

    {!! Form::select('category_id', @$categories, $category_id, ['class' => 'form-control']) !!}
</div>
<!-- /END phpexcel CATEGORY LIST -->


<!-- SLIDESHOW LIST -->
<div class="form-group">
    <?php $slideshow_id = $request->get('slideshow_id') ? $request->get('slideshow_id') : @$phpexcel->slideshow_id ?>

    {!! Form::label('slideshow_id', trans('phpexcel::phpexcel_admin.slideshow_name').':') !!}

    {!! Form::select('slideshow_id', @$slideshows, @$slideshow_id, ['class' => 'form-control']) !!}
</div>
<!-- /END SLIDESHOW LIST -->