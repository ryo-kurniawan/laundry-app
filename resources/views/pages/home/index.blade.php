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
