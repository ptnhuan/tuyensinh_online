<!--POST INPUT IMAGE-->

<div class="input-group">
    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" data-dir="dir" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> {{ trans('post::post_admin.post_image_choose') }}
        </a>
    </span>

    <?php $post_image_name = $request->get('post_image_name') ? $request->get('post_image_name') : @$post->post_image_name ?>
    <input id="thumbnail" class="form-control" type="text" name="post_image_name" value="{{$post_image_name}}">
</div>

<?php
    $url_src = '';
    $post_image_dir = !empty(@$post->post_image_dir) ? $post->post_image_dir:'';

    if (empty($post_image_dir)) {
        $url_src = URL::to('/photos/no-image.png');
    } else {
        $url_src = URL::to($post_image_dir.'/'.$post_image_name);
    }
?>

<img id="holder" style="margin-top:15px;max-height:100px;" src='{{ $url_src }}'>

<input id="dir" class="form-control" type="hidden" name="post_image_path" value="{{ $url_src }}">

<!--END POST INPUT IMAGE-->