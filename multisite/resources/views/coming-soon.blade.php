@extends('layouts.app')
@section('content')
<div class="text-center max-w-lg">
    {{-- Tiêu đề --}}
    <h1 class="text-4xl md:text-6xl font-bold mb-6">🚀 Coming Soon</h1>
    <p class="text-lg md:text-xl mb-8">Chúng tôi đang xây dựng web này, hẹn gặp bạn sớm!</p>
    {{-- Countdown --}}
    <div id="countdown" class="grid grid-cols-4 gap-4 text-center mb-8">
        <div>
            <div id="days" class="text-3xl font-bold">00</div>
            <span class="text-sm">Ngày</span>
        </div>
        <div>
            <div id="hours" class="text-3xl font-bold">00</div>
            <span class="text-sm">Giờ</span>
        </div>
        <div>
            <div id="minutes" class="text-3xl font-bold">00</div>
            <span class="text-sm">Phút</span>
        </div>
        <div>
            <div id="seconds" class="text-3xl font-bold">00</div>
            <span class="text-sm">Giây</span>
        </div>
    </div>
    <p class="text-lg md:text-xl mb-8">Toàn tác quyền thuộc về {{ @$auth ?? env('APP_AUTH') }}!</p>
</div>
<script>
    const targetDate = new Date("2025-08-31T20:59:59").getTime();
    const countdown = () => {
        const now = new Date().getTime();
        const distance = targetDate - now;
        if (distance < 0) return;
        document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
        document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000);
    };
    setInterval(countdown, 1000);
</script>
@endsection