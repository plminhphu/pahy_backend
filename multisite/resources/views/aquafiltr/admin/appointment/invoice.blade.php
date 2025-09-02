<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn bán hàng</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 15px; }
        .title { font-size: 24px; font-weight: bold; text-align: center; margin-bottom: 20px; }
        .info-table td { padding: 4px 8px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background: #f5f5f5; }
        .right { text-align: right; }
        .center { text-align: center; }
        .footer { margin-top: 40px; font-size: 13px; text-align: center; color: #888; }
    </style>
</head>
<body>
<div class="invoice-box">
    <div class="title">HÓA ĐƠN BÁN HÀNG</div>
    <table class="info-table">
        <tr>
            <td><strong>Mã KH:</strong></td>
            <td>{{ $appointment->customer_code }}</td>
            <td><strong>Ngày lập:</strong></td>
            <td>{{ $appointment->created_at ? $appointment->created_at->format('d/m/Y') : date('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Tên khách hàng:</strong></td>
            <td>{{ $appointment->customer_name }}</td>
            <td><strong>SĐT:</strong></td>
            <td>{{ $appointment->phone }}</td>
        </tr>
        <tr>
            <td><strong>Địa chỉ:</strong></td>
            <td colspan="3">{{ $appointment->address }}</td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th class="center">STT</th>
                <th>Tên sản phẩm/Dịch vụ</th>
                <th class="center">Số lượng</th>
                <th class="right">Đơn giá</th>
                <th class="right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td>{{ $appointment->product_type }} {{ $appointment->service ? ' - ' . $appointment->service : '' }}</td>
                <td class="center">1</td>
                <td class="right">{{ number_format($appointment->price ?? 0) }}</td>
                <td class="right">{{ number_format($appointment->price ?? 0) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="right">Tổng cộng</th>
                <th class="right">{{ number_format($appointment->price ?? 0) }}</th>
            </tr>
        </tfoot>
    </table>
    <div class="footer">
        Cảm ơn quý khách đã sử dụng dịch vụ!<br>
        Hotline: 0901 234 567 &nbsp;|&nbsp; Địa chỉ: 123 Đường ABC, Quận 1, TP.HCM
    </div>
</div>
</body>
</html>
