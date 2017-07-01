
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.school_number_room_test') ?></h3>
    </div>
    <div class="panel-body">



        <!--TITLE-->
        <div class="form-group">


            <table class="table table-hover">

                <thead>



                    <tr>
                        <th  >Mã HĐCT </th>  
                         <th  >Môn chuyên </th>  
                        <th  >Phòng số </th>  
                        <th  >Từ BD</th> 
                        <th  >Đến BD</th> 
                        <th  >Số TS</th> 

                    </tr>
                    @foreach($list_room as $school)
                    <tr>


                        <td>{!! @$school->school_code_test !!}  </td>    
                        <td>{!! @$school->school_choose_specialist !!}  </td>    
                        <td>{!! @$school->school_room !!}  </td>    
                        <td>{!! @$school->student_indentifi_to!!}</td>     
                        <td>{!! @$school->student_indentifi_from!!} </td>     
                        <td>{!! @$school->school_number_students!!} </td>     


                    </tr>
                    @endforeach


                <div class="paginator">

                </div>
                <div class="row">
                       {!! Form::open(['route' => 'admin_pnd_exame_school_room_list','method' => 'get']) !!}
                    <div class="col-md-12">
                     
                        {!! Form::submit(trans('pexcel::pexcel.export_in').'', ["class" => "btn btn-info pull-left", 'name' => 'export_in']) !!}
                       {!! Form::submit(trans('pexcel::pexcel.export_inde').'', ["class" => "btn btn-info pull-right", 'name' => 'export_inde']) !!}
                       
                    </div>
                   
                        {!! Form::close() !!}
                </div>
                </thead>
            </table>





        </div>
        <!--/END TITLE-->


    </div>

    <div class="panel-body">



    </div>    

</div>


