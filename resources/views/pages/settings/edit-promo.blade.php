@extends('layouts.app')

@section('title', 'Edit Promo')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Promo</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Settings</a></div>

                    <div class="breadcrumb-item">Edit Promo</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Promo</h2>
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="card">
                    <form action="{{ route('settings.update-promo', $promo['data']['_id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data Promo</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Promo</label>
                                <input type="text" class="form-control @error('promo') is-invalid @enderror"
                                    name="promo" value="{{ old('promo', $promo['data']['promo']) }}">
                                @error('promo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                    name="keterangan">{{ old('keterangan', $promo['data']['keterangan']) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Potongan</label>
                                <input type="number" class="form-control @error('potongan') is-invalid @enderror" name="potongan" value="{{ old('potongan', $promo['data']['potongan']) }}">
                                @error('potongan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if (!empty($promo['data']['image']))
                                    <div class="mt-3">
                                        <img src="http://127.0.0.1:5001/static/{{ $promo['data']['image'] }}" alt="Promo Image" width="200">
                                    </div>
                                @endif
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
