@if( ! empty($students))

<!--LIST OF STUDENTS-->
<div class="scroll_outer">
    <div class="table-data">
    <table class="table table-hover">

        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>          
                <th>Lớp</th>
                <th>Học sinh trường</th>      
                <th>Điểm TB Văn</th>    
                <th>Điểm TB Toán</th>    
                <th>Tổng điểm</th>
                <th>Trúng tuyển</th>    

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
                <td>{!! @$student->student_class!!}</td>
                  <td>{!!@$student->school_code!!}</td>
                  <td>{!!@$student->student_average_1!!}</td>
                  <td>{!!@$student->student_average_2!!}</td>
                 <td>{!! @$student->student_point_sum!!}</td>
                   <td>{!! @$student->active!!}</td>
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
        $('.table-data').width(17 * 77);

        $(".delete").click(function () {
            return confirm("{{ trans('pexcel::pexcel.delete_confirm') }}");
        });
    </script>
@stop