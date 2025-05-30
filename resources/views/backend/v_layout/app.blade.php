<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>tokoonline</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <!-- Topbar header -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <a class="navbar-brand" href="index.html">
                        <b class="logo-icon p-l-10">
                            <img class="light-logo w-100" src="{{ asset('backend/images/khoceng.png') }}" alt="homepage" />
                        </b>
                        <span class="logo-text">
                            <img src="{{ asset('backend/images/image/logo_text.png') }}" alt="homepage" class="light-logo" />
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light"
                       href="javascript:void(0)" data-toggle="collapse"
                       data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                       aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light"
                               href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <!-- ========================================================= -->
                        <!-- User profile and search -->
                        <!-- ========================================================= -->
                        <li class="nav-item dropdown">
                            <!-- Tombol untuk membuka dropdown profil pengguna -->
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->foto)
                                    <!-- Jika user memiliki foto, tampilkan -->
                                    <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user" class="rounded-circle" width="31">
                                @else
                                    <!-- Jika tidak ada foto, tampilkan gambar default -->
                                    <img src="{{ asset('storage/img-user/img-default.jpg') }}" alt="user" class="rounded-circle" width="31">
                                @endif
                            </a>

                            <!-- Dropdown menu untuk user -->
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <!-- Link ke halaman edit profil -->
                                <a class="dropdown-item" href="{{ route('backend.user.edit', Auth::user()->id) }}">
                                    <i class="ti-user m-r-5 m-l-5"></i> Profil Saya
                                </a>
                                <!-- Link untuk logout -->
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Keluar
                                </a>
                                <!-- Garis pembatas -->
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('backend.kategori.index') }}" class="sidebar-link">
                                <i class="mdi mdi-chevron-right"></i>
                                <span class="hide-menu">Kategori</span>
                            </a>
                        </li>


                        <!-- ========================================================= -->
                        <!-- End user profile and search -->
                        <!-- ========================================================= -->
                    </ul>
                </div>
            </nav>
        </header>
        <aside>

        </aside>
        <!-- Sidebar -->
     <aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.beranda') }}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Beranda</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.user.index') }}" aria-expanded="false">
                        <i class="mdi mdi-account"></i>
                        <span class="hide-menu">User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-shopping"></i>
                        <span class="hide-menu">Data Produk</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('backend.kategori.index')}}" class="sidebar-link">
                                <i class="mdi mdi-chevron-right"></i>
                                <span class="hide-menu">Kategori</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href= "{{ route('backend.produk.index')}}" class="sidebar-link">
                                <i class="mdi mdi-chevron-right"></i>
                                <span class="hide-menu">Produk</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    <!-- End Sidebar navigation-->
    </div>
        </aside>



        <!-- Page wrapper -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Tables</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                @yield('content')

            <footer class="footer text-center">
                Web Programming. Studi Kasus Toko Online <a href="https://bsi.ac.id/">Kuliah..? BSI Aja !!!</a>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
    <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        $('#zero_config').DataTable();
    </script>

    <!-- Form logout -->
    <form id="keluar-app" action="{{ route('backend.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

        <!-- SweetAlert -->
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- SweetAlert End -->

    <!-- Konfirmasi Success -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}"
        });
    </script>
    @endif
    <!-- Konfirmasi Success End -->

    <script type="text/javascript">
    // Konfirmasi delete
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var konfdelete = $(this).data("konf-delete");
        event.preventDefault();

        Swal.fire({
            title: 'Konfirmasi Hapus Data?',
            html: "Data yang dihapus <strong>" + konfdelete + "</strong> tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, dihapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                    .then(() => {
                        form.submit();
                    });
            }
        });
    });
</script>

</body>

</html>
