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
                     <th style='width:10%'>
                        <div class="item_left">
                            {{ trans('pexcel::pexcel.operations') }}
                        </div>
                    </th>
                   <th>STT</th>
                    <th>Số báo danh </th>
                   <th>Phòng thi</th>
                    <th>Họ </th>
                    <th>Tên</th>                    
                    <th>Sinh ngày</th>
                    <th>Môn thi</th>
                    
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
                         
                        <a href="{!! URL::route('admin_pnd_option.edit', ['id' => $student->student_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                        <a href="{!! URL::route('admin_pnd_option.delete',['id' =>  $student->student_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                     
                        <span class="clearfix"></span>
                    </td>    
                    <td>
                        <?php
                        echo $counter;
                        $counter++
                        ?>
                    </td>
<td>{!! @$student->student_identifi_name!!}</td>
<td>{!! @$student->school_room!!}</td>
                 <td>{!! @$student->student_first_name  !!}</td>
                    <td>{!!  @$student->student_last_name !!}</td>
                    
                    <td>{!! @$student->student_birth_day.'/'.@$student->student_birth_month.'/'.@$student->student_birth_year!!}</td>

                 
                    <td>{!! @$student->school_subject_name!!}</td>
                   


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
    $('.table-data').width(8 * 120);

    $(".delete").click(function () {
        return confirm("{{ trans('pexcel::pexcel.delete_confirm') }}");
    });
</script>
@stop