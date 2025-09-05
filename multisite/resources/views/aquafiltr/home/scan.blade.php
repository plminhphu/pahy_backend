{{-- 
Đầu tiên hiện thị Form với chức năng tìm kiếm và nút quét mã QR #startButton
Sau khi nhấn nút quét mã QR, hiển thị video từ camera và bắt đầu quét mã QR
Khi quét thành công, trả về code, tiến hành ajax để lấy dữ liệu từ server và hiển thị kết quả
hoặc khi nhập mã thủ công thì cũng gọi ajax để tìm bằng code đó
Sử dụng thư viện ZXing để quét mã QR
--}}
@extends('layouts.home')
@section('content')
  <section class="d-flex flex-column align-items-center my-4">
    <div class="input-group input-group-lg mb-2" style="max-width: 400px">
      <span class="input-group-text" onclick="sendScanResult()">
        <i class="bi bi-search"></i>
      </span>
      <input id="valueSearch" type="text" class="form-control" placeholder="Nhập mã tra cứu...">
      <span class="input-group-text" id="startScanning">
        <i class="bi bi-upc-scan"></i>
      </span>
    </div> 
    <pre><code id="result"></code></pre>
    <video id="video" width="300px" height="300px" style="display: none;"></video>
    <a class="btn btn-danger btn-block mt-2" id="resetscan" style="display: none">Hủy Scan</a>
  </section>
  <section class="d-flex flex-column align-items-center text-center">
    <div id="content" class="w-100" style="max-width: 600px;"></div>
  </section>
  <style>
    /* css animation scanning for #video  */
    #video {
      background-color: #000;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: relative;
      overflow: hidden;
    }
  </style>
@endsection
@push('scripts')
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest/umd/index.min.js"></script>
<script>
  $(function() {
    let selectedDeviceId;
    const codeReader = new ZXing.BrowserMultiFormatReader();

    codeReader.listVideoInputDevices().then((videoInputDevices) => {
      $('#startScanning').on('click', function() {
        $('#content').html('');
        $('#valueSearch').val('')
        $('#video').css('display', 'block');
        $('#resetscan').css('display', 'inline-block');
        $('#result').text('');
        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
          if (result) {
            $('#valueSearch').val(result.text);
            $('#result').text('');
            $('#video').css('display', 'none');
            $('#resetscan').css('display', 'none');
            codeReader.reset();
            sendScanResult();
          }
          if (err && !(err instanceof ZXing.NotFoundException)) {
            $('#result').text(err);
          }
        });
      });
      $('#resetscan').on('click', function() {
        codeReader.reset();
        $('#result').text('');
        $('#video').css('display', 'none');
        $('#resetscan').css('display', 'none');
      });
    });


  });
  $(document).ready(function () {
    $('#content').html('<div class="text-muted">Vui lòng quét mã QR hoặc nhập mã để tra cứu thông tin.</div>');
  });
  // Xử lý nhập mã thủ công khi có thay đổi input
  $('#valueSearch').change(function() {
    sendScanResult();
  });
  function sendScanResult() {
    // kiểm tra code nếu đúng định dạng thì mới gửi ajax
    let code = $('#valueSearch').val().trim();
    if (!/^AP\d{7}$/.test(code)) {
      // thêm hiệu ứng loading vào #content
      $('#content').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Đang tải dữ liệu...</span></div>');
      // chuyển hướng đến route /scan/{code}
      window.location.href = location.origin + '/scan/' + code;
    }else {
      $('#content').html('<div class="text-danger my-5 text-lg">Mã không đúng định dạng! Mã phải bắt đầu bằng "AP" và theo sau là 8 chữ số.</div>');
    }
  }
  // nếu có id truyền vào thì tự động điền và gửi ajax
  @if (!empty($id))
    $(document).ready(function () {
      // thêm hiệu ứng loading vào #content
      $('#valueSearch').val('{{ $id }}');
      $('#content').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Đang tải dữ liệu...</span></div>');
      // gửi ajax
      $.ajax({
        url: location.origin + '/scan-result',
        method: 'POST',
        data: { code: '{{ $id }}', _token: '{{ csrf_token() }}' },
        success: function(data) {
          setTimeout(() => {
            $('#content').html(data);
          }, 1000);
        },
        error: function() {
          $('#content').html('<div class="text-danger my-5 text-lg">Không tìm thấy dữ liệu!</div>');
        }
      });
    });
  @endif
</script>
@endpush