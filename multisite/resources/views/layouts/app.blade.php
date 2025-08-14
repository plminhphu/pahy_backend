<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'PAHY')</title>
  <meta name="robots" content="noindex, nofollow">
  
  <link rel="canonical" href="{{ env('APP_URL') }}" />
  <link href="{{ env('CDN_URL') }}/image/favicon.ico?v={{ env('APP_VER') }}" alt="{{ env('APP_AUTH') }}" rel="shortcut icon" type="image/x-icon"/>
  <meta name="msapplication-TileImage" content="{{ env('CDN_URL') }}/image/favicon.ico?v={{ env('APP_VER') }}" alt="{{ env('APP_AUTH') }}"/>
  <style> @import url('https://fonts.googleapis.com/css2?family=K2D:wght@400;600;700&display=swap');</style>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['K2D', 'sans-serif'],
            },
            colors: {
              primary: {
                DEFAULT: "#143D6B", // màu chính
                dark: "#143D6B",    // khi hover hoặc dark mode
                light: "#143D6B"    // màu nhạt
              },
              brand: "#143D6B",
              brand2: "#0E2A4C",
              accent: "#143D6B"
            },
            boxShadow: {
              card: '0 10px 24px rgba(0,0,0,.06)'
            }
          }
        }
      }
  </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="bg-brand text-white text-xs">
      <div class="max-w-7xl mx-auto px-4 py-2 flex items-center gap-4">
          <span class="hidden sm:inline">plminhphu@icloud.com</span>
          <span class="hidden sm:inline">+84329886884</span>
          <a href="https://github.com" class="ml-auto hover:underline">github</a>
          <a href="https://facebook.com" class="hover:underline">facebook</a>
          <a href="https://youtube.com" class="hover:underline">youtube</a>
          <a href="https://tiktok.com" class="hover:underline">tiktok</a>
      </div>
    </div>
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/70 border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
          <div class="flex items-center gap-3">
              <img src="{{ env('CDN_URL') }}/client/images/whychoose/pahy.webp?v=1.1" alt="PAHY"
                  class="h-9 w-9 rounded object-cover">
              <span class="font-semibold text-brand">Hệ thống PAHY</span>
          </div>
          <nav class="hidden md:flex items-center gap-6">
              <a href="#" class="hover:text-accent">Trang chủ</a>
              <a href="#pricing" class="hover:text-accent">Bảng giá</a>
              <a href="#docs" class="hover:text-accent">Tài liệu</a>
              <a href="#support" class="hover:text-accent">Hỗ trợ</a>
              <a href="#" class="inline-flex items-center bg-brand text-white px-3 py-1.5 rounded">Tải ứng
                  dụng</a>
          </nav>
          <button class="md:hidden px-3 py-2 rounded bg-brand text-white">Menu</button>
      </div>
    </header>
    <main class="max-w-6xl mx-auto p-4">
        @yield('content')
    </main>
    <footer class="bg-brand2 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-4 gap-8">
            <div>
                <h4 class="font-semibold mb-2">Trọng tâm</h4>
                <p class="text-sm text-white/80">Anh chị chỉ cần một Trung tâm Quản trị Chuyên nghiệp cho mọi hoạt động
                    kinh doanh của mình với PAYH "Pro Admin Hub for You"</p>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Chính sách</h4>
                <ul class="space-y-1 text-sm text-white/80">
                    <li><a href="#" class="hover:underline">Chính sách sử dụng dịch vụ</a></li>
                    <li><a href="#" class="hover:underline">Chính sách bảo mật dữ liệu</a></li>
                    <li><a href="#" class="hover:underline">Quyền sao lưu và xóa dữ liệu</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Điều khoản</h4>
                <ul class="space-y-1 text-sm text-white/80">
                    <li><a href="#" class="hover:underline">Điều khoản sử dụng ứng dụng</a></li>
                    <li><a href="#" class="hover:underline">Chấp hành đúng pháp luật</a></li>
                    <li><a href="#" class="hover:underline">Quy tắc ứng xử chung</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Nhà phát triển</h4>
            </div>
        </div>
        <div class="center max-w-7xl mx-auto p-md-4 p-2">
            <p class="text-center text-white/80">© ® Tác giả và bản quyền thuộc về <a class="underline" href="https://plminhphu.vn">PL Minh Phú</a></p>
        </div>
    </footer>
</body>
</html>
