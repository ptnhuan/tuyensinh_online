<!--ADD phpexcel CATEGORY ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_phpexcel_category.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('phpexcel::phpexcel_admin.phpexcel_category_add_button')}}
        </a>
    </div>
</div>
<!--/END ADD phpexcel CATEGORY ITEM-->

@if( ! $phpexcels_categories->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>
                {{ trans('phpexcel::phpexcel_admin.order') }}
            </td>

            <th style='width:10%'>
                {{ trans('phpexcel::phpexcel_admin.phpexcel_categoty_id') }}
            </th>

            <th style='width:50%'>
                {{ trans('phpexcel::phpexcel_admin.phpexcel_categoty_name') }}
            </th>

            <th style='width:20%'>
                {{ trans('phpexcel::phpexcel_admin.operations') }}
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $phpexcels_categories->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($phpexcels_categories as $phpexcel_category)
        <tr>
            <!--COUNTER-->
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <!--/END COUNTER-->

            <!--phpexcel CATEGORY ID-->
            <td>
                {!! $phpexcel_category->phpexcel_category_id !!}
            </td>
            <!--/END phpexcel CATEGORY ID-->

            <!--phpexcel CATEGORY NAME-->
            <td>
                {!! $phpexcel_category->phpexcel_category_name !!}
            </td>
            <!--/END phpexcel CATEGORY NAME-->

            <!--OPERATOR-->
            <td>
                <a href="{!! URL::route('admin_phpexcel_category.edit', ['id' => $phpexcel_category->phpexcel_category_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('admin_phpexcel_category.delete',['id' =>  $phpexcel_category->phpexcel_category_id, '_token' => csrf_token()]) !!}"
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
            {{ trans('phpexcel::phpexcel_admin.message_find_failed') }}
        </h5>
    </span>
    <!-- /END FIND MESSAGE -->
@endif
<!--phpexcel PAGINATOR-->
<div class="paginator">
    {!! $phpexcels_categories->appends($request->except(['page']) )->render() !!}
</div>
<!--/END phpexcel PAGINATOR-->