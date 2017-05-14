@extends('laravel-authentication-acl::admin.layouts.baseauth')
@section('title')
    {{trans('tuyensinh.login_title')}}
@stop
@section('container')

<div class="container">

    <div class="container">
        <div class="loginbox">
            <div class="logo-hvct"><img src="http://hrm.local/packages/jacopo/laravel-authentication-acl/images/hvct1.png" width="70" class="img-logo"></div>
            <div class="mane-shool"><span>Trường Cao Đẳng Nghề Kỹ Thuật Công Nghệ<br>Thành Phố Hồ Chí Minh</span></div>
            <div class="innerheading">
                <h1>
                    Trang tin nội bộ
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
                                <strong>
                                </strong>
                            </p>
                            <p>
                                <strong>Gặp vấn đề</strong>
                            </p>
                            <p> Liên hệ Phòng Kế Toán</p>
                            <p class="phone">
                                <strong>08.37314063 - 34 <i style="font-weight: normal;">hoặc</i> 08.37310640</strong>
                            </p>
                            <p>
                                Email: phongketoantv@hvct.edu.vn
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        {!! Form::open(array('url' => URL::route("user.login.process"), 'method' => 'post') ) !!}
                            <div class="login-form">
                                <label class="lb">
                                    Tài khoản</label><br>
                                <input id="email" class="form-control form-input" required="required" autocomplete="off" name="email" type="text" value="">
                                <span id="RequiredFieldValidator5" title="User Name is required." class="failureNotification" style="visibility: hidden;">*</span>
                                <label class="lb ps">
                                    Mật khẩu</label><br>
                                <input id="password" class="form-control form-input" required="required" autocomplete="off" name="password" type="password" value="">
                                <span id="RequiredFieldValidator6" title="Password is required." class="failureNotification" style="visibility: hidden;">*</span><br>
                                <br>
                                <div class="rmb">
                                    <input type="submit" name="Login" value="Đăng nhập" class="btnn">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@stop