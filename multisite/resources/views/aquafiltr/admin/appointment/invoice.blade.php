<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ORDER DELIVERED</title>
    <style>
        body{
            font: 0.9em sans-serif;
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
            padding-bottom: 5px;
        }
        .invoice-body-main{
            padding-top: 10px;
            padding-left: 5px;
            padding-right: 5px;
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
            font-size: 1em;
        }
        .invoice-totals-table {
            width: 100%;
            margin-top: 10px;
        }
        .invoice-total-row {
            font-size: 1.1em;
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
                <td class="right" style="width:50%">ORDER DELIVERED</td>
            </tr>
        </table>
    </div>
    <table class="invoice-body-table">
        <tr style="border-bottom:2px solid #222;padding:5px">
            <td style="width:50%; border-right:2px solid #222; vertical-align:top;">
                <div class="invoice-body-title">Supplier:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td><strong>PENAM, a.s.</strong></td><td>Phone: +420 545 518 111</td></tr>
                        <tr><td>Cejl 38</td><td>E-mail: penam@penam.cz</td></tr>
                        <tr><td>602 00 BRNO</td><td>IR: 469 67 851</td></tr>
                        <tr><td>Czech Republic</td><td>VAT: CZ469 67 851</td></tr>
                    </table>
                </div>
            </td>
            <td style="width:50%; vertical-align:top;">
                <div class="invoice-body-title">Document:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td>Delivery identification:</td><td>1st delivery</td></tr>
                        <tr><td>Delivery day:</td><td>03.09.2025 0:01:00</td></tr>
                        <tr><td>Order date:</td><td>02.09.2025 12:41:46</td></tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr style="border-bottom:2px solid #222;padding:5px">
            <td style="width:50%; border-right:2px solid #222; vertical-align:top;">
                <div class="invoice-body-title">Recipient:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td>Food BEAR</td></tr>
                        <tr><td>Hornoměstská 494/7</td></tr>
                        <tr><td>795 01 Rymarov</td></tr>
                    </table>
                </div>
            </td>
            <td style="width:50%; vertical-align:top;">
                <div class="invoice-body-title">Subscriber:</div>
                <div class="invoice-body-main">
                    <table style="width:100%">
                        <tr><td><strong>{{ $appointment->customer_name ?? 'N/A' }}</strong></td></tr>
                        <tr><td>Kigginsova 1514/8</td></tr>
                        <tr><td>627 00 Brno-Slatina</td></tr>
                        <tr><td>Phone: +420 545 518 111</td></tr>
                        <tr><td>E-mail: penam@penam.cz</td></tr>
                        <tr><td>IR: 469 67 851</td></tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table class="invoice-content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price/MJ incl. VAT</th>
                <th>Unit of measure</th>
                <th>Quantity</th>
                <th>Total price including VAT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>33254</td>
                <td>Rohlík 43g</td>
                <td>2,40 $</td>
                <td>KS</td>
                <td>105,00</td>
                <td>251,66 $</td>
            </tr>
            <tr>
                <td>2</td>
                <td>33254</td>
                <td>Rohlík 43g</td>
                <td>2,40 $</td>
                <td>KS</td>
                <td>105,00</td>
                <td>251,66 $</td>
            </tr>
            <tr>
                <td>3</td>
                <td>33254</td>
                <td>Rohlík 43g</td>
                <td>2,40 $</td>
                <td>KS</td>
                <td>105,00</td>
                <td>251,66 $</td>
            </tr>
        </tbody>
    </table>
</div>
<table class="invoice-totals-table">
    <tr>
        <td style="width:60%"></td>
        <td style="width:40%">
            <div class="invoice-total-row">
                <span>Rounding</span>
                <span>0,00 $</span>
            </div>
            <div class="invoice-total-row total-sum">
                <span>Total including VAT:</span>
                <span>745,89 $</span>
            </div>
        </td>
    </tr>
</table>
<div style="display: block;text-align: right;">Prices are governed by the valid price list at the time of delivery.</div>

</body>
</html>
