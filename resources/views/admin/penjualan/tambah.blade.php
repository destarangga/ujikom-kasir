@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <form action="{{ route('penjualan-store') }}" method="post">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Penjualan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal</label>
                                            <input type="date" name="tanggal_penjualan" class="form-control"
                                                id="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pelanggan</label>
                                            <input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan"
                                                placeholder="Masukan Nama">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Alamat</label>
                                    <textarea rows="5" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Telpon</label>
                                    <input type="number" name="no_tlp" class="form-control" id="no_tlp"
                                        placeholder="Masukan No Telpon">
                                </div>
                            </div>
                            <!-- /.card-body -->


                            <div class="card-header">
                                <h3 class="card-title">Produk</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body" id="saleForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="produk">Produk</label>
                                            <select class="form-control" name="produk_id[]" required>
                                                <option value="" selected disabled>Pilih Produk</option>
                                                @foreach ($products as $produk)
                                                    <option value="{{ $produk->produk_id }}">{{ $produk->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Jumlah Beli</label>
                                            <input type="number" class="form-control" name="jumlah_produk[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" id="addSaleItem"><i
                                    class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger mt-2" id="minSaleItem"><i
                                    class="fas fa-minus"></i></button>


                            <div class="card-footer">
                                <a href="{{ route('penjualan') }}">
                                    <button type="button" class="btn btn-danger" style="float: left">Kembali</button>
                                </a>
                                <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('costumJs')
    <script>
        document.getElementById('addSaleItem').addEventListener('click', function() {
            var saleForm = document.getElementById('saleForm');
            var newSaleItem = saleForm.cloneNode(true);
            saleForm.parentNode.insertBefore(newSaleItem, this);
        });

        document.getElementById('minSaleItem').addEventListener('click', function() {
            var saleForms = document.querySelectorAll('.card-body');
            if (saleForms.length > 1) {
                saleForms[saleForms.length - 1].remove();
            }
        });
    </script>
@endsection
