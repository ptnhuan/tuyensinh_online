<div class="form-group">
    <?php $pnd_name = $request->get('pnd_name') ? $request->get('pnd_name') : @$pnd->pnd_name ?>
    {!! Form::label($name, trans('pnd::pnd.name').':') !!}
    {!! Form::text($name, $pnd_name, ['class' => 'form-control pnd_name', 'placeholder' => trans('pnd::pnd.name'), 'id' => 'pnd_name']) !!}
</div>
