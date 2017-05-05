<!-- POST INPUT NAME -->
<div class="form-group">
    <?php $post_name = $request->get('post_name') ? $request->get('post_name') : @$post->post_name ?>
    {!! Form::label($name, trans('post::post_admin.name').':') !!}
    {!! Form::text($name, $post_name, ['class' => 'form-control post_name', 'placeholder' => trans('post::post_admin.name'), 'id' => 'post_name']) !!}
</div>

<div class="form-group">

    <?php $post_slug = $request->get('post_slug') ? $request->get('post_slug') : @$post->post_slug ?>
    {!! Form::label($name, trans('post::post_admin.slug').':') !!}
    {!! Form::text('post_slug', $post_slug, ['class' => 'form-control', 'placeholder' => trans('post::post_admin.slug'), 'id' => 'post_slug']) !!}

</div>
<!-- /END POST INPUT NAME -->

@section('footer_scripts_form')
<script type='text/javascript'>
    $(document).ready(function () {

        function ChangeToSlug(title)
        {
            var slug;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            return slug;
        }

        $(".post_name").on("change paste keyup", function() {
            $('#post_slug').val(ChangeToSlug($(this).val()));
        });
    });
</script>
@stop