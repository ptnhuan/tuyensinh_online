@if( ! empty($students))




<!--LIST OF STUDENTS-->
<div class="scroll_outer">
    <div class="table-data">
        <table class="table table-hover">

            <thead>
                <tr>
                     
                    <th>STT</th>
                    <th>HỘI ĐỒNG TUYỂN SINH</th>
                    <th>HỘI ĐỒNG COI THI</th>
                    <th>SỐ PHÒNG THI</th>                
                    <th>TỪ PHÒNG</th>
                    <th>ĐẾN PHÒNG</th>
                    <th>CHỦ TỊCH</th>
                    <th>ĐT CHỦ TỊCH</th>
                    <th>EMAIL CHỦ TỊCH</th>
                    <th>THƯ KÝ</th>
                    <th>ĐT THƯ KÝ</th>
                    <th>EMAIL THƯ KÝ</th>
                   
                </tr>
            </thead>

            <tbody>
                <?php
             
                $counter = 1;
                ?>
                @foreach($students as $student)
                <tr>
                    
                    <td>
                        <?php
                          // var_dump($student->school_code);die();
                        echo $counter;
                        $counter++
                        ?>
                    </td>

                    <td>{!! @$student->school_name!!}</td>
                    <td>{!! @$student->school_test_name!!}</td>
                    <td>{!! @$student->school_number_room!!}</td>
                    <td>{!! @$student->school_number_room_to!!}</td>                   
                    <td>{!! @$student->school_number_room_from	!!}</td>
                    <td>{!! @$student->school_test_chutich!!}</td>
                    <td>{!! @$student->school_test_phone_chutich!!}</td>
                    <td>{!! @$student->school_test_email_chutich!!}</td>
                    <td>{!! @$student->school_test_thuky!!}</td>
                    <td>{!! @$student->school_test_phone_thuky!!}</td>
                    <td>{!! @$student->school_test_email_thuky!!}</td>
                 
                    


                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<div class="paginator">
   
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
    $('.table-data').width(12 * 160);

    $(".delete").click(function () {
        return confirm("{{ trans('pexcel::pexcel.delete_confirm') }}");
    });
</script>
@stop