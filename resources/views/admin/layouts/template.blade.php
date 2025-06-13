<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GRADULANE</title>

    <!-- Custom Fonts -->
    {{-- <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"> --}}
    <!-- Font Awesome CDN --><!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"
        referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Core Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Custom Styles (Your template styles) -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('admin.layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('failed'))
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: '{{ session('failed') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan hilang!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa fa-check"></i> Ya!',
                    cancelButtonText: '<i class="fa fa-times"></i> Tidak',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });

        document.querySelectorAll('.btn-mulaireview').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Review usulan judul oleh mahasiswa akan dimulai, sehingga mahasiswa tidak bisa melakukan perubahan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa fa-check"></i> Ya!',
                    cancelButtonText: '<i class="fa fa-times"></i> Tidak',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load prodi ketika form edit terbuka
            let selectedJurusan = $('#jurusan').val();
            let selectedProdi = $('#jurusan').data('selected-prodi'); // Ambil dari data attribute

            if (selectedJurusan) {
                loadProdi(selectedJurusan, selectedProdi);
            }

            // Mengisi dropdown prodi ketika jurusan berubah
            $('#jurusan').on('change', function() {
                let jurusan_id = $(this).val();
                loadProdi(jurusan_id);
            });

            function loadProdi(jurusan_id, selectedProdi = null) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getprodi') }}",
                    data: {
                        jurusan_id: jurusan_id
                    },
                    cache: false,
                    success: function(msg) {
                        $('#prodi').html(msg);
                        if (selectedProdi) {
                            $('#prodi').val(selectedProdi);
                        }
                    },
                    error: function(data) {
                        console.error('Error:', data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to load Prodi options. Please try again later.',
                        });
                    }
                });
            }
        });

        // $(document).ready(function() {
        //     $('#pembimbing1').select2({
        //         theme: 'bootstrap-5',
        //         placeholder: "-- Pilih Dosen Pembimbing 1 --",
        //         allowClear: true,
        //         dropdownAutoWidth: true, // Menyesuaikan lebar dropdown dengan kontainer
        //         width: '100%',
        //         dropdownPosition: 'below', // Posisi dropdown di bawah input
        //         templateResult: formatOption,
        //         templateSelection: formatSelectedOption
        //     }).on('select2:open', function() {
        //         var dropdown = $(this).data('select2').dropdown;
        //         dropdown.$dropdown.css('width', '100%'); // Mengatur lebar dropdown 100%
        //     });

        //     function formatOption(option) {
        //         if (!option.id) {
        //             return option.text;
        //         }

        //         var bidangArray = $(option.element).data('bidang') || [];
        //         var $option = $('<div class="option-item">' + option.text + '</div>');

        //         if (bidangArray.length > 0) {
        //             var $badgeContainer = $('<div class="badge-container"></div>');
        //             bidangArray.forEach(function(bidang) {
        //                 $badgeContainer.append('<span class="badge bg-primary me-1">' + bidang + '</span>');
        //             });
        //             $option.append($badgeContainer);
        //         }

        //         return $option;
        //     }

        //     function formatSelectedOption(option) {
        //         return option.text;
        //     }
        // });

        // $(document).ready(function() {
        //     $('#pembimbing2').select2({
        //         theme: 'bootstrap-5',
        //         placeholder: "-- Pilih Dosen Pembimbing 2 --",
        //         allowClear: true,
        //         dropdownAutoWidth: true, // Menyesuaikan lebar dropdown dengan kontainer
        //         width: '100%',
        //         dropdownPosition: 'below', // Posisi dropdown di bawah input
        //         templateResult: formatOption,
        //         templateSelection: formatSelectedOption
        //     }).on('select2:open', function() {
        //         var dropdown = $(this).data('select2').dropdown;
        //         dropdown.$dropdown.css('width', '100%'); // Mengatur lebar dropdown 100%
        //     });

        //     function formatOption(option) {
        //         if (!option.id) {
        //             return option.text;
        //         }

        //         var bidangArray = $(option.element).data('bidang') || [];
        //         var $option = $('<div class="option-item">' + option.text + '</div>');

        //         if (bidangArray.length > 0) {
        //             var $badgeContainer = $('<div class="badge-container"></div>');
        //             bidangArray.forEach(function(bidang) {
        //                 $badgeContainer.append('<span class="badge bg-primary me-1">' + bidang + '</span>');
        //             });
        //             $option.append($badgeContainer);
        //         }

        //         return $option;
        //     }

        //     function formatSelectedOption(option) {
        //         return option.text;
        //     }
        // });

        $(document).ready(function() {
            // Inisialisasi Select2 pada pembimbing1 dan pembimbing2
            $('#pembimbing1, #pembimbing2').select2({
                theme: 'bootstrap-5',
                placeholder: "-- Pilih Dosen Pembimbing --",
                allowClear: true,
                dropdownAutoWidth: true,
                width: '100%',
                dropdownPosition: 'below',
                templateResult: formatOption,
                templateSelection: formatSelectedOption
            });

            // Event listener untuk perubahan Pembimbing 1
            $('#pembimbing1').on('change', function() {
                var selectedPembimbing1 = $(this).val(); // Dosen yang dipilih untuk Pembimbing 1

                // Update dropdown Pembimbing 2 untuk menghindari pilihan yang sama dengan Pembimbing 1
                var pembimbing2 = $('#pembimbing2');
                pembimbing2.find('option').each(function() {
                    var option = $(this);
                    if (option.val() == selectedPembimbing1) {
                        option.prop('disabled',
                            true); // Nonaktifkan dosen yang sama dengan Pembimbing 1
                    } else {
                        option.prop('disabled', false); // Aktifkan kembali dosen yang lain
                    }
                });

                // Reset Pembimbing 2 jika sudah dipilih dosen yang sama
                if (selectedPembimbing1 == pembimbing2.val()) {
                    pembimbing2.val(null).trigger('change'); // Reset pilihan Pembimbing 2
                }
            });

            // Format tampilan option dan selected option
            function formatOption(option) {
                if (!option.id) {
                    return option.text;
                }

                var bidangArray = $(option.element).data('bidang') || [];
                var $option = $('<div class="option-item">' + option.text + '</div>');

                if (bidangArray.length > 0) {
                    var $badgeContainer = $('<div class="badge-container"></div>');
                    bidangArray.forEach(function(bidang) {
                        $badgeContainer.append('<span class="badge bg-primary me-1">' + bidang + '</span>');
                    });
                    $option.append($badgeContainer);
                }

                return $option;
            }

            function formatSelectedOption(option) {
                return option.text;
            }
        });

        $(document).ready(function() {
            $('#TabelMahasiswa').DataTable();
            $('#TabelDosen').DataTable();
        });
    </script>

</body>

</html>
