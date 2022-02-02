@extends('admin.layouts.app')
@section('title')
    The Crabbys Management System | Produk
@endsection

@section('addHeader')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
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
                            <h3 class="card-title">Tabel Data Produk</h3>
                            <button type="button" id="btn-show-tambah" class="btn btn-success float-right"><i
                                    class="fas fa-plus-circle"></i></button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="Tabel-Data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No.</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Produk Unggulan?</th>
                                        <th>In Stock?</th>
                                        <th style="width: 220px;">Action</th>
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
                            <h3 class="card-title">Tambah Data Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form-tambah" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" class="form-control form-control-border border-width-2" id="nama"
                                        name="nama" placeholder="Nama Produk" aria-describedby="nama_error"
                                        aria-invalid="true">
                                    <span id="nama_error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga Produk</label>
                                    <input type="text" class="form-control form-control-border border-width-2" id="harga"
                                        name="harga" placeholder="Harga Produk" aria-describedby="harga_error"
                                        aria-invalid="true">
                                    <span id="harga_error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori Produk</label>
                                    <select class="custom-select form-control-border border-width-2" id="kategori"
                                        name="kategori" aria-describedby="kategori_error" aria-invalid="true">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span id="kategori_error" class="error invalid-feedback"></span>
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
                                    <label for="nama_ubah">Nama Produk</label>
                                    <input type="text" class="form-control form-control-border border-width-2"
                                        id="nama_ubah" name="nama_ubah" placeholder="Nama Produk"
                                        aria-describedby="nama_ubah_error" aria-invalid="true">
                                    <span id="nama_ubah_error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="harga_ubah">Harga Produk</label>
                                    <input type="text" class="form-control form-control-border border-width-2"
                                        id="harga_ubah" name="harga_ubah" placeholder="Harga Produk"
                                        aria-describedby="harga_ubah_error" aria-invalid="true">
                                    <span id="harga_ubah_error" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="kategori_ubah">Kategori Produk</label>
                                    <select class="custom-select form-control-border border-width-2" id="kategori_ubah"
                                        name="kategori_ubah" aria-describedby="kategori_ubah_error" aria-invalid="true">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span id="kategori_ubah_error" class="error invalid-feedback"></span>
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
                <div class="col-md-12 d-none" id="editor-column">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title" id="keterangan_judul"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <textarea id="keterangan_editor"></textarea>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btn-close-editor" class="btn btn-default">Tutup</button>
                            <button type="button" class="btn btn-success float-right"
                                onclick="keterangan_submit()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-custom-image">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <div class="row" id="data-image">

                                </div>
                            </div>
                            <div id="loading-image" class="overlay d-none"><i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                    <form id="form-image" enctype="multipart/form-data">
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="produk_image">Unggah Gambar Produk</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" id="produk_image"
                                                name="produk_image" aria-describedby="produk_image_error"
                                                aria-invalid="true">
                                            <label class="custom-file-label" for="produk_image">Pilih File</label>
                                        </div>
                                    </div>
                                    <span id="produk_image_error" class="error invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i>
                                Unggah Sekarang</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('addFooter')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#keterangan_editor').summernote();

        bsCustomFileInput.init();

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        var table, id_ubah, id_keterangan, id_produk;
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
                    "url": "/admin/product/data",
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
        });

        $('#form-tambah').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "/admin/product",
                enctype: 'multipart/form-data',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    refreshTable();
                    $('#nama_error').html('');
                    $('#nama').removeClass('is-invalid');
                    $('#harga_error').html('');
                    $('#harga').removeClass('is-invalid');
                    $('#kategori_error').html('');
                    $('#kategori').removeClass('is-invalid');
                    $('#form-tambah')[0].reset();
                    Toast.fire({
                        icon: 'success',
                        title: response.success,
                    });
                },
                error: function(response) {
                    if (response.responseJSON.errors.nama) {
                        $('#nama').addClass('is-invalid');
                        $('#nama_error').html(response.responseJSON.errors.nama);
                    } else {
                        $('#nama_error').html('');
                        $('#nama').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.harga) {
                        $('#harga').addClass('is-invalid');
                        $('#harga_error').html(response.responseJSON.errors.harga);
                    } else {
                        $('#harga_error').html('');
                        $('#harga').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.kategori) {
                        $('#kategori').addClass('is-invalid');
                        $('#kategori_error').html(response.responseJSON.errors.kategori);
                    } else {
                        $('#kategori_error').html('');
                        $('#kategori').removeClass('is-invalid');
                    }
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Tidak Valid!',
                    });
                }
            });
        });

        function ubah_data(id, nama, harga, kategori_id) {
            $('#tabel-data-column').removeClass('col-lg-12').addClass('col-lg-8');
            $('#form-ubah-column').removeClass('d-none');
            $('#form-tambah-column').addClass('d-none');
            id_ubah = id;
            $('#nama_ubah').val(nama);
            $('#harga_ubah').val(harga);
            document.getElementById("kategori_ubah").value = kategori_id;
            $('#nama_ubah_error').html('');
            $('#harga_ubah_error').html('');
            $('#kategori_ubah_error').html('');
            Toast.fire({
                icon: 'success',
                title: 'Produk ' + nama + ' Dipilih!',
            });
        }

        $('#form-ubah').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            formData.append("id", id_ubah);
            $.ajax({
                url: "/admin/product/update",
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
                    $('#harga_ubah_error').html('');
                    $('#harga_ubah').removeClass('is-invalid');
                    $('#kategori_ubah_error').html('');
                    $('#kategori_ubah').removeClass('is-invalid');
                    id_ubah = 0;
                    $('#form-ubah')[0].reset();
                    Toast.fire({
                        icon: 'success',
                        title: response.success,
                    });
                },
                error: function(response) {
                    if (response.responseJSON.errors.nama_ubah) {
                        $('#nama_ubah').addClass('is-invalid');
                        $('#nama_ubah_error').html(response.responseJSON.errors.nama_ubah);
                    } else {
                        $('#nama_ubah_error').html('');
                        $('#nama_ubah').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.harga_ubah) {
                        $('#harga_ubah').addClass('is-invalid');
                        $('#harga_ubah_error').html(response.responseJSON.errors.harga_ubah);
                    } else {
                        $('#harga_ubah_error').html('');
                        $('#harga_ubah').removeClass('is-invalid');
                    }
                    if (response.responseJSON.errors.kategori_ubah) {
                        $('#kategori_ubah').addClass('is-invalid');
                        $('#kategori_ubah_error').html(response.responseJSON.errors.kategori_ubah);
                    } else {
                        $('#kategori_ubah_error').html('');
                        $('#kategori_ubah').removeClass('is-invalid');
                    }
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
                        url: "/admin/product",
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
                                title: 'Data Tidak Valid!',
                            });
                        }
                    });
                }
            })
        };

        function best_seller_ubah(id, seller) {
            $.ajax({
                type: "POST",
                url: "/admin/product/seller",
                dataType: "json",
                data: {
                    id: id,
                    seller: seller
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

        function in_stock_ubah(id, stock) {
            $.ajax({
                type: "POST",
                url: "/admin/product/stock",
                dataType: "json",
                data: {
                    id: id,
                    stock: stock
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

        $('#btn-close-editor').on('click', function() {
            id_keterangan = 0;
            $('#keterangan_judul').html('');
            $('#keterangan_editor').summernote('code', '');
            $('#tabel-data-column').removeClass('d-none');
            $('#tabel-data-column').removeClass('col-lg-8').addClass('col-lg-12');
            $('#editor-column').addClass('d-none');
            $('#form-tambah-column').addClass('d-none');
            $('#form-ubah-column').addClass('d-none');
        });

        function keterangan_editor(id, nama, keterangan) {
            id_keterangan = id;
            $('#keterangan_judul').html('Keterangan Untuk Produk ' + nama);
            $('#keterangan_editor').summernote('code', keterangan);
            $('#editor-column').removeClass('d-none');
            $('#editor-column').removeClass('d-none');
            $('#tabel-data-column').addClass('d-none');
            $('#form-tambah-column').addClass('d-none');
            $('#form-ubah-column').addClass('d-none');
        }

        function keterangan_submit() {
            var keterangan = $('#keterangan_editor').val();
            $.ajax({
                type: "POST",
                url: "/admin/product/keterangan",
                dataType: "json",
                data: {
                    id: id_keterangan,
                    keterangan: keterangan
                },
                success: function(response) {
                    refreshTable();
                    id_keterangan = 0;
                    $('#keterangan_judul').html('');
                    $('#keterangan_editor').summernote('code', '');
                    $('#tabel-data-column').removeClass('d-none');
                    $('#tabel-data-column').removeClass('col-lg-8').addClass('col-lg-12');
                    $('#editor-column').addClass('d-none');
                    $('#form-tambah-column').addClass('d-none');
                    $('#form-ubah-column').addClass('d-none');
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
        }

        function get_image_data(id) {
            $.ajax({
                type: "GET",
                url: "/admin/product/images",
                dataType: "json",
                data: {
                    id: id,
                },
                success: function(response) {
                    $('#loading-image').addClass('d-none');
                    $('#data-image').html(response.data);
                },
                error: function(response) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Tidak Valid!',
                    });
                }
            });
        }

        function custom_image(id, nama) {
            $('#modal-custom-image').modal('show');
            $('#loading-image').removeClass('d-none');
            $('#modal-title').html('Kostumisasi Gambar Produk ' + nama);
            id_produk = id;
            get_image_data(id);
        }

        $('#form-image').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            formData.append("id", id_produk);
            $.ajax({
                url: "/admin/product/images_upload",
                enctype: 'multipart/form-data',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#loading-image').removeClass('d-none');
                    get_image_data(id_produk);
                    $('#produk_image_error').html('');
                    $('#produk_image').removeClass('is-invalid');
                    $('#produk_image_error').removeClass('d-block');
                    $('#form-image')[0].reset();
                    Toast.fire({
                        icon: response.type,
                        title: response.message,
                    });
                },
                error: function(response) {
                    if (response.responseJSON.errors.produk_image) {
                        $('#produk_image').addClass('is-invalid');
                        $('#produk_image_error').html(response.responseJSON.errors.produk_image);
                        $('#produk_image_error').addClass('d-block');
                    } else {
                        $('#produk_image_error').html('');
                        $('#produk_image').removeClass('is-invalid');
                        $('#produk_image_error').removeClass('d-block');
                    }
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Tidak Valid!',
                    });
                }
            });
        });

        function delete_image(id) {
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
                        url: "/admin/product/images_delete",
                        dataType: "json",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('#loading-image').removeClass('d-none');
                            get_image_data(id_produk);
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Gambar Berhasil Dihapus!'
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
