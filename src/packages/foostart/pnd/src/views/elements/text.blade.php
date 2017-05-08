<div class="form-group">
     <?php $pexcel_description = $request->get('pexcel_description') ? $request->get('pexcel_description') : @$pexcel->pexcel_description ?>
    {!! Form::label('pexcel_description', trans('pexcel::pexcel.pexcel_description').':') !!}
    {!! Form::textarea ('pexcel_description', @$pexcel_description, ['class' => 'form-control tinymce my-editor', 'rows' => 20, 'placeholder' => trans('tasks.task_description')]) !!}
</div>