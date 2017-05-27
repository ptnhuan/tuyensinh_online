<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
     
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $school_student_school_level_3->isEmpty())

<table class="table table-hover">
    <thead>
        <tr>
            <th style='width:3%'>{{ trans('pnd::pnd.order') }}</th>
            
            <th style='width:8%'>{{ trans('pnd::pnd.school_code') }} </th>
            <th style='width:35%'>{{ trans('pnd::pnd.school_name') }}</th>  
             <th style='width:10%'>{{ trans('pnd::pnd.school_index') }}</th>  
                 
            <th style='width:15%'>{{ trans('pnd::pnd.school_dk1') }}</th> 
            <th style='width:15%'>{{ trans('pnd::pnd.school_dk2') }}</th> 
           
        </tr>
    </thead>
    <tbody>
        <?php
        
       $counter =1;
       $sum1=0;
       $sum2=0;
       $sum3=0;
       $sum4=0;
        ?>
        @foreach($school_student_school_level_3 as $school)
        <tr>
            <td>
                <?php
                echo $counter;
               $counter++;
                       $sum1=$sum1+ $school->school_index_1;
                                                 $sum3=$sum3+ $school->school_option_1;
                             $sum4=$sum4+ $school->school_option_2;
                ?>
            </td>
         
            <td>{!! @$school->school_code !!}</td>
            <td>{!! @$school->school_name !!}</td>    
             <td>{!! @$school->school_index_1 !!}</td>     
             
             <td>{!! @$school->school_option_1 !!}</td>     
             <td>{!! @$school->school_option_2 !!}</td>     
                    
                     
        </tr>
        @endforeach
         <tr>
            <td>
               
            </td>
            <td> </td>
            <td> </td>   
                <td><?php echo $sum1;?></td>    
            
             <td><?php echo $sum3;?></td>     
             <td><?php echo $sum4;?></td>     
                     
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
