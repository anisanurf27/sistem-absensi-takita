<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
        <i class="ph-house"></i>
        <span>
            Dashboard
        </span>
    </a>
</li>

@can('add-permission')
<li class="nav-item">
    <a href="{{ route('input_izin') }}" class="nav-link @yield('input_izin')">
        <i class="ph-download-simple"></i>
        <span>
            Input Perizinan
        </span>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('monitoring_presensi_diri') }}" class="nav-link @yield('monitoring_diri')">
        <i class="ph-calendar"></i>
        <span>
            Monitoring Presensi
        </span>
    </a>
</li>
@endcan

@can('read-presensi')
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link @yield('home')">
        <i class="ph ph-notepad"></i>
        <span>
            Monitoring Perizinan
        </span>
    </a>
</li>
@endcan

@can('read-presensi')
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link @yield('home')">
        <i class="ph-files"></i>
        <span>
            Rekap Perizinan
        </span>
    </a>
</li>
@endcan


{{-- Menu Super Admin --}}
@can('read-user')
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">MASTER USER</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a href="{{ route('enroll_device') }}" class="nav-link @yield('enroll_device')">
        <i class="ph-desktop-tower"></i>
        <span>
            Enroll Device
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('enroll_user') }}" class="nav-link @yield('enroll_user')">
        <i class="ph-identification-card"></i>
        <span>
            Enroll New User
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link @yield('home')">
        <i class="ph-users-three"></i>
        <span>
            User Account
        </span>
    </a>
</li>
@endcan