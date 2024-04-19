@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gambar Produk</label>
                                <input type="file" name="img-produk" class="form-control" id="" value=""
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Produk</label>
                                <input type="text" name="nama_produk" class="form-control" id=""
                                    value="{{ $produk->nama_produk }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga</label>
                                <input type="number" name="harga" class="form-control" id=""
                                    value="{{ $produk->harga }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stok</label>
                                <input type="number" name="stok" class="form-control" id=""
                                    value="{{ $produk->stok }}" disabled>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('produk-admin') }}">
                                    <button type="button" class="btn btn-secondary" style="float: right">Kembali</button>
                                </a>
                            @else
                                <a href="{{ route('produk-petugas') }}">
                                    <button type="button" class="btn btn-secondary" style="float: right">Kembali</button>
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
