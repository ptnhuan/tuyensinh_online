
@if( ! $phpexcels->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('phpexcel::phpexcel_admin.order') }}</td>
            <th style='width:10%'>phpexcel ID</th>
            <th style='width:50%'>phpexcel title</th>
            <th style='width:20%'>{{ trans('phpexcel::phpexcel_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $phpexcels->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($phpexcels as $phpexcel)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! $phpexcel->phpexcel_id !!}</td>
            <td>{!! $phpexcel->phpexcel_name !!}</td>
            <td>
                <a href="{!! URL::route('admin_phpexcel.edit', ['id' => $phpexcel->phpexcel_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_phpexcel.delete',['id' =>  $phpexcel->phpexcel_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
 <span class="text-warning">
	<h5>
            {{ trans('phpexcel::phpexcel_admin.message_find_failed') }}
	</h5>
 </span>
@endif
<div class="paginator">
    {!! $phpexcels->appends($request->except(['page']) )->render() !!}
</div>