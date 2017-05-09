<div class="form-group">
    <?php $pexcel_name = $request->get($name) ? $request->get($name) : @$pexcel->$name ?>
    {!! Form::label($name, $label.':') !!}
    {!! Form::text($name, $pexcel_name, ['class' => 'form-control pexcel_name', 'placeholder' => $label, 'id' => $name]) !!}
</div>
