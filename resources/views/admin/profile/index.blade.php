@extends('admin.layouts.app')
@section('title')
    The Crabbys Management System | My Profile
@endsection

@section('addHeader')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('assets/admin/image_admin/' . auth()->user()->image) }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                            <p class="text-muted text-center">{{ auth()->user()->level }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ auth()->user()->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right">{{ auth()->user()->username }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Created at</b> <a class="float-right">{{ auth()->user()->created_at }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Last Update</b> <a class="float-right">{{ auth()->user()->updated_at }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('addFooter')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form-ubah').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
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
    </script>
@endsection
