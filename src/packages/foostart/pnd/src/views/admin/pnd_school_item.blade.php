<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pnd_school.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pnd::pnd.add_school')}}
        </a>
    </div>
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $schools->isEmpty())
    
    <table class="table table-hover">
        <thead>
        <tr>
            <td style='width:5%'>{{ trans('pnd::pnd.order') }}</td>
            <th style='width:30%'>Mã trường</th>
            <th style='width:15%'>Tên trường</th>
            <th style='width:15%'>Địa chỉ</th>
            <th style='width:15%'>Điện thoại</th>
            <th style='width:15%'>Thư điện tử</th>
            <th style='width:15%'>Liên hệ</th>
            <th style='width:15%'>Thuộc huyện</th>
            <th style='width:15%'>Cấp học</th>
            <th style='width:15%'>Tên đăng nhập</th>
            <th style='width:15%'>Mật khẩu</th>
            <th style='width:20%'>{{ trans('pnd::pnd.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nav = $schools->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($schools as $school)
            <tr>
                <td>
                    <?php
                    echo $counter;
                    $counter++
                    ?>
                </td>
                <td>{!! @$school-> school_code !!}</td>
                <td>{!! @$school->school_name !!}</td>
                <td>{!! @$school->school_address !!}</td>
                <td>{!! @$school->school_phone !!}</td>
                <td>{!! @$school->school_email !!}</td>
                <td>{!! @$school->school_contact !!}</td>
                <td>{!! @$school->school_district_id !!}</td>
                <td>{!! @$school->school_level_id !!}</td>
                <td>{!! @$school->school_user !!}</td>
                <td>{!! @$school->school_pass !!}</td>
                <td>
                    <a href="{!! URL::route('admin_pnd_school.edit', ['id' => $school->school_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{!! URL::route('admin_pnd_school.delete',['id' =>  $school->school_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                    <span class="clearfix"></span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="paginator">
        {!! $schools->appends($request->except(['page']) )->render() !!}
    </div>
    
@else
    <span class="text-warning">
    <h5>
        {{ trans('pnd::pnd.message_find_failed') }}
    </h5>
</span>
@endif
