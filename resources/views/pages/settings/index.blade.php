@extends('layouts.app')

@section('title', 'Settings')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Settings</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Settings</a></div>

                    <div class="breadcrumb-item">Settings</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4">
                        <a href="{{route('settings.create-paket')}}" class="btn btn-lg btn-primary">Buat Paket</a>

                        <div class="card mt-2">
                            <div class="card-header">
                                <h4>Paket</h4>
                            </div>
                            <div class="card-body">

                                {{-- <div class="float-right">
                                    <form method="GET" action="{{ route('settings.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Nama Paket</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                        @isset($paket)
                                        @foreach ($paket as $p)
                                        <tr>

                                            <td>{{ $p['namapaket'] }}
                                            </td>
                                            <td>
                                                {{ format_currency($p['harga']) }}
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href='{{ route('settings.edit-paket', $p['_id']) }}'
                                                        class="btn btn-sm btn-info btn-icon">
                                                        <i class="fas fa-edit"></i>
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('settings.destroy-paket', $p['_id']) }}"
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
                                    @else
                                    <td colspan="3">Tidak ada Paket</td>
                                    @endisset


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $paket->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4">
                        <a href="{{route('settings.create-layanan')}}" class="btn btn-lg btn-info">Buat Layanan</a>

                        <div class="card mt-2">
                            <div class="card-header">
                                <h4>Layanan</h4>
                            </div>
                            <div class="card-body">

                                {{-- <div class="float-right">
                                    <form method="GET" action="{{ route('settings.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>No</th>
                                            <th>Layanan</th>
                                            <th>Action</th>
                                        </tr>

                                            <tr>
                                               @isset($layanan)
                                               @foreach ($layanan as $l)
                                               <td>{{ $loop->iteration }}
                                               </td>
                                               <td>
                                                   {{ $l['layanan'] }}
                                               </td>


                                               <td>
                                                   <div class="d-flex justify-content-center">
                                                       <a href='{{ route('settings.edit-layanan', $l['_id']) }}'
                                                           class="btn btn-sm btn-info btn-icon">
                                                           <i class="fas fa-edit"></i>
                                                           Edit
                                                       </a>

                                                       <form action="{{ route('settings.destroy-layanan', $l['_id']) }}"
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
                                               @endforeach
                                               @else
                                               <td colspan="3">Tidak ada Layanan</td>
                                               @endisset
                                            </tr>



                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $layanan->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4">
                        <a href="{{route('settings.create-promo')}}" class="btn btn-lg btn-warning">Buat Promo</a>

                        <div class="card mt-2">
                            <div class="card-header">
                                <h4>Promo</h4>
                            </div>
                            <div class="card-body">

                                {{-- <div class="float-right">
                                    <form method="GET" action="{{ route('settings.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Gambar</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>

                                            <tr>
                                                @isset($promo)
                                                @foreach ($promo as $pr)
                                                <td>
                                                    @if (!empty($pr['image']))
                    <img src="http://127.0.0.1:5001/static/{{ $pr['image'] }}" alt="{{ $pr['promo'] }}" style="max-width: 100px;">
                @else
                    <p>No image available</p>
                @endif
                                                </td>
                                                <td>
                                                    <b>{{ $pr['promo'] }}</b> - {{ $pr['keterangan'] }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('settings.edit-promo', $pr['_id']) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('settings.destroy-promo', $pr['_id']) }}"
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
                                                @endforeach
                                                @else
                                                <td colspan="3">Tidak ada Promo</td>
                                                @endisset
                                            </tr>



                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $promo->withQueryString()->links() }}
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
