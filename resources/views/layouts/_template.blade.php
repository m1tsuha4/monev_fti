<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FTI Unand</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <!-- <i class="fa fa-hospital"></i> -->
                    <img src="{{asset('logo/logo_fti.png')}}" height="70px" width="70px">
                </div>
                <div class="sidebar-brand-text mx-3">Monitoring FTI Unand</div>
            </a>

            <!-- Divider -->

            @yield('navbar')

            <hr class="sidebar-divider my-0">
            @if(auth()->user()->status == 0)
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Master
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/users')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dosen</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/prodi')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Prodi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/tahun-akademik')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Tahun Akademik</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/matakuliah')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Matakuliah</span>
                </a>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{url('/jurusan/kategori-berkas')}}">--}}
{{--                    <i class="fas fa-fw fa-chart-area"></i>--}}
{{--                    <span>Kategori Berkas</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/kategori-penilaian')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kategori Penilaian</span>
                </a>
            </li>

            @elseif(auth()->user()->status == 1)
                <!-- Nav Item - Dashboard -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                <span style="font-size:15px">{{Auth::user()->jabatan}}</span>
                <span style="font-size:15px">{{Auth::user()->prodi->nama_prodi}}</span>
            </div>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Monitoring & Evaluasi
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/kelas-perkuliahan')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kelas Perkuliahan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/monitoring')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Monitoring</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/jurusan/laporan-penilaian')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan Penilaian</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Pengampu Matakuliah
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/kelas-perkuliahan')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kelas Perkuliahan</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/monitoring')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kegiatan Perkuliahan</span>
                </a>
            </li> -->

            <div class="sidebar-heading">
                Verifikator
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/monev')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Monitoring & Evaluasi</span>
                </a>
            </li>

            <!-- Divider -->
            @elseif(auth()->user()->status == 2)

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Monitoring & Evaluasi
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/gkm/monev')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Verifikasi</span>
                </a>
            </li>

            <div class="sidebar-heading">
                Pengampu Matakuliah
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/kelas-perkuliahan')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kelas Perkuliahan</span>
                </a>
            </li>

            <div class="sidebar-heading">
                Verifikator
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/monev')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Monitoring & Evaluasi</span>
                </a>
            </li>

            @else

            <li class="nav-item active">
                <a class="nav-link" href="{{ url('admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Pengampu Matakuliah
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/kelas-perkuliahan')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kelas Perkuliahan</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/monitoring')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kegiatan Perkuliahan</span>
                </a>
            </li> -->

            <div class="sidebar-heading">
                Verifikator
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/dosen/monev')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Monitoring & Evaluasi</span>
                </a>
            </li>

            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="profile" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->nama}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('template/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" id="profile" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            </div> -->
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
            @yield('main')

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistem Informasi Monitoring & Evaluasi Dosen</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @yield('modal')

    <div class="modal fade" id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Profile User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            @if(Auth::user()->foto != null)
                            {{Auth::user()->foto}}
                            @else
                            <img src="{{asset('logo/user.jpg')}}" height="100px" width="100px">
                            @endif
                        </div>
                        <div class="col-4">
                            <div>Nama</div>
                            <b><div>Nip</div></b>
                            <div>Prodi</div>
                            <div>Jabatan</div>
                            <div>Email</div>
                        </div>
                        <div class="col-8">
                            <div>: {{Auth::user()->nama_dosen}}</div>
                            <b><div>: {{Auth::user()->nip_dosen}}</div></b>
                            <div>: {{Auth::user()->prodi->nama_prodi}}</div>
                            <div>: {{Auth::user()->jabatan}}</div>
                            <div>: {{Auth::user()->email}}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Back</button>
                    <a class="btn btn-danger" id="editprofile" href="{{url('/profile')}}">Edit</a>
                </div>
            </div>
        </div>
    </div>

 <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    @yield('js')
    <script>
        $(document).ready( function () {
            $(document).on('click', '#profile', function() {
                $('#ProfileModal').modal('show');
                    $.ajax({
                        type: "get",
                        url: "{{ url('/profile') }}",
                        dataType: "json",
                        success: function(data) {
                            event.preventDefault();
                            var nama=data.nama
                            var nip=data.nip
                            var golongan=data.golongan
                            var pangkat=data.pangkat
                            var mulai=data.mulai_dinas
                            var tempat=data.tempat_lahir
                            var tanggal=data.tanggal_lahir
                            var pendidikan=data.pendidikan
                            var email=data.email
                            var jabatan=data.perawat_klinik.jabatan
                            var role=data.role.nama_role

                            $('#profile_nama').html(": "+nama);
                            $('#profile_nip').html(": "+nip);
                            $('#profile_golongan').html(": "+golongan);
                            $('#profile_pangkat').html(": "+pangkat);
                            $('#profile_mulai').html(": "+mulai);
                            $('#profile_tempat').html(": "+tempat);
                            $('#profile_tanggal').html(": "+tanggal);
                            $('#profile_pendidikan').html(": "+pendidikan);
                            $('#profile_email').html(": "+email);
                            $('#profile_jabatan').html(": "+jabatan);
                            $('#profile_role').html(": "+role);
                        }
                    });
                });
        });
    </script>
</body>

</html>
