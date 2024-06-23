@extends('layouts.app')

@section('title', 'Pelanggan')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            {{-- <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Add New User</a> --}}
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pelanggan</a></div>

                <div class="breadcrumb-item">Semua Pelanggan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <h2 class="section-title">Pelanggan</h2>


            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Semua Pelanggan</h4>
                        </div>
                        <div class="card-body">

                            <div class="float-right">
                                <form method="GET" action="{{ route('pelanggan.index') }}">
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

                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone</th>
                                        <th>Position</th>

                                        <th>Action</th>
                                    </tr>
                                    @foreach ($pelanggan as $user)
                                        <tr>

                                            <td>{{ $user['namalengkap'] }}
                                            </td>
                                            <td>
                                                {{ $user['username'] }}
                                            </td>
                                            <td>
                                                {{ $user['telepon'] }}
                                            </td>
                                            <td>
                                                @if($user['role'] == 1)
                                                    Pelanggan
                                                @elseif($user['role'] == 2)
                                                    Admin
                                                @elseif($user['role'] == 3)
                                                    Owner
                                                @else
                                                    Role tidak valid
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href='{{ route('pelanggan.edit', $user['_id']) }}'
                                                        class="btn btn-sm btn-info btn-icon">
                                                        <i class="fas fa-edit"></i>
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('pelanggan.destroy', $user['_id']) }}"
                                                        method="POST" class="ml-2">
                                                        <input type="hidden" name="_method" value="DELETE" />
                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}" />
                                                        <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </table>
                            </div>
                            <div class="float-right">
                                {{ $pelanggan->withQueryString()->links() }}
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
