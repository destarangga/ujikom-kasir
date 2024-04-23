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
                                <a href="{{ route('penjualan.pdf', ['id' => $penjualans->first()->penjualan_id]) }}">
                                    <button class="btn btn-sm btn-danger" style="float: center">export PDF</button>
                                </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p><strong>Nama Pelanggan:</strong> {{ $pelanggan->nama_pelanggan }}</p>
                            <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
                            <p><strong>Nomor Telp:</strong> {{ $pelanggan->no_tlp }}</p>
                            <p><strong>Detail Penjualan:</strong></p>
                            <table class="table" id="detailTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualans as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detail->penjualan->tanggal_penjualan }}</td>
                                            <input type="hidden" name="tanggal_penjualan" id="tanggal_penjualan" value="hiddenValue">
                                            <td>{{ $detail->produk->nama_produk }}</td>
                                            <input type="hidden" name="nama_produk" id="nama_produk" value="hiddenValue">
                                            <td>{{ $detail->produk->harga }}</td>
                                            <input type="hidden" name="harga" id="harga" value="hiddenValue">
                                            <td>{{ $detail->jumlah_produk }}</td>
                                            <input type="hidden" name="jumlah_produk" id="jumlah_produk" value="hiddenValue">
                                            <td>{{ $detail->subtotal }}</td>
                                            <input type="hidden" name="subtotal" id="subtotal" value="hiddenValue">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
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
@endsection
    <!-- /.content -->
    @section('costumJs')
    <!-- JavaScript -->
    <script>
        document.getElementById("searchInput").addEventListener("input", function() {
            console.log("Input event triggered");
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll("#detailTable tbody tr");
            
            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                if (text.includes(searchValue)) {
                    row.style.display = "rows";
                } else {
                    row.style.display = "none";
                }
            });
        });

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
