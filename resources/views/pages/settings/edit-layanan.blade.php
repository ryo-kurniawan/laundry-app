@extends('layouts.app')

@section('title', 'Settings')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Layanan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Settings</a></div>

                    <div class="breadcrumb-item">Edit Layanan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Paket Laundry</h2>
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="card">
                    <form action="{{ route('settings.update-layanan', $layanan['data']['_id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data Layanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Layanan</label>
                                <input type="text" class="form-control @error('layanan') is-invalid @enderror"
                                    name="layanan" value="{{ $layanan['data']['layanan'] }}">
                                @error('layanan')
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
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
