@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">User</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ Session::get('name'); }}!</h2>
                <p class="section-lead">
                    Ubah informasi tentang diri anda di sini.
                </p>

                <div class="row mt-sm-4">

                    <div class="row">
                        <div class="col-12">
                            @include('layouts.alert')
                        </div>
                    </div>


                    <div class="card">
                        <form id="user-form" action="{{ route('pelanggan.update', $userData['data']['_id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Input Text</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text"
                                        class="form-control @error('namalengkap')
                                    is-invalid
                                @enderror"
                                        name="namalengkap" value="{{ $userData['data']['namalengkap'] }}">
                                    @error('namalengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text"
                                        class="form-control @error('username')
                                    is-invalid
                                @enderror"
                                        name="username" value="{{ $userData['data']['username'] }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password"
                                            class="form-control @error('password')
                                    is-invalid
                                @enderror"
                                            name="password">
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" class="form-control" name="telepon" value="{{ $userData['data']['telepon'] }}">
                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-primary" id="confirmation">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
