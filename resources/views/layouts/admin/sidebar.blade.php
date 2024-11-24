<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <!-- Dashboard Menu -->
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark {{ request()->is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- Master Menu Dropdown -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ request()->is('jurusan*', 'prodi*', 'dosen*', 'ruangan*', 'mahasiswa*', 'jabatan_pimpinan*', 'pimpinan*', 'sesi*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#masterMenu"
                        aria-expanded="{{ request()->is('jurusan*', 'prodi*', 'dosen*', 'ruangan*', 'mahasiswa*', 'jabatan_pimpinan*', 'pimpinan*', 'sesi*') ? 'true' : 'false' }}"
                        aria-controls="masterMenu">
                        <i class="mdi mdi-folder-multiple"></i>
                        <span class="hide-menu">Master</span>
                    </a>
                    <ul class="collapse first-level {{ request()->is('jurusan*', 'prodi*', 'dosen*', 'ruangan*', 'mahasiswa*', 'jabatan_pimpinan*', 'pimpinan*', 'sesi*') ? 'show' : '' }}"
                        id="masterMenu">
                        <li class="sidebar-item"><a class="sidebar-link {{ request()->is('jurusan*') ? 'active' : '' }}"
                                href="{{ route('jurusan.index') }}"><i class="mdi mdi-account-network"></i><span
                                    class="hide-menu">Jurusan</span></a></li>
                        <li class="sidebar-item"><a class="sidebar-link {{ request()->is('prodi*') ? 'active' : '' }}"
                                href="{{ route('prodi.index') }}"><i class="mdi mdi-border-all"></i><span
                                    class="hide-menu">Prodi</span></a></li>
                        <li class="sidebar-item"><a class="sidebar-link {{ request()->is('dosen*') ? 'active' : '' }}"
                                href="{{ route('dosen.index') }}"><i class="mdi mdi-face"></i><span
                                    class="hide-menu">Dosen</span></a></li>
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('ruangan*') ? 'active' : '' }}"
                                href="{{ route('ruangan.index') }}"><i class="mdi mdi-home-variant"></i><span
                                    class="hide-menu">Ruangan</span></a></li>
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('mahasiswa*') ? 'active' : '' }}"
                                href="{{ route('mahasiswa.index') }}"><i class="mdi mdi-account-multiple"></i><span
                                    class="hide-menu">Mahasiswa</span></a></li>
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('jabatan_pimpinan*') ? 'active' : '' }}"
                                href="{{ route('jabatan_pimpinan.index') }}"><i
                                    class="mdi mdi-account-network"></i><span class="hide-menu">Jabatan
                                    Pimpinan</span></a></li>
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('pimpinan*') ? 'active' : '' }}"
                                href="{{ route('pimpinan.index') }}"><i class="mdi mdi-alert-outline"></i><span
                                    class="hide-menu">Pimpinan</span></a></li>
                        <li class="sidebar-item"><a class="sidebar-link {{ request()->is('sesi*') ? 'active' : '' }}"
                                href="{{ route('sesi.index') }}"><i class="mdi mdi-clock"></i><span
                                    class="hide-menu">Sesi</span></a></li>
                    </ul>
                </li>

                <!-- Data PKL - Mahasiswa Menu -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ request()->is('tempat_pkl*', 'usulan_pkl*', 'mhs_pkl*', 'mhs_logbook*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#pklMahasiswaMenu"
                        aria-expanded="{{ request()->is('tempat_pkl*', 'usulan_pkl*', 'mhs_pkl*', 'mhs_logbook*') ? 'true' : 'false' }}"
                        aria-controls="pklMahasiswaMenu">
                        <i class="mdi mdi-school"></i>
                        <span class="hide-menu">PKL Mahasiswa</span>
                    </a>
                    <ul class="collapse first-level {{ request()->is('tempat_pkl*', 'usulan_pkl*', 'mhs_pkl*', 'mhs_logbook*') ? 'show' : '' }}"
                        id="pklMahasiswaMenu">
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('usulan_pkl*') ? 'active' : '' }}"
                                href="{{ route('usulan_pkl.index') }}"><i class="mdi mdi-map-marker"></i><span
                                    class="hide-menu">Usulan Tempat</span></a></li>
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('mhs_pkl*') ? 'active' : '' }}"
                                href="{{ route('mhs_pkl.index') }}"><i class="mdi mdi-account-circle"></i><span
                                    class="hide-menu">Mahasiswa PKL</span></a></li>
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('mhs_logbook*') ? 'active' : '' }}"
                                href="{{ route('mhs_logbook.index') }}"><i class="mdi mdi-book"></i><span
                                    class="hide-menu">Logbook PKL</span></a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="#"><i
                                    class="mdi mdi-clipboard-check"></i><span class="hide-menu">Nilai PKL</span></a>
                        </li>
                    </ul>
                </li>

                <!-- Data PKL - Kaprodi Menu -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ request()->is('usulan_pkl*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#pklKaprodiMenu"
                        aria-expanded="{{ request()->is('usulan_pkl*') ? 'true' : 'false' }}"
                        aria-controls="pklKaprodiMenu">
                        <i class="mdi mdi-school"></i>
                        <span class="hide-menu">PKL - Kaprodi</span>
                    </a>
                    <ul class="collapse first-level {{ request()->is('') ? 'show' : '' }}"
                        id="pklKaprodiMenu">
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('tempat_pkl*') ? 'active' : '' }}"
                                href="{{ route('tempat_pkl.index') }}"><i class="mdi mdi-home-map-marker"></i><span
                                    class="hide-menu">Tempat PKL</span></a></li>
                        <li class="sidebar-item"><a
                                class="sidebar-link {{ request()->is('usulan_pkl*') ? 'active' : '' }}"
                                href="{{ route('usulan_pkl.indexprodi') }}"><i class="mdi mdi-lightbulb"></i><span
                                    class="hide-menu">Verifikasi Tempat</span></a></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('verif_berkas.index') ? 'active' : '' }}"
                                href="{{ route('sidang_pkl.index') }}">
                                <i class="mdi mdi-map"></i><span class="hide-menu">Sidang PKL</span>
                            </a>
                        </li>
                </li>
            </ul>
            </li>

            <!-- Data PKL - Pembimbing Menu -->
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark {{ request()->is('usulan_pkl*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" href="#pklPembimbingMenu"
                    aria-expanded="{{ request()->is('') ? 'true' : 'false' }}" aria-controls="pklPembimbingMenu">
                    <i class="mdi mdi-school"></i>
                    <span class="hide-menu">PKL - Pembimbing</span>
                </a>
                <ul class="collapse first-level {{ request()->is('') ? 'show' : '' }}" id="pklPembimbingMenu">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('dosen.pembimbing.index') ? 'active' : '' }}"
                            href="{{ route('dosen.pembimbing.index') }}">
                            <i class="mdi mdi-map"></i><span class="hide-menu">Bimbingan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('nilai_sidang_pkl.index') ? 'active' : '' }}"
                            href="{{ route('nilai_sidang_pkl.index') }}">
                            <i class="mdi mdi-map"></i><span class="hide-menu">Nilai Sidang PKL</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Data PKL - Admin -->
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark {{ request()->is('') ? 'active' : '' }}"
                    data-bs-toggle="collapse" href="#pkladminMenu"
                    aria-expanded="{{ request()->is('') ? 'true' : 'false' }}" aria-controls="pkladminMenu">
                    <i class="mdi mdi-school"></i>
                    <span class="hide-menu">PKL - Admin</span>
                </a>
                <ul class="collapse first-level {{ request()->is('') ? 'show' : '' }}" id="pkladminMenu">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('verif_berkas.index') ? 'active' : '' }}"
                            href="{{ route('verif_berkas.index') }}">
                            <i class="mdi mdi-map"></i><span class="hide-menu">Verifikasi Berkas</span>
                        </a>
                    </li>
            </li>
            </ul>
            </li>

            <!-- Data Sempro Menu -->
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark {{ request()->is('sempro*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" href="#semproMenu"
                    aria-expanded="{{ request()->is('sempro*') ? 'true' : 'false' }}" aria-controls="semproMenu">
                    <i class="mdi mdi-book-open-variant"></i>
                    <span class="hide-menu">Data Sempro</span>
                </a>
                <ul class="collapse first-level {{ request()->is('sempro*') ? 'show' : '' }}" id="semproMenu">
                    <li class="sidebar-item"><a
                            class="sidebar-link {{ request()->is('sempro/verifikasi') ? 'active' : '' }}"
                            href="#"><i class="mdi mdi-check-circle"></i><span
                                class="hide-menu">Verifikasi</span></a></li>
                </ul>
            </li>

            </ul>
        </nav>
    </div>
</aside>
