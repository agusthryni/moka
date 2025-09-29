@extends('layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Input Data Industri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/siiba/data-industri') }}">Data Industri</a></li>
                        <li class="breadcrumb-item active">Tambah Data Industri</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <!-- Card for Data Pelaku Usaha -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Data Pelaku Usaha</h3>
                    </div>
                    <form action="{{ route('data-industri.store') }}" method="post" id="data-industri-form">
                        @csrf
                        {{-- Pelaku Usaha --}}
                        <div class="card-body">
                            <!-- Data Pelaku Usaha -->
                            <!-- Nama -->
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <!-- NIB -->
                            <div class="form-group">
                                <label for="NIB">NIB</label>
                                <input type="text" class="form-control" id="NIB" name="NIB" required>
                            </div>
                            <!-- Jenis Badan Usaha -->
                            <div class="form-group">
                                <label for="jenis_badan_usaha">Jenis Badan Usaha</label>
                                <select class="form-control" id="jenis_badan_usaha" id="jenis_badan_usaha" name="jenis_badan_usaha" required>
                                    <option value="perseorangan">Perseorangan</option>
                                    <option value="PT">PT</option>
                                    <option value="CV">CV</option>
                                    <option value="PT Perseorangan">PT Perseorangan</option>
                                    <option value="Badan Hukum Lainnya">Badan Hukum Lainnya</option>
                                    <option value="Badan Layanan Umum">Badan Layanan Umum</option>
                                    <option value="Koperasi">Koperasi</option>
                                    <option value="Persekutuan dan Perkumpulan">Persekutuan dan Perkumpulan</option>
                                    <option value="Perusahaan Umum">Perusahaan Umum</option>
                                    <option value="Yayasan">Yayasan</option>
                                </select>
                            </div>
                            <!-- Skala Usaha -->
                            <div class="form-group">
                                <label for="skala_usaha">Skala Usaha</label>
                                <select class="form-control" id="skala_usaha" name="skala_usaha" required>
                                    <option value="Mikro">Mikro</option>
                                    <option value="Kecil">Kecil</option>
                                    <option value="Menengah">Menengah</option>
                                    <option value="Besar">Besar</option>
                                </select>
                            </div>
                            <!-- Risiko -->
                            <div class="form-group">
                                <label for="risiko">Risiko Usaha</label>
                                <select class="form-control" id="risiko" name="risiko" required>
                                    <option value="Rendah">Rendah</option>
                                    <option value="Menengah Rendah">Menengah Rendah</option>
                                    <option value="Menengah Tinggi">Menengah Tinggi</option>
                                    <option value="Tinggi">Tinggi</option>
                                </select>
                            </div>
                            <!-- Jenis Proyek -->
                            <div class="form-group">
                                <label for="jenis_proyek">Jenis Proyek</label>
                                <select class="form-control" id="jenis_proyek" name="jenis_proyek" required>
                                    <option value="Utama">Utama</option>
                                    <option value="Pendukung">Pendukung</option>
                                    <option value="Perluasan">Perluasan</option>
                                </select>
                            </div>
                            <!-- Tanggal Permohonan -->
                            <div class="form-group">
                                <label for="tanggal_permohonan">Tanggal Permohonan</label>
                                <input type="date" class="form-control" id="tanggal_permohonan" name="tanggal_permohonan"
                                    required>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <!-- No. Telepon -->
                            <div class="form-group">
                                <label for="no_telp">No. Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                            </div>
                            <!-- KBLI -->
                            <div class="form-group">
                                <label for="id_kbli">KBLI</label>
                                <select class="form-control" id="id_kbli" name="id_kbli" required>
                                    @foreach ($kbli as $k)
                                        <option value="{{ $k->id_kbli }}">{{ $k->id_kbli }} - {{ $k->jenis_kbli }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Alamat Usaha -->
                            <div class="form-group">
                                <label for="alamat_usaha">Alamat Usaha</label>
                                <input type="text" class="form-control" id="alamat_usaha" name="alamat_usaha" required>
                            </div>
                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="Balikpapan Selatan">Balikpapan Selatan</option>
                                    <option value="Balikpapan Kota">Balikpapan Kota</option>
                                    <option value="Balikpapan Timur">Balikpapan Timur</option>
                                    <option value="Balikpapan Utara">Balikpapan Utara</option>
                                    <option value="Balikpapan Tengah">Balikpapan Tengah</option>
                                    <option value="Balikpapan Barat">Balikpapan Barat</option>
                                </select>
                            </div>
                            <!-- Kelurahan -->
                            <div class="form-group">
                                <label for="kelurahan">Kelurahan</label>
                                <select class="form-control" id="kelurahan" name="kelurahan" required>
                                    <!-- Opsi ini akan diisi dengan JavaScript berdasarkan pilihan Kecamatan -->
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        {{-- Tenaga Kerja --}}
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Input Data Tenaga Kerja</h3>
                            </div>
                            <div class="card-body">
                                <!-- Jumlah TKI Laki-laki -->
                                <div class="form-group">
                                    <label for="jumlah_tki_laki_laki">Jumlah TKI Laki-laki</label>
                                    <input type="number" class="form-control" id="jumlah_tki_laki_laki"
                                        name="jumlah_tki_laki_laki" required>
                                </div>
                                <!-- Jumlah TKI Perempuan -->
                                <div class="form-group">
                                    <label for="jumlah_tki_perempuan">Jumlah TKI Perempuan</label>
                                    <input type="number" class="form-control" id="jumlah_tki_perempuan"
                                        name="jumlah_tki_perempuan" required>
                                </div>
                                <!-- Jumlah Tenaga Kerja Asing -->
                                <div class="form-group">
                                    <label for="jumlah_tenaga_kerja_asing">Jumlah Tenaga Kerja Asing</label>
                                    <input type="number" class="form-control" id="jumlah_tenaga_kerja_asing"
                                        name="jumlah_tenaga_kerja_asing" required>
                                </div>
                            </div>
                        </div>

                        {{-- Investasi --}}
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Input Data Investasi</h3>
                            </div>
                            <div class="card-body">
                                <!-- Modal Usaha -->
                                <div class="form-group">
                                    <label for="modal_usaha">Modal Usaha</label>
                                    <input type="number" class="form-control" id="modal_usaha" name="modal_usaha"
                                        step="0" required>
                                </div>
                                <!-- Investasi Mesin -->
                                <div class="form-group">
                                    <label for="investasi_mesin">Investasi Mesin</label>
                                    <input type="number" class="form-control" id="investasi_mesin"
                                        name="investasi_mesin" required>
                                </div>
                                <!-- Investasi Lainnya -->
                                <div class="form-group">
                                    <label for="investasi_lainnya">Investasi Lainnya</label>
                                    <input type="number" class="form-control" id="investasi_lainnya"
                                        name="investasi_lainnya" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Input Data Produk</h3>
                            </div>
                            <div class="card-body">
                                <div id="produk-container">
                                    <div class="produk-item">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" id="nama_produk"
                                                name="nama_produk[]" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_kbli">KBLI</label>
                                            <select class="form-control" id="id_kbli" name="id_kbli_produk[]" required>
                                                @foreach ($kbli as $k)
                                                    <option value="{{ $k->id_kbli }}">{{ $k->id_kbli }} -
                                                        {{ $k->jenis_kbli }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kapasitas">Kapasitas</label>
                                            <input type="number" class="form-control" id="kapasitas" name="kapasitas[]"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" id="satuan" name="satuan[]"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_siinas">Status Akun Siinas</label>
                                            <select class="form-control" id="status_siinas" name="status_siinas" required>
                                                <option value="Terdaftar">Terdaftar</option>
                                                <option value="Tidak Terdaftar">Tidak Terdaftar</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_registrasi_siinas">Tanggal Registrasi Siinas</label>
                                            <input type="date" class="form-control" id="tanggal_registrasi_siinas" name="tanggal_registrasi_siinas[]"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mt-2" id="add-produk">Tambah
                                    Produk</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary ml-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('kecamatan').addEventListener('change', function() {
                var kecamatan = this.value;
                var kelurahanSelect = document.getElementById('kelurahan');

                // Bersihkan opsi sebelum memuat yang baru
                kelurahanSelect.innerHTML = '';

                // Tambahkan opsi kelurahan sesuai dengan kecamatan yang dipilih
                if (kecamatan === 'Balikpapan Selatan') {
                    var kelurahanOptions = [
                        'Gunung Bahagia',
                        'Sepinggan',
                        'Damai Baru',
                        'Damai Bahagia',
                        'Sungai Nangka',
                        'Sepinggan Raya',
                        'Sepinggan Baru'
                    ];
                } else if (kecamatan === 'Balikpapan Kota') {
                    var kelurahanOptions = [
                        'Prapatan',
                        'Telaga Sari',
                        'Klandasan Ulu',
                        'Klandasan Ilir',
                        'Damai'
                    ];
                } else if (kecamatan === 'Balikpapan Barat') {
                    var kelurahanOptions = [
                        'Baru Tengah',
                        'Margasari',
                        'Margo Mulyo',
                        'Baru Ulu',
                        'Baru Ilir',
                        'Kariangau'
                    ];
                } else if (kecamatan === 'Balikpapan Timur') {
                    var kelurahanOptions = [
                        'Manggar',
                        'Manggar Baru',
                        'Lamaru',
                        'Teritip'
                    ];
                } else if (kecamatan === 'Balikpapan Utara') {
                    var kelurahanOptions = [
                        'Muara Rapak',
                        'Gunung Samarinda',
                        'Batu Ampar',
                        'Karang Joang',
                        'Gunung Samarinda Baru',
                        'Graha Indah'
                    ];
                } else if (kecamatan === 'Balikpapan Tengah') {
                    var kelurahanOptions = [
                        'Gunung Sari Ilir',
                        'Gunung Sari Ulu',
                        'Mekar Sari',
                        'Karang Rejo',
                        'Sumber Rejo',
                        'Karang Jati'
                    ];
                }
                // Tambahkan opsi ke dalam select
                kelurahanOptions.forEach(function(kelurahan) {
                    var option = document.createElement('option');
                    option.value = kelurahan;
                    option.text = kelurahan;
                    kelurahanSelect.appendChild(option);
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#data-industri-form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('data-industri.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                }).then(function() {
                                    window.location.href = "{{ url('/siiba/data-industri') }}";
                                });
                            }
                        },
                        error: function(response) {
                            if (response.status === 400) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.responseJSON.message,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat mengirim data.',
                                });
                            }
                        }
                    });
                });
            });
        </script>

        <script>
            document.getElementById('add-produk').addEventListener('click', function() {
                var produkContainer = document.getElementById('produk-container');
                var newProdukItem = document.createElement('div');
                newProdukItem.classList.add('produk-item');
                newProdukItem.innerHTML = `
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" name="nama_produk[]" required>
                </div>
                <div class="form-group">
                    <label for="id_kbli">KBLI</label>
                    <select class="form-control" id="id_kbli" name="id_kbli_produk[]" required>
                        @foreach ($kbli as $k)
                            <option value="{{ $k->id_kbli }}">{{ $k->id_kbli }} -
                                {{ $k->jenis_kbli }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kapasitas">Kapasitas</label>
                    <input type="number" class="form-control" name="kapasitas[]" required>
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" class="form-control" name="satuan[]" required>
                </div>
                <button type="button" class="btn btn-danger remove-produk">Hapus Produk</button>
            `;
                produkContainer.appendChild(newProdukItem);
            });

            document.getElementById('produk-container').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-produk')) {
                    e.target.closest('.produk-item').remove();
                }
            });
        </script>
    @endsection
