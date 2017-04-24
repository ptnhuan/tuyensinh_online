<div class="panel panel-info">
    
    <!--HEADING-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i>
            {{trans('tuyensinh.user_search_heading')}}
        </h3>
    </div>
    
    <div class="panel-body">
        {!! Form::open(['route' => 'users.list','method' => 'get']) !!}
        
        <!--EMAIL-->
        <div class="form-group">
            {!! Form::label('email',trans('tuyensinh.user_Email')) !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('tuyensinh.user_email')]) !!}
        </div>
        <span class="text-danger">{!! $errors->first('email') !!}</span>
        
        <!--FULL NAME-->
        <div class="form-group">
            {!! Form::label('first_name',trans('tuyensinh.user_first_name')) !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('tuyensinh.user_fullname')]) !!}
        </div>
        <span class="text-danger">{!! $errors->first('user_fullname') !!}</span>
        
        
        <div class="form-group">
            {!! Form::label('activated', trans('tuyensinh.user_Active')) !!}
            {!! Form::select('activated', ['' => 'Any', 1 => 'Yes', 0 => 'No'], $request->get('activated',''), ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('banned', 'Banned: ') !!}
            {!! Form::select('banned', ['' => 'Any', 1 => 'Yes', 0 => 'No'], $request->get('banned',''), ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('group_id', 'Group: ') !!}
            <?php $group_values[""] = "Any"; ?>
            {!! Form::select('group_id', $group_values, $request->get('group_id',''), ["class" => "form-control"]) !!}
        </div>
        @include('laravel-authentication-acl::admin.user.partials.sorting')
        <div class="form-group">
             
            {!! Form::submit(trans('tuyensinh.user_Reset'), ["class" => "btn btn-info", "id" => "search-submit"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>