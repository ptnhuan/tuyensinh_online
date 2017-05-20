@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: dashboard
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3><i class="fa fa-dashboard"></i> Trang chủ</h3>
            <hr/>
        </div>


        <div class="col-md-12">

            <div class="panel panel-info">


                <!--MESSAGE-->
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                    <div class="alert alert-success flash-message">{!! $message !!}</div>
                @endif
            <!--MESSAGE-->

                <!--ERRORS-->
                @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger flash-message">{!! $error !!}</div>
                @endforeach
            @endif
            <!--ERRORS-->
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style='width:50%'>{{trans('pnd::pnd.user_name')}}</th>
                            <th style='width:25%'>{{trans('pnd::pnd.edit_profile')}}</th>
                            <th style='width:20%'>{{ trans('pnd::pnd.logout') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>{{ $logged_user->user_name}}</td>
                            <td><a href="{!! URL::route('users.selfprofile.edit')!!}"><i
                                            class="fa fa-edit fa-2x"></i></a></td>
                            <td>
                                <a href="{{URL::route('user.logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                                <span class="clearfix"></span>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
