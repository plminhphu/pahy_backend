<x-guest-layout>
    <div class="container text-center md-mt-5 py-2">
        <h1 class="display-3 fw-bold mb-4">🚀 Coming Soon</h1>
        <p class="fs-5 mb-5">Chúng tôi đang xây dựng web này, hẹn gặp bạn sớm!</p>
        <div id="countdown" class="row justify-content-center mb-5">
            <div class="col-3 col-md-2">
                <div id="days" class="fs-2 fw-bold">00</div>
                <small class="text-muted">Ngày</small>
            </div>
            <div class="col-3 col-md-2">
                <div id="hours" class="fs-2 fw-bold">00</div>
                <small class="text-muted">Giờ</small>
            </div>
            <div class="col-3 col-md-2">
                <div id="minutes" class="fs-2 fw-bold">00</div>
                <small class="text-muted">Phút</small>
            </div>
            <div class="col-3 col-md-2">
                <div id="seconds" class="fs-2 fw-bold">00</div>
                <small class="text-muted">Giây</small>
            </div>
        </div>
        <p class="fs-6">Toàn tác quyền thuộc về {{ @$auth ?? env('APP_AUTH') }}!</p>
    </div>
    <script>
        const targetDate = new Date("2025-08-31T20:59:59").getTime();
        const countdown = () => {
            const now = new Date().getTime();
            const distance = targetDate - now;
            if (distance < 0) return;
            document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
            document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 *
                60));
            document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000);
        };
        setInterval(countdown, 1000);
    </script>
</x-guest-layout>