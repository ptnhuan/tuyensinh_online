<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pnd_school.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pnd::pnd.add_school')}}
        </a>
    </div>
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $schools->isEmpty())

<table class="table table-hover">
    <thead>
        <tr>
            <th style='width:5%'>{{ trans('pnd::pnd.order') }}</th>
            <th style='width:10%'>{{ trans('pnd::pnd.school_code') }} </th>
            <th style='width:35%'>{{ trans('pnd::pnd.school_name') }}</th>  
            <th style='width:5%'>{{ trans('pnd::pnd.school_level_id') }}</th>  
            <th style='width:10%'>{{ trans('pnd::pnd.school_phone') }}</th>
            <th style='width:15%'>{{ trans('pnd::pnd.school_email') }}</th>
            <th style='width:20%'>{{ trans('pnd::pnd.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $schools->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($schools as $school)
        <tr>
            <td>
                <?php
                echo $counter;
                $counter++
                ?>
            </td>
            <td>{!! @$school-> school_code !!}</td>
            <td>{!! @$school->school_name !!}</td>     
             <td>{!! @$school->school_level_id !!}</td>     
            <td>{!! @$school->school_phone !!}</td>
            <td>{!! @$school->school_email !!}</td>


            <td>
                <a href="{!! URL::route('admin_pnd_school.edit', ['id' => $school->school_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_pnd_school.delete',['id' =>  $school->school_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="paginator">
    {!! $schools->appends($request->except(['page']) )->render() !!}
</div>

@else
<span class="text-warning">
    <h5>
        {{ trans('pnd::pnd.message_find_failed') }}
    </h5>
</span>
@endif
