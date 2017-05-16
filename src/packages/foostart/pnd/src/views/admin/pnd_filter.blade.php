
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pnd::pnd.page_categories') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pnd','method' => 'get']) !!}
  
        <!--TITLE-->
        <div class="form-group">
            <?php $categories = !empty(@$categories) ? $categories : array(); ?>
            <?php $category_id = $request->get('category_id') ? $request->get('category_id') : @$student->pexcel_category_id?>

            <!--CATEGORIES-->
            @include('pnd::elements.pnd_select', ['name' => 'pexcel_category_id',
                                                 'categories'=> !empty(@$categories) ? $categories  : array(),
                                                 'category_id'=>@$category_id])

             <div class="row">
                 <div class="col-md-6">
                     <!--SCHOOL OPTION-->
                     @include('pnd::elements.pnd_select', ['name' => 'school_option',
                                                          'categories'=> ['Tất cả','Nguyện vọng 1','Nguyện vọng 2'],
                                                          'category_id'=> !empty(@$request->get('school_option')) ? @$request->get('school_option') : 0])
                 </div>
                
             </div>

            <!--NAME OR EMAIL STUDENT-->
            @include ('pnd::elements.input',['name'=>'search_student',
                                'value' => !empty(@$request->get('search_student')) ? $request->get('search_student') : ''])

        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pnd::pnd.filter').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


