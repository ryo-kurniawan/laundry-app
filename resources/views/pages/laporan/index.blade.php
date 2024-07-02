@extends('layouts.app')

@section('title', 'Laporan')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                {{-- <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Add New User</a> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Laporan</a></div>

                    <div class="breadcrumb-item">Cetak Laporan</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Cetak Laporan</h2>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('laporan.cetak') }}" method="get">
                                    <div class="form-group">
                                        <label>Dari Tanggal</label>
                                        <input type="date" class="form-control" name="from_date">
                                    </div>
                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" class="form-control" name="to_date">
                                    </div>

                                    <button class="btn btn-primary">Cetak</button>
                                </form>
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
