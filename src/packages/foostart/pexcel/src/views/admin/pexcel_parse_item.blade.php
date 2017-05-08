
@if( ! $students->isEmpty())
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('pexcel::pexcel.order') }}</td>
            <th style='width:50%'>Họ và tên</th>
            <th style='width:15%'>Ngày sinh</th>
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
                <?php echo $counter;
                $counter++ ?>
            </td>
            <td>{!! @$student->student_first_name .' '. @$student->student_last_name !!}</td>

            <td>{!! date('d-m-Y', $student->student_birth) !!}</td>

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
        {{ trans('pexcel::pexcel.message_find_failed') }}
    </h5>
</span>
@endif