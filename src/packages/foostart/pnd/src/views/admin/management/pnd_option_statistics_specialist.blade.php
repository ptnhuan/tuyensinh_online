
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
                        <th  >Lớp chuyên </th>  
                        <th  >Số lượng</th> 

                    </tr>
                     @foreach($statistics_all_specialist as $school)
                    <tr>


                        <td>+{!! @$school->school_class_name !!}  </td>    
                        <td>{!! @$school->school_class_count !!} hồ sơ</td>     


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


