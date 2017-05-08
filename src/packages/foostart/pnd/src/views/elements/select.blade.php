<!-- POST CATEGORY LIST -->
<div class="form-group">
    <?php $category_id = $request->get('category_id') ? $request->get('category_id') : @$pexcel->category_id ?>

    {!! Form::label('category_id', trans('pexcel::pexcel.pexcel_categoty_name').':') !!}

    {!! Form::select('category_id', @$categories, $category_id, ['class' => 'form-control']) !!}
    <span class="add-new">
        <a href='{{URL::route('user_pexcel_category.edit')}}'>
            Thêm danh mục mới
        </a>
    </span>
</div>
<!-- /END POST CATEGORY LIST -->


<!-- SLIDESHOW LIST -->
<div class="form-group">
    <?php $slideshow_id = $request->get('slideshow_id') ? $request->get('slideshow_id') : @$pexcel->slideshow_id ?>

    {!! Form::label('slideshow_id', trans('pexcel::pexcel.slideshow_name').':') !!}

    {!! Form::select('slideshow_id', @$slideshows, @$slideshow_id, ['class' => 'form-control']) !!}
    <span class="add-new">
        <a href='{{URL::route('user_slideshow.edit')}}'>
            Thêm slideshow mới
        </a>
    </span>
</div>
<!-- /END SLIDESHOW LIST -->