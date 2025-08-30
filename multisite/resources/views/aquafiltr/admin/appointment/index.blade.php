@extends('layouts.app')
@section('content')
<div class="container">
    <div class="my-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentCreateModal" id="btnCreateAppointment">
            <i class="bi bi-calendar-plus"></i> Tạo lịch hẹn mới
        </button>
        <div class="input-group" style="max-width: 300px; float: right;">
            <span class="input-group-text" id="searching-data"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="searching-data" id="searchInput">
        </div>
    </div>
    <div id="appointmentListData">
        <div class="shimmer-loader" style="min-height:60vh;">
            <div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div>
            <div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div>
            <div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="appointmentCreateModal" tabindex="-1" aria-labelledby="appointmentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentCreateModalLabel">Tạo lịch hẹn mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="appointmentCreateModalBody"></div>
        </div>
    </div>
</div>
<script>
    const shimmerloader = `
<div class="shimmer-loader">
    <div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div>
    <div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div>
    <div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div>
</div>
`;
    var page = 1;
    var keywords = '';
    $(function() {
        $('#appointmentListData').html(shimmerloader);
        loadListData();
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
    // Tạo lịch hẹn
    $('#btnCreateAppointment').on('click', function() {
        $('#appointmentCreateModalBody').html(shimmerloader);
        $.get("{{ route('appointment.create') }}", function(data) {
            $('#appointmentCreateModalBody').html(data);
        }).fail(function(err) {
            let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON.message : (err.message ?? 'Lỗi quyền truy cập!');
            showBootstrapToast(msg, 'danger');
        });
    });
</script>
@endsection