<!-- POST OVERVIEW -->
<div class="form-group">
     <?php $post_overview = $request->get('post_overview') ? $request->get('post_overview') : @$post->post_overview ?>
    {!! Form::label('post_overview', trans('post::post_admin.post_overview').':') !!}
    {!! Form::textarea ('post_overview', @$post_overview, ['class' => 'form-control tinymce my-editor', 'rows' => 5, 'placeholder' => trans('tasks.task_overview')]) !!}

</div>
<!--/END POST OVERVIEW-->

<!-- POST DESCRIPTION -->
<div class="form-group">
     <?php $post_description = $request->get('post_description') ? $request->get('post_description') : @$post->post_description ?>
    {!! Form::label('post_description', trans('post::post_admin.post_description').':') !!}
    {!! Form::textarea ('post_description', @$post_description, ['class' => 'form-control tinymce my-editor', 'rows' => 20, 'placeholder' => trans('tasks.task_description')]) !!}
</div>
<!--/END POST DESCRIPTION-->