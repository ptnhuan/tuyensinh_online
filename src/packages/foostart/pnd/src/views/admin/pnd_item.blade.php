@if( ! empty($students))



<?php
if ($addeditde == 0) {
    ?>
    <div class="row margin-bottom-12">
        <div class="col-md-12">
            <a href="{!! URL::route('admin_pnd.edit') !!}" class="btn btn-info pull-right">
                <i class="fa fa-plus"></i>{{trans('pnd::pnd.page_add')}}
            </a>
        </div>
    </div>
<?php } ?>
<!--LIST OF STUDENTS-->
<div class="scroll_outer">
    <div class="table-data">
        <table class="table table-hover">

            <thead>
                <tr>
                    <th style='width:4%'>
                        <div class="item_left">
                            {{ trans('pexcel::pexcel.operations') }}
                        </div>
                    </th>
                    <th>STT</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Sinh ngày</th>
                    <th>Nơi sinh</th>
                    <th>Mã Trường THCS</th>
                    <th>Mã huyện</th>
                    <th>Lớp</th>
                    <th>HL L6</th>
                    <th>HK L6</th>
                    <th>HL L7</th>
                    <th>HK L7</th>
                    <th>HL L8</th>
                    <th>HK L8</th>
                    <th>HL L9</th>
                    <th>HK L9</th>
                    <th>ĐTBCN</th>
                    <th>ĐTB Văn</th>
                    <th>ĐTB Toán</th>
                    <th>TN THCS</th>
                    <th>ƯT,KK</th>
                    <th>Ký hiệu ƯT,KK</th>
                    <th>TUYỂN THẲNG</th>
                    <th>CHUYÊN-DTNT</th>
                    <th>LỚP CHUYÊN </th>
                    <th>NV 1</th>
                    <th>NV 2</th>
                    <th>Thư điện tử</th>
                    <th>Điện thoại</th>
                    <th>Tên đăng nhập</th>
                    <th>Mật khẩu</th>
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
                        <a href="{!! URL::route('admin_pnd.edit', ['id' => $student->student_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                        <a href="{!! URL::route('admin_pnd.delete',['id' =>  $student->student_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                        <span class="clearfix"></span>
                    </td>

                    <td>
                        <?php
                        echo $counter;
                        $counter++
                        ?>
                    </td>

                    <td>{!! @$student->student_first_name .' '. @$student->student_last_name !!}</td>
                    <td>{!! @$student->student_sex!!}</td>
                    <td>{!! @$student->student_birth_day.'/'.@$student->student_birth_month.'/'.@$student->student_birth_year!!}</td>

                    <td>{!! @$student->student_birth_place!!}</td>
                    <td>{!! @$student->school_code!!}</td>
                    <td>{!! @$student->school_district_code!!}</td>
                    <td>{!! @$student->student_class!!}</td>
                    <td>{!! @$student->student_conduct_6!!}</td>
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
                    <td>{!! @$student->school_code_option!!}</td>
                    <td>{!! @$student->school_class_code!!}</td>
                    <td>{!! @$student->school_code_option_1!!}</td>
                    <td>{!! @$student->school_code_option_2!!}</td>
                    <td>{!! @$student->student_email!!}</td>
                    <td>{!! @$student->student_phone!!}</td>
                    <td>{!! @$student->student_user!!}</td>
                    <td>{!! @$student->student_pass!!}</td>



                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
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

<style>
    .scroll_outer{overflow: scroll;}
    table{width: auto !important;}
    .type-413 {
        font-family: PT Serif;
        margin: 30px 0;
    }
    .type-413 .alert {
        margin-bottom: 0;
    }
    .type-413 hr.message-inner-separator {
        clear: both;
        margin-top: 10px;
        margin-bottom: 13px;
        border: 0;
        height: 1px;
        background-image: -webkit-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    }
</style>

@section('sub_page_scripts')
<script type='text/javascript'>
    $('.table-data').width(32 * 77);

    $(".delete").click(function () {
        return confirm("{{ trans('pexcel::pexcel.delete_confirm') }}");
    });
</script>
@stop