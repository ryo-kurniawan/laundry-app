@extends('layouts.app')

@section('title', 'Transaksi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                {{-- <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Add New User</a> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>

                    <div class="breadcrumb-item">Transaksi Masuk</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Transaksi Masuk</h2>


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
                                                    @if ($t['status'] == 0)
                                                    Pakaian sedang diberi kode
                                                    @endif
                                                    @if ($t['status'] == 1)
                                                    Pakaian sedang dilakukan pengecekan
                                                    @endif
                                                    @if ($t['status'] == 2)
                                                    Pakaian sedang dicuci
                                                    @endif
                                                    @if ($t['status'] == 3)
                                                    Pakaian sedang dikeringkan
                                                    @endif
                                                    @if ($t['status'] == 4)
                                                    Pakaian sedang disetrika
                                                    @endif
                                                    @if ($t['status'] == 5)
                                                    Pakaian sedang dipacking
                                                    @endif
                                                    @if ($t['status'] == 6)
                                                    Laundry selesai
                                                    @endif
                                                    @if ($t['status'] == 7)
                                                    Driver mengantarkan pakaian anda
                                                    @endif
                                                    @if ($t['status'] == 8)
                                                    Pengantaran dan pembayaran selesai
                                                    @endif

                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('transaksi.edit', $t['_id']) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('transaksi.destroy', $t['_id']) }}"
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
                                {{-- <div class="float-right">
                                    {{ $transaksis->withQueryString()->links() }}
                                </div> --}}
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
