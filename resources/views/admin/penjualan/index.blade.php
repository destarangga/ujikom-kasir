@extends('admin.layouts.app')

@section('content')
    <style>
        .button-container {
            position: relative;
            display: inline-block;
        }

        .tooltip {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 100%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .button-container:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Penjualan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                            @if (Auth::user()->role == 'petugas')
                                <a href="{{ route('penjualan-create') }}">
                                    <button class="btn btn-sm btn-primary" style="float: right">Tambah</button>
                                </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center">No</th>
                                        <th style="width: 10px" class="text-center">Tanggal</th>
                                        <th style="width: 10px" class="text-center">Pelanggan</th>
                                        <th style="width: 10px" class="text-center">Alamat</th>
                                        <th style="width: 10px" class="text-center">No Telepon</th>
                                        <th style="width: 10px" class="text-center">Total</th>
                                        <th style="width: 30px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($penjualans as $penjualan)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-center">{{ $penjualan->tanggal_penjualan }}</td>
                                            <td class="text-center">{{ $penjualan->pelanggan->nama_pelanggan }}</td>
                                            <td class="text-center">{{ $penjualan->pelanggan->alamat }}</td>
                                            <td class="text-center">{{ $penjualan->pelanggan->no_tlp }}</td>
                                            <td class="text-center">
                                                Rp.{{ number_format($penjualan->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                @if (Auth::user()->role == 'petugas')
                                                    <div class="button-container">
                                                        <a href="{{ route('detail-penjualan-petugas', ['id' => $penjualan->penjualan_id]) }}">
                                                            <button type="button" class="mr-1 btn btn-sm btn-secondary">
                                                            <i class="bi bi-info-square"></i>
                                                            </button>
                                                            <span class="tooltip">Detail</span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button-container">
                                                        <a href="{{ route('admin-detail-penjualan', ['id' => $penjualan->penjualan_id]) }}">
                                                            <button type="button" class="mr-1 btn btn-sm btn-secondary">
                                                            <i class="bi bi-info-square"></i>
                                                            </button>
                                                            <span class="tooltip">Detail</span>
                                                        </a>
                                                        <span class="tooltip">Detail</span>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal -->
    @foreach ($penjualans as $penjualan)
        <div class="modal fade" id="showDetail-{{ $penjualan->penjualan_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="detail-content"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('customJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-detail').click(function() {
                var url = $(this).data('url');
                var penjualan_id = $(this).data('penjualan-id'); // Dapatkan ID penjualan
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "html",
                    success: function(res) {
                        $('#showDetail-' + penjualan_id).find('.modal-body #detail-content').html(res); // Masukkan respons ke dalam modal yang sesuai
                        $('#showDetail-' + penjualan_id).modal('show'); // Tampilkan modal
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Tampilkan pesan kesalahan jika terjadi kesalahan dalam permintaan AJAX
                    }
                });
            });
        });
    </script>
@endsection

