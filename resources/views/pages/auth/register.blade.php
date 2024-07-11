@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                    <div class="form-group ">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input id="namalengkap"
                            type="text"
                            class="form-control"
                            name="namalengkap"
                            autofocus>
                    </div>
                    <div class="form-group ">
                        <label for="telepon">Nomor Hp</label>
                        <input id="telepon"
                            type="text"
                            class="form-control"
                            name="telepon" placeholder="(+62)">
                    </div>


                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username"
                        type="text"
                        class="form-control"
                        name="username">
                    <div class="invalid-feedback">
                    </div>
                </div>


                    <div class="form-group ">
                        <label for="password"
                            class="d-block">Password</label>
                        <input id="password"
                            type="password"
                            class="form-control pwstrength"
                            data-indicator="pwindicator"
                            name="password">
                        <div id="pwindicator"
                            class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>


                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
