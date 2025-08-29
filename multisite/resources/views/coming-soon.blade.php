@extends('layouts.guest')
@section('content')
<div class="min-vh-100 d-flex flex-column justify-content-center align-items-center bg-light px-4">
    <div class="text-center mb-5">
        <h1 class="display-3 fw-bold mb-3 text-dark">🚀 Coming Soon</h1>
        <p class="fs-4 text-secondary">Chúng tôi đang xây dựng web này, hẹn gặp bạn sớm!</p>
    </div>
    <div id="countdown" class="row g-2 mb-5 justify-content-center">
        <div class="col-12 col-sm-6">
            <div class="card text-center shadow-md border-0">
                <div class="card-body">
                    <div id="days" class="display-3 fw-bold text-primary">00</div>
                    <span class="text-muted small">Ngày</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card text-center shadow-md border-0">
                <div class="card-body">
                    <div id="hours" class="display-3 fw-bold text-primary">00</div>
                    <span class="text-muted small">Giờ</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card text-center shadow-md border-0">
                <div class="card-body">
                    <div id="minutes" class="display-3 fw-bold text-primary">00</div>
                    <span class="text-muted small">Phút</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card text-center shadow-md border-0">
                <div class="card-body">
                    <div id="seconds" class="display-3 fw-bold text-primary">00</div>
                    <span class="text-muted small">Giây</span>
                </div>
            </div>
        </div>
    </div>
    <p class="text-muted mt-4 small">
        Toàn tác quyền thuộc về {{ $auth ?? env('APP_AUTH') }}!
    </p>
</div>
<script>
    const targetDate = new Date("2025-08-31T20:59:59").getTime();
    const countdown = () => {
        const now = new Date().getTime();
        const distance = targetDate - now;
        if (distance < 0) return;
        document.getElementById("days").innerText = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
        document.getElementById("hours").innerText = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
        document.getElementById("minutes").innerText = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
        document.getElementById("seconds").innerText = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
    };
    setInterval(countdown, 1000);
</script>
@endsection