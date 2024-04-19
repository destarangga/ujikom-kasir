@extends('admin.layouts.app')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach ($penjualans as $penjualan)
                                <div class="penjualan">
                                    @if ($penjualan->produk)
                                        <p><strong>Nama Produk:</strong> {{ $penjualan->produk->nama_produk }}</p>
                                    @else
                                        <p><strong>Nama Produk:</strong> Not available</p>
                                    @endif
                                    <p><strong>Jumlah Produk:</strong> {{ $penjualan->jumlah_produk }}</p>
                                    <p><strong>Subtotal:</strong> Rp.{{ number_format($penjualan->subtotal, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- JavaScript -->

