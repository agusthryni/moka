@extends('layout.main')

@section('title', 'MOKA | DASHBOARD')

@section('content')
    <section class="content-header text-center py-5 mt-5">
        <div class="container-fluid">
            <h1 class="text-success font-weight-bold mb-1">LAPORAN DAN MONEV KINERJA PEGAWAI</h1>
            <h6 class="text-success">Dinas Koperasi, UMKM, dan Perindustrian Kota Balikpapan</h6>
            <a href="{{ route('data-industri.input') }}" class="btn btn-success btn-lg mt-4">Masukkan Laporan</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Flash messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- === Form Filter Awal === --}}
            <section class="content">     
                <form id="filterForm" class="form-horizontal" style="max-width: 600px;">
                    <div class="form-group row mb-3">
                        <label for="periode" class="col-sm-3 font-weight-normal">Periode</label>
                        <div class="col-sm-6">
                            <select id="periode" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="jenisData" class="col-sm-3 font-weight-normal">Bidang</label>
                        <div class="col-sm-6">
                            <select id="jenisData" class="form-control">
                                <option value="">Pilih Bidang</option>
                                <option value="semua">Semua Bidang</option>
                                <option value="mikro">Sekretariat</option>
                                <option value="kecil">TSDI</option>
                                <option value="menengah">IKM</option>
                                <option value="besar">Koperasi</option>
                                <option value="upt">UPT</option>
                            </select>
                        </div>
                        <div class="col-sm-3 d-flex">
                            <button type="submit" class="btn btn-success">Cari</button>
                        </div>
                    </div>
                </form>
                <!-- Hasil informasi filter -->
                <div id="infoData" style="margin-top: 30px; display:none;">
                    <h5>
                        <span id="judulData">Kapasitas Produksi (0 Laporan)</span>
                    </h5>
                    <small class="text-muted fst-italic" id="tanggalData">
                        Data per tanggal -
                    </small>
                    <hr>
                </div>
            </section>

            {{-- === Tabel Data Industri === --}}
            <div id="dataContainer" class="row" style="display: none;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-sm compact display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelapor</th>
                                        <th>Jabatan Pelapor</th>
                                        <th>Nama Pimpinan Monev</th>
                                        <th>Jabatan Pimpinan Monev</th>
                                        <th>Program</th>
                                        <th>Indikator Program</th>
                                        <th>Satuan</th>
                                        <th>Target</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Pagu</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Keterangan</th>
                                        <th>Faktor Pendorong</th>
                                        <th>Faktor Penghambat</th>
                                        <th>Rekomendasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelakuUsaha as $usaha)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $usaha->nama }}</td>
                                            <td>{{ $usaha->NIB }}</td>
                                            <td>{{ $usaha->jenis_badan_usaha }}</td>
                                            <td>{{ $usaha->id_kbli }}</td>
                                            <td>{{ optional($usaha->kbli)->jenis_kbli }}</td>
                                            <td>{{ $usaha->skala_usaha }}</td>
                                            <td>{{ $usaha->risiko }}</td>
                                            <td>{{ \Carbon\Carbon::parse($usaha->tanggal_permohonan)->format('Y-m-d') }}</td>
                                            <td>{{ $usaha->jenis_proyek }}</td>
                                            <td>{{ $usaha->email }}</td>
                                            <td>{{ $usaha->no_telp }}</td>
                                            <td>{{ $usaha->alamat->alamat_usaha }}</td>
                                            <td>{{ $usaha->alamat->kecamatan }}</td>
                                            <td>{{ $usaha->alamat->kelurahan }}</td>
                                            <td>{{ $usaha->tenagaKerja->jumlah_tki_perempuan + $usaha->tenagaKerja->jumlah_tki_laki_laki + $usaha->tenagaKerja->jumlah_tenaga_kerja_asing }}</td>
                                            <td>{{ $usaha->investasi->modal_usaha }}</td>
                                            <td>{{ $usaha->investasi->investasi_mesin }}</td>
                                            <td>
                                                <a href="{{ route('data-industri.edit', $usaha->id_usaha) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('data-industri.delete', $usaha->id_usaha) }}')">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                responsive: false,
                scrollX: true,
                columnDefs: [
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                    className: 'dt-head-center'
                ],
                columns: [
                    {data: "null"},
                    {data: "nama"},
                    {data: "NIB"},
                    {data: "jenis_badan_usaha"},
                    {data: "id_kbli"},
                    {data: "kbli.jenis_kbli"},
                    {data: "kbli.kode_kbli"},
                    {data: "skala_usaha"},
                    {data: "risiko"},
                    {data: "tanggal_permohonan", render: function(data, type, row) {return moment(data).format('YYYY-MM-DD');}},
                    {data: "jenis_proyek"},
                    {data: "email"},
                    {data: "no_telp"},
                    {data: "alamat.alamat_usaha"},
                    {data: "alamat.kecamatan"},
                    {data: "alamat.kelurahan"},
                    {data: "total_tenaga_kerja"},
                    {data: "investasi.modal_usaha"},
                    {data: "investasi.investasi_mesin"},
                    {data: "aksi"}
                ]
            });
        });

        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filter = document.getElementById('filter');
            const keyword = document.getElementById('keyword');
            const enumValue = document.getElementById('enum_value');

            const enumOptions = {
                'jenis_badan_usaha': ['Perseorangan', 'PT', 'CV', 'PT Perseorangan', 'Badan Hukum Lainnya', 'Badan Layanan Umum', 'Koperasi', 'Persekutuan dan Perkumpulan', 'Perusahaan Umum', 'Yayasan'],
                'skala_usaha': ['Mikro', 'Kecil', 'Menengah', 'Besar'],
                'risiko': ['Rendah', 'Menengah Rendah', 'Menengah Tinggi', 'Tinggi'],
                'jenis_proyek': ['Utama', 'Pendukung','Perluasan'],
                'kecamatan': ['Balikpapan Selatan', 'Balikpapan Kota', 'Balikpapan Timur', 'Balikpapan Utara',
                    'Balikpapan Tengah', 'Balikpapan Barat'
                ],
                'kelurahan': ['Gunung Bahagia', 'Sepinggan', 'Damai Baru', 'Damai Bahagia', 'Sungai Nangka',
                    'Sepinggan Raya', 'Sepinggan Baru', 'Prapatan', 'Telaga Sari', 'Klandasan Ulu',
                    'Klandasan Ilir', 'Damai', 'Manggar', 'Manggar Baru', 'Lamaru', 'Teritip',
                    'Muara Rapak', 'Gunung Samarinda', 'Batu Ampar', 'Karang Joang',
                    'Gunung Samarinda Baru', 'Margo Mulyo', 'Batu Ampar Timur', 'Marga Sari', 'Karang Rejo',
                    'Karang Jati'
                ],
                'bidang': ['Sekretariat', 'TSDI', 'IKM', 'Koperasi', 'UPT']
            };

            filter.addEventListener('change', function() {
                if (enumOptions[filter.value]) {
                    enumValue.style.display = 'block';
                    keyword.style.display = 'none';

                    enumValue.innerHTML = enumOptions[filter.value].map(option =>
                        `<option value="${option}">${option}</option>`).join('');
                } else {
                    enumValue.style.display = 'none';
                    keyword.style.display = 'block';
                }
            });
        });
    </script>

    <script>
        const selectPeriode = document.getElementById("periode");
        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth() + 1;

        // Hitung triwulan saat ini
        const currentTriwulan = Math.ceil(currentMonth / 3);

        // Generate 4 triwulan untuk tahun ini (dari recent ke lama)
        selectPeriode.innerHTML = `<option value="">Pilih Periode</option>`;
        
        for (let i = 4; i >= 1; i--) {
            const selected = (i === currentTriwulan) ? "selected" : "";
            const option = document.createElement("option");
            option.value = i;
            option.text = `Triwulan ${i} ${currentYear}`;
            option.selected = selected !== "";
            selectPeriode.add(option);
        }
    </script>

    <script>
        // === Form Filter: tampilkan tabel setelah klik submit ===
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const periode = document.getElementById('periode').value;
            const jenisData = document.getElementById('jenisData').value;

            if (!periode || !jenisData) {
                Swal.fire('Peringatan', 'Silakan pilih Periode dan Bidang terlebih dahulu.', 'warning');
                return;
            }

            // Simulasi jumlah laporan (nanti bisa dari API)
            const jumlahLaporan = Math.floor(Math.random() * 100) + 1;

            // Format tanggal sekarang
            const now = new Date().toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' });

            // Isi infoData
            document.getElementById('judulData').innerText =
                `${jenisData.charAt(0).toUpperCase() + jenisData.slice(1)} (${jumlahLaporan} Laporan)`;

            document.getElementById('tanggalData').innerText =
                `Data per tanggal ${now}`;

            document.getElementById('infoData').style.display = 'block';

            // tampilkan tabel
            document.getElementById('dataContainer').style.display = 'block';

            // inisialisasi DataTable
            if (!$.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable({
                    responsive: false,
                    scrollX: true
                });
            }
        });
    </script>
@endsection