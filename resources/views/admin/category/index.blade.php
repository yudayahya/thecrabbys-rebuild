@extends('admin.layouts.app')
@section('title')
    The Crabbys Management System | Kategori
@endsection

@section('addHeader')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kategori</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div id="tabel-data-column" class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Kategori</h3>
                            <button type="button" id="btn-show-tambah" class="btn btn-success float-right"><i
                                    class="fas fa-plus-circle"></i></button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="Tabel-Data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No.</th>
                                        <th>Nama Kategori</th>
                                        <th>Butuh Varian Saos?</th>
                                        <th style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div id="form-tambah-column" class="col-lg-4 d-none">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data Kategori</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form-tambah" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Kategori</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Nama Kategori" aria-describedby="nama-error" aria-invalid="true">
                                    <span id="nama-error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="varian" id="varian" class="custom-control-input"
                                            aria-describedby="varian-error">
                                        <label class="custom-control-label" for="varian">Butuh Varian Saos?</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" id="btn-close-tambah" class="btn btn-default">Tutup</button>
                                <button type="submit" class="btn btn-success float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="form-ubah-column" class="col-lg-4 d-none">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Data Kategori</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form-ubah" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_ubah">Nama Kategori</label>
                                    <input type="text" name="nama_ubah" class="form-control" id="nama_ubah"
                                        placeholder="Nama Kategori" aria-describedby="nama_ubah_error" aria-invalid="true">
                                    <span id="nama_ubah_error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="varian_ubah" id="varian_ubah"
                                            class="custom-control-input" aria-describedby="varian_ubah_error">
                                        <label class="custom-control-label" for="varian_ubah">Butuh Varian Saos?</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" id="btn-close-ubah" class="btn btn-default">Tutup</button>
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('addFooter')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table, id_ubah;
        $(function() {
            table = $('#Tabel-Data').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": {
                    "url": "/admin/category/data",
                    "type": "GET"
                },
            });
        });

        function refreshTable() {
            table.ajax.reload(null, false);
        }

        $('#btn-show-tambah').on('click', function() {
            $('#tabel-data-column').removeClass('col-lg-12').addClass('col-lg-8');
            $('#form-tambah-column').removeClass('d-none');
            $('#form-ubah-column').addClass('d-none');
        });

        $('#btn-close-tambah').on('click', function() {
            $('#tabel-data-column').removeClass('col-lg-8').addClass('col-lg-12');
            $('#form-tambah-column').addClass('d-none');
        });

        $('#btn-close-ubah').on('click', function() {
            $('#tabel-data-column').removeClass('col-lg-8').addClass('col-lg-12');
            $('#form-ubah-column').addClass('d-none');
            id_ubah = 0;
            $('#nama_ubah').val('');
            document.getElementById("varian_ubah").checked = false;
        });

        $('#form-tambah').on('submit', function(event) {
            event.preventDefault();
            var varian;
            if (document.getElementById("varian").checked) {
                varian = 1;
            } else {
                varian = 0;
            }
            var formData = new FormData(this);
            formData.append("varian", varian);
            $.ajax({
                url: "/admin/category",
                enctype: 'multipart/form-data',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    refreshTable();
                    $('#nama-error').html('');
                    $('#nama').removeClass('is-invalid');
                    $('#form-tambah')[0].reset();
                    Toast.fire({
                        icon: 'success',
                        title: response.success,
                    });
                },
                error: function(response) {
                    $('#nama-error').html(response.responseJSON.errors.nama);
                    $('#nama').addClass('is-invalid');
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Tidak Valid!',
                    });
                }
            });
        });

        function ubah_data(id, nama, varian) {
            $('#tabel-data-column').removeClass('col-lg-12').addClass('col-lg-8');
            $('#form-ubah-column').removeClass('d-none');
            $('#form-tambah-column').addClass('d-none');
            id_ubah = id;
            $('#nama_ubah').val(nama);
            if (varian == 1) {
                document.getElementById("varian_ubah").checked = true;
            } else {
                document.getElementById("varian_ubah").checked = false;
            }
            $('#nama_ubah_error').html('');
            Toast.fire({
                icon: 'success',
                title: 'Kategori ' + nama + ' Dipilih!',
            });
        }

        $('#form-ubah').on('submit', function(event) {
            event.preventDefault();
            var varian;
            if (document.getElementById("varian_ubah").checked) {
                varian = 1;
            } else {
                varian = 0;
            }
            var formData = new FormData(this);
            formData.append("id", id_ubah);
            formData.append("varian_ubah", varian);
            $.ajax({
                url: "/admin/category/update",
                enctype: 'multipart/form-data',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    refreshTable();
                    $('#tabel-data-column').removeClass('col-lg-8').addClass('col-lg-12');
                    $('#form-ubah-column').addClass('d-none');
                    $('#nama_ubah_error').html('');
                    $('#nama_ubah').removeClass('is-invalid');
                    id_ubah = 0;
                    document.getElementById("varian_ubah").checked = false;
                    $('#form-ubah')[0].reset();
                    Toast.fire({
                        icon: 'success',
                        title: response.success,
                    });
                },
                error: function(response) {
                    $('#nama_ubah_error').html(response.responseJSON.errors.nama_ubah);
                    $('#nama_ubah').addClass('is-invalid');
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Tidak Valid!',
                    });
                }
            });
        });

        function hapus_data(id) {
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Data Tidak Akan Bisa Dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya. Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "/admin/category",
                        dataType: "json",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            refreshTable();
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Kategori Telah Dihapus!'
                            });
                        },
                        error: function(response) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Data Tidak Valid! Sepertinya Kategori Masih Digunakan Oleh Suatu Produk',
                            });
                        }
                    });
                }
            })
        };

        function varian_ubah(id, varian) {
            $.ajax({
                type: "POST",
                url: "/admin/category/varian",
                dataType: "json",
                data: {
                    id: id,
                    varian: varian
                },
                success: function(response) {
                    refreshTable();
                    Toast.fire({
                        icon: 'info',
                        title: response.success,
                    });
                },
                error: function(response) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Tidak Valid!',
                    });
                }
            });
        };
    </script>
@endsection
