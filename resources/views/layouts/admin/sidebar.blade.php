<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- Dropdown untuk Master -->
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false" onclick="toggleDropdown('masterDropdown')">
                        <i class="mdi mdi-folder-multiple"></i>
                        <span class="hide-menu">Master</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="collapse" id="masterDropdown">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('jurusan') }}" aria-expanded="false">
                                <i class="mdi mdi-account-network"></i> <!-- Ikon untuk Jurusan -->
                                <span class="hide-menu">Jurusan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('prodi') }}" aria-expanded="false">
                                <i class="mdi mdi-border-all"></i> <!-- Ikon untuk Prodi -->
                                <span class="hide-menu">Prodi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dosen') }}" aria-expanded="false">
                                <i class="mdi mdi-face"></i>
                                <span class="hide-menu">Dosen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('ruangan') }}" aria-expanded="false">
                                <i class="mdi mdi-home-variant"></i>
                                <span class="hide-menu">Ruangan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('mahasiswa') }}" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">Mahasiswa</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('jabatan_pimpinan') }}" aria-expanded="false">
                                <i class="mdi mdi-account-network"></i>
                                <span class="hide-menu">Jabatan Pimpinan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('pimpinan') }}" aria-expanded="false">
                                <i class="mdi mdi-alert-outline"></i>
                                <span class="hide-menu">Pimpinan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('sesi') }}" aria-expanded="false">
                                <i class="mdi mdi-clock"></i>
                                <span class="hide-menu">Sesi</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<script>
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('collapse');
    }
</script>

<style>
    /* CSS untuk mengatur tampilan dropdown */
    .collapse {
        display: none;
    }
</style>
