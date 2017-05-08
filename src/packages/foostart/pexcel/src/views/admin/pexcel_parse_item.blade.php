
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('pexcel::pexcel.order') }}</td>
            <th style='width:50%'>{{trans('pexcel::pexcel.pexcel_item_title')}}</th>
        </tr>
    </thead>
    <tbody>
        <?php
//            $nav = $students->toArray();
        $nav = 1;
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($students as $student)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! @$student->id !!}</td>

        </tr>
        @endforeach
    </tbody>
</table>
 <span class="text-warning">
	<h5>
            {{ trans('pexcel::pexcel.message_find_failed') }}
	</h5>
 </span>
<div class="paginator">
</div>