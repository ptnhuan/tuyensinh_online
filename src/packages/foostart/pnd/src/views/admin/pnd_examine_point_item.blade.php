<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pnd_examine_point.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pnd::pnd.add_examine_point')}}
        </a>
    </div>
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $examinepoints->isEmpty())
    
    <table class="table table-hover">
        <thead>
        <tr>
            <th style='width:5%'>{{ trans('pnd::pnd.order') }}</th>
            <th style='width:15%'>{{ trans('pnd::pnd.school_point_capacity') }}</th>
            <th style='width:15%'>{{ trans('pnd::pnd.school_point_conduct') }}</th>
             <th style='width:15%'>{{ trans('pnd::pnd.school_point_point') }}</th>          
            <th style='width:20%'>{{ trans('pnd::pnd.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nav = $examinepoints->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($examinepoints as $examinepoint)
            <tr>
                <td>
                    <?php
                    echo $counter;
                    $counter++
                    ?>
                </td>
                <td>{!! @$examinepoint-> school_point_capacity !!}</td>
                <td>{!! @$examinepoint->school_point_conduct !!}</td>
                   <td>{!! @$examinepoint->school_point_point !!}</td>
                <td>
                    <a href="{!! URL::route('admin_pnd_examine_point.edit', ['id' => $examinepoint->school_point_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{!! URL::route('admin_pnd_examine_point.delete',['id' =>  $examinepoint->school_point_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                    <span class="clearfix"></span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="paginator">
        {!! $examinepoints->appends($request->except(['page']) )->render() !!}
    </div>
    
@else
    <span class="text-warning">
    <h5>
        {{ trans('pnd::pnd.message_find_failed') }}
    </h5>
</span>
@endif
