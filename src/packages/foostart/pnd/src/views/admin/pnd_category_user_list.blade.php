@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Trang quản trị bài viết
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        <i class="fa fa-group"></i>
                        {!! $request->all() ?
                            trans('pnd::pnd.pnd_category_search') : trans('pnd::pnd.page_category')
                        !!}
                    </h3>
                </div>
                <!--MESSAGE-->
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success flash-message">{!! $message !!}</div>
                @endif
                <!--/END MESSAGE-->

                <!--ERRORS-->
                @if($errors && ! $errors->isEmpty() )
                @foreach($errors->all() as $error)
                <div class="alert alert-danger flash-message">{!! $error !!}</div>
                @endforeach
                @endif
                <!--/END ERRORS-->
                <div class="panel-body">
                    @include('pnd::admin.pnd_category_user_item')
                </div>
            </div>
        </div>
        <!--SAMPLE SEARCH-->
        <div class="col-md-4">
            @include('pnd::admin.pnd_category_user_search')
        </div>
        <!--/END SAMPLE SEARCH-->
    </div>
</div>
@stop

@section('footer_scripts')
<!-- DELETE CONFIRM -->
<script>
    $(".delete").click(function () {
        return confirm("{{ trans('pnd::pnd.delete_confirm') }}");
    });
</script>
<!-- /END DELETE CONFIRM -->
@stop
