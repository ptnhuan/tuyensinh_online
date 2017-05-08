<div class="form-group">
    <?php $pexcel_name = $request->get('pexcel_name') ? $request->get('pexcel_name') : @$pexcel->pexcel_name ?>
    {!! Form::label($name, trans('pexcel::pexcel.name').':') !!}
    {!! Form::text($name, $pexcel_name, ['class' => 'form-control pexcel_name', 'placeholder' => trans('pexcel::pexcel.name'), 'id' => 'pexcel_name']) !!}
</div>
