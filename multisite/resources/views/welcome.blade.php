<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#1e40af', // Xanh chủ đạo
                        accent: '#f97316', // Cam nhấn
                    },
                    fontFamily: {
                        sans: ['K2D', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=K2D:wght@400;600;700&display=swap');
    </style>
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg text-center">
        <h1 class="text-4xl font-bold text-brand">
            Laravel + Tailwind CDN 🎨
        </h1>
        <p class="mt-4 text-lg text-gray-600">
            Đây là phiên bản dùng CDN nhưng vẫn tùy chỉnh màu & font.
        </p>
        <button class="mt-6 px-5 py-2 bg-accent text-white rounded-lg hover:bg-orange-600 transition">
            Bấm thử
        </button>
    </div>
    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
