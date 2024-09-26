<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" rel="icon">
    <link href="{{ asset('assets/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Flatpickr Date Time Picker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        #loader {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            text-align: center;
            padding-top: 20%;
        }

        .swal2-button-space .swal2-confirm {
            margin-left: 10px;
            /* Tambahkan jarak antara tombol cancel dan confirm */
        }

        .swal2-button-space .swal2-cancel {
            margin-right: 10px;
            /* Tambahkan jarak antara confirm dan cancel */
        }
    </style>
</head>

<body id="page-top">
    <div id="loader">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p>Loading...</p>
    </div>

    <!-- Content -->
    @yield('content')

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        @method('POST')
                        <button class="btn btn-primary" type="submit">Keluar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.loadPage').click(function(e) {
                e.preventDefault();
                $('#loader').show();

                setTimeout(() => {
                    window.location.href = $(this).attr('href');
                }, 1000);
            });
        });

        // tambah
        document.querySelectorAll(".btn-tambah").forEach((button) => {
            button.addEventListener("click", function() {
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-danger",
                        confirmButton: "btn btn-primary",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin menambahkan data ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil ditambahkan",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Data tidak ditambahkan!",
                                icon: "error",
                            });
                        }
                    });
            });
        });

        // ubah
        document.querySelectorAll(".btn-ubah").forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-danger",
                        confirmButton: "btn btn-primary",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin mengubah data ini?",
                        text: `ID: ${id} - Nama: ${nama}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil diubah",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Data tidak diubah!",
                                icon: "error",
                            });
                        }
                    });
            });
        });

        // hapus
        document.querySelectorAll(".btn-hapus").forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-primary",
                        confirmButton: "btn btn-danger",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin menghapus data ini?",
                        text: `ID: ${id} - Nama: ${nama}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil dihapus!",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Data tidak dihapus",
                                icon: "error",
                            });
                        }
                    });
            });
        });

        /*
         * tombol soal
         */

        // tambah soal
        document.querySelectorAll(".btn-tambah-soal").forEach((button) => {
            button.addEventListener("click", function() {
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-danger",
                        confirmButton: "btn btn-primary",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin menambahkan soal ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Soal berhasil ditambahkan",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Soal tidak ditambahkan!",
                                icon: "error",
                            });
                        }
                    });
            });
        });

        // import soal
        document.querySelectorAll(".btn-import-soal").forEach((button) => {
            button.addEventListener("click", function() {
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-danger",
                        confirmButton: "btn btn-primary",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin mengimpor soal ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Soal berhasil diimpor",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Soal tidak diimpor!",
                                icon: "error",
                            });
                        }
                    });
            });
        });

        // ubah soal
        document.querySelectorAll(".btn-ubah-soal").forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-danger",
                        confirmButton: "btn btn-primary",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin mengubah soal ini?",
                        text: `ID: ${id} - Soal: ${nama}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Soal berhasil diubah!",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Soal tidak diubah!",
                                icon: "error",
                            });
                        }
                    });
            });
        });


        // hapus soal
        document.querySelectorAll(".btn-hapus-soal").forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-primary",
                        confirmButton: "btn btn-danger",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin menghapus soal ini?",
                        text: `ID: ${id} - Soal: ${nama}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Soal berhasil dihapus!",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Soal tidak dihapus!",
                                icon: "error",
                            });
                        }
                    });
            });
        });
    </script>

</html>
