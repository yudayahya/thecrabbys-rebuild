@extends('admin.layouts.app')
@section('title')
    The Crabbys Management System | Kelola Admin
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
                    <h1 class="m-0">Kelola Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Admin</li>
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
                            <h3 class="card-title">Tabel Data Admin</h3>
                            <button type="button" id="btn-show-tambah" class="btn btn-success float-right"><i
                                    class="fas fa-plus-circle"></i></button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="Tabel-Data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No.</th>
                                        <th>Nama Admin</th>
                                        <th>Username Admin</th>
                                        <th>Email Admin</th>
                                        <th style="width: 200px;">Action</th>
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
                            <h3 class="card-title">Tambah Data Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form-tambah" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap"
                                        aria-describedby="nama-error" aria-invalid="true">
                                    <span id="nama-error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                        placeholder="Username" aria-describedby="username-error" aria-invalid="true">
                                    <span id="username-error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email"
                                        aria-describedby="email-error" aria-invalid="true">
                                    <span id="email-error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password" aria-describedby="password-error" aria-invalid="true">
                                    <span id="password-error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Ulangi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="password_confirmation" placeholder="Ulangi Password"
                                        aria-describedby="password_confirmation-error" aria-invalid="true">
                                    <span id="password_confirmation-error" class="error invalid-feedback"></span>
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
                            <h3 class="card-title">Ubah Password Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form-ubah" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label id="nama-admin"></label>
                                </div>
                                <div class="form-group">
                                    <label for="cek_password">Password Kamu</label>
                                    <input type="password" name="cek_password" class="form-control" id="cek_password"
                                        placeholder="Password Kamu" aria-describedby="cek_password_error"
                                        aria-invalid="true">
                                    <span id="cek_password_error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword">Password Baru Admin</label>
                                    <input type="password" name="newpassword" class="form-control" id="newpassword"
                                        placeholder="Password Baru Admin" aria-describedby="newpassword_error"
                                        aria-invalid="true">
                                    <span id="newpassword_error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword_confirmation">Ulangi Password Baru Admin</label>
                                    <input type="password" name="newpassword_confirmation" class="form-control"
                                        id="newpassword_confirmation" placeholder="Ulangi Password Baru Admin"
                                        aria-describedby="newpassword_confirmation" aria-invalid="true">
                                    <span id="newpassword_confirmation_error" class="error invalid-feedback"></span>
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
                    "url": "/admin/manage-admin/data",
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
            $('#nama-admin').val('');
        });

        $('#form-tambah').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "/admin/manage-admin",
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
                    $('#username-error').html('');
                    $('#username').removeClass('is-invalid');
                    $('#email-error').html('');
                    $('#email').removeClass('is-invalid');
                    $('#password-error').html('');
                    $('#password').removeClass('is-invalid');
                    $('#form-tambah')[0].reset();
                    Toast.fire({
                        icon: 'success',
                        title: response.success,
                    });
                },
                error: function(response) {
                    if (response.responseJSON.errors.nama) {
                        $('#nama').addClass('is-invalid');
                        $('#nama-error').html(response.responseJSON.errors.nama);
                    } else {
                        $('#nama-error').html('');
                        $('#nama').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.username) {
                        $('#username').addClass('is-invalid');
                        $('#username-error').html(response.responseJSON.errors.username);
                    } else {
                        $('#username-error').html('');
                        $('#username').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.email) {
                        $('#email').addClass('is-invalid');
                        $('#email-error').html(response.responseJSON.errors.email);
                    } else {
                        $('#email-error').html('');
                        $('#email').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.password) {
                        $('#password').addClass('is-invalid');
                        $('#password-error').html(response.responseJSON.errors.password);
                    } else {
                        $('#password-error').html('');
                        $('#password').removeClass('is-invalid');
                    }
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Tidak Valid!',
                    });
                }
            });
        });

        function ubah_data(id, nama) {
            $('#tabel-data-column').removeClass('col-lg-12').addClass('col-lg-8');
            $('#form-ubah-column').removeClass('d-none');
            $('#form-tambah-column').addClass('d-none');
            id_ubah = id;
            $('#nama-admin').html('Nama Admin : ' + nama);
            $('#password_error').html('');
            $('#newpassword_error').html('');
            $('#newpassword_confirmation_error').html('');
            Toast.fire({
                icon: 'success',
                title: 'Admin ' + nama + ' Dipilih!',
            });
        }

        $('#form-ubah').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            formData.append("id", id_ubah);
            $.ajax({
                url: "/admin/manage-admin/update",
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
                    $('#cek_password_error').html('');
                    $('#cek_password').removeClass('is-invalid');
                    $('#newpassword_error').html('');
                    $('#newpassword').removeClass('is-invalid');
                    $('#newpassword_confirmation_error').html('');
                    $('#newpassword_confirmation').removeClass('is-invalid');
                    id_ubah = 0;
                    $('#form-ubah')[0].reset();
                    Toast.fire({
                        icon: 'success',
                        title: response.success,
                    });
                },
                error: function(response) {
                    if (response.responseJSON.errors.cek_password) {
                        $('#cek_password').addClass('is-invalid');
                        $('#cek_password_error').html(response.responseJSON.errors.cek_password);
                    } else {
                        $('#cek_password_error').html('');
                        $('#cek_password').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.newpassword) {
                        $('#newpassword').addClass('is-invalid');
                        $('#newpassword_error').html(response.responseJSON.errors.newpassword);
                    } else {
                        $('#newpassword_error').html('');
                        $('#newpassword').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.newpassword_confirmation) {
                        $('#newpassword_confirmation').addClass('is-invalid');
                        $('#newpassword_confirmation_error').html(response.responseJSON.errors
                            .newpassword_confirmation);
                    } else {
                        $('#newpassword_confirmation_error').html('');
                        $('#newpassword_confirmation').removeClass('is-invalid');
                    }
                    Toas
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
                        url: "/admin/manage-admin",
                        dataType: "json",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            refreshTable();
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Admin Telah Dihapus!'
                            });
                        },
                        error: function(response) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Data Tidak Valid!',
                            });
                        }
                    });
                }
            })
        };
    </script>
@endsection
