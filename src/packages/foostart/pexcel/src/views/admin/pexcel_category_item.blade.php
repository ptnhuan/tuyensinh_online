<!--ADD SAMPLE CATEGORY ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pexcel_category.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pexcel::pexcel.pexcel_category_add_button')}}
        </a>
    </div>
</div>
<!--/END ADD SAMPLE CATEGORY ITEM-->

@if( ! $pexcels_categories->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>
                {{ trans('pexcel::pexcel.order') }}
            </td>

            <th style='width:35%'>
                {{ trans('pexcel::pexcel.pexcel_categoty_name') }}
            </th>

            <th style='width:15%'>
                Trạng thái
            </th>


            <th style='width:25%'>
                {{ trans('pexcel::pexcel.pexcel_categoty_created') }}
            </th>

            <th style='width:20%'>
                {{ trans('pexcel::pexcel.operations') }}
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $pexcels_categories->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($pexcels_categories as $pexcel_category)
        <tr>
            <!--COUNTER-->
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <!--/END COUNTER-->

            <!--SAMPLE CATEGORY ID-->
            <td>
                {!! $pexcel_category->pexcel_category_name !!}
            </td>
            <!--/END SAMPLE CATEGORY ID-->


            <!--SAMPLE CATEGORY ID-->
            <td>
                <?php
                    $pexcel_category_status = config('pexcel.status_category');
                    if ($pexcel_category->pexcel_category_status) {
                        echo $pexcel_category_status[$pexcel_category->pexcel_category_status];
                    }
                ?>
            </td>
            <!--/END SAMPLE CATEGORY ID-->

            <!--SAMPLE CATEGORY NAME-->
            <td>
                {!! date('d-m-Y', $pexcel_category->pexcel_category_updated_at) !!}
            </td>
            <!--/END SAMPLE CATEGORY NAME-->

            <!--OPERATOR-->
            <td>
                <a href="{!! URL::route('admin_pexcel_category.edit', ['id' => $pexcel_category->pexcel_category_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('admin_pexcel_category.delete',['id' =>  $pexcel_category->pexcel_category_id, '_token' => csrf_token()]) !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>
            <!--/END OPERATOR-->
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <!-- FIND MESSAGE -->
    <span class="text-warning">
        <h5>
            {{ trans('pexcel::pexcel.message_find_failed') }}
        </h5>
    </span>
    <!-- /END FIND MESSAGE -->
@endif
<!--SAMPLE PAGINATOR-->
<div class="paginator">
    {!! $pexcels_categories->appends($request->except(['page']) )->render() !!}
</div>
<!--/END SAMPLE PAGINATOR-->