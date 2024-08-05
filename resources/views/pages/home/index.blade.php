@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Dashboard</h1>

                @if (Session::get('role') == 4 && Session::get('status') == 0)
    <span>Tidak Ready</span>
@else
    <span>Ready</span>
@endif


            </div>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            @if (Session::get('role') == 4)
            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('ubah-status-driver', Session::get('user_id')) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="status">Status Driver</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0">Tidak Ready</option>
                                        <option value="1">Ready</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>

                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>No. Hp</th>
                                        <th>Alamat</th>
                                        <th>Orderan</th>
                                        <th>Posisi Laundry</th>
                                        <th>Action</th>

                                    </tr>
                                    @foreach ($transaksi as $t)
                                        @if (Session::get('status') == 1 && $t['status'] != 11)
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
                                            @if ($t['status'] == 1)
                                                <td>
                                                    Ada di Lokasi Client
                                                </td>
                                            @else
                                                <td>
                                                    Ada di Lokasi Laundry
                                                </td>
                                            @endif
                                           @if ($t['status'] == 1 || $t['status'] == 10)
                                           <td>
                                            <div class="d-flex justify-content-center">

                                                <a href='{{ route('transaksi.hubungi', $t['_id']) }}'
                                                    class="btn btn-sm btn-success btn-icon ml-2">
                                                    <i class="fas fa-whatsapp"></i>
                                                    Hubungi Pelanggan
                                                </a>
                                               @if ($t['idDriver'] == null)
                                               <form id="orderan-form-{{ $t['_id'] }}" action="{{ route('ambil-orderan', ['id' => $t['_id'], 'idDriver' => Session::get('user_id') ]) }}" method="POST" class="ml-2">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-primary btn-icon">
                                                    <i class="fas fa-truck"></i> Ambil Orderan
                                                </button>
                                            </form>
                                            @else
                                            <div class="ml-2">
                                                <b>Orderan Sudah Diambil oleh {{ $t['idDriver']['namalengkap'] }}</b>
                                            </div>
                                               @endif


                                            </div>
                                            </td>
                                           @else
                                           <td>
                                            Menunggu Konfirmasi Admin

                                           </td>
                                           @endif
                                        </tr>
                                        @endif


                                    @endforeach


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (Session::get('role') == 2 || Session::get('role') == 3)
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-credit-card"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Transaksi</h4>
                            </div>
                            <div class="card-body">
                                @isset($jumlahTransaksi)
                                {{ $jumlahTransaksi }}
                            @else
                                0
                            @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pemasukan</h4>
                            </div>
                            <div class="card-body">
                                @isset($totalPemasukan)
                                {{ format_currency($totalPemasukan) }}
                            @else
                                0
                            @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                @isset($jumlahPelanggan)
                                    {{ $jumlahPelanggan }}
                                @else
                                    0
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
