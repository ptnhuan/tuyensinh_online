<!-- phpexcel OVERVIEW -->
<div class="form-group">
    {!! Form::label('phpexcel_overview', trans('phpexcel::phpexcel_admin.phpexcel_overview').':') !!}
    {!! Form::textarea ('phpexcel_overview', @$phpexcel->phpexcel_overview, ['class' => 'form-control tinymce my-editor', 'rows' => 5, 'placeholder' => trans('tasks.task_overview')]) !!}

</div> 
<!--/END phpexcel OVERVIEW-->

<!-- phpexcel DESCRIPTION -->
<div class="form-group">
    {!! Form::label('phpexcel_description', trans('phpexcel::phpexcel_admin.phpexcel_description').':') !!}
    {!! Form::textarea ('phpexcel_description', @$phpexcel->phpexcel_description, ['class' => 'form-control tinymce my-editor', 'rows' => 20, 'placeholder' => trans('tasks.task_description')]) !!}
</div>
<!--/END phpexcel DESCRIPTION-->