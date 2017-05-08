<!--FILE PATH-->

<div class="input-group">

    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail"  class="btn btn-primary">
            <i class="fa fa-picture-o"></i> {{ trans('pexcel::pexcel.pexcel_image_choose') }}
        </a>
    </span>

    <?php $pexcel_file_path = $request->get('pexcel_file_path') ? $request->get('pexcel_file_path') : @$pexcel->pexcel_file_path ?>
    <input id="thumbnail" class="form-control" type="text" name="pexcel_file_path" value="{{$pexcel_file_path}}">

</div>

<!--END FILE PATH-->