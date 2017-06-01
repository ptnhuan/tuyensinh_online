<!--ADD SCHOOL ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_pnd_exame_school_test.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('pnd::pnd.add_school_test')}}
        </a>
    </div>
</div>
<!--/END ADD SCHOOL ITEM-->

@if( ! $schooltests->isEmpty())

<table class="table table-hover">
    <thead>
        <tr>
            <th style='width:5%'>{{ trans('pnd::pnd.order') }}</th>
                  <th style='width:35%'>{{ trans('pnd::pnd.school_test_name') }}</th>             
            <th style='width:10%'>{{ trans('pnd::pnd.school_test_phone') }}</th>
            <th style='width:15%'>{{ trans('pnd::pnd.school_test_email') }}</th>
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
                        <td>{!! @$school->school_test_name !!}</td>           
            <td>{!! @$school->school_test_phone !!}</td>
            <td>{!! @$school->school_test_email !!}</td>


            <td>
                <a href="{!! URL::route('admin_pnd_exame_school_test.edit', ['id' => $school->school_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_pnd_exame_school_test.delete',['id' =>  $school->school_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
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
