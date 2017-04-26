
<table class="table table-hover">
    <thead>
        <tr>
            <th style='width:10%'>Phpexcel ID</th>
            <th style='width:50%'>Phpexcel Name</th>
            <th style='width:30%'>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($phpexcels as $phpexcel)
        <tr>
            <td>{{ $phpexcel->phpexcel_id }}</td>
            <td>{{$phpexcel->phpexcel_name}}</td>

            <td>
                <a href="{!! URL::route('admin_phpexcel.edit', ['id' => $phpexcel->phpexcel_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_phpexcel.delete',['id' =>  $phpexcel->phpexcel_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>