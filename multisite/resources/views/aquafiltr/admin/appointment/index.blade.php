@extends('layouts.app')
@section('content')
<div class="row mt-md-4 mt-3 px-md-3 px-2">
    <div class="col-md-4 col-12">
        <select class="form-control col-md-4 col-6" id="sort_customer_id" name="sort_customer_id" data-placeholder="Vui lòng chọn khách hàng">
            <option value="" selected>Tất cả khách hàng</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->phone }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 col-12">
        <select class="form-control col-md-4 col-6" id="sort_device_id" name="sort_device_id" data-placeholder="Vui lòng chọn thiết bị">
            <option value="" selected>Tất cả thiết bị</option>
            @foreach ($devices as $device)
                <option value="{{ $device->id }}">{{ $device->name }} - {{ $device->model }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 col-12">
        <div class="input-group col-md-4 col-12" style="max-width: 300px; float: right;">
            <span class="input-group-text" id="searching-data"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="searching-data" id="searchInput">
        </div>
    </div>
</div>
<div id="appointmentListData" class="w-100"></div>
<div class="modal fade" id="appointmentShowModal" tabindex="-1" aria-labelledby="appointmentShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentShowModalLabel">Thông tin lịch hẹn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="appointmentShowModalBody"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="appointmentDeleteModal" tabindex="-1" aria-labelledby="appointmentDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentDeleteModalLabel">Xóa lịch hẹn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="appointmentDeleteModalBody"></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
    var page = 1;
    var keywords = '';
    $(function() {
        $('#appointmentListData').html(shimmerloader());
        loadListData();
    });
    $("#sort_customer_id").select2({
        allowClear: true,
    });
    $("#sort_device_id").select2({
        allowClear: true,
    });
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
                url: "{{ route('appointment.index') }}",
                type: 'GET',
                data: { page: page, keywords: keywords },
                success: function(res, status, xhr) {
                    $('#appointmentListData').html(res);
                    $('#searching-data').html('<i class="bi bi-search"></i>');
                },
                error: function(xhr) {
                    $('#appointmentListData').html('<p class="text-danger">Lỗi tải dữ liệu!</p>');
                }
            });
        }, 300);
    }
    
</script>
@endpush