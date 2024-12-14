

<div class="vertical-menu" style="background: #001A88 !important;">

    <!-- LOGO -->
    <div class="navbar-brand-box" style="   box-shadow: -2px 6px 3px rgb(52 58 64 / 8%);">
        <a href="#" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{asset('mp3/images/logo.png')}}" alt="" height="20">
            </span>
            <span class="logo-lg">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{asset('mp3/images/logo.png')}}" alt="" height="40">
                    <span class="text-white fw-bold" style="font-size:24px;">KIP-HUB</span>
                </div>
            </span>
        </a>
    </div>

    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('dashboard.index')}}">
                        <i class='bx bxs-dashboard'></i>
                        <span class="menu-item" data-key="t-sales">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-dashboards">Transaksi Absensi</li>
                <li>
                    <a href="{{route('absensi.menu-absensi')}}">
                        <i class='bx bx-paste'></i>
                        <span class="menu-item" data-key="t-sales">Absensi</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bxs-report'></i>
                        <span class="menu-item" data-key="t-email">Cuti</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('pengajuan-cuti.index')}}" data-key="t-inbox">Pengajuan Cuti</a></li>
                        <li><a href="{{route('pengajuan-cuti.approval')}}" data-key="t-inbox">Approval Cuti</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('lembur.index')}}">
                        <i class='bx bx-time'></i>
                        <span class="menu-item" data-key="t-sales">Lembur</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dinas-luar-kota.index') }}">
                        <i class='bx bx-buildings'></i>
                        <span class="menu-item" data-key="t-sales">Dinas Luar Kota</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('master-data.kegiatan-luar-kantor.index')}}">
                        <i class='bx bx-building' ></i>
                        <span class="menu-item" data-key="t-sales">Kegiatan Luar Kantor</span>
                    </a>
                </li>
               
                <li class="d-none">
                    <a href="#">
                        <i class='bx bx-calendar'></i>
                        <span class="menu-item" data-key="t-sales">Jadwal</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-dashboards">Laporan</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bxs-report'></i>
                        <span class="menu-item" data-key="t-email">Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('laporan.absensi.index') }}" data-key="t-inbox">Laporan Absensi</a></li>
                        {{-- <li><a href="/" data-key="t-inbox">Laporan Cuti</a></li> --}}
                        <li><a href="{{route('laporan.lembur.laporan')}}" data-key="t-inbox">Laporan Lembur</a></li>
                    </ul>
                </li>
                <li class="menu-title" data-key="t-dashboards">Calender</li>
                <li>
                    <a href="{{route('calender.index')}}">
                        <i class='bx bx-box'></i>
                        <span class="menu-item" data-key="t-sales">Calender</span>
                    </a>
                </li>
                @php
                    $adminRole = Auth::user()->getRoleNames()[0] ?? '';
                  
                @endphp

                @if($adminRole == 'Admin' || $adminRole == 'super-admin')
                <li class="menu-title" data-key="t-dashboards">MASTER DATA</li>


                <li>
                    <a href="{{route('master-data.index')}}">
                        <i class='bx bx-box'></i>
                        <span class="menu-item" data-key="t-sales">Master Data</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('berita.index')}}">
                        <i class='bx bxs-report'></i>
                        <span class="menu-item" data-key="t-sales">Berita & Pengumuman</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('role-setting.index')}}">
                        <i class='bx bx-cog'></i>
                        <span class="menu-item" data-key="t-sales">Role Setting</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('user-setting', Auth::user()->id) }}">
                        <i class='bx bx-user'></i>
                        <span class="menu-item" data-key="t-sales">User Setting</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
