<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pexcel::pexcel.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pexcel','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">

            {!! Form::label('pexcel_name', trans('pexcel::pexcel.pexcel_name_label')) !!}
            {!!
            Form::text('pexcel_name', @$params['pexcel_name'],
            ['class' => 'form-control', 'placeholder' => trans('pexcel::pexcel.pexcel_name_placeholder')])
            !!}

        </div>
        <!--/END TITLE-->

        <!--DATE FROM-->
        <div class="form-group">

            {!! Form::label('pexcel_date_from', trans('pexcel::pexcel.pexcel_date_from')) !!}
            {!!
            Form::text('pexcel_date_from', @$params['pexcel_date_from'],
            ['class' => 'form-control', 'placeholder' => trans('pexcel::pexcel.pexcel_date_from'),
            'id' => 'date_from'])
            !!}

        </div>
        <!--/END DATE FROM-->

        <!--DATE TO-->
        <div class="form-group">

            {!! Form::label('pexcel_date_to', trans('pexcel::pexcel.pexcel_date_to')) !!}
            {!!
            Form::text('pexcel_date_to', @$params['pexcel_date_from'],
            ['class' => 'form-control', 'placeholder' => trans('pexcel::pexcel.pexcel_date_to'),
            'id' => 'date_to'])
            !!}

        </div>
        <!--/END DATE TO-->

        {!! Form::submit(trans('pexcel::pexcel.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>

@section('sub_page_scripts')
{!! HTML::script('js/jquery-ui.min.1-12-1.js') !!}
<script type="text/javascript">
    $(function () {
        $("#date_from").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $("#date_to").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });
</script>
@stop