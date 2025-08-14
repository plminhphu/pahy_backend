@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
  <!-- Hero -->
  <section class="relative bg-gray-50">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8 px-4 py-12 items-center">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold text-brand">Trung tâm Quản trị Chuyên nghiệp</h1>
        <p class="mt-4 text-gray-600">
          Mọi hoạt động trong công ty sẽ phải tập trung tại một hệ thống duy nhất.
          Từ quản lý nhân sự, kế toán, đến chăm sóc khách hàng, tất cả đều được tích hợp
          trong một gói đăng ký PAHY.
        </p>

        <div class="mt-6 grid grid-cols-2 gap-4">
          <div class="bg-white p-4 rounded-xl shadow-card">
            <div class="text-sm text-gray-500">01</div>
            <h3 class="font-semibold mt-1">Đồng bộ dữ liệu</h3>
            <p class="text-sm text-gray-600">Đồng bộ dữ liệu nhanh chóng và hiệu quả giữa các thiết bị và mọi nền tảng.</p>
          </div>
          <div class="bg-white p-4 rounded-xl shadow-card">
            <div class="text-sm text-gray-500">02</div>
            <h3 class="font-semibold mt-1">Thông báo tức thì</h3>
            <p class="text-sm text-gray-600">Nhận thông báo tức thì về các sự kiện quan trọng và cập nhật trong hệ thống.</p>
          </div>
          <div class="bg-white p-4 rounded-xl shadow-card">
            <div class="text-sm text-gray-500">03</div>
            <h3 class="font-semibold mt-1">Xác thực Leads</h3>
            <p class="text-sm text-gray-600">Đảm bảo thông tin khách hàng chính xác bằng cách gửi OTP số điện thoại.</p>
          </div>
          <div class="bg-white p-4 rounded-xl shadow-card">
            <div class="text-sm text-gray-500">04</div>
            <h3 class="font-semibold mt-1">Thanh toán tiện lợi</h3>
            <p class="text-sm text-gray-600">Đảm bảo quy trình thanh toán nhanh chóng và dễ dàng cho người dùng.</p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <img class="rounded-xl shadow-card w-full" src="{{ env('CDN_URL') }}/client/images/intros/pahy1.webp?v=1.1" alt="">
        <img class="rounded-xl shadow-card w-full" src="{{ env('CDN_URL') }}/client/images/intros/pahy2.webp?v=1.1" alt="">
        <img class="rounded-xl shadow-card w-full col-span-2" src="{{ env('CDN_URL') }}/client/images/intros/pahy3.webp?v=1.1" alt="">
      </div>
    </div>
  </section>

  <!-- About -->
  <section class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid md:grid-cols-2 gap-8 items-start">
      <div>
        <h2 class="text-2xl font-bold text-brand">Về PAHY</h2>
        <p class="mt-3 text-gray-700 leading-relaxed">
          PAHY là viết tắc của Pro Admin Hub for You: là một hệ thống chuyên để quản lý mọi hoạt động
          kinh doanh trên mạng đồng thời bao gồm cả phần mềm quản lý đơn, khách, sản phẩm....
        </p>
        <p class="mt-4 text-gray-700">
          Không lưu thẻ, thanh toán mỗi lần sử dụng. Nâng cấp dễ dàng, hoàn tiền gói cũ theo hạn còn lại.
          Trong trường hợp sử dụng ít tài nguyên anh chị có thể mua gói nhỏ để tiết kiệm. Khi doanh nghiệp
          trưởng nhanh chóng, hệ thống sẽ đề xuất nâng cấp gói thích hợp. Tài nguyên phát sinh hơn có thể
          được tự động cho mượn thêm không mất phí trong 30 ngày.
        </p>
        <div class="mt-4 text-sm">
          <div class="font-semibold">Bộ phận tư vấn khách hàng:</div>
          <div class="text-brand font-bold">+84329886884</div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <img class="rounded-xl shadow-card" src="{{ env('CDN_URL') }}/client/images/whychoose/pahy.webp?v=1.1" alt="">
        <img class="rounded-xl shadow-card" src="{{ env('CDN_URL') }}/client/images/intros/pahy1.webp?v=1.1" alt="">
        <img class="rounded-xl shadow-card col-span-2" src="{{ env('CDN_URL') }}/client/images/intros/pahy2.webp?v=1.1" alt="">
      </div>
    </div>
  </section>

  <!-- Pricing -->
  <section id="pricing" class="bg-gray-50 py-14">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-2xl font-bold text-center">Bảng giá Gói cước</h2>
      <p class="text-center text-gray-500 mt-1">Bảng giá gói cước đang được áp dụng tại PAHY.</p>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-8">
        <div class="bg-white rounded-xl shadow-card p-6">
          <div class="text-sm font-semibold text-brand">TRIAL</div>
          <div class="mt-2 text-2xl font-bold text-accent">3.000/ngày</div>
          <ul class="mt-4 space-y-2 text-sm text-gray-700">
            <li>• Dung lượng: 128 MB</li>
            <li>• Unit DB: 12.000</li>
          </ul>
          <a href="#" class="mt-5 inline-block w-full text-center bg-brand text-white py-2 rounded-lg">Đăng ký</a>
        </div>
        <div class="bg-white rounded-xl shadow-card p-6">
          <div class="text-sm font-semibold text-brand">BASIC</div>
          <div class="mt-2 text-2xl font-bold text-accent">5.000/ngày</div>
          <ul class="mt-4 space-y-2 text-sm text-gray-700">
            <li>• Dung lượng: 256 MB</li>
            <li>• Unit DB: 32.000</li>
          </ul>
          <a href="#" class="mt-5 inline-block w-full text-center bg-brand text-white py-2 rounded-lg">Đăng ký</a>
        </div>
        <div class="bg-white rounded-xl shadow-card p-6">
          <div class="text-sm font-semibold text-brand">NORMAL</div>
          <div class="mt-2 text-2xl font-bold text-accent">10.000/ngày</div>
          <ul class="mt-4 space-y-2 text-sm text-gray-700">
            <li>• Dung lượng: 512 MB</li>
            <li>• Unit DB: 54.000</li>
          </ul>
          <a href="#" class="mt-5 inline-block w-full text-center bg-brand text-white py-2 rounded-lg">Đăng ký</a>
        </div>
        <div class="bg-white rounded-xl shadow-card p-6">
          <div class="text-sm font-semibold text-brand">STANDARD</div>
          <div class="mt-2 text-2xl font-bold text-accent">20.000/ngày</div>
          <ul class="mt-4 space-y-2 text-sm text-gray-700">
            <li>• Dung lượng: 1 GB</li>
            <li>• Unit DB: 120.000</li>
          </ul>
          <a href="#" class="mt-5 inline-block w-full text-center bg-brand text-white py-2 rounded-lg">Đăng ký</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Create account -->
  <section class="max-w-7xl mx-auto px-4 py-14 grid md:grid-cols-2 gap-8 items-center">
    <div>
      <h3 class="text-xl font-bold">Tạo tài khoản</h3>
      <p class="mt-3 text-gray-600">
        Hướng dẫn tạo tài khoản trên PAHY để trải nghiệm các tính năng quản trị doanh nghiệp một cách dễ dàng và hiệu quả.
        Chỉ cần vài bước đơn giản trên ứng dụng di động, anh chị đã có thể bắt đầu sử dụng hệ thống quản lý toàn diện này.
      </p>
      <a class="mt-6 inline-flex items-center gap-2 bg-accent text-white px-5 py-2 rounded-lg" href="https://youtube.com">Xem Youtube</a>
    </div>
    <div>
      <img class="rounded-xl shadow-card w-full" src="{{ env('CDN_URL') }}/client/images/intros/pahy1.webp?v=1.1" alt="">
    </div>
  </section>

  <!-- Team -->
  <section class="max-w-7xl mx-auto px-4 py-14">
    <h3 class="text-xl font-bold text-center">Đội ngũ Nhà phát triển</h3>
    <p class="text-center text-gray-500 mt-1">PAHY Team luôn nỗ lực cập nhật tính năng mới và hỗ trợ nhiệt tình</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">
      <div class="bg-white rounded-xl shadow-card p-4 text-center">
        <img class="w-full h-44 object-cover rounded-lg" src="{{ env('CDN_URL') }}/client/images/teams/phu.webp?v=1.1" alt="">
        <div class="mt-3 font-semibold"><a href="https://plminhphu.vn">Minh Phú</a></div>
        <div class="text-sm text-gray-500">Điều hành</div>
      </div>
      <div class="bg-white rounded-xl shadow-card p-4 text-center">
        <img class="w-full h-44 object-cover rounded-lg" src="{{ env('CDN_URL') }}/client/images/teams/tu.webp?v=1.1" alt="">
        <div class="mt-3 font-semibold"><a href="https://plminhphu.vn">Phương Ly</a></div>
        <div class="text-sm text-gray-500">Thiết kế UX UI</div>
      </div>
      <div class="bg-white rounded-xl shadow-card p-4 text-center">
        <img class="w-full h-44 object-cover rounded-lg" src="{{ env('CDN_URL') }}/client/images/teams/hung.webp?v=1.1" alt="">
        <div class="mt-3 font-semibold"><a href="https://plminhphu.vn">Quang Hùng</a></div>
        <div class="text-sm text-gray-500">Developer</div>
      </div>
      <div class="bg-white rounded-xl shadow-card p-4 text-center">
        <img class="w-full h-44 object-cover rounded-lg" src="{{ env('CDN_URL') }}/client/images/teams/huyen.webp?v=1.1" alt="">
        <div class="mt-3 font-semibold"><a href="https://plminhphu.vn">Trần Huyền</a></div>
        <div class="text-sm text-gray-500">Digital Marketing</div>
      </div>
    </div>
  </section>

  <!-- Commitments -->
  <section class="bg-brand text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="text-xl font-bold">Cam kết với khách hàng</h3>
      <p class="text-white/80 mt-2">Chúng em cam kết mang lại giải pháp tối ưu, giúp doanh nghiệp vận hành hiệu quả và phát triển bền vững.</p>

      <div class="grid sm:grid-cols-4 gap-5 mt-8">
        <div class="bg-white/10 rounded-xl p-5">
          <div class="text-lg font-semibold">Sản phẩm</div>
          <p class="text-sm text-white/80 mt-2">Quản lý, theo dõi và kiểm soát hàng hóa.</p>
        </div>
        <div class="bg-white/10 rounded-xl p-5">
          <div class="text-lg font-semibold">Đơn hàng</div>
          <p class="text-sm text-white/80 mt-2">Lên đơn và xử lý trạng thái đơn hàng.</p>
        </div>
        <div class="bg-white/10 rounded-xl p-5">
          <div class="text-lg font-semibold">Khách hàng</div>
          <p class="text-sm text-white/80 mt-2">Theo dõi và phân tích hành vi mua sắm.</p>
        </div>
        <div class="bg-white/10 rounded-xl p-5">
          <div class="text-lg font-semibold">Giao dịch</div>
          <p class="text-sm text-white/80 mt-2">Quản lý giao dịch và dòng tiền hiệu quả.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Modern UI + 9K -->
  <section class="max-w-7xl mx-auto px-4 py-16">
    <h3 class="text-center text-sm tracking-wide text-gray-600">Giao diện hiện đại dễ dùng</h3>
    <p class="text-center text-xs text-gray-500">Ứng dụng PAHY mang đến trải nghiệm người dùng mượt mà và trực quan.</p>

    <div class="relative mt-8 rounded-2xl overflow-hidden shadow-card">
      <img class="w-full h-64 object-cover" src="{{ env('CDN_URL') }}/client/images/whychoose/pahy.webp?v=1.1" alt="">
      <div class="absolute right-4 bottom-4 bg-white rounded-xl shadow-card max-w-sm p-4">
        <div class="text-brand font-bold text-lg">Dùng thử 9K</div>
        <p class="text-sm text-gray-600 mt-1">
          Bản Trial 9K/tháng dùng thử của chúng em cung cấp quyền truy cập vào các tính năng cơ bản,
          cho phép anh chị khám phá nền tảng của chúng em và trải nghiệm các dịch vụ của chúng em.
        </p>
        <a href="#" class="mt-3 inline-block bg-brand text-white px-4 py-2 rounded-lg">Đăng ký ngay</a>
      </div>
    </div>
  </section>

  <!-- New features -->
  <section class="bg-gray-50 py-14">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="text-center text-sm font-semibold">Tính năng mới</h3>
      <p class="text-center text-xs text-gray-500">PAHY liên tục cập nhật và cải tiến các chức năng để đáp ứng nhu cầu ngày càng cao của người dùng Việt Nam:</p>

      <div class="grid md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white p-5 rounded-xl shadow-card">
          <img src="{{ env('CDN_URL') }}/client/images/blogs/1.webp" class="w-full h-40 object-cover rounded-lg" alt="">
          <p class="mt-3 text-sm">
            Cập nhật 34 tỉnh thành và 3321 xã, phường sau sát nhập với bản đồ Việt Nam mới cho bảng điều khiển.
          </p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-card">
          <img src="{{ env('CDN_URL') }}/client/images/blogs/2.webp" class="w-full h-40 object-cover rounded-lg" alt="">
          <p class="mt-3 text-sm">
            Tích hợp API vận chuyển với GHN, GHTK, Lalamove chỉ một click để đưa đơn hàng đến khách của mình.
          </p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-card">
          <img src="{{ env('CDN_URL') }}/client/images/blogs/3.webp" class="w-full h-40 object-cover rounded-lg" alt="">
          <p class="mt-3 text-sm">
            Đồng bộ bán hàng với Tiktok Shop, FB Marketplace, Google Shopping về giá, số lượng.
          </p>
        </div>
      </div>

      <div class="grid md:grid-cols-2 gap-6 mt-6">
        <div class="bg-white p-5 rounded-xl shadow-card">
          <p class="text-sm">Nhận tiền từ Webhook giúp đơn hàng được thanh toán tự động, nhanh chóng, an toàn, tiện lợi.</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-card">
          <p class="text-sm">Xem hiệu quả truyền thông từ video ngắn YouTube Shorts, Facebook Reels, Tiktok, tại hệ thống PAHY.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="max-w-7xl mx-auto px-4 py-14">
    <h3 class="text-xl font-bold text-center">Trải nghiệm Khách hàng</h3>
    <p class="text-center text-gray-500 mt-1">Dưới đây là những đánh giá từ những khách hàng đã sử dụng dịch vụ.</p>

    <div class="grid md:grid-cols-3 gap-6 mt-8 text-sm">
      <div class="bg-white rounded-xl shadow-card p-5">
        <div class="flex items-center gap-3">
          <img class="w-10 h-10 rounded-full" src="{{ env('CDN_URL') }}/client/images/testimonials/1.webp" alt="">
          <div>
            <div class="font-semibold">N. Văn Hưng</div>
            <div class="text-gray-500 text-xs">Cà phê Hương Việt</div>
          </div>
        </div>
        <p class="mt-3">PAHY giúp tôi kiểm soát doanh thu và hàng tồn kho trong tích tắc. Không cần phải nhờ đến kế toán mỗi ngày nữa.</p>
      </div>

      <div class="bg-white rounded-xl shadow-card p-5">
        <div class="flex items-center gap-3">
          <img class="w-10 h-10 rounded-full" src="{{ env('CDN_URL') }}/client/images/testimonials/2.webp" alt="">
          <div>
            <div class="font-semibold">T. Bình Toản</div>
            <div class="text-gray-500 text-xs">Nội Thất Sáng Tạo</div>
          </div>
        </div>
        <p class="mt-3">Điểm mạnh lớn nhất của PAHY là khả năng tùy biến. Tôi có thể thay đổi giao diện và chức năng theo đúng mô hình kinh doanh của mình.</p>
      </div>

      <div class="bg-white rounded-xl shadow-card p-5">
        <div class="flex items-center gap-3">
          <img class="w-10 h-10 rounded-full" src="{{ env('CDN_URL') }}/client/images/testimonials/3.webp" alt="">
          <div>
            <div class="font-semibold">L. Thị Mai</div>
            <div class="text-gray-500 text-xs">VCLT Logistics</div>
          </div>
        </div>
        <p class="mt-3">Từ khi dùng PAHY, tôi rút ngắn thời gian báo cáo hàng ngày còn một nửa. Quản lý đội ngũ cũng trực quan và hiệu quả hơn.</p>
      </div>

      <div class="bg-white rounded-xl shadow-card p-5">
        <div class="flex items-center gap-3">
          <img class="w-10 h-10 rounded-full" src="{{ env('CDN_URL') }}/client/images/testimonials/4.webp" alt="">
          <div>
            <div class="font-semibold">P. Kim Anh</div>
            <div class="text-gray-500 text-xs">Spa Kim Anh</div>
          </div>
        </div>
        <p class="mt-3">PAHY giúp tôi quản lý lịch hẹn, nhân sự và thu chi cực kỳ linh hoạt. Giao diện rất dễ sử dụng ngay cả với nhân viên mới.</p>
      </div>

      <div class="bg-white rounded-xl shadow-card p-5">
        <div class="flex items-center gap-3">
          <img class="w-10 h-10 rounded-full" src="{{ env('CDN_URL') }}/client/images/testimonials/5.webp" alt="">
          <div>
            <div class="font-semibold">H. Diệu Huyền</div>
            <div class="text-gray-500 text-xs">HaNa Mobile</div>
          </div>
        </div>
        <p class="mt-3">Tôi từng dùng nhiều phần mềm quản lý, nhưng PAHY là cái tên tôi chọn để gắn bó lâu dài nhờ khả năng mở rộng và bảo mật tốt.</p>
      </div>

      <div class="bg-white rounded-xl shadow-card p-5">
        <div class="flex items-center gap-3">
          <img class="w-10 h-10 rounded-full" src="{{ env('CDN_URL') }}/client/images/testimonials/6.webp" alt="">
          <div>
            <div class="font-semibold">N. Thu Thủy</div>
            <div class="text-gray-500 text-xs">Thời trang Thu Thủy</div>
          </div>
        </div>
        <p class="mt-3">PAHY giống như một trợ lý ảo đắc lực. Tôi có thể kiểm tra số liệu từ xa qua điện thoại mà không cần gọi ai cả.</p>
      </div>
    </div>
  </section>

  <!-- Tech news -->
  <section class="bg-gray-50 py-14">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="text-xl font-bold text-center">Tin công nghệ</h3>
      <p class="text-center text-gray-500 mt-1">Mang đến cho anh chị những thông tin công nghệ bổ ích và thú vị.</p>

      <div class="grid md:grid-cols-3 gap-6 mt-8">
        <a class="block bg-white rounded-xl shadow-card overflow-hidden" href="#">
          <img src="{{ env('CDN_URL') }}/client/images/blogs/1.webp" class="w-full h-40 object-cover" alt="">
          <div class="p-5">
            <div class="text-xs text-gray-500">2025-07-10 • Trần Huyền • 21 bình luận</div>
            <h4 class="font-semibold mt-1">5 lý do doanh nghiệp vừa và nhỏ nên đầu tư vào hệ thống</h4>
            <p class="text-sm text-gray-600 mt-1">Việc đầu tư vào một hệ thống ERP hiện đại như PAHY không chỉ giúp bạn tối ưu vận hành...</p>
          </div>
        </a>
        <a class="block bg-white rounded-xl shadow-card overflow-hidden" href="#">
          <img src="{{ env('CDN_URL') }}/client/images/blogs/2.webp" class="w-full h-40 object-cover" alt="">
          <div class="p-5">
            <div class="text-xs text-gray-500">2025-07-08 • Trần Huyền • 22 bình luận</div>
            <h4 class="font-semibold mt-1">Tùy biến giao diện quản trị để phù hợp từng ngành nghề</h4>
            <p class="text-sm text-gray-600 mt-1">PAHY cung cấp khả năng tùy biến theo lĩnh vực kinh doanh...</p>
          </div>
        </a>
        <a class="block bg-white rounded-xl shadow-card overflow-hidden" href="#">
          <img src="{{ env('CDN_URL') }}/client/images/blogs/3.webp" class="w-full h-40 object-cover" alt="">
          <div class="p-5">
            <div class="text-xs text-gray-500">2025-07-05 • Trần Huyền • 23 bình luận</div>
            <h4 class="font-semibold mt-1">So sánh PAHY và các giải pháp ERP phổ biến trên thị trường</h4>
            <p class="text-sm text-gray-600 mt-1">Bài viết đưa ra phân tích so sánh giữa PAHY với các nền tảng như Odoo, SAP Business One...</p>
          </div>
        </a>
      </div>
    </div>
  </section>

@endsection
