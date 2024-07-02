<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Orderan</th>
                <th>Pembayaran</th>
                <th>Berat</th>
                <th>Harga</th>

            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction['idUser']['namalengkap'] }}</td>

                <td>{{ $transaction['idPaket']['namapaket'] }} / {{ $transaction['idLayanan']['layanan'] }}</td>

                <td>
                    @if ($transaction['buktiPembayaran'] == null)
                        Cash/Bayar di tempat
                    @endif
                    @if ($transaction['buktiPembayaran'] != null)
                        Transfer
                    @endif
                </td>
                <td>{{ $transaction['berat'] }}kg</td>
                <td>{{ format_currency($transaction['berat'] * $transaction['idPaket']['harga']) }}</td>

            </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $total = 0;

                foreach ($transactions as $transaction) {
                    $total += $transaction['berat'] * $transaction['idPaket']['harga'];
                }

                $total = format_currency($total);
            @endphp
            <tr>

                <td colspan="4" style="text-align: right;"><b>Total</b></td>
                <td>{{ $total }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
