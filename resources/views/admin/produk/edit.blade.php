@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Produk</li>
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
                            <h3 class="card-title">Form Edit Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('produk-update', ['id' => $produk->produk_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gambar Produk</label>
                                    <input type="file" name="image" class="form-control" id="" value="
                                    {{ asset('image/produk/' . $produk->image) }}">
                                    @if ($produk->image)
                                    <img src="{{ asset('image/produk/' . $produk->image) }}" alt="Product Image" style="max-width: 200px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Produk</label>
                                    <input type="text" name="nama_produk" class="form-control" id=""
                                        value="{{ $produk->nama_produk }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input type="number" name="harga" class="form-control" id=""
                                        value="{{ $produk->harga }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok</label>
                                    <input type="number" name="stok" class="form-control" id=""
                                        value="{{ $produk->stok }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Deskripsi</label>
                                    <textarea rows="5" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi Produk">{{ $produk->deskripsi }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('produk-admin') }}">
                                        <button type="button" class="btn btn-secondary"
                                            style="float: left">Kembali</button>
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
                                @else
                                    <a href="{{ route('produk-petugas') }}">
                                        <button type="button" class="btn btn-secondary"
                                            style="float: right">Kembali</button>
                                    </a>
                                @endif
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
