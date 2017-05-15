<div class="type-413">
    <div class="alert alert-info">
        @if(isset($pexcels) && ($pexcels->total() > 0))
            <p>
                Bạn đã gửi <b>{{$pexcels->total()}}</b>
            </p>
        @else
            <p>
                Bạn chưa gửi dữ liệu
            </p>
        @endif
    </div>
</div>