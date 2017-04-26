<!-- phpexcel INPUT NAME -->
<div class="form-group">
    <?php $phpexcel_name = $request->get('phpexcel_name') ? $request->get('phpexcel_name') : @$phpexcel->phpexcel_name ?>
    {!! Form::label($name, trans('phpexcel::phpexcel_admin.name').':') !!}
    {!! Form::text($name, $phpexcel_name, ['class' => 'form-control', 'placeholder' => trans('phpexcel::phpexcel_admin.name').'']) !!}
</div>
<!-- /END phpexcel INPUT NAME -->