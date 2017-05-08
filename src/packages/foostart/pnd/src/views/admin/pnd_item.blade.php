
@if( ! $students->isEmpty())
    
    <table class="table table-hover">
        <thead>
        <tr>
            <td style='width:5%'>{{ trans('pnd::pnd.order') }}</td>
            <th style='width:30%'>Họ và tên</th>
            <th style='width:15%'>Email</th>
            <th style='width:15%'>Ngày sinh</th>
            <th style='width:20%'>{{ trans('pnd::pnd.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nav = $students->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($students as $student)
            <tr>
                <td>
                    <?php
                    echo $counter;
                    $counter++
                    ?>
                </td>
                <td>{!! @$student->student_first_name .' '. @$student->student_last_name !!}</td>
                <td>{!! @$student->student_email !!}</td>
                <td>{!! date('d-m-Y', $student->student_birth) !!}</td>
                <td>
                    <a href="{!! URL::route('admin_pnd.edit', ['id' => $student->student_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{!! URL::route('admin_pnd.delete',['id' =>  $student->student_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                    <span class="clearfix"></span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="paginator">
        {!! $students->appends($request->except(['page']) )->render() !!}
    </div>
    
@else
    <span class="text-warning">
    <h5>
        {{ trans('pnd::pnd.message_find_failed') }}
    </h5>
</span>
@endif
