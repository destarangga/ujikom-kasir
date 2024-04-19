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
                        <form action="{{ route('produk-store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gambar Produk</label>
                                    <input type="file" name="img-produk" class="form-control" id=""
                                        placeholder="Input hanya nomber">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Produk</label>
                                    <input type="text" name="nama_produk" class="form-control" id=""
                                        placeholder="Input hanya nomber">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input type="number" name="harga" class="form-control" id=""
                                        placeholder="Input hanya nomber">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok</label>
                                    <input type="number" name="stok" class="form-control" id=""
                                        placeholder="Input hanya nomber">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{ route('produk-admin') }}">
                                    <button type="button" class="btn btn-danger" style="float: left">Kembali</button>
                                </a>
                                <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
