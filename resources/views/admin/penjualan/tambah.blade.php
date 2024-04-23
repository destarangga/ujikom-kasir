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
                    <form action="{{ route('penjualan-store') }}" method="post" enctype="multipart/form-data" >
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
                                                <option value="{{ $produk->produk_id }}" data-harga="{{ $produk->harga }}">{{ $produk->nama_produk }}</option>
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

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_harga">Total Harga</label>
                                                <input type="number" name="total_harga" id="total_harga" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bayar">Bayar</label>
                                                <input type="number" name="bayar" id="bayar" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="kembalian">Kembalian</label>
                                                <input type="number" name="kembalian" id="kembalian" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
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
    // Function to calculate total price
        function calculateTotalPrice() {
        var totalHarga = 0;
        document.querySelectorAll('#saleForm').forEach(function(saleForm) {
            var hargaProduk = saleForm.querySelector('.form-control[name="produk_id[]"]').value;
            var selectedOption = saleForm.querySelector('.form-control[name="produk_id[]"] option:checked');
            var hargaProduk = selectedOption.getAttribute('data-harga');
            var jumlahProduk = saleForm.querySelector('.form-control[name="jumlah_produk[]"]').value;
            var subtotal = hargaProduk * jumlahProduk;
            totalHarga += subtotal;
            console.log(jumlahProduk);
            console.log(totalHarga.toFixed(2));
        });
        sessionStorage.setItem('totalHarga', totalHarga.toFixed(2));
        document.getElementById('total_harga').value = totalHarga.toFixed(2);
    }

    document.getElementById('addSaleItem').addEventListener('click', function() {
        var saleForm = document.getElementById('saleForm');
        var newSaleItem = saleForm.cloneNode(true);
        saleForm.parentNode.insertBefore(newSaleItem, this);
        newSaleItem.querySelector('.form-control[name="produk_id[]"]').selectedIndex = 0;
        newSaleItem.querySelector('.form-control[name="jumlah_produk[]"]').value = '';
        calculateTotalPrice()
    });

    document.getElementById('minSaleItem').addEventListener('click', function() {
        var saleForms = document.querySelectorAll('.card-body');
        if (saleForms.length > 1) {
            saleForms[saleForms.length - 1].remove();
        }
        calculateTotalPrice()
    });

    function updateTotalPrice() {
        setTimeout(calculateTotalPrice, 100); // Menunda pemanggilan calculateTotalPrice() sejenak
    }

    // Event listener untuk input pada setiap card-body
    document.querySelectorAll('.card-body .form-control').forEach(function(input) {
        input.addEventListener('input', updateTotalPrice);
    });


    // Calculate change when entering the amount paid
    document.getElementById('bayar').addEventListener('input', function() {
        var totalHarga = parseFloat(document.getElementById('total_harga').value);
        var bayar = parseFloat(document.getElementById('bayar').value);
        var kembalian = bayar - totalHarga;
        document.getElementById('kembalian').value = kembalian;
    });
</script>
@endsection
