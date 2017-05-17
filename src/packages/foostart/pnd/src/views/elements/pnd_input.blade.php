<div class="form-group">
    <?php $request_name = $request->get($name) ? $request->get($name) : $value ?>
    {!! Form::label($name, trans('pnd::pnd.'.$name).':') !!}
    {!! Form::text($name, $request_name, ['class' => 'form-control pnd_name', @$disabled , 'placeholder' => trans('pnd::pnd.'.$name), 'id' => $name]) !!}
</div>
