<!--phpexcel INPUT IMAGE-->

<div class="input-group">
    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> {{ trans('phpexcel::phpexcel_admin.phpexcel_image_choose') }}
        </a>
    </span>
    
    <?php $phpexcel_image = $request->get('phpexcel_image') ? $request->get('phpexcel_image') : @$phpexcel->phpexcel_image ?>
    <input id="thumbnail" class="form-control" type="text" name="phpexcel_image" value="{{$phpexcel_image}}">
</div>

<?php $phpexcel_image = !empty($phpexcel_image)?$phpexcel_image:'no-image.png' ?>
<img id="holder" style="margin-top:15px;max-height:100px;" src='{{ URL::to('/photos/thumbs/'.$phpexcel_image) }}'>

<!--END phpexcel INPUT IMAGE-->