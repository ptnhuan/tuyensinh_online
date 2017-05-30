@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('pexcel::pexcel.page_edit') }}
@stop
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <!--SAMPLE TITLE-->
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($pexcel_category->pexcel_category_id) ? '<i class="fa fa-pencil"></i>'.trans('pexcel::pexcel.pexcel_category_update') : '<i class="fa fa-users"></i>'.trans('pexcel::pexcel.pexcel_category_new') !!}
                    </h3>
                </div>
                <!--/END SAMPLE TITLE-->

                <!--ERRORS CATEGORY-->
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">{!! $error !!}</div>
                @endforeach

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif
                {!! Form::open(['route'=>['admin_pexcel_category.post', 'id' => @$pexcel_category->pexcel_category_id],  'files'=>true, 'method' => 'pexcel'])  !!}

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- SAMPLE CATEGORIES ID -->
                            <div class="row">  
                                <div class="col-md-3">

                                    <!-- SAMPLE NAME TEXT-->
                                    <?php $pexcel_category_name = $request->get('pexcel_category_name') ? $request->get('pexcel_category_name') : @$pexcel_category->pexcel_category_name ?>
                                    @include('pexcel::elements.input', ['name' => 'pexcel_category_name', 'value' => $pexcel_category_name])
                                    <!-- /END SAMPLE NAME TEXT -->
                                </div>

                                <div class="col-md-3">
                                    <?php $category_status = $request->get('pexcel_category_status') ? $request->get('pexcel_category_status') : @$pexcel_category->pexcel_category_status ?>

                                    {!! Form::label('pexcel_category_status', trans('pexcel::pexcel.pexcel_category_status').':') !!}

                                    {!! Form::select('pexcel_category_status', [99 => 'Sẵn sàng', 77 => 'Khóa'], $category_status, ['class' => 'form-control']) !!}

                                </div>
                            </div>
                             <div class="row">  
                               <div class="col-md-3">

                                            <!--INPUT-->
                                            
                                              @include('pnd::elements.pnd_select', ['name' => 'add_level2',
                                                          'categories'=> ['0'=>'Cho phép','1'=>'Không cho phép'],
                                                          'category_id'=> @$pexcel_category->add_level2])
                                           
                                            <!--/END INPUT-->
                                        </div>
                                <div class="col-md-3">

                                            <!--INPUT-->
                                            
                                              @include('pnd::elements.pnd_select', ['name' => 'edit_level2',
                                                           'categories'=> ['0'=>'Cho phép','1'=>'Không cho phép'],
                                                          'category_id'=> @$pexcel_category->edit_level2])
                                           
                                            <!--/END INPUT-->
                                        </div>
                                   <div class="col-md-3">

                                            <!--INPUT-->
                                            
                                              @include('pnd::elements.pnd_select', ['name' => 'delete_level2',
                                                           'categories'=> ['0'=>'Cho phép','1'=>'Không cho phép'],
                                                          'category_id'=> @$pexcel_category->delete_level2])
                                           
                                            <!--/END INPUT-->
                                        </div>
                            </div>
                            <div class="row">  
                                <div class="col-md-3">

                                    <!--INPUT-->

                                    @include('pnd::elements.pnd_select', ['name' => 'add_level3',
                                    'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                    'category_id'=> @$pexcel_category->add_level3])

                                    <!--/END INPUT-->
                                </div>
                                <div class="col-md-3">

                                    <!--INPUT-->

                                    @include('pnd::elements.pnd_select', ['name' => 'edit_level3',
                                    'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                    'category_id'=> @$pexcel_category->edit_level3])

                                    <!--/END INPUT-->
                                </div>
                                <div class="col-md-3">

                                    <!--INPUT-->

                                    @include('pnd::elements.pnd_select', ['name' => 'delete_level3',
                                    'categories'=> ['1'=>'Không cho phép','0'=>'Cho phép'],
                                    'category_id'=> @$pexcel_category->delete_level3])

                                    <!--/END INPUT-->
                                </div>
                            </div>
                             <div class="row">  
                               <div class="col-md-3">

                                            <!--INPUT-->
                                            
                                              @include('pnd::elements.pnd_select', ['name' => 'add_levelstd',
                                                            'categories'=> ['2'=>'Không','0'=>'Chỉ thay đổi mật khẩu','1'=>'Sửa tất cả thông tin'],
                                                          'category_id'=> @$pexcel_category->aed_student])
                                           
                                            <!--/END INPUT-->
                                        </div>
                               
                            </div>
                        </div>

                        <!-- /END POST CATEGORY LIST -->

                        {!! Form::hidden('id',@$pexcel_category->pexcel_category_id) !!}

                        <!-- DELETE BUTTON -->
                        <a href="{!! URL::route('admin_pexcel_category.delete',['id' => @$pexcel_category->pexcel_category_id, '_token' => csrf_token()]) !!}"
                           class="btn btn-danger pull-right margin-left-5 delete">
                            Xóa
                        </a>
                        <!-- DELETE BUTTON -->

                        <!-- SAVE BUTTON -->
                        {!! Form::submit('Lưu', array("class"=>"btn btn-info pull-right ")) !!}
                        <!-- /SAVE BUTTON -->

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
        <div class='col-md-4'>
            @include('pexcel::admin.pexcel_category_search')
        </div>
    </div>


</div>

@stop
