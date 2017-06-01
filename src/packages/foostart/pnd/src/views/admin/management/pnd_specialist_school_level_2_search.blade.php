
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_statistics') ?></h3>
    </div>
    <div class="panel-body">

      

        <!--TITLE-->
        <div class="form-group">


            <table class="table table-hover">

                <thead>
                    <tr>
                         <th  >Tổng số học sinh: <?php echo $statistics['sum']; ?> hồ sơ</th>

                    </tr>
                    <tr>
                        <td>Trong đó, các nguyện vọng như sau:</td>

                    </tr>

                    <tr>
                        <th  > Nguyện vọng </th>  
                        <th  >Số lượng</th> 

                    </tr>
                    @foreach($school_student_school_option as $school)
                    <tr>


                        <td>-{!! @$school->school_name !!}  </td>    
                        <td>{!! @$school->countstudent !!} hồ sơ</td>     


                    </tr>
                    @endforeach

                    <tr>
                       <th  >Đăng ký trường chuyên:<?php echo $statistics['lvc']; ?> hồ sơ</th>
                    </tr>
                      <tr>
                        <td>- Trong đó, lớp chuyên như sau:</td>

                    </tr>
                     <tr>
                        <th  >Lớp chuyên </th>  
                        <th  >Số lượng</th> 

                    </tr>
                     @foreach($statistics_all_specialist as $school)
                    <tr>


                        <td>+{!! @$school->school_class_name !!}  </td>    
                        <td>{!! @$school->school_class_count !!} hồ sơ</td>     


                    </tr>
                    @endforeach
                    
                   
                    <tr>
                        <th>Đăng ký DTNT:<?php echo $statistics['dtnt']; ?> hồ sơ</th>
                    </tr>
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


