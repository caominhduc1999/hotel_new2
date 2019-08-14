@if(Auth::guard('web')->check())
    <p class="text-success">
        You're logging in as <strong>ADMIN</strong>
    </p>
@else
    <p class="text-danger">
        You're logging out as <strong>ADMIN</strong>
    </p>
@endif

@if(Auth::guard('khachhang')->check())
    <p class="text-success">
        You're logging in as <strong>KHACH HANG</strong>
    </p>
@else
    <p class="text-danger">
        You're logging out as <strong>KHACH HANG</strong>
    </p>
@endif