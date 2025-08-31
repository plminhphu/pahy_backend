@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="my-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleCreateModal" id="btnCreateRole">
                <i class="bi bi-plus"></i> Thêm quyền tài khoản
            </button>
            <div class="input-group" style="max-width: 300px; float: right;">
                <span class="input-group-text" id="searching-data"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search"
                    aria-describedby="searching-data" id="searchInput">
            </div>
        </div>
        <div id="roleListData">
            <div class="shimmer-loader" style="min-height:60vh;">
                <div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div>
                <div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div>
                <div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="roleShowModal" tabindex="-1" aria-labelledby="roleShowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleShowModalLabel">Quyền tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="roleShowModalBody"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="roleCreateModal" tabindex="-1" aria-labelledby="roleCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleCreateModalLabel">Thêm quyền tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="roleCreateModalBody"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="roleEditModal" tabindex="-1" aria-labelledby="roleEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleEditModalLabel">Sửa quyền tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="roleEditModalBody"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="roleDeleteModal" tabindex="-1" aria-labelledby="roleDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleDeleteModalLabel">Xóa quyền tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="roleDeleteModalBody"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
  var page = 1;
  var keywords = '';
  $(function() {
      // Load danh sách role
      $('#roleListData').html(shimmerloader);
      loadListData();
  });
  // khi nhấn tìm kiếm phải debounce để tránh gọi hàm loadListData quá nhiều
  let debounceTimer;
  $('#searchInput').on('input', function() {
      if ($('#searching-data').find('span').length) {
          return;
      } else {
          $('#searching-data').html('<span class="spinner-border spinner-border-sm" role="status"></span>');
      }
      clearTimeout(debounceTimer);
      var query = $(this).val();
      debounceTimer = setTimeout(function() {
          keywords = query;
          page = 1;
          loadListData();
      }, 500);
  });
  function loadListData() {
      setTimeout(() => {
          $.ajax({
              url: "{{ route('role.index') }}",
              type: 'GET',
              data: { page: page, keywords: keywords },
              success: function(res, status, xhr) {
                  $('#roleListData').html(res);
                  $('#searching-data').html('<i class="bi bi-search"></i>');
              },
              error: function(xhr) {
                  $('#roleListData').html('<p class="text-danger">Lỗi tải dữ liệu!</p>');
              }
          });
      }, 300);
  }
  // Thêm role
  $('#btnCreateRole').on('click', function() {
      $('#roleCreateModalBody').html(shimmerloader);
      $.get("{{ route('role.create') }}", function(data) {
          $('#roleCreateModalBody').html(data);
      }).fail(function(err) {
          let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON.message : (err.message ?? 'Lỗi quyền truy cập!');
          showBootstrapToast(msg, 'danger');
      });
  });
</script>
@endpush
