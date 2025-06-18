@extends('layouts.admin.template')

@section('title', 'Dashboard')

@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="link"><i
                                    class="mdi mdi-home-outline fs-4"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h1 class="mb-0 fw-bold">Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if (auth()->user()->hasAnyRole(['admin', 'super_admin']))
            <!-- Dashboard for Admin/Super Admin -->
            <div class="row">
                <!-- Summary Cards -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">Total Mahasiswa</p>
                                    <h3 class="fw-bold">{{ $totalMahasiswa }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">Total Dosen</p>
                                    <h3 class="fw-bold">{{ $totalDosen }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">PKL Aktif</p>
                                    <h3 class="fw-bold">{{ $pklVerified }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-briefcase fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">Sempro Selesai</p>
                                    <h3 class="fw-bold">{{ $completedSempro }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-check-circle fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Status Cards -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Status Verifikasi PKL</h4>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $pklPending }}</h4>
                                    <small class="text-muted">Pending</small>
                                </div>
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $pklVerified }}</h4>
                                    <small class="text-muted">Terverifikasi</small>
                                </div>
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $totalPKL }}</h4>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="progress mt-3">
                                @php
                                    $pklVerifiedPercent = $totalPKL > 0 ? ($pklVerified / $totalPKL) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $pklVerifiedPercent }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Status Verifikasi Sempro</h4>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $semproPending }}</h4>
                                    <small class="text-muted">Pending</small>
                                </div>
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $semproVerified }}</h4>
                                    <small class="text-muted">Terverifikasi</small>
                                </div>
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $totalSempro }}</h4>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="progress mt-3">
                                @php
                                    $semproVerifiedPercent =
                                        $totalSempro > 0 ? ($semproVerified / $totalSempro) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $semproVerifiedPercent }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (auth()->user()->hasAnyRole(['pembimbing', 'penguji', 'dosen', 'kaprodi']))
            <div class="row">
                <!-- Summary Cards -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">Total Mahasiswa Bimbingan PKL</p>
                                    <h3 class="fw-bold">{{ $totalMahasiswa }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">Total Mahasiswa Sedang PKL</p>
                                    <h3 class="fw-bold">{{ $totalPKL }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-briefcase fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">Total Mahasiswa Sedang Sempro</p>
                                    <h3 class="fw-bold">{{ $totalSempro }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-file-alt fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="fs-4 mb-1">Total Mahasiswa Sudah Sempro</p>
                                    <h3 class="fw-bold">{{ $sudahSempro }}</h3>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-check-circle fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Recent Activities -->
                {{-- <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Aktivitas Terbaru</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mahasiswa</th>
                                        <th>Kegiatan</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentActivities as $activity)
                                        <tr>
                                            <td>{{ $activity->mahasiswa->nama }}</td>
                                            <td>{{ $activity->kegiatan }}</td>
                                            <td>
                                                <span class="badge bg-{{ $activity->status_color }}">
                                                    {{ $activity->status }}
                                                </span>
                                            </td>
                                            <td>{{ $activity->tanggal->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        @else
            <div class="row">
                <!-- Student Progress Cards -->
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Status PKL</h4>
                            <div class="d-flex align-items-center mt-4">
                                <div class="d-flex align-items-center">
                                    @if ($statusPKL)
                                        <i class="fas fa-check-circle fa-3x text-success me-3"></i>
                                        <div>
                                            <h5 class="mb-0">Sudah PKL</h5>
                                            <small class="text-muted">Periode: {{ $periodePKL }}</small>
                                        </div>
                                    @else
                                        <i class="fas fa-clock fa-3x text-warning me-3"></i>
                                        <div>
                                            <h5 class="mb-0">Belum PKL</h5>
                                            <small class="text-muted">Silahkan ajukan PKL</small>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Status Sempro</h4>
                            <div class="d-flex align-items-center mt-4">
                                <div class="d-flex align-items-center">
                                    @if ($statusSempro)
                                        <i class="fas fa-check-circle fa-3x text-success me-3"></i>
                                        <div>
                                            <h5 class="mb-0">Sudah Sempro</h5>
                                            <small class="text-muted">Tanggal: {{ $tanggalSempro }}</small>
                                        </div>
                                    @else
                                        <i class="fas fa-clock fa-3x text-warning me-3"></i>
                                        <div>
                                            <h5 class="mb-0">Belum Sempro</h5>
                                            <small class="text-muted">Silahkan ajukan Sempro</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Progress -->
                {{-- <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Progress Akademik</h4>
                        <div class="timeline">
                            @foreach ($progressTimeline as $progress)
                            <div class="timeline-item">
                                <div class="timeline-badge {{ $progress->status ? 'bg-success' : 'bg-secondary' }}">
                                    <i class="fas {{ $progress->icon }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>{{ $progress->title }}</h6>
                                    <p>{{ $progress->description }}</p>
                                    <small>{{ $progress->date }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        @endif
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            @if (Auth::user()->hasAnyRole(['admin', 'super_admin']))
                // Monthly Statistics Chart
                var monthlyOptions = {
                    chart: {
                        type: 'bar',
                        height: 350,
                        stacked: true,
                    },
                    series: [{
                        name: 'PKL',
                        data: {}
                    }, {
                        name: 'Sempro',
                        data: {}
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah Mahasiswa'
                        }
                    },
                    legend: {
                        position: 'top'
                    },
                    fill: {
                        opacity: 1
                    }
                };

                var monthlyChart = new ApexCharts(document.querySelector("#monthlyStats"), monthlyOptions);
                monthlyChart.render();

                // Status Distribution Pie Chart
                var distributionOptions = {
                    chart: {
                        type: 'pie',
                        height: 350
                    },
                    series: [{{ $pklVerified }}, {{ $semproVerified }}, {{ $completedSempro }}],
                    labels: ['PKL Aktif', 'Sempro Terverifikasi', 'Sempro Selesai'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var distributionChart = new ApexCharts(document.querySelector("#statusDistribution"), distributionOptions);
                distributionChart.render();
            @elseif (Auth::user()->hasAnyRole(['pembimbing', 'penguji', 'dosen', 'kaprodi']))
                // Bar Chart for Student Statistics (ApexCharts)
                var optionsBar = {
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    series: [{
                        name: 'PKL',
                        data: {!! json_encode($pklStats) !!} // Using dynamic data
                    }, {
                        name: 'Sempro',
                        data: {!! json_encode($semproStats) !!} // Using dynamic data
                    }],
                    xaxis: {
                        categories: ['Current', 'Last Month', '2 Months Ago', '3 Months Ago', '4 Months Ago',
                            '5 Months Ago'
                        ],
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah'
                        },
                        min: 0
                    }
                };

                var chartBar = new ApexCharts(document.querySelector("#studentStats"), optionsBar);
                chartBar.render();



                var chartBar = new ApexCharts(document.querySelector("#studentStats"), optionsBar);
                chartBar.render();

                // Pie Chart for Status Distribution (ApexCharts)
                var optionsPie = {
                    chart: {
                        type: 'pie',
                        height: 350
                    },
                    series: [5, 10, 15], // Dummy Data
                    labels: ['Sedang PKL', 'Siap Sempro', 'Sudah Sempro'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: '100%'
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chartPie = new ApexCharts(document.querySelector("#statusPie"), optionsPie);
                chartPie.render();
            @endif
        </script>
    @endpush
@endsection
