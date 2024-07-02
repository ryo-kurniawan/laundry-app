@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Transaksi</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Riwayat Transaksi</h2>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Transaksi</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET" action="{{ route('transaksi.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>No. Hp</th>
                                            <th>Alamat</th>
                                            <th>Orderan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($transaksis as $t)
                                            @if ($t['status'] == 10)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $t['idUser']['namalengkap'] }}
                                                </td>
                                                <td>
                                                    {{ $t['idUser']['telepon'] }}
                                                </td>
                                                <td>
                                                    {{ $t['idUser']['alamat'] }}
                                                </td>
                                                <td>
                                                    {{ $t['idPaket']['namapaket'] }} / {{ $t['idLayanan']['layanan'] }}
                                                </td>
                                                <td>
                                                    @if ($t['status'] == 10)
                                                    Pengantaran dan pembayaran selesai
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ route('transaksi.cetakNota', $t['_id']) }}" target="_blank" class="btn btn-lg btn-primary"><i class="fas fa-print"></i> Cetak Nota</a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach


                                    </table>
                                </div>

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
@endpush
