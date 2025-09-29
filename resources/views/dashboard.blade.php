@extends('layout.main')

@section('title', 'SIIBA | Data KBLI')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    <style>
        #mapKelurahan {
            height: 600px;
        }
        #mapKecamatan {
            height: 600px;
        }
        .leaflet-popup-content {
            color: #191919;
            font-Weight: bold;
            font-Size:8;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Industri Balikpapan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Data KBLI</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content ml-3">
        <div class="row">
            <div class="col-12">
                <div class="mt-2 mb-1">
                    <h5>Jumlah Pelaku Usaha Berdasarkan Skala Usaha</h5>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-seedling"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mikro</span>
                                <span class="info-box-number">
                                    {{ $mikro }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-leaf"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kecil</span>
                                <span class="info-box-number">
                                    {{ $kecil }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tree"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Menengah</span>
                                <span class="info-box-number">
                                    {{ $menengah }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Besar</span>
                                <span class="info-box-number">
                                    {{ $besar }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 mb-1">
                    <h5>Jumlah Pelaku Usaha Berdasarkan Risiko</h5>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-exclamation-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Rendah</span>
                                <span class="info-box-number">
                                    {{ $rendah }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i
                                    class="fas fa-exclamation-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Menengah Rendah</span>
                                <span class="info-box-number">
                                    {{ $menengahRendah }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i
                                    class="fas fa-exclamation-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Menengah Tinggi</span>
                                <span class="info-box-number">
                                    {{ $menengahTinggi }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1"><i
                                    class="fas fa-exclamation-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tinggi</span>
                                <span class="info-box-number">
                                    {{ $tinggi }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 mb-1">
                    <h5>Jumlah Pelaku Usaha Berdasarkan Jenis Usaha</h5>
                </div>

                <div class="row d-flex">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perseorangan</span>
                                <span class="info-box-number">
                                    {{ $perseorangan }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">PT</span>
                                <span class="info-box-number">
                                    {{ $pt }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-briefcase"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">CV</span>
                                <span class="info-box-number">
                                    {{ $cv }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-user-tie"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">PT Perseorangan</span>
                                <span class="info-box-number">
                                    {{ $ptPerseorangan }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-balance-scale"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Badan Hukum Lainnya</span>
                                <span class="info-box-number">
                                    {{ $bhl }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-warehouse"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Badan Layanan Umum</span>
                                <span class="info-box-number">
                                    {{ $blu }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-store"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Koperasi</span>
                                <span class="info-box-number">
                                    {{ $koperasi }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Persatuan dan Perkumpulan</span>
                                <span class="info-box-number">
                                    {{ $pdp }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-toolbox"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perusahaan Umum</span>
                                <span class="info-box-number">
                                    {{ $perum }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-school"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Yayasan</span>
                                <span class="info-box-number">
                                    {{ $yayasan }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h5>Jumlah Tenaga Kerja di Industri Kota Balikpapan</h5>
                </div>
                <div class="row d-flex">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laki-Laki</span>
                                <span class="info-box-number">
                                    {{ $tenagalk }}
                                    <small>Orang</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-pink elevation-1"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perempuan</span>
                                <span class="info-box-number">
                                    {{ $tenagapr }}
                                    <small>Orang</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-globe"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Asing</span>
                                <span class="info-box-number">
                                    {{ $tenagaasing }}
                                    <small>Pelaku Usaha</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Persebaran Industri Tiap Kecamatan Berdasarkan Jenis Usaha</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart" style="height: 400px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jumlah Tenaga Kerja Laki-Laki dan Perempuan Tiap Kecamatan</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="tenagaKerjaChart" style="height: 400px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Persebaran Risiko Pelaku Usaha di Tiap Kecamatan</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="riskChart" style="height: 400px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Total Investasi Berdasarkan Skala Usaha</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="investmentPieChart" style="height: 400px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Total Investasi Berdasarkan Jenis Usaha</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="businessTypePieChart" style="height: 400px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Peta Sebaran Industri per Kelurahan</h3>
                            </div>
                            <div class="card-body">
                                <div id="mapKelurahan"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Peta Sebaran Industri per Kecamatan</h3>
                            </div>
                            <div class="card-body">
                                <div id="mapKecamatan"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Pertumbuhan Industri</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        function loadData() {
            // Data dari controller
            var kecamatan = @json($kecamatan);
            var chartData = @json($chartData);
            var jenisUsaha = @json($jenisUsaha);
            var tenagaKerjaChartData = @json($tenagaKerjaChartData);
            var risiko = @json($risiko);
            var risikoData = @json($risikoData);

            // Log untuk memastikan data
            console.log('Kecamatan:', kecamatan);
            console.log('Chart Data:', chartData);
            console.log('Jenis Usaha:', jenisUsaha);
            console.log('Tenaga Kerja Data:', tenagaKerjaChartData);

            if (kecamatan.length === 0 || chartData.length === 0 || jenisUsaha.length === 0) {
                console.error('Data tidak tersedia atau kosong');
                return;
            }

            // Chart 1: Persebaran Industri Tiap Kecamatan Berdasarkan Jenis Usaha
            var labels = kecamatan;
            var datasets = [];

            jenisUsaha.forEach(function(jenis, index) {
                var data = [];
                chartData.forEach(function(item) {
                    data.push(item[jenis]);
                });

                var colors = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)'];
                var borderColors = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'];

                datasets.push({
                    label: jenis,
                    data: data,
                    backgroundColor: colors[index],
                    borderColor: borderColors[index],
                    borderWidth: 1
                });
            });

            var ctx = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            stacked: true
                        }
                    }
                }
            });

            // Chart 2: Jumlah Tenaga Kerja Laki-Laki dan Perempuan Tiap Kecamatan
            var tenagaKerjaLabels = kecamatan;
            var tenagaKerjaDatasets = [{
                    label: 'Laki-Laki',
                    data: tenagaKerjaChartData.map(item => item.total_lk),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Perempuan',
                    data: tenagaKerjaChartData.map(item => item.total_pr),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                }
            ];

            var ctx2 = document.getElementById('tenagaKerjaChart').getContext('2d');
            var tenagaKerjaChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: tenagaKerjaLabels,
                    datasets: tenagaKerjaDatasets,
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            stacked: true
                        }
                    }
                }
            });

            // Chart 3: Persebaran Risiko Pelaku Usaha di Tiap Kecamatan
            var riskLabels = kecamatan;
            var riskDatasets = [];

            risiko.forEach(function(risk, index) {
                var data = [];
                risikoData.forEach(function(item) {
                    data.push(item[risk]);
                });

                var colors = ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ];
                var borderColors = ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ];

                riskDatasets.push({
                    label: risk,
                    data: data,
                    backgroundColor: colors[index],
                    borderColor: borderColors[index],
                    borderWidth: 1
                });
            });

            var ctx3 = document.getElementById('riskChart').getContext('2d');
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: riskLabels,
                    datasets: riskDatasets
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Piechart 4: Total Investasi Berdasarkan Skala Usaha
            var totalInvestasi = @json($totalInvestasi);

            var labels = Object.keys(totalInvestasi);
            var data = Object.values(totalInvestasi);

            var ctx4 = document.getElementById('investmentPieChart').getContext('2d');
            new Chart(ctx4, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Investasi',
                        data: data,
                        backgroundColor: [
                            'rgba(33, 156, 144, 0.6)',
                            'rgba(255, 244, 85, 0.6)',
                            'rgba(255, 199, 0, 0.6)',
                            'rgba(231, 233, 237, 0.5)'
                        ],
                        borderColor: [
                            'rgb(33, 156, 144)',
                            'rgb(255, 244, 85)',
                            'rgb(255, 199, 0)',
                            'rgba(231, 233, 237, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                }
            });

            // Piechart 5: Total Investsi Berdasarkan Jenis Usaha
            var totalInvestmentsByType = @json($totalInvestmentsByType);
            var businessTypeLabels = Object.keys(totalInvestmentsByType);
            var businessTypeData = Object.values(totalInvestmentsByType);

            var ctx5 = document.getElementById('businessTypePieChart').getContext('2d');
            new Chart(ctx5, {
                type: 'pie',
                data: {
                    labels: businessTypeLabels,
                    datasets: [{
                        label: 'Total Investasi Jenis Usaha',
                        data: businessTypeData,
                        backgroundColor: [
                            'rgba(124, 0, 254, 0.4)',
                            'rgba(249, 228, 0, 0.4)',
                            'rgba(245, 7, 9, 0.4)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(124, 0, 254, 1)',
                            'rgba(249, 228, 0, 1)',
                            'rgba(245, 7, 9, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        });
    </script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    
    <!-- Peta Sebaran Industri per Kelurahan -->
    <script>
        const mapkel = L.map('mapKelurahan').setView([-1.2654, 116.8312], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(mapkel);

        setTimeout(() => {
            mapkel.invalidateSize();
        }, 100);

        let jumlahIndustriKel = {};

        // Ambil jumlah industri per kelurahan dari API
        fetch('/api/industri-kelurahan')
            .then(res => res.json())
            .then(data => {
                // Simpan jumlah industri dengan nama kelurahan lowercase
                data.forEach(item => {
                    jumlahIndustriKel[item.kelurahan.toLowerCase()] = item;
                });

                // Load GeoJSON batas wilayah
                fetch('/Batas_Wilayah_Kelurahan_Kota_Balikpapan.geojson')
                    .then(res => res.json())
                    .then(geojson => {
                        L.geoJSON(geojson, {
                            style: function(feature) {
                                return {
                                    color: '#3388ff',
                                    weight: 0,
                                    fillOpacity: 0.1
                                };
                            },
                            onEachFeature: function(feature, layer) {
                                const nama = feature.properties.DESA_KEL || 'Tidak diketahui';
                                const dataKel = jumlahIndustriKel[nama.toLowerCase()] || {
                                    total_usaha: 0, mikro: 0, kecil: 0, menengah: 0, besar: 0,
                                    risiko_rendah: 0, risiko_menengah_rendah: 0, risiko_menengah_tinggi: 0, risiko_tinggi: 0,
                                    tenaga_laki: 0, tenaga_perempuan: 0, tenaga_asing: 0
                                };

                                // Tambahkan marker di tengah polygon
                                if (layer.getBounds && dataKel.total_usaha > 0) {
                                    const center = layer.getBounds().getCenter();
                                    L.marker(center)
                                        .addTo(mapkel)
                                        .bindPopup(`
                                            <b>${nama}</b><br>
                                            Jumlah Unit Usaha: ${dataKel.total_usaha}
                                            <br><br>

                                            <b>Skala Usaha</b>
                                            <ul>
                                                <li>Mikro: ${dataKel.mikro}</li>
                                                <li>Kecil: ${dataKel.kecil}</li>
                                                <li>Menengah: ${dataKel.menengah}</li>
                                                <li>Besar: ${dataKel.besar}</li>
                                            </ul>

                                            <b>Risiko Usaha</b>
                                            <ul>
                                                <li>Rendah: ${dataKel.risiko_rendah}</li>
                                                <li>Menengah Rendah: ${dataKel.risiko_menengah_rendah}</li>
                                                <li>Menengah Tinggi: ${dataKel.risiko_menengah_tinggi}</li>
                                                <li>Tinggi: ${dataKel.risiko_tinggi}</li>
                                            </ul>

                                            <b>Tenaga Kerja</b>
                                            <ul>
                                                <li>Laki-laki: ${dataKel.tenaga_laki}</li>
                                                <li>Perempuan: ${dataKel.tenaga_perempuan}</li>
                                                <li>Asing: ${dataKel.tenaga_asing}</li>
                                            </ul>
                                        `);
                                }
                            }
                        }).addTo(mapkel);
                    });
            });

        const mapkec = L.map('mapKecamatan').setView([-1.2654, 116.8312], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(mapkec);

        setTimeout(() => {
            mapkec.invalidateSize();
        }, 100);

            let jumlahIndustriKec = {};
        // Ambil jumlah industri per kelurahan dari API
        fetch('/api/industri-kecamatan')
            .then(res => res.json())
            .then(data => {
                // Simpan jumlah industri dengan nama kelurahan lowercase
                data.forEach(item => {
                    jumlahIndustriKec[item.kecamatan.toLowerCase()] = item;
                });

                // Load GeoJSON batas wilayah
                fetch('/Batas_Wilayah_Kecamatan_Kota_Balikpapan.geojson')
                    .then(res => res.json())
                    .then(geojson => {
                        L.geoJSON(geojson, {
                            style: function(feature) {
                                return {
                                    color: '#3388ff',
                                    weight: 0,
                                    fillOpacity: 0.1
                                };
                            },
                            onEachFeature: function(feature, layer) {
                                const nama = feature.properties.KEC_ || 'Tidak diketahui';
                                const dataKec = jumlahIndustriKec[nama.toLowerCase()] || {
                                    total_usaha: 0, mikro: 0, kecil: 0, menengah: 0, besar: 0,
                                    risiko_rendah: 0, risiko_menengah_rendah: 0, risiko_menengah_tinggi: 0, risiko_tinggi: 0,
                                    tenaga_laki: 0, tenaga_perempuan: 0, tenaga_asing: 0
                                };

                                // Tambahkan marker di tengah polygon
                                if (layer.getBounds && dataKec.total_usaha > 0) {
                                    const center = layer.getBounds().getCenter();
                                    L.marker(center)
                                        .addTo(mapkec)
                                        .bindPopup(`
                                            <b>${nama}</b><br>
                                            Jumlah Unit Usaha: ${dataKec.total_usaha}
                                            <br><br>

                                            <b>Skala Usaha</b>
                                            <ul>
                                                <li>Mikro: ${dataKec.mikro}</li>
                                                <li>Kecil: ${dataKec.kecil}</li>
                                                <li>Menengah: ${dataKec.menengah}</li>
                                                <li>Besar: ${dataKec.besar}</li>
                                            </ul>

                                            <b>Risiko Usaha</b>
                                            <ul>
                                                <li>Rendah: ${dataKec.risiko_rendah}</li>
                                                <li>Menengah Rendah: ${dataKec.risiko_menengah_rendah}</li>
                                                <li>Menengah Tinggi: ${dataKec.risiko_menengah_tinggi}</li>
                                                <li>Tinggi: ${dataKec.risiko_tinggi}</li>
                                            </ul>

                                            <b>Tenaga Kerja</b>
                                            <ul>
                                                <li>Laki-laki: ${dataKec.tenaga_laki}</li>
                                                <li>Perempuan: ${dataKec.tenaga_perempuan}</li>
                                                <li>Asing: ${dataKec.tenaga_asing}</li>
                                            </ul>
                                        `);
                                }
                            }
                        }).addTo(mapkec);
                    });
            });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var triwulanData = @json($triwulanData);
        var tahunanData = @json($tahunanData);

        console.log("Triwulan Data:", triwulanData); // cek isi datanya di console browser
        console.log("Tahunan Data:", tahunanData);

        if (!triwulanData || triwulanData.length === 0) {
            // Kalau data kosong, tampilkan teks pengganti
            var ctx = document.getElementById('lineChart').getContext('2d');
            ctx.font = "16px Arial";
            ctx.textAlign = "center";
            ctx.fillText("Data tidak tersedia", ctx.canvas.width / 2, ctx.canvas.height / 2);
            return;
        }

        // Labels: gabungan Q + Tahun
        var labels = [...new Set(triwulanData.map(item => `Q${item.triwulan} - ${item.tahun}`))];

        // Urutan skala usaha yang diinginkan
        var skalaUrut = ['Mikro', 'Kecil', 'Menengah', 'Besar'];
        
        // Ambil daftar skala usaha unik
        var skalaList = skalaUrut.filter(s => triwulanData.some(item => item.skala_usaha === s));

        // Warna untuk tiap skala usaha
        var colors = ['#e15759','#f28e2b','#4e79a7','#045718ff'];

        // Buat dataset untuk masing-masing skala usaha
        var datasets = skalaList.map((skala, idx) => {
            return {
                label: skala,
                data: labels.map(label => {
                    var [q, t] = label.split(" - ");
                    var tahun = t;
                    var triwulan = q.replace("Q", "");
                    var found = triwulanData.find(item => 
                        item.tahun == tahun &&
                        item.triwulan == triwulan &&
                        item.skala_usaha == skala
                    );
                    return found ? found.total : 0;
                }),
                backgroundColor: colors[idx % colors.length],
                stack: 'Stack 0 '
            }
        });

        // Hitung total per tahun
        var totalPerTahun = {};
        triwulanData.forEach(item => {
            if (!totalPerTahun[item.tahun]) {
                totalPerTahun[item.tahun] = 0;
            }
            totalPerTahun[item.tahun] += item.total;
        });

        // Data line chart: mapping total tahunan hanya muncul di Q4
        var dataTahunan = labels.map(label => {
            if (label.startsWith('Q4')) {
                var tahun = label.split(' - ')[1];
                var found = tahunanData.find(item => item.tahun == tahun);
                return found ? found.total : null;
            } else {
                return null;
            }
        });

        datasets.push({
            type: 'line',
            label: 'Tahun',
            data: dataTahunan,
            borderColor: 'grey',
            tension: 0.2,
            pointBackgroundColor: 'grey',
            pointRadius: 5,
            spanGaps: true,
            fill: false
        });

        // Render Chart
        var ctx = document.getElementById('lineChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Pertumbuhan Industri per Triwulan berdasarkan Skala Usaha'
                    },
                    legend: { position: 'bottom' }
                },
                scales: {
                    x: { stacked: true },
                    y: { stacked: true, beginAtZero: true }
                }
            }
        });
    });
</script>
@endsection