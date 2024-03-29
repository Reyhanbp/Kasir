<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }

        .header {
            margin: 0;
            text-align: center;
        }

        h2,
        p {
            margin: 0;
        }

        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1>div {
            text-align: left;
        }

        .flex-container-1 .right {
            text-align: right;
            width: 200px;
        }

        .flex-container-1 .left {
            width: 100px;
        }

        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container>div {
            -ms-flex: 1;
            /* IE 10 */
            flex: 1;
        }

        ul {
            display: contents;
        }

        ul li {
            display: block;
        }

        hr {
            border-style: dashed;
        }

        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body onload="printOut()">
    <div class="container" style="margin: auto;">
        <div class="header" style="margin-bottom: 30px;">
            <h2> N - Games </h2>
            <small> Jl. Kencanasari Timur, 20. no. 15, Surabaya, Jawa Timur</small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No. Pesanan</li>
                    <li>Penangan</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{$invoice->id}} </li>
                    <li> {{$user->name}} </li>
                    <li> {{date('d-m-Y', strtotime($invoice->date))}} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Product</div>
            <div>Harga/Jumlah</div>
            <div>Total</div>
        </div>
        @foreach ($invoice->detail as $item )
        <div class="flex-container" style="text-align: right;">
            <div style="text-align: left;">{{$item->item->name}}</div>
            <div>Rp. {{$item->item->price}}/{{$item->qty}}</div>
            <div>Rp. {{$item->subtotal}}</div>
        </div>
        @endforeach

        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div>
                <ul>
                    <li>Grand Total</li>
                    <li>Pembayaran</li>
                    <li>Kembalian</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>Rp. {{$invoice->total}}</li>
                    <li>Rp. {{$invoice->pay_total}}</li>
                    <li>Rp. {{$invoice->pay_total - $invoice->total}}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>Terimakasih</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
</body>
<script>
    function printOut() {
        window.print();
        setTimeout("self.close()", 1000)
    }

    window.onafterprint = function (e) {
        window.location.href = '{{route('transaction')}}'
    }
</script>

</html>