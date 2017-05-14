@extends('laravel-authentication-acl::admin.layouts.baseauth')
@section('title')
{{trans('tuyensinh.login_title')}}
@stop
@section('container')

<div class="container">

    <div class="container">
        <div class="loginbox">
            <div class="logo-hvct"><img src="<?php echo url('logo.jpg') ?>" width="80" class="img-logo"></div>
            <div class="mane-shool-login"><span> <?php echo trans('tuyensinh.login_head') ?></span></div>
            
            <div class="innerheading_login"  style="text-align: center" >
                <h1>
                    {{trans('tuyensinh.login_viewhead')}}
                </h1>
            </div>
            <div style="padding-bottom: 25px;">
                <div class="aspNetHidden">
                    <input type="hidden" name="" id="" value="">
                    <input type="hidden" name="" id="" value="">
                    <input type="hidden" name="" id="" value="">
                </div>
                <div class="aspNetHidden">

                    <input type="hidden" name="" id="" value="">
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div id="uxHelperInfoBox" class="helpbox">

                            <p>
                                <strong>{{trans('tuyensinh.login_contact_title')}}</strong>
                            </p>
                            <p> {{trans('tuyensinh.login_contact')}}</p>
                            <p class="phone">
                                {{trans('tuyensinh.login_phone')}}  
                            </p>
                            <p>
                                {{trans('tuyensinh.login_email')}}
                            </p>
                           
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        {!! Form::open(array('url' => URL::route("user.login.process"), 'method' => 'post') ) !!}
                        <div class="login-form">
                            <label class="lb">
                                {{trans('tuyensinh.login_user')}}</label><br>
                            <input id="email" class="form-control form-input" required="required" autocomplete="off" name="email" type="text" value="">
                            <span id="RequiredFieldValidator5" title="User Name is required." class="failureNotification" style="visibility: hidden;">*</span>
                            <label class="lb ps">
                                {{trans('tuyensinh.login_pass')}}</label><br>
                            <input id="password" class="form-control form-input" required="required" autocomplete="off" name="password" type="password" value="">
                            <span id="RequiredFieldValidator6" title="Password is required." class="failureNotification" style="visibility: hidden;">*</span><br>
                            <br>
                            <div class="rmb">
                                <input type="submit" name="Login" value="{{trans('tuyensinh.login_login')}}" class="btnn">
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="innerheading_login" style="text-align: center" >
                <h1>
                    {{trans('tuyensinh.login_contact_support')}}
                </h1>
            </div>
        </div>
    </div>

</div>
@stop