@extends('layout.main')

@section('title', 'SIIBA | Data Industri')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Industri di Balikpapan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Data Industri</li>
                    </ol>
                </div>
            </div>
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

            {{-- filter pencarian --}}
            <div class="row mb-2">
                <div class="col-12-md-6">
                    <form action="{{ route('data-industri') }}" method="GET" class="form-inline">
                        <div class="form-group mr-2">
                            <label for="filter" class="ml-3 mr-1">Filter berdasarkan:</label>
                            <select name="filter" id="filter" class="form-control">
                                <option value="nama">Nama</option>
                                <option value="nib">NIB</option>
                                <option value="id_kbli">ID KBLI</option>
                                <option value="jenis_badan_usaha">Jenis Badan Usaha</option>
                                <option value="skala_usaha">Skala Usaha</option>
                                <option value="risiko">Risiko</option>
                                <option value="jenis_proyek">Jenis Proyek</option>
                                <option value="kecamatan">Kecamatan</option>
                                <option value="kelurahan">Kelurahan</option>
                                <option value="jumlah_tki_laki_laki">Tenaga Kerja Laki-laki</option>
                                <option value="jumlah_tki_perempuan">Tenaga Kerja Perempuan</option>
                                <option value="jumlah_tenaga_kerja_asing">Tenaga Kerja Asing</option>
                                <option value="total">Total Tenaga Kerja</option>
                                <option value="modal_usaha">Modal Usaha</option>
                                <option value="investasi_mesin">Investasi Mesin</option>
                                <option value="investasi_lainnya">Investasi Lainnya</option>
                                <option value="total_investasi">Total Investasi</option>
                                <option value="nama_produk">Nama Produk</option>
                                <option value="kapasitas">Kapasitas</option>
                                <option value="satuan">Satuan</option>
                                <option value="status_siinas">Status Akun Siinas</option>
                                <option value="tanggal_registrasi_siinas">Tanggal Registrasi Siinas</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <input type="text" name="keyword" id="keyword" class="form-control"
                                placeholder="Masukkan kata kunci">
                            <select name="enum_value" id="enum_value" class="form-control" style="display: none;">
                                <option value="">-- Pilih --</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </form>
                </div>
            </div>
            {{-- end of filter --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Seluruh Data IKM di Balikpapan</h3>
                        </div>

                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <a href="{{ route('data-industri.input') }}" class="btn btn-primary">Tambah Data</a>
                                    <a href="{{ route('data-industri') }}" class="btn btn-info ml-1">
                                        <img src="{{ asset('images/refresh.png') }}" alt="Refresh Icon"
                                            style="width: 21px; height: 21px; padding: 1px;"> Muat Ulang
                                    </a>
                                </div>
                            </div>
                            <table id="example1" class="table table-bordered table-striped table-sm compact display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIB</th>
                                        <th>Jenis Badan Usaha</th>
                                        <th>KBLI</th>
                                        <th>Jenis KBLI</th>
                                        <th>Skala Usaha</th>
                                        <th>Risiko Usaha</th>
                                        <th>Tanggal Permohonan</th>
                                        <th>Jenis Proyek</th>
                                        <th>Email</th>
                                        <th>No Telp</th>
                                        <th>Alamat</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan</th>
                                        <th>Jumlah TKI Laki-laki</th>
                                        <th>Jumlah TKI Perempuan</th>
                                        <th>Jumlah Tenaga Kerja Asing</th>
                                        <th>Total Tenaga Kerja</th>
                                        <th>Modal Usaha</th>
                                        <th>Investasi Mesin</th>
                                        <th>Investasi Lainnya</th>
                                        <th>Total Investasi</th>
                                        <th>Nama Produk</th>
                                        <th>Kapasitas</th>
                                        <th>Satuan</th>
                                        <th>Status SIINAS</th>
                                        <th>Tanggal Registrasi SIINAS</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelakuUsaha as $usaha)
                                        <tr>
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
                                            <td>{{ $usaha->tenagaKerja->jumlah_tki_perempuan }}</td>
                                            <td>{{ $usaha->tenagaKerja->jumlah_tki_laki_laki }}</td>
                                            <td>{{ $usaha->tenagaKerja->jumlah_tenaga_kerja_asing }}</td>
                                            <td>{{ $usaha->tenagaKerja->jumlah_tki_perempuan + $usaha->tenagaKerja->jumlah_tki_laki_laki + $usaha->tenagaKerja->jumlah_tenaga_kerja_asing }}</td>
                                            <td>{{ $usaha->investasi->modal_usaha }}</td>
                                            <td>{{ $usaha->investasi->investasi_mesin }}</td>
                                            <td>{{ $usaha->investasi->investasi_lainnya }}</td>
                                            <td>{{ $usaha->investasi->modal_usaha + $usaha->investasi->investasi_mesin + $usaha->investasi->investasi_lainnya }}</td>
                                            <td>
                                                @foreach($usaha->kapasitasProduksi as $produksi)
                                                    <div>{{ $produksi->nama_produk ?? '-' }}</div>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($usaha->kapasitasProduksi as $produksi)
                                                    <div>{{ $produksi->kapasitas ?? '-' }}</div>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($usaha->kapasitasProduksi as $produksi)
                                                    <div>{{ $produksi->satuan ?? '-' }}</div>
                                                @endforeach
                                            </td>
                                            <td>{{ $usaha->status_siinas }}</td>
                                            <td>{{ $usaha->tanggal_registrasi_siinas }}</td>
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
                scrollX: true
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                    className: 'dt-head-center'
                }],
                columns: [
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
                    {data: "tenagaKerja.jumlah_tki_laki_laki"},
                    {data: "tenagaKerja.jumlah_tki_perempuan"},
                    {data: "tenagaKerja.jumlah_tenaga_kerja_asing"},
                    {data: "total_tenaga_kerja"},
                    {data: "investasi.modal_usaha"},
                    {data: "investasi.investasi_mesin"},
                    {data: "investasi.investasi_lainnya"},
                    {data: "total_investasi"},
                    {data: "produk.nama_produk"},
                    {data: "produk.kapasitas"},
                    {data: "produk.satuan"},
                    {data: "status_siinas"},
                    {data: "tanggal_registrasi_siinas"},
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
                ]
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
@endsection
