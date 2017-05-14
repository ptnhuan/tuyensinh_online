<div class="form-group">
    {!! Form::label($name, trans('pnd::pnd.'.$name).':') !!}
    {!! Form::text($name, @$value, ['class' => 'form-control pnd_name', 'placeholder' => trans('pnd::pnd.'.$name), 'id' => $name]) !!}
</div>
