<!-- POST CATEGORY LIST -->
<div class="form-group">
    <?php $category_id = $request->get('category_id') ? $request->get('category_id') : @$post->category_id ?>

    {!! Form::label('category_id', trans('post::post_admin.post_categoty_name').':') !!}

    {!! Form::select('category_id', @$categories, $category_id, ['class' => 'form-control']) !!}
    <span class="add-new">
        <a href='{{URL::route('user_post_category.edit')}}'>
            Thêm danh mục mới
        </a>
    </span>
</div>
<!-- /END POST CATEGORY LIST -->


<!-- SLIDESHOW LIST -->
<div class="form-group">
    <?php $slideshow_id = $request->get('slideshow_id') ? $request->get('slideshow_id') : @$post->slideshow_id ?>

    {!! Form::label('slideshow_id', trans('post::post_admin.slideshow_name').':') !!}

    {!! Form::select('slideshow_id', @$slideshows, @$slideshow_id, ['class' => 'form-control']) !!}
    <span class="add-new">
        <a href='{{URL::route('user_slideshow.edit')}}'>
            Thêm slideshow mới
        </a>
    </span>
</div>
<!-- /END SLIDESHOW LIST -->

<style type="text/css">
    .add-new a:hover {
        text-decoration: none;
        font-weight: bold;
    }
    .add-new a{
        color: #f4645f;
        font-size: 11px;
        font-style: italic;
    }
</style>