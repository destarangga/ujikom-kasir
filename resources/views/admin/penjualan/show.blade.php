@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Penjualan</h1>
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
                            @if (Auth::user()->role == 'petugas')
                                <a href="{{ route('penjualan-create') }}">
                                    <button class="btn btn-sm btn-primary" style="float: right">Tambah</button>
                                </a>
                                <a href="{{ route('pdf-detail') }}">
                                    <button class="btn btn-sm btn-danger" style="float: center">export PDF</button>
                                </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach ($penjualans as $penjualan)
                                <div class="penjualan">
                                    @if ($penjualan->produk->count() > 0)
                                        <p><strong>Nama Produk:</strong>
                                            @foreach ($penjualan->produk as $produk)
                                                {{ $produk->nama_produk }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </p>
                                    @else
                                        <p><strong>Nama Produk:</strong> Not available</p>
                                    @endif
                                    <!-- <p><strong>Nama Pelanggan:</strong> {{ $penjualan->nama_pelanggan}}</p>
                                    <p><strong>Alamat:</strong> {{ $penjualan->alamat }}</p>
                                    <p><strong>Nomor Telp:</strong> {{ $penjualan->no_telp }}</p> -->
                                    <p><strong>Jumlah Produk:</strong> {{ $penjualan->jumlah_produk }}</p>
                                    <p><strong>Subtotal:</strong> Rp.{{ number_format($penjualan->subtotal, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card -->
                        @if (Auth::user()->role == 'admin')
                            <div class="card-footer">
                                <a href="{{ route('penjualan-admin') }}" class="btn btn-sm btn-secondary"><i
                                        class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        @else
                            <div class="card-footer">
                                <a href="{{ route('penjualan') }}" class="btn btn-sm btn-secondary"><i
                                        class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        @endif
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            $('.btn-detail').click(function() {
                var url = $(this).data('url');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        // Tampilkan detail penjualan di modal
                        $('#detail-modal .modal-body').html(response);
                        $('#detail-modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika terjadi
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
