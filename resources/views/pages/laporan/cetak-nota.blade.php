<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota Transaksi | Andra's Laundry</title>
    <link rel="shortcut icon" href="{{ asset('img/stisla-fill.svg') }}" type="image/x-icon">
    <!-- Include CSS untuk styling nota -->
    <!-- General CSS Files -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/components.css') }}">
</head>
<body>
    <div id="app">
        <section class="section">
            <div class="row min-vh-100 d-flex justify-content-center align-items-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header d-flex flex-column justify-content-center align-items-center bg-primary">
                            <img src="{{ asset('img/mesin.png') }}" alt="logo" width="80" class="mt-2">
                            <h4 class="text-white">Andra's Laundry</h4>
                        </div>
                        <div class="card-body">
                            <table cellpadding="5" cellspacing="0" style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">Nama</td>
                                    <td colspan="2">:</td>
                                    <td colspan="7">{{ $transaksi['data']['idUser']['namalengkap'] }}</td>
                                </tr>
                                <tr>
                                    <td>No. Hp</td>
                                    <td colspan="2">:</td>
                                    <td colspan="7">{{ $transaksi['data']['idUser']['telepon'] }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td colspan="2">:</td>
                                    <td colspan="7">{{ $transaksi['data']['idUser']['alamat'] }}</td>
                                </tr>
                                <tr>
                                    <td>Order</td>
                                    <td colspan="2">:</td>
                                    <td colspan="7">{{ $transaksi['data']['idPaket']['namapaket'] }} / {{ $transaksi['data']['idLayanan']['layanan'] }}</td>
                                </tr>
                            </table>
                            <table cellpadding="5" cellspacing="0" style="width: 100%;">
                                <tr>
                                    <td style="vertical-align: top;">Berat: {{ $transaksi['data']['berat'] }} Kg</td>
                                    <td style="vertical-align: top;">
                                        {!! nl2br(str_replace(['Lembar', 'Helai'], ['Lembar<br>', 'Helai<br>'], $transaksi['data']['detail'])) !!}
                                    </td>
                                </tr>
                            </table>
                            <table cellpadding="5" cellspacing="0" style="width: 100%;">
                                <tr>
                                    <td style="vertical-align: top;">{{ $transaksi['data']['berat'] }} Kg x {{ format_currency($transaksi['data']['idPaket']['harga']) }} = <b>{{ format_currency($transaksi['data']['berat'] * $transaksi['data']['idPaket']['harga']) }}</b></td>
                                </tr>
                            </table>
                            @if (!empty($transaksi['data']['idPromo']))
                            <div class="d-flex flex-column justify-content-center align-items-center bg-primary mt-3">
                                <h6 class="text-white mt-2">Anda mendapatkan potongan sebesar {{ format_currency($transaksi['data']['idPromo']['potongan']) }}</h6>
                                <h6 class="text-white mt-2">Anda hanya perlu membayar {{ format_currency($transaksi['data']['berat'] * $transaksi['data']['idPaket']['harga'] - $transaksi['data']['idPromo']['potongan']) }}</h6>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Script untuk otomatis cetak saat halaman dimuat -->
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
