
@if( ! $students->isEmpty())
<div class="row margin-bottom-12">
    <div class="col-md-12 margin-bottom-12">

        <div class="payroll-status">
            <span class="payroll-status-title">Trạng thái</span>
            <span class="payroll-status-val">
                Bảng lương đã được duyệt

            </span>
        </div>
        <!--Button config payroll-->
        <span>
            <a href="" class="btn btn-info payroll-undo pexcel-confirm">
                <i class="fa fa-undo "></i>Xác nhận</a>
        </span>

        <!--Button edit payroll-->
        <span>
            <a href="" class="btn btn-info pexcel-edit">
                <i class="fa fa-pencil"></i>Làm lại</a>
        </span>

        <!--Button delete payroll-->
        <span>
            <a href="" class="btn btn-info  payroll-delete pexcel-delete">
                <i class="fa fa-times"></i>Xóa</a>
        </span>

    </div>
</div>

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
                <?php
                echo $counter;
                $counter++
                ?>
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