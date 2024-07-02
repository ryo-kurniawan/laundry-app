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
            @if (Session::get('role') == 3)
            <h2 class="section-title">Admin</h2>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Semua Admin</h4>
                        </div>
                        <div class="card-body">

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
                                        @if ($user['role'] == 2)
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

                                                    <form id="delete-form-{{ $user['_id'] }}" action="{{ route('pelanggan.destroy', $user['_id']) }}" method="POST" class="ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
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
            @endif


            <h2 class="section-title">Pelanggan</h2>


            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Semua Pelanggan</h4>
                        </div>
                        <div class="card-body">

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>

                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone</th>
                                        <th>Position</th>
                                        @if (Session::get('role') == 3)
                                        <th>Action</th>
                                        @endif

                                    </tr>
                                    @foreach ($pelanggan as $user)
                                        @if ($user['role'] == 1)
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
                                            @if (Session::get('role') == 3)
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href='{{ route('pelanggan.edit', $user['_id']) }}'
                                                        class="btn btn-sm btn-info btn-icon">
                                                        <i class="fas fa-edit"></i>
                                                        Edit
                                                    </a>

                                                    <form id="delete-form-{{ $user['_id'] }}" action="{{ route('pelanggan.destroy', $user['_id']) }}" method="POST" class="ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endif

                                        </tr>
                                        @endif
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

            <h2 class="section-title">Driver</h2>


            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Semua Driver</h4>
                        </div>
                        <div class="card-body">

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>

                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone</th>
                                        <th>Position</th>
                                        @if (Session::get('role') == 3)
                                        <th>Action</th>
                                        @endif

                                    </tr>
                                    @foreach ($pelanggan as $user)
    @if($user['role'] == 4)
        <tr>
            <td>{{ $user['namalengkap'] }}</td>
            <td>{{ $user['username'] }}</td>
            <td>{{ $user['telepon'] }}</td>
            <td>Driver</td>
            @if (Session::get('role') == 3)
            <td>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('pelanggan.edit', $user['_id']) }}" class="btn btn-sm btn-info btn-icon">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form id="delete-form-{{ $user['_id'] }}" action="{{ route('pelanggan.destroy', $user['_id']) }}" method="POST" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger btn-icon confirm-delete">
                            <i class="fas fa-times"></i> Delete
                        </button>
                    </form>
                </div>
            </td>
            @endif

        </tr>
    @endif
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
<!-- JS Libraries -->
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.confirm-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');

            swal({
                title: 'Are you sure?',
                text: 'Apakah anda yakin ingin menghapus data ini?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
