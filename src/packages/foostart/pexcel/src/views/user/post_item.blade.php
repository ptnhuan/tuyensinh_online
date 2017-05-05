
@if( ! $posts->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('post::post_admin.order') }}</td>
            <th style='width:50%'>{{trans('post::post_admin.post_item_title')}}</th>
            <th style='width:25%'>{{trans('post::post_admin.post_item_created')}}</th>
            <th style='width:20%'>{{ trans('post::post_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $posts->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($posts as $post)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! $post->post_name !!}</td>
            <td>{!! date('d-m-Y', $post->post_updated_at) !!}</td>
            <td>
                <a href="{!! URL::route('user_post.edit', ['id' => $post->post_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('user_post.delete',['id' =>  $post->post_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
 <span class="text-warning">
	<h5>
            {{ trans('post::post_admin.message_find_failed') }}
	</h5>
 </span>
@endif
<div class="paginator">
    {!! $posts->appends($request->except(['page']) )->render() !!}
</div>