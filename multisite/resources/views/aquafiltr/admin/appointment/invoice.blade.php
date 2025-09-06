<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Invoice - Appointment Schedule {{$appointment->code}}</title>
    <style>
        body{
            font-size: 0.8em;
            font-family: 'DejaVu Sans', Arial, sans-serif;
        }
        .invoice-box {
            border: 2px solid #222;
            width: 100%;
            margin: 0 auto;
        }
        .invoice-head{
            border-bottom: 2px solid #222;
            font-weight: bold;
            padding: 10px;
        }
        .invoice-head-table {
            width: 100%;
        }
        .invoice-body-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-body-title{
            font-weight: bold;
            font-style: italic;
            text-decoration: underline;
            padding: 10px;
        }
        .invoice-body-main{
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 10px
        }
        .invoice-body-row{
            width: 100%;
        }
        .space{
            padding: 3px;
        }
        .invoice-content-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-content-table th, .invoice-content-table td {
            border: 1px solid #222;
            padding: 8px;
            font-size: 0.9em;
        }
        .invoice-totals-table {
            width: 100%;
            margin-top: 10px;
        }
        .invoice-total-row {
            font-size: 1em;
            padding: 5px 10px;
            text-align: right;
        }
        .total-sum {
            font-size: 1.2em;
            padding: 10px 10px;
            font-weight: bold;
            border: 2px solid #222;
        }
        .left { text-align: left; }
        .right { text-align: right; }
        .center { text-align: center; }
    </style>
</head>
<body>
<div class="invoice-box">
    <div class="invoice-head">
        <table class="invoice-head-table">
            <tr>
                <td class="left" style="width:50%">{{ $appointment->code ?? 'N/A' }}</td>
                <td class="right" style="width:50%">Service Invoice</td>
            </tr>
        </table>
    </div>
    <table class="invoice-body-table">
        <tr style="border-bottom:2px solid #222;padding:5px">
            <td style="width:50%; border-right:2px solid #222; vertical-align:top;">
                <div class="invoice-body-title">Supplier:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td><strong>{{ $user->name ?? 'N/A' }}</strong></td><td>Phone: {{ $user->phone ?? 'N/A' }}</td></tr>
                        <tr><td>{{ $user->title ?? '' }}</td><td>E-mail: {{ $user->email ?? 'N/A' }}</td></tr>
                    </table>
                </div>
            </td>
            <td style="width:50%; vertical-align:top;">
                <div class="invoice-body-title">Document:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td>Appointment date:</td><td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}</td></tr>
                        <tr><td>Created at:</td><td>{{ $appointment->created_at->format('d/m/Y H:i') }}</td></tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr style="border-bottom:2px solid #222;padding:5px">
            <td style="width:50%; border-right:2px solid #222; vertical-align:top;">
                <div class="invoice-body-title">Recipient:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td><strong>{{ $appointment->customer_name ?? 'N/A' }}</strong></td></tr>
                        <tr><td>Phone: {{ $appointment->customer_phone ?? 'N/A' }}</td></tr>
                        <tr><td>Address: {{ $appointment->customer_address ?? 'N/A' }}</td></tr>
                        <tr><td>Region: {{ $appointment->customer_region ?? 'N/A' }}</td></tr>
                    </table>
                </div>
            </td>
            <td style="width:50%; vertical-align:top;">
                <div class="invoice-body-title">Device:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td><strong>{{ $appointment->device_code ?? 'N/A' }}</strong></td></tr>
                        <tr><td>Name: {{ $appointment->device_name ?? 'N/A' }}</td></tr>
                        <tr><td>Model: {{ $appointment->device_model ?? 'N/A' }}</td></tr>
                        <tr><td>Price: {{ number_format($appointment->device_price ?? 0) }}</td></tr>
                        <tr><td>Imei: <strong>{{ $appointment->device_imei ?? 'N/A' }}</strong></td></tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <div class="invoice-head" style="border-bottom:none;">
        <table class="invoice-head-table">
            <tr>
                <td class="left" style="width:40%">Reminder cycle: {{ $appointment->reminder_cycle ?? '0' }} M</td>
                <td class="right" style="width:60%">{{ $appointment->note ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
</div>
<table class="invoice-totals-table">
    <tr>
        <td style="width:60%"></td>
        <td style="width:40%">
            {{-- <div class="invoice-total-row">
                <span>Rounding</span>
                <span>0,00 $</span>
            </div> --}}
            @if(($appointment->device_price??0)>0)
            <div class="invoice-total-row total-sum">
                <span>Total including VAT:</span>
                <span>745,89 $</span>
            </div>
            @endif
        </td>
    </tr>
</table>
@if (($appointment->device_info??'') != '')
<div style="display: block;text-align: right; padding-top:10px">
    {{ $appointment->device_info }}
</div>
@endif
</body>
</html>
