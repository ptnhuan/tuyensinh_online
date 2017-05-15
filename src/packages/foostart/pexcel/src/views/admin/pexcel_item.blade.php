
@if( ! $pexcels->isEmpty() )
<table class="table table-hover">

    <thead>
        <tr>
            <th style='width:5%'>{{ trans('pexcel::pexcel.order') }}</th>

            <th style='width:25%'>{{trans('pexcel::pexcel.pexcel_item_title')}}</th>

            <th style='width:15%'>{{trans('pexcel::pexcel.pexcel_item_updated')}}</th>

            <th style='width:25%'>{{trans('pexcel::pexcel.pexcel_item_status')}}</th>

            <th style='width:20%'>{{trans('pexcel::pexcel.pexcel_item_file')}}</th>

            <th style='width:15%'>
                <div class="item_right">
                    {{ trans('pexcel::pexcel.operations') }}
                </div>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php
        $nav = $pexcels->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($pexcels as $pexcel)


        <tr>
            <!--ORDER-->
            <td><?php
                echo $counter;
                $counter++
                ?></td>

            <!--PEXCEL NAME-->
            <td>{!! $pexcel->pexcel_name !!}</td>

            <!--UPDATED TIME-->
            <td>{!! date('d-m-Y', $pexcel->pexcel_updated_at) !!}</td>

            <!--STATUS-->
            <td>
                <?php
                $status = config('pexcel.status_str');
                echo $status[$pexcel->pexcel_status]
                ?>
            </td>

            <!--FILE-->
            <td>
                <a href='<?php echo Url($pexcel->pexcel_file_path) ?>'>
<?php echo $pexcel->pexcel_file_path ?>
                </a>
            </td>

            <!--ACTION-->
            <td>
                <div class="item_right">
                    <a href="{!! URL::route('admin_pexcel.edit', ['id' => $pexcel->pexcel_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{!! URL::route('admin_pexcel.delete',['id' =>  $pexcel->pexcel_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete">
                        <i class="fa fa-trash-o fa-2x"></i>
                    </a>
                    <span class="clearfix"></span>
                </div>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
<div class="paginator">
    {!! $pexcels->appends($request->except(['page']) )->render() !!}
</div>
@endif