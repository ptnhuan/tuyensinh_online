<div class="form-group">
    {!! Form::label($name, trans('pexcel::pexcel.'.$name).':') !!}
    {!! Form::text($name, $value, ['class' => 'form-control pexcel_name', 'placeholder' => trans('pexcel::pexcel.name'), 'id' => $name]) !!}
</div>