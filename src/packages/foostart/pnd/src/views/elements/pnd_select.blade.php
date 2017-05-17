<!-- POST CATEGORY LIST -->
<div class="form-group">  
    
    {!! Form::label(@$name, trans('pnd::pnd.'.@$name).':') !!}

    {!! Form::select(@$name, @$categories, @$category_id, ['class' => 'form-control',@$disabled ]) !!}

</div>
<!-- /END POST CATEGORY LIST -->
 
