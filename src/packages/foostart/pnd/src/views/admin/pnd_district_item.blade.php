<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pnd_district.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pnd::pnd.add_district')}}
        </a>
    </div>
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $districts->isEmpty())
    
    <table class="table table-hover">
        <thead>
        <tr>
            <th style='width:5%'>{{ trans('pnd::pnd.order') }}</th>
            <th style='width:30%'>{{ trans('pnd::pnd.school_district_id') }}</th>
            <th style='width:15%'>{{ trans('pnd::pnd.school_district_name') }}</th>
          
            <th style='width:20%'>{{ trans('pnd::pnd.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nav = $districts->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($districts as $district)
            <tr>
                <td>
                    <?php
                    echo $counter;
                    $counter++
                    ?>
                </td>
                <td>{!! @$district-> school_district_code !!}</td>
                <td>{!! @$district->school_district_name !!}</td>
                
                <td>
                    <a href="{!! URL::route('admin_pnd_district.edit', ['id' => $district->school_district_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{!! URL::route('admin_pnd_district.delete',['id' =>  $district->school_district_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                    <span class="clearfix"></span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="paginator">
        {!! $districts->appends($request->except(['page']) )->render() !!}
    </div>
    
@else
    <span class="text-warning">
    <h5>
        {{ trans('pnd::pnd.message_find_failed') }}
    </h5>
</span>
@endif
