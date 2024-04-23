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

        /* .button-container .btn {
                                        margin-bottom: 25px;
                                    } */
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
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
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('produk-create') }}">
                                    <button class="btn btn-sm btn-primary" style="float: right">Tambah</button>
                                </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table" id="produkTable">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center">No</th>
                                        <th style="width: 10px" class="text-center">Produk</th>
                                        <th style="width: 10px" class="text-center">Harga</th>
                                        <th style="width: 10px" class="text-center">Stok</th>
                                        <th style="width: 10px" class="text-center">Deskripsi</th>
                                        <th style="width: 10px" class="text-center">Foto</th>
                                        <th style="width: 30px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($produks as $produk)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center" id="td:nth-child(2)">{{ $produk->nama_produk }}
                                                <input type="hidden" name="nama_produk" value="hiddenValue">
                                            </td>
                                            <td class="text-center" id="td:nth-child(3)">Rp.{{ number_format($produk->harga, 0, ',', '.') }}
                                                <input type="hidden" name="harga" value="hiddenValue">
                                            </td>
                                            <td class="text-center" id="td:nth-child(4)">{{ $produk->stok }}
                                                <input type="hidden" name="stok" value="hiddenValue">
                                            </td>
                                            <td class="text-center" id="td:nth-child(5)">{{ $produk->deskripsi }}
                                                <input type="hidden" name="deskripsi" value="hiddenValue">
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ url('image/produk/', $produk->image) }}" alt="Product Image" style="max-width: 100px;">
                                            </td>      
                                                  
                                            <td class="d-flex justify-content-center">
                                                @if (Auth::user()->role == 'admin')
                                                    <div class="button-container">
                                                        <a href="{{ route('produk-show', ['id' => $produk->produk_id]) }}">
                                                            <button type="button" class="mr-1 btn btn-sm btn-secondary">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                            <span class="tooltip">Lihat</span>
                                                        </a>
                                                    </div>
                                                    <!-- <div class="button-container">
                                                        <a href="#modalrestok" data-toggle="modal">
                                                            <button type="button" class="mr-1 btn btn-sm btn-primary">
                                                                <i class="bi bi-arrow-repeat"></i>
                                                            </button>
                                                            <span class="tooltip">Restok</span>
                                                        </a>
                                                    </div> -->
                                                    <div class="button-container">
                                                        <a href="{{ route('produk-edit', ['id' => $produk->produk_id]) }}">
                                                            <button type="button" class="mr-1 btn btn-sm btn-success">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>
                                                            <span class="tooltip">Edit</span>
                                                        </a>
                                                    </div>
                                                    <div class="button-container">
                                                        <form id="deleteForm{{ $produk->produk_id }}"
                                                            action="{{ route('produk-delete', ['id' => $produk->produk_id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button"
                                                                onclick="confirmDelete('{{ $produk->produk_id }}')"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                            <span class="tooltip">Hapus</span>
                                                        </form>
                                                    </div>
                                                @else
                                                <div class="button-container">
                                                    <a
                                                        href="{{ route('produk-petugas-show', ['id' => $produk->produk_id]) }}">
                                                        <button type="button" class="mr-1 btn btn-sm btn-secondary">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <span class="tooltip">Lihat</span>
                                                    </a>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>

                                        {{-- modal-edit --}}
                                        <div class="modal fade" id="modalrestok" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('produk-restok', ['id' => $produk->produk_id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{-- <input type="text" name="produk_id" id="produk_id"
                                                                value="{{ $produk->produk_id }}"> --}}
                                                            <div class="mb-3">
                                                                <label for="stok" class="form-label">Stok</label>
                                                                <input type="text" class="form-control" name="stok"
                                                                    id="stok" value="{{ $produk->stok }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card -->
                    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('costumJs')
    <script>
        document.getElementById("searchInput").addEventListener("input", function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll("#produkTable tbody tr");
            
            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                if (text.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: "Serius ingin menghapus?",
                text: "Data yang telah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        "Berhasil",
                        "Produk berhasil dihapus",
                        "success"
                    );
                    document.getElementById('deleteForm' + id).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        "Cancelled",
                        "",
                        "error"
                    );
                }
            });
        }
    </script>
@endsection
