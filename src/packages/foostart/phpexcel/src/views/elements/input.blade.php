<!-- SAMPLE INPUT NAME -->
<div class="form-group">

    {!! Form::label('key', trans('api::api_admin.api_key').':') !!}
    {!! Form::text('key', $api->api_key, ['class' => 'form-control', 'placeholder' => trans('api::api_admin.name').'']) !!}

</div>
<!-- /END SAMPLE INPUT NAME -->