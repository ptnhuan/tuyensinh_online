<!-- SAMPLE INPUT NAME -->
<div class="form-group">

    {!! Form::label('key', trans('phpexcel::phpexcel_admin.phpexcel_key').':') !!}
    {!! Form::text('key', $phpexcel->phpexcel_key, ['class' => 'form-control', 'placeholder' => trans('phpexcel::phpexcel_admin.name').'']) !!}

</div>
<!-- /END SAMPLE INPUT NAME -->