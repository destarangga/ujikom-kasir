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
                    <h1>Tambah Data </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Kegiatan Harian</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- modal-tambah --}}
    <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('user-store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control form-select" name="role" required>
                                <option value="" selected disabled>Pilih</option>
                                <option value="admin">admin</option>
                                <option value="petugas">petugas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal-show --}}
    <div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" value="" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- modal-edit --}}
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('user-update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="id" id="id" value="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="nameedit" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="emailedit" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="roleedit" class="form-control form-select" name="role" required>
                                <option value="" selected disabled>Pilih</option>
                                <option value="admin">admin</option>
                                <option value="petugas">petugas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Bordered Table</h3> --}}
                            <button class="btn btn-sm btn-primary btn-tambah" style="float: right" data-toggle="modal"
                                data-target="#modaltambah">Tambah</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center">No</th>
                                        <th style="width: 30px" class="text-center">Nama</th>
                                        <th style="width: 30px" class="text-center">Email</th>
                                        <th style="width: 30px" class="text-center">Role</th>
                                        <th style="width: 10px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">{{ $user->role }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="button-container">
                                                    <button type="button"
                                                        class="mr-1 btn btn-sm btn-secondary btn-detail"
                                                        data-url="{{ route('getUser', ['id' => $user->id]) }}"
                                                        data-toggle="modal" data-target="#modaldetail">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <span class="tooltip">Lihat</span>
                                                </div>
                                                <div class="button-container">
                                                    <button type="button" class="mr-1 btn btn-sm btn-success btn-edit"
                                                        data-url="{{ route('getUser', ['id' => $user->id]) }}"
                                                        data-toggle="modal" data-target="#modaledit ">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <span class="tooltip">Edit</span>
                                                </div>
                                                <div class="button-container">
                                                    <form id="deleteForm{{ $user->id }}"
                                                        action="{{ route('user-delete', ['id' => $user->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button"
                                                            onclick="confirmDelete('{{ $user->id }}')"
                                                            class="ms-3 btn btn-sm btn-danger"><i
                                                                class="bi bi-trash3"></i></button>
                                                    </form>
                                                    <span class="tooltip">Hapus</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{-- <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $kegiatanH->previousPageUrl() }}" aria-label="Previous">
                                        &laquo;
                                    </a>
                                </li>
                                @foreach ($kegiatanH->getUrlRange(1, $kegiatanH->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $kegiatanH->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item">
                                    <a class="page-link" href="{{ $kegiatanH->nextPageUrl() }}" aria-label="Next">
                                        &raquo;
                                    </a>
                                </li>
                            </ul>
                    </div> --}}
                        <!-- /.card -->
                    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('cotumJs')
    <script>
        $('.btn-edit').click(function() {
            var url = $(this).data('url');
            $('#modaledit #id').val('')
            $('#modaledit #nameedit').val('')
            $('#modaledit #emailedit').val('')
            $('#modaledit #roleedit').val('')
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(res) {
                    $('#modaledit #id').val(res['id'])
                    $('#modaledit #nameedit').val(res['name'])
                    $('#modaledit #emailedit').val(res['email'])
                    $('#modaledit #roleedit').val(res['role'])
                }
            });
        });

        $('.btn-detail').click(function() {
            var url = $(this).data('url');
            $('#modaldetail #id').val('')
            $('#modaldetail #name').val('')
            $('#modaldetail #email').val('')
            $('#modaldetail #role').val('')
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(res) {
                    $('#modaldetail #id').val(res['id'])
                    $('#modaldetail #name').val(res['name'])
                    $('#modaldetail #email').val(res['email'])
                    $('#modaldetail #role').val(res['role'])
                }
            });
        });


        function confirmDelete(id) {
            Swal.fire({
                title: "Serius ingin menghapus ?",
                text: "Data yang telah dihapus tidak bisa dikembalikan !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        "Berhasil",
                        "User berhasil di hapus",
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
