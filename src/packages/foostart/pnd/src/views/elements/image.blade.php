<!--FILE PATH-->

<div class="input-group">

    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail"  class="btn btn-primary">
            <i class="fa fa-picture-o"></i> {{ trans('pnd::pnd.pnd_image_choose') }}
        </a>
    </span>

    <?php $pnd_file_path = $request->get('pnd_file_path') ? $request->get('pnd_file_path') : @$pnd->pnd_file_path ?>
    <input id="thumbnail" class="form-control" type="text" name="pnd_file_path" value="{{$pnd_file_path}}">

</div>

<!--END FILE PATH-->
