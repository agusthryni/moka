@extends('layout.main')

@section('title', 'SIIBA | Edit Data Industri')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data Industri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/siiba/data-industri') }}">Data Industri</a></li>
                        <li class="breadcrumb-item active">Edit Data Industri</li>
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
                        <h3 class="card-title">Edit Data Pelaku Usaha</h3>
                    </div>
                    <form action="{{ route('data-industri.update', $pelakuUsaha->id_usaha) }}" method="post"
                        id="data-industri-update">
                        @csrf
                        @method('PUT')
                        {{-- Pelaku Usaha --}}
                        <div class="card-body">
                            <!-- Data Pelaku Usaha -->
                            <!-- Nama -->
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ $pelakuUsaha->nama }}" required>
                            </div>
                            <!-- NIB -->
                            <div class="form-group">
                                <label for="NIB">NIB</label>
                                <input type="text" class="form-control" id="NIB" name="NIB"
                                    value="{{ $pelakuUsaha->NIB }}" required>
                            </div>
                            <!-- Jenis Badan Usaha -->
                            <div class="form-group">
                                <label for="jenis_badan_usaha">Jenis Badan Usaha</label>
                                <select class="form-control" id="jenis_badan_usaha" name="jenis_badan_usaha" required>
                                    <option value="perseorangan"
                                        {{ $pelakuUsaha->jenis_badan_usaha == 'perseorangan' ? 'selected' : '' }}>
                                        Perseorangan</option>
                                    <option value="PT" {{ $pelakuUsaha->jenis_badan_usaha == 'PT' ? 'selected' : '' }}>
                                        PT</option>
                                    <option value="CV" {{ $pelakuUsaha->jenis_badan_usaha == 'CV' ? 'selected' : '' }}>
                                        CV</option>
                                    <option value="PT Perseorangan" {{ $pelakuUsaha->jenis_badan_usaha == 'PT Perseorangan' ? 'selected' : '' }}>
                                        PT Perseorangan</option>
                                    <option value="Badan Hukum Lainnya" {{ $pelakuUsaha->jenis_badan_usaha == 'Badan Hukum Lainnya' ? 'selected' : '' }}>
                                        Badan Hukum Lainnya</option>
                                    <option value="Badan Layanan Umum" {{ $pelakuUsaha->jenis_badan_usaha == 'Badan Layanan Umum' ? 'selected' : '' }}>
                                        Badan Layanan Umum</option>
                                    <option value="Koperasi" {{ $pelakuUsaha->jenis_badan_usaha == 'Koperasi' ? 'selected' : '' }}>
                                        Koperasi</option>
                                    <option value="Persekutuan dan Perkumpulan" {{ $pelakuUsaha->jenis_badan_usaha == 'Persekutuan dan Perkumpulan' ? 'selected' : '' }}>
                                        Persekutuan dan Perkumpulan</option>
                                    <option value="Perusahaan Umum" {{ $pelakuUsaha->jenis_badan_usaha == 'Perusahaan Umum' ? 'selected' : '' }}>
                                        Perusahaan Umum</option>
                                    <option value="Yayasan" {{ $pelakuUsaha->jenis_badan_usaha == 'Yayasan' ? 'selected' : '' }}>
                                        Yayasan</option>
                                </select>
                            </div>
                            <!-- Skala Usaha -->
                            <div class="form-group">
                                <label for="skala_usaha">Skala Usaha</label>
                                <select class="form-control" id="skala_usaha" name="skala_usaha" required>
                                    <option value="Mikro" {{ $pelakuUsaha->skala_usaha == 'Mikro' ? 'selected' : '' }}>
                                        Mikro</option>
                                    <option value="Kecil" {{ $pelakuUsaha->skala_usaha == 'Kecil' ? 'selected' : '' }}>
                                        Kecil</option>
                                    <option value="Menengah"
                                        {{ $pelakuUsaha->skala_usaha == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                                    <option value="Besar" {{ $pelakuUsaha->skala_usaha == 'Besar' ? 'selected' : '' }}>
                                        Besar</option>
                                </select>
                            </div>
                            <!-- Risiko -->
                            <div class="form-group">
                                <label for="risiko">Risiko Usaha</label>
                                <select class="form-control" id="risiko" name="risiko" required>
                                    <option value="Rendah" {{ $pelakuUsaha->risiko == 'Rendah' ? 'selected' : '' }}>Rendah
                                    </option>
                                    <option value="Menengah Rendah"
                                        {{ $pelakuUsaha->risiko == 'Menengah Rendah' ? 'selected' : '' }}>Menengah Rendah
                                    </option>
                                    <option value="Menengah Tinggi"
                                        {{ $pelakuUsaha->risiko == 'Menengah Tinggi' ? 'selected' : '' }}>Menengah Tinggi
                                    </option>
                                    <option value="Tinggi" {{ $pelakuUsaha->risiko == 'Tinggi' ? 'selected' : '' }}>Tinggi
                                    </option>
                                </select>
                            </div>
                            <!-- Jenis Proyek -->
                            <div class="form-group">
                                <label for="jenis_proyek">Jenis Proyek</label>
                                <select class="form-control" id="jenis_proyek" name="jenis_proyek" required>
                                    <option value="Utama" {{ $pelakuUsaha->jenis_proyek == 'Utama' ? 'selected' : '' }}>
                                        Utama</option>
                                    <option value="Pendukung"
                                        {{ $pelakuUsaha->jenis_proyek == 'Pendukung' ? 'selected' : '' }}>Pendukung
                                    </option>
                                    <option value="Perluasan"
                                        {{ $pelakuUsaha->jenis_proyek == 'Perluasan' ? 'selected' : '' }}>Perluasan
                                    </option>
                                </select>
                            </div>
                            <!-- Tanggal Permohonan -->
                            <div class="form-group">
                                <label for="tanggal_permohonan">Tanggal Permohonan</label>
                                <input type="date" class="form-control" id="tanggal_permohonan" name="tanggal_permohonan"
                                    value="{{ \Carbon\Carbon::parse($pelakuUsaha->tanggal_permohonan)->format('Y-m-d') }}"
                                    required>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" i d="email" name="email"
                                    value="{{ $pelakuUsaha->email }}" required>
                            </div>
                            <!-- No. Telepon -->
                            <div class="form-group">
                                <label for="no_telp">No. Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp"
                                    value="{{ $pelakuUsaha->no_telp }}" required>
                            </div>
                            <!-- KBLI -->
                            <div class="form-group">
                                <label for="id_kbli">KBLI</label>
                                <select class="form-control" id="id_kbli" name="id_kbli" required>
                                    @foreach ($kbli as $k)
                                        <option value="{{ $k->id_kbli }}"
                                            {{ $k->id_kbli == $pelakuUsaha->id_kbli ? 'selected' : '' }}>
                                            {{ $k->id_kbli }} - {{ $k->jenis_kbli }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Alamat Usaha -->
                            <div class="form-group">
                                <label for="alamat_usaha">Alamat Usaha</label>
                                <input type="text" class="form-control" id="alamat_usaha" name="alamat_usaha"
                                    value="{{ $pelakuUsaha->alamat->alamat_usaha }}" required>
                            </div>
                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatan as $kc)
                                        <option value="{{ $kc }}"
                                            {{ $kc == $pelakuUsaha->alamat->kecamatan ? 'selected' : '' }}>
                                            {{ $kc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Kelurahan -->
                            <div class="form-group">
                                <label for="kelurahan">Kelurahan</label>
                                <select class="form-control" id="kelurahan" name="kelurahan" required>
                                    <!-- Opsi ini akan diisi dengan JavaScript berdasarkan pilihan Kecamatan -->
                                    <option value="{{ $pelakuUsaha->alamat->kelurahan }}">
                                        {{ $pelakuUsaha->alamat->kelurahan }}</option>
                                </select>
                            </div>

                        </div>
                        <!-- Input Data Tenaga Kerja -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Data Tenaga Kerja</h3>
                            </div>
                            <div class="card-body">
                                <!-- Jumlah TKI Laki-laki -->
                                <div class="form-group">
                                    <label for="jumlah_tki_laki_laki">Jumlah TKI Laki-laki</label>
                                    <input type="number" class="form-control" id="jumlah_tki_laki_laki"
                                        name="jumlah_tki_laki_laki"
                                        value="{{ $pelakuUsaha->tenagaKerja->jumlah_tki_laki_laki }}" required>
                                </div>
                                <!-- Jumlah TKI Perempuan -->
                                <div class="form-group">
                                    <label for="jumlah_tki_perempuan">Jumlah TKI Perempuan</label>
                                    <input type="number" class="form-control" id="jumlah_tki_perempuan"
                                        name="jumlah_tki_perempuan"
                                        value="{{ $pelakuUsaha->tenagaKerja->jumlah_tki_perempuan ?? '' }}" required>
                                </div>
                                <!-- Jumlah Tenaga Kerja Asing -->
                                <div class="form-group">
                                    <label for="jumlah_tenaga_kerja_asing">Jumlah Tenaga Kerja Asing</label>
                                    <input type="number" class="form-control" id="jumlah_tenaga_kerja_asing"
                                        name="jumlah_tenaga_kerja_asing"
                                        value="{{ $pelakuUsaha->tenagaKerja->jumlah_tenaga_kerja_asing ?? '' }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Input Data Investasi -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Data Investasi</h3>
                            </div>
                            <div class="card-body">
                                <!-- Modal Usaha -->
                                <div class="form-group">
                                    <label for="modal_usaha">Modal Usaha</label>
                                    <input type="number" class="form-control" id="modal_usaha" name="modal_usaha"
                                        step="0" value="{{ $pelakuUsaha->investasi->modal_usaha }}" required>
                                </div>
                                <!-- Investasi Mesin -->
                                <div class="form-group">
                                    <label for="investasi_mesin">Investasi Mesin</label>
                                    <input type="number" class="form-control" id="investasi_mesin"
                                        name="investasi_mesin" step="0.01"
                                        value="{{ $pelakuUsaha->investasi->investasi_mesin }}" required>
                                </div>
                                <!-- Investasi Lainnya -->
                                <div class="form-group">
                                    <label for="investasi_lainnya">Investasi Lainnya</label>
                                    <input type="number" class="form-control" id="investasi_lainnya"
                                        name="investasi_lainnya" step="0.01"
                                        value="{{ $pelakuUsaha->investasi->investasi_lainnya }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- Data Kapasitas Produk --}}
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Data Produk</h3>
                            </div>
                            <div class="card-body">
                                <div id="produk-container">
                                    @foreach ($produk as $index => $p)
                                        <div class="produk-item">
                                            <div class="form-group">
                                                <label for="nama_produk[]">Nama Produk</label>
                                                <input type="text" class="form-control" id="nama_produk[]"
                                                    name="nama_produk[]" value="{{ $p->nama_produk }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_kbli_produk[]">KBLI</label>
                                                <select class="form-control" id="id_kbli_produk[]"
                                                    name="id_kbli_produk[]" required>
                                                    @foreach ($kbli as $k)
                                                        <option value="{{ $k->id_kbli }}"
                                                            {{ $k->id_kbli == $p->id_kbli ? 'selected' : '' }}>
                                                            {{ $k->id_kbli }} - {{ $k->jenis_kbli }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kapasitas[]">Kapasitas</label>
                                                <input type="number" class="form-control" id="kapasitas[]"
                                                    name="kapasitas[]" value="{{ $p->kapasitas }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="satuan[]">Satuan</label>
                                                <input type="text" class="form-control" id="satuan[]"
                                                    name="satuan[]" value="{{ $p->satuan }}" required>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-success mt-2" id="add-produk">Tambah
                                    Produk</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary ml-4">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                    option.text = 'Kelurahan ' + kelurahan;
                    kelurahanSelect.appendChild(option);
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#data-industri-update').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('data-industri.update', $pelakuUsaha->id_usaha) }}", // Update sesuai dengan route Anda
                        type: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                }).then(() => {
                                    window.location.href =
                                        "{{ url('/siiba/data-industri') }}";
                                });
                            } else if (response.status === 'error') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan!',
                                    text: response.message,
                                });
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                // Get the error message from the response
                                var errors = xhr.responseJSON;
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan!',
                                    text: errors.message ||
                                        'NIB sudah digunakan sebelumnya, periksa kembali NIB anda.',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan!',
                                    text: 'Terjadi kesalahan saat menyimpan data.',
                                });
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
