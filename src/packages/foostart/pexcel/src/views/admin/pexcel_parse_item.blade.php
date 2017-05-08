
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

<div class="scroll_outer">
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('pexcel::pexcel.order') }}</td>
            <th style='width:50%'>Họ và tên</th>
            <th style='width:5%'>Giới tính</th>
            <th style='width:5%'>Sinh ngày</th>
            <th style='width:5%'>Nơi sinh</th>
            <th style='width:5%'>Mã Trường THCS</th>
            <th style='width:5%'>Lớp</th>
            <th style='width:5%'>HL L6</th>
            <th style='width:5%'>HK L6</th>
             <th style='width:5%'>HL L7</th>
            <th style='width:5%'>HK L7</th>
            <th style='width:5%'>HL L8</th>
            <th style='width:5%'>HK L8</th>
             <th style='width:5%'>HL L9</th>
            <th style='width:5%'>HK L9</th>            
            <th style='width:5%'>ĐTBCN</th>
            <th style='width:5%'>ĐTB Văn</th>
            <th style='width:5%'>ĐTB Toán</th>
            <th style='width:5%'>TN THCS</th>
            <th style='width:5%'>ƯT,KK</th>
            <th style='width:5%'>Ký hiệu ƯT,KK</th>
              <th style='width:5%'>TUYỂN THẲNG</th> 
            <th style='width:5%'>CHUYÊN-DTNT</th>            
            <th style='width:5%'>LỚP CHUYÊN </th>
            <th style='width:5%'>NV 1</th>
            <th style='width:5%'>NV 2</th>
            <th style='width:5%'>Thư điện tử</th>
            <th style='width:5%'>Điện thoại</th>          
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
            <td>{!! @$student->student_birth_day .' /'. @$student->student_birth_month .'/ '. @$student->student_birth_year!!}</td>     
            <td>{!! @$student->student_birth_place!!}</td>    
            <td>{!! @$student->school_id!!}</td>                
            <td>{!! @$student->student_class!!}</td>    
            <td>{!! @$student->student_capacity_6!!}</td>    
            <td>{!! @$student->student_conduct_6!!}</td>    
            <td>{!! @$student->student_capacity_7!!}</td>    
            <td>{!! @$student->student_conduct_7!!}</td>    
            <td>{!! @$student->student_capacity_8!!}</td>    
            <td>{!! @$student->student_conduct_8!!}</td>    
            <td>{!! @$student->student_capacity_9!!}</td>    
            <td>{!! @$student->student_conduct_9!!}</td>    
            <td>{!! @$student->student_average!!}</td>    
            <td>{!! @$student->student_average_1!!}</td>    
            <td>{!! @$student->student_average_2!!}</td>    
            <td>{!! @$student->student_graduate!!}</td>    
            <td>{!! @$student->student_score_prior!!}</td>              
            <td>{!! @$student->student_score_prior_comment!!}</td>    
            <td>{!! @$student->student_nominate!!}</td>    
            <td>{!! @$student->school_id_option!!}</td>    
            <td>{!! @$student->school_class_code!!}</td>    
            <td>{!! @$student->school_code_option_1!!}</td>    
            <td>{!! @$student->school_code_option_2!!}</td>    
            <td>{!! @$student->student_email!!}</td>    
            <td>{!! @$student->student_phone!!}</td>               
        </tr>
        @endforeach
    </tbody>
</table>
</div>
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

<style>
    .scroll_outer{overflow: scroll;}
    table{width: auto !important;}
</style>