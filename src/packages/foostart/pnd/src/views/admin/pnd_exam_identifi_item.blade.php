@if( ! empty($students))

<!--LIST OF STUDENTS-->
<div class="scroll_outer">
    <div class="table-data">
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>STT</th>
                    <th>Số báo danh</th>   
                    <th>Phòng thi</th> 
                    <th>Họ và tên</th>          
                    <th>HL L6</th>
                    <th>HK L6</th>
                    <th>Điểm L6</th>
                    <th>HL L7</th>
                    <th>HK L7</th>
                    <th>Điểm L7</th>
                    <th>HL L8</th>
                    <th>HK L8</th>
                    <th>Điểm L8</th>
                    <th>HL L9</th>
                    <th>HK L9</th>
                    <th>Điểm L9</th>
                    <th>ƯT,KK</th>
                    <th>Ký hiệu ƯT,KK</th>
                    <th>Tổng điểm</th>

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
                    <td>{!! @$student->	student_identifi_name!!}</td>
                    <td>{!! @$student->student_room!!}</td>
                    <td>{!! @$student->student_first_name .' '. @$student->student_last_name !!}</td>
                    <td>{!! @$student->student_capacity_6!!}</td>
                    <td>{!! @$student->student_conduct_6!!}</td>
                    <td>{!! @$student->student_point_6!!}</td>                
                    <td>{!! @$student->student_capacity_7!!}</td>
                    <td>{!! @$student->student_conduct_7!!}</td>
                    <td>{!! @$student->student_point_7!!}</td>
                    <td>{!! @$student->student_capacity_8!!}</td>
                    <td>{!! @$student->student_conduct_8!!}</td>
                    <td>{!! @$student->student_point_8!!}</td>
                    <td>{!! @$student->student_capacity_9!!}</td>
                    <td>{!! @$student->student_conduct_9!!}</td>
                    <td>{!! @$student->student_point_9!!}</td>
                    <td>{!! @$student->student_score_prior!!}</td>
                    <td>{!! @$student->student_score_prior_comment!!}</td>
                    <td>{!! @$student->student_point_sum!!}</td>
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
    $('.table-data').width(19 * 77);

    $(".delete").click(function () {
        return confirm("{{ trans('pexcel::pexcel.delete_confirm') }}");
    });
</script>
@stop