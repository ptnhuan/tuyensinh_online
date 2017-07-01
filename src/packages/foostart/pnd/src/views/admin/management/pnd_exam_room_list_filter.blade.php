
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
                        <th  >Phòng số </th>  
                        <th  >Từ số BD</th> 
                        <th  >Đến số BD</th> 
                        <th  >Số TS</th> 

                    </tr>
                    @foreach($list_room as $school)
                    <tr>


                        <td>{!! @$school->school_code_test !!}  </td>    
                        <td>{!! @$school->school_room !!}  </td>    
                        <td>{!! @$school->student_indentifi_to!!}</td>     
                        <td>{!! @$school->student_indentifi_from!!} </td>     
                        <td>{!! @$school->school_number_students!!} </td>     


                    </tr>
                    @endforeach

                   
                <div class="paginator">

                </div>

                </thead>
            </table>


            
            

        </div>
        <!--/END TITLE-->

         
    </div>

    <div class="panel-body">



    </div>    

</div>


