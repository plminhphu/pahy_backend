@extends('layouts.app')
@section('content')
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
@endsection
@push('scripts')

<script>
    $(function() {
        $('#appointmentListData').html(shimmerloader());
        loadListData();
    });
    function loadListData() {
        setTimeout(() => {
            $.ajax({
                url: "{{ route('dashboard') }}",
                type: 'GET',
                data: { type:'load' },
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