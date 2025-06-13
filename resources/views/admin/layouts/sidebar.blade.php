<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">GraduLane</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    {{-- SUPER ADMIN --}}
    @if (Auth::user()->can('isSuperAdmin') || Auth::user()->can('isAdmin'))
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="/admin/user">User</a>
                    <a class="collapse-item" href="/admin/mahasiswa">Mahasiswa</a>
                    <a class="collapse-item" href="/admin/dosen">Dosen</a>
                    <a class="collapse-item" href="/admin/jurusan">Jurusan</a>
                    <a class="collapse-item" href="/admin/prodi">Prodi</a>
                    <a class="collapse-item" href="/admin/session">Sesi</a>
                    <a class="collapse-item" href="/admin/ruangan">Ruangan</a>
                    <h6 class="collapse-header">Menu Dosen:</h6>
                    <a class="collapse-item" href="/admin/jabatan">Jabatan</a>
                    <a class="collapse-item" href="/admin/jabatanfungsional">Jabatan Fungsional</a>
                    <a class="collapse-item" href="/admin/bidang">Bidang Keahlian</a>
                    <a class="collapse-item" href="/admin/bidangdosen">Bidang Keahlian Dosen</a>

                    {{-- <a class="collapse-item" href="/admin/pangkat">Pangkat</a>
                <a class="collapse-item" href="/admin/golongan">Golongan</a> --}}
                    {{-- <a class="collapse-item" href="/admin/tahunajaran">Tahun Ajaran</a> --}}
                    {{-- <a class="collapse-item" href="/admin/level">Level</a> --}}
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTA"
                aria-expanded="true" aria-controls="collapseTA">
                <i class="fas fa-fw fa-folder"></i>
                <span>TA</span>
            </a>
            <div id="collapseTA" class="collapse" aria-labelledby="headingTA" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tugas Akhir:</h6>
                    <a class="collapse-item" href="/sita">Sidang TA</a>
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- PKL --}}
    <!-- Nav Item - PKL Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePKL"
            aria-expanded="true" aria-controls="collapsePKL">
            <i class="fas fa-fw fa-folder"></i>
            <span>PKL</span>
        </a>
        <div id="collapsePKL" class="collapse" aria-labelledby="headingPKL" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="login.html">Usulan PKL</a>
                <a class="collapse-item" href="register.html">Bimbingan</a>
                <a class="collapse-item" href="forgot-password.html">Daftar Sidang</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Revisi:</h6>
                <a class="collapse-item" href="404.html">Revisi Lap. PKL</a>
            </div>
        </div>
    </li> --}}

    {{-- SEMPRO --}}
    <!-- Nav Item - Sempro Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSempro"
            aria-expanded="true" aria-controls="collapseSempro">
            <i class="fas fa-fw fa-folder"></i>
            <span>Sempro</span>
        </a>
        <div id="collapseSempro" class="collapse" aria-labelledby="headingSempro" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="login.html">Seminar Proposal</a>
            </div>
        </div>
    </li> --}}

    {{-- TUGAS AKHIR --}}
    <!-- Nav Item - TA Collapse Menu -->
    @if (Auth::user()->can('isMahasiswa'))
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        {{-- PKL --}}
        <!-- Nav Item - PKL Collapse Menu -->
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePKL"
                aria-expanded="true" aria-controls="collapsePKL">
                <i class="fas fa-fw fa-folder"></i>
                <span>PKL</span>
            </a>
            <div id="collapsePKL" class="collapse" aria-labelledby="headingPKL" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="login.html">Usulan PKL</a>
                    <a class="collapse-item" href="register.html">Bimbingan</a>
                    <a class="collapse-item" href="forgot-password.html">Daftar Sidang</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Revisi:</h6>
                    <a class="collapse-item" href="404.html">Revisi Lap. PKL</a>
                </div>
            </div>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTA"
                aria-expanded="true" aria-controls="collapseTA">
                <i class="fas fa-fw fa-folder"></i>
                <span>TA</span>
            </a>
            <div id="collapseTA" class="collapse" aria-labelledby="headingTA" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tugas Akhir:</h6>
                    {{-- <a class="collapse-item" href="#">Similarity</a> --}}
                    <a class="collapse-item" href="/admin/tugasakhir">Usulan Judul</a>
                    <a class="collapse-item" href="/admin/bimbingan">Bimbingan</a>
                    <div class="collapse-divider"></div>
                    @if (Gate::allows('isSarjana'))
                        <h6 class="collapse-header">Seminar Proposal:</h6>
                        <a class="collapse-item" href="/admin/sempro">Daftar Sempro</a>
                        <div class="collapse-divider"></div>
                    @endif
                    <h6 class="collapse-header">Sidang Tugas Akhir:</h6>
                    <a class="collapse-item" href="/sita">Daftar Sidang TA</a>
                    {{-- <h6 class="collapse-header">Revisi:</h6>
                    <a class="collapse-item" href="#">Revisi Lap. TA</a> --}}
                </div>
            </div>
        </li>
    @elseif (Auth::user()->can('isKaprodi'))
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Kaprodi
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTADos"
                aria-expanded="true" aria-controls="collapseTADos">
                <i class="fas fa-fw fa-folder"></i>
                <span>TA</span>
            </a>
            <div id="collapseTADos" class="collapse" aria-labelledby="headingTADos" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu Usulan Mahasiswa:</h6>
                    <a class="collapse-item" href="/admin/tugasakhir">Judul Proposal</a>
                    <a class="collapse-item" href="/admin/sempro">Seminar Proposal</a>
                    <a class="collapse-item" href="/sita">Sidang Tugas Akhir</a>
                </div>
            </div>
        </li>

        <div class="sidebar-heading">
            Menu Dosen
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTA"
                aria-expanded="true" aria-controls="collapseTA">
                <i class="fas fa-fw fa-folder"></i>
                <span>TA</span>
            </a>
            <div id="collapseTA" class="collapse" aria-labelledby="headingTA" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="/admin/bimbingan">Mahasiswa Bimbingan</a>
                    <a class="collapse-item" href="/admin/sempro">Mahasiswa Sempro</a>
                    <a class="collapse-item" href="/sita">Mahasiswa Sidang TA</a>
                </div>
            </div>
        </li>
    @elseif (Gate::allows('isDosen'))
        <div class="sidebar-heading">
            Menu
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTA"
                aria-expanded="true" aria-controls="collapseTA">
                <i class="fas fa-fw fa-folder"></i>
                <span>TA</span>
            </a>
            <div id="collapseTA" class="collapse" aria-labelledby="headingTA" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="/admin/bimbingan">Mahasiswa Bimbingan</a>
                    <a class="collapse-item" href="/admin/sempro">Mahasiswa Sempro</a>
                    <a class="collapse-item" href="/sita">Mahasiswa Sidang TA</a>
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('assets/img/undraw_rocket.svg') }}" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and
            more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
