<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- Dashboard Menu -->
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @hasrole('admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#masterMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="masterMenu">
                            <i class="mdi mdi-folder-multiple"></i>
                            <span class="hide-menu">Master</span>
                        </a>
                        <ul class="collapse first-level" id="masterMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('jurusan.index') }}">
                                    <i class="mdi mdi-account-network"></i>
                                    <span class="hide-menu">Jurusan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('prodi.index') }}">
                                    <i class="mdi mdi-border-all"></i>
                                    <span class="hide-menu">Prodi</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('dosen.index') }}">
                                    <i class="mdi mdi-face"></i>
                                    <span class="hide-menu">Dosen</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('ruangan.index') }}">
                                    <i class="mdi mdi-home-variant"></i>
                                    <span class="hide-menu">Ruangan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('mahasiswa.index') }}">
                                    <i class="mdi mdi-account-multiple"></i>
                                    <span class="hide-menu">Mahasiswa</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark"
                                    href="{{ route('jabatan_pimpinan.index') }}">
                                    <i class="mdi mdi-account-network"></i>
                                    <span class="hide-menu">Jabatan Pimpinan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('pimpinan.index') }}">
                                    <i class="mdi mdi-alert-outline"></i>
                                    <span class="hide-menu">Pimpinan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('sesi.index') }}">
                                    <i class="mdi mdi-clock"></i>
                                    <span class="hide-menu">Sesi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasrole

                @hasrole('mahasiswa')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#pklMahasiswaMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="pklMahasiswaMenu">
                            <i class="mdi mdi-school"></i>
                            <span class="hide-menu">PKL</span>
                        </a>
                        <ul class="collapse first-level" id="pklMahasiswaMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('usulan_pkl.index') }}">
                                    <i class="mdi mdi-map-marker"></i>
                                    <span class="hide-menu">Usulan Tempat</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('mhs_logbook.index') }}">
                                    <i class="mdi mdi-book"></i>
                                    <span class="hide-menu">Logbook PKL</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('mhs_pkl.index') }}">
                                    <i class="mdi mdi-account-circle"></i>
                                    <span class="hide-menu">Sidang PKL</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="#">
                                    <i class="mdi mdi-clipboard-check"></i>
                                    <span class="hide-menu">Nilai PKL</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#sempromhsMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="sempromhsMenu">
                            <i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Sempro</span>
                        </a>
                        <ul class="collapse first-level" id="sempromhsMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('mhs_sempro.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Ajukan Sempro</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#tamhsMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="tamhsMenu">
                            <i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Tugas Akhir</span>
                        </a>
                        <ul class="collapse first-level" id="sempromhsMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark"
                                    href="{{ route('mhs_bimbingan.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Bimbingan TA</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('mhs_ta.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Sidang TA</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasrole

                @hasrole('kaprodi')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#pklKaprodiMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="pklKaprodiMenu">
                            <i class="mdi mdi-school"></i>
                            <span class="hide-menu">PKL</span>
                        </a>
                        <ul class="collapse first-level" id="pklKaprodiMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('tempat_pkl.index') }}">
                                    <i class="mdi mdi-home-map-marker"></i>
                                    <span class="hide-menu">Tempat PKL</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark"
                                    href="{{ route('usulan_pkl.indexprodi') }}">
                                    <i class="mdi mdi-lightbulb"></i>
                                    <span class="hide-menu">Verifikasi Tempat</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('sidang_pkl.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Sidang PKL</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#sempromhsMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="sempromhsMenu">
                            <i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Sempro</span>
                        </a>
                        <ul class="collapse first-level" id="sempromhsMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark"
                                    href="{{ route('pengajuan_sempro.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Verifikasi Sempro</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('sempro.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Seminar Proposal</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#tamhsMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="tamhsMenu">
                            <i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Tugas Akhir</span>
                        </a>
                        <ul class="collapse first-level" id="tamhsMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('sidang_ta.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Sidang TA</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasrole

                @hasrole('pembimbing|penguji')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="{{ route('dosen.pembimbing.index') }}">
                            <i class="mdi mdi-map"></i>
                            <span class="hide-menu">Bimbingan PKL</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="{{ route('nilai_sidang_pkl.index') }}">
                            <i class="mdi mdi-map"></i>
                            <span class="hide-menu">Nilai Sidang PKL</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="{{ route('nilai_sempro.index') }}">
                            <i class="mdi mdi-map"></i>
                            <span class="hide-menu">Nilai Sempro</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="{{ route('dosen.bimbingan.index') }}">
                            <i class="mdi mdi-map"></i>
                            <span class="hide-menu">Bimbingan TA</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="{{ route('nilai_ta.index') }}">
                            <i class="mdi mdi-map"></i>
                            <span class="hide-menu">Nilai TA</span>
                        </a>
                    </li>
                @endhasrole

                @hasrole('admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#pkladminMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="pkladminMenu">
                            <i class="mdi mdi-school"></i>
                            <span class="hide-menu">PKL</span>
                        </a>
                        <ul class="collapse first-level" id="pkladminMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('verif_berkas.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Verifikasi Berkas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#semproadminMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="semproadminMenu">
                            <i class="mdi mdi-school"></i>
                            <span class="hide-menu">Seminar Proposal</span>
                        </a>
                        <ul class="collapse first-level" id="semproadminMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark"
                                    href="{{ route('verif_berkas_sempro.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Verifikasi Berkas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark has-arrow" href="#taadminMenu"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="taadminMenu">
                            <i class="mdi mdi-school"></i>
                            <span class="hide-menu">Tugas Akhir</span>
                        </a>
                        <ul class="collapse first-level" id="taadminMenu">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark"
                                    href="{{ route('verif_berkas_ta.index') }}">
                                    <i class="mdi mdi-map"></i>
                                    <span class="hide-menu">Verifikasi Berkas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasrole
            </ul>
        </nav>
    </div>
</aside>
