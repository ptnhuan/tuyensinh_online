<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pnd_specialist.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pnd::pnd.add_specialist')}}
        </a>
    </div>
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $specialists->isEmpty())
    
    <table class="table table-hover">
        <thead>
        <tr>
            <th style='width:5%'>{{ trans('pnd::pnd.order') }}</th>
            <th style='width:30%'>{{ trans('pnd::pnd.school_class_code') }}</th>
            <th style='width:15%'>{{ trans('pnd::pnd.school_class_name') }}</th>
          
            <th style='width:20%'>{{ trans('pnd::pnd.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nav = $specialists->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($specialists as $specialist)
            <tr>
                <td>
                    <?php
                    echo $counter;
                    $counter++
                    ?>
                </td>
                <td>{!! @$specialist-> school_class_code !!}</td>
                <td>{!! @$specialist->school_class_name !!}</td>
                
                <td>
                    <a href="{!! URL::route('admin_pnd_specialist.edit', ['id' => $specialist->school_class_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{!! URL::route('admin_pnd_specialist.delete',['id' =>  $specialist->school_class_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                    <span class="clearfix"></span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="paginator">
        {!! $specialists->appends($request->except(['page']) )->render() !!}
    </div>
    
@else
    <span class="text-warning">
    <h5>
        {{ trans('pnd::pnd.message_find_failed') }}
    </h5>
</span>
@endif
