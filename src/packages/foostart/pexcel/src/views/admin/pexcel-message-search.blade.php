<div class="type-414">
    <div class="alert alert-warning">
        <strong>Kết quả tìm kiếm</strong>
        <hr class="message-inner-separator">
        @if(isset($pexcels) && ($pexcels->total() > 0))
            <p>
                Đã tìm thấy <b>{{$pexcels->total()}}</b> tin đã gửi
            </p>
        @else
            <p>
                Không tìm thấy tin đã gửi
            </p>
        @endif
    </div>
</div>