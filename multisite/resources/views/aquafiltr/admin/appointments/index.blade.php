@extends('layouts.app')
@section('content')
    <div class="py-2">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                            + Tạo lịch hẹn mới
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã KH</th>
                                    <th>Tên KH</th>
                                    <th>SĐT</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày hẹn</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appt)
                                    <tr>
                                        <td>{{ $appt->customer_code }}</td>
                                        <td>{{ $appt->customer_name }}</td>
                                        <td>{{ $appt->phone }}</td>
                                        <td>{{ $appt->address }}</td>
                                        <td>{{ $appt->appointment_date }}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('appointments.show', $appt->id) }}" class="btn btn-sm btn-link text-primary">Xem</a>
                                            <a href="{{ route('appointments.edit', $appt->id) }}" class="btn btn-sm btn-link text-success">Sửa</a>
                                            <form action="{{ route('appointments.destroy', $appt->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-danger"
                                                    onclick="return confirm('Bạn có chắc muốn xóa lịch hẹn này?')">
                                                    Xóa
                                                </button>
                                            </form>
                                            <a href="{{ route('appointments.invoice', $appt->id) }}" class="btn btn-sm btn-link text-purple">Xuất HĐ</a>
                                            <a href="{{ route('appointments.barcode', $appt->id) }}" class="btn btn-sm btn-link text-secondary">Mã vạch</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $appointments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
