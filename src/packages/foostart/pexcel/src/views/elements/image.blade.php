<!--POST INPUT IMAGE-->

<div class="input-group">
    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" data-dir="dir" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> {{ trans('pexcel::pexcel.pexcel_image_choose') }}
        </a>
    </span>

    <?php $pexcel_image_name = $request->get('pexcel_image_name') ? $request->get('pexcel_image_name') : @$pexcel->pexcel_image_name ?>
    <input id="thumbnail" class="form-control" type="text" name="pexcel_image_name" value="{{$pexcel_image_name}}">
</div>

<?php
    $url_src = '';
    $pexcel_image_dir = !empty(@$pexcel->pexcel_image_dir) ? $pexcel->pexcel_image_dir:'';

    if (empty($pexcel_image_dir)) {
        $url_src = URL::to('/photos/no-image.png');
    } else {
        $url_src = URL::to($pexcel_image_dir.'/'.$pexcel_image_name);
    }
?>

<img id="holder" style="margin-top:15px;max-height:100px;" src='{{ $url_src }}'>

<input id="dir" class="form-control" type="hidden" name="pexcel_image_path" value="{{ $url_src }}">

<!--END POST INPUT IMAGE-->