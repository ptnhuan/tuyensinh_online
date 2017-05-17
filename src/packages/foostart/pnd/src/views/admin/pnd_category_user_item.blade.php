<!--ADD SAMPLE CATEGORY ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pnd_category_user.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pnd::pnd.pnd_category_add_button')}}
        </a>
    </div>
</div>
<!--/END ADD SAMPLE CATEGORY ITEM-->

@if( ! $categoryusers->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>
                {{ trans('pnd::pnd.order') }}
            </td>

            <th style='width:50%'>
                {{ trans('pnd::pnd.pnd_categoty_name') }}
            </th>

            <th style='width:25%'>
                {{ trans('pnd::pnd.pnd_categoty_created') }}
            </th>

            <th style='width:20%'>
                {{ trans('pnd::pnd.operations') }}
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $categoryusers->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($categoryusers as $pnd_category)
        <tr>
            <!--COUNTER-->
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <!--/END COUNTER-->

            <!--SAMPLE CATEGORY ID-->
            <td>
                {!! $pnd_category->user_categoy_name !!}
            </td>
            <!--/END SAMPLE CATEGORY ID-->

            <!--SAMPLE CATEGORY NAME-->
            <td>
                {!! date('d-m-Y', $pnd_category->pnd_category_updated_at) !!}
            </td>
            <!--/END SAMPLE CATEGORY NAME-->

            <!--OPERATOR-->
            <td>
                <a href="{!! URL::route('admin_pnd_category_user.edit', ['id' => $pnd_category->user_categoy_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('admin_pnd_category_user.delete',['id' =>  $pnd_category->user_categoy_id, '_token' => csrf_token()]) !!}"
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
            {{ trans('pnd::pnd.message_find_failed') }}
        </h5>
    </span>
    <!-- /END FIND MESSAGE -->
@endif
<!--SAMPLE PAGINATOR-->
<div class="paginator">
    {!! $categoryusers->appends($request->except(['page']) )->render() !!}
</div>
<!--/END SAMPLE PAGINATOR-->
