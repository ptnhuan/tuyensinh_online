@extends('pexcel::layouts.layout')

<!--CSS LIB-->
@section('sub_page_css')
<style>
    .table-responsive>.fixed-column {
        position: absolute;
        display: inline-block;
        width: auto;
        border-right: 1px solid #ddd;
    }
    @media(min-width:768px) {
        .table-responsive>.fixed-column {
            display: none;
        }
    }

</style>
@stop

<!--MAIN CONTENT-->
@section('content')
<div class="table-responsive">
    <table class="table table-pinned table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th class="pinned"># pin</th>
                <th class="pinned">Table heading pin</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>

                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
                <th>Table heading</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="pinned">1 pin</td>
                <td class="pinned">Table cell pin</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>

                 <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
            </tr>
        </tbody>
    </table>
</div>
@stop

@section('sub_page_scripts')
<script type='text/javascript'>
</script>
@stop