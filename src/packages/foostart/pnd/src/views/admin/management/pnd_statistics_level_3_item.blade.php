<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
     
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $school_student_school_level_3->isEmpty())

<table class="table table-hover">
    <thead>
        <tr>
            <th style='width:5%'>{{ trans('pnd::pnd.order') }}</th>
            
            <th style='width:10%'>{{ trans('pnd::pnd.school_code') }} </th>
            <th style='width:35%'>{{ trans('pnd::pnd.school_name') }}</th>  
             <th style='width:15%'>{{ trans('pnd::pnd.school_index') }}</th>  
               <th style='width:15%'>{{ trans('pnd::pnd.school_index') }}</th>  
            <th style='width:35%'>{{ trans('pnd::pnd.school_student_count') }}</th> 
           
        </tr>
    </thead>
    <tbody>
        <?php
        
       $counter =1;
       $sum=0;
        ?>
        @foreach($school_student_school_level_3 as $school)
        <tr>
            <td>
                <?php
                echo $counter;
               $counter++;
                       $sum=$sum+ $school->countstudent;
                ?>
            </td>
         
            <td>{!! @$school-> school_code !!}</td>
            <td>{!! @$school->school_name !!}</td>    
             <td>{!! @$school->school_index !!}</td>     
             <td>{!! @$school->countstudent !!}</td>     
                     <td>{!! @$school->countstudent1 !!}</td>     
                     
        </tr>
        @endforeach
         <tr>
            <td>
               
            </td>
            <td> </td>
            <td> </td>   
              <td> </td>  
             <td><?php echo $sum;?></td>     
                     
        </tr>
        
    </tbody>
</table>
 
@else
<span class="text-warning">
    <h5>
        {{ trans('pnd::pnd.message_find_failed') }}
    </h5>
</span>
@endif
