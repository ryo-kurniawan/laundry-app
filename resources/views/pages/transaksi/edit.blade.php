@extends('layouts.app')

@section('title', 'Detail Transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>

                    <div class="breadcrumb-item">Detail Transaksi</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Detail Transaksi</h2>
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6">
                        <div class="card">
                            <form action="{{ route('transaksi.update', $transaksi['data']['_id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Detail Transaksi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" class="form-control @error('namalengkap') is-invalid @enderror"
                                            name="namalengkap" value="{{ $transaksi['data']['idUser']['namalengkap'] }}" readonly>
                                        @error('namalengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            name="alamat" value="{{ $transaksi['data']['idUser']['alamat'] }}" readonly>
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No. Hp</label>
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                            name="telepon" value="{{ $transaksi['data']['idUser']['telepon'] }}" readonly>
                                        @error('telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Berat - /Kg</label>
                                        <input type="number" class="form-control @error('berat') is-invalid @enderror"
                                            name="berat" value="{{ $transaksi['data']['berat'] }}" >
                                        @error('berat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Detail Cucian</label>
                                    <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" data-height="150">{{ old('detail', $transaksi['data']['detail']) }}</textarea>
                                        @error('detail')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Paket</label>
                                        <input type="text" class="form-control @error('namapaket') is-invalid @enderror"
                                            name="namapaket" value="{{ $transaksi['data']['idPaket']['namapaket'] }}" readonly>
                                        @error('namapaket')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                            name="harga" value="{{ $transaksi['data']['idPaket']['harga'] }}" readonly>
                                        @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Layanan</label>
                                        <input type="text" class="form-control @error('layanan') is-invalid @enderror"
                                            name="layanan" value="{{ $transaksi['data']['idLayanan']['layanan'] }}" readonly>
                                        @error('layanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    @if ($transaksi['data']['idPromo'] != null)
                                    <div class="form-group">
                                        <label>Promo</label>
                                        <input type="text" class="form-control @error('promo') is-invalid @enderror"
                                            name="promo" value="{{ $transaksi['data']['idPromo']['promo'] }}" readonly>
                                        @error('promo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                            name="keterangan" value="{{ $transaksi['data']['idPromo']['keterangan'] }}" readonly>
                                        @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Total</label>
                                        <h1>
                                            @php
                                                $total = $transaksi['data']['berat'] * $transaksi['data']['idPaket']['harga'];
                                                echo format_currency($total);
                                            @endphp
                                        </h1>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select2" name="status">
                                            <option value="0">Menunggu konfirmasi dari admin</option>
                                            <option value="1">Driver sedang menjemput pakaian anda</option>
                                            <option value="2">Pakaian sedang ditimbang</option>
                                            <option value="3">Pakaian sedang diberi kode</option>
                                            <option value="4">Pakaian sedang dilakukan pengecekan</option>
                                            <option value="5">Pakaian sedang dicuci</option>
                                            <option value="6">Pakaian sedang dikeringkan</option>
                                            <option value="7">Pakaian sedang disetrika</option>
                                            <option value="8">Pakaian sedang dipacking</option>
                                            <option value="9">Laundry selesai</option>
                                            <option value="10">Driver mengantarkan pakaian anda</option>
                                            <option value="11">Pengantaran dan pembayaran selesai</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Transaksi</label>
                                        <input type="text" class="form-control @error('tanggal') is-invalid @enderror"
                                            name="tanggal" value="{{ $transaksi['data']['tanggal'] }}" readonly>
                                        @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-8 col-md-6 col-sm-6">
                        <div class="card">

                                <div class="card-header d-flex flex-column justify-content-center align-items-center bg-primary">
                                    <img src="{{ asset('img/mesin.png') }}"
                            alt="logo"
                            width="80"
                            class=" mt-2">

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
                                <div class="card-footer text-right">
                                    {{-- Tombol Cetak Nota --}}
                                    <a href="{{ route('transaksi.cetakNota', $transaksi['data']['_id']) }}" target="_blank" class="btn btn-lg btn-primary"><i class="fas fa-print"></i> Cetak Nota</a>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
@endpush
