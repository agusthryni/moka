@extends('layout.main')

@section('title', 'MOKA | FORM LAPORAN')

@section('content')
    <section class="content" style="padding-top: 100px;">
        <div class="container-fluid">
            <div class="card border-0">
                <div class="card-header bg-success text-white">
                    <h5>LAPORAN DAN MONEV KINERJA PEGAWAI</h5>
                </div>

                {{-- Step Indicator --}}
                <div class="step-indicator d-flex justify-content-between align-items-center px-4 py-3">
                    <div class="step-circle active">1</i></div>
                    <div class="step-line"></div>
                    <div class="step-circle">2</div>
                    <div class="step-line"></div>
                    <div class="step-circle">3</div>
                    <div class="step-line"></div>
                    <div class="step-circle">4</div>
                    <div class="step-line"></div>
                    <div class="step-circle">5</div>
                    <div class="step-line"></div>
                    <div class="step-circle">6</div>
                    <div class="step-line"></div>
                    <div class="step-circle">7</div>
                </div>

                <style>
                    .step-indicator {
                    position: relative;
                    }
                    .step-circle {
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    background: #ccc;
                    color: white;
                    font-weight: bold;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 2;
                    transition: 0.3s;
                    }
                    .step-circle.active {
                    background: #28a745;
                    box-shadow: 0 0 8px #28a745;
                    }
                    .step-line {
                    flex: 1;
                    height: 4px;
                    background: #ccc;
                    z-index: 1;
                    }
                    .step-line.active {
                    background: #28a745;
                    }
                </style>

                {{-- LAPORAN --}}
                <div class="card-body">
                    <form id="monevForm">
                        {{-- 1 - LAPORAN --}}
                        <div class="step">
                            <h5 class="text-success mb-3">LAPORAN</h5>
                            <div class="form-group">
                                <label for="bidang">Bidang</label>
                                <select class="form-control" id="bidang" name="bidang" required>
                                    <option value="">Pilih Bidang</option>
                                    <option value="Sekretariat">Sekretariat</option>
                                    <option value="Teknologi Sumber Daya Industri">TSDI</option>
                                    <option value="UMKM">IKM</option>
                                    <option value="Koperasi">Koperasi</option>
                                    <option value="UPT Sumber">UPT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select class="form-control select2-success" id="tahun" name="tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    @php
                                        $currentYear = date('Y');
                                    @endphp
                                    @for ($year = $currentYear; $year >= 2020; $year--)
                                        <option value="{{ $year }}"{{ $year == $currentYear ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="triwulan">Triwulan</label>
                                <select class="form-control" id="triwulan" name="triwulan" required>
                                    <option value="">Pilih Triwulan</option>
                                    @php
                                        $currentTri = ceil(date('n') / 3); // hitung triwulan sekarang (1–4)
                                    @endphp
                                    <option value="I" {{ $currentTri == 1 ? 'selected' : '' }}>Triwulan I</option>
                                    <option value="II" {{ $currentTri == 2 ? 'selected' : '' }}>Triwulan II</option>
                                    <option value="III" {{ $currentTri == 3 ? 'selected' : '' }}>Triwulan III</option>
                                    <option value="IV" {{ $currentTri == 4 ? 'selected' : '' }}>Triwulan IV</option>
                                </select>
                            </div>
                        </div>

                        {{-- 2 - PROGRAM --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">LAPORAN CAPAIAN KINERJA PROGRAM INDIVIDU DAN REALISASI ANGGARAN</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pelapor">Nama Pelapor</label>
                                        <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan_pelapor">Jabatan Pelapor</label>
                                        <input type="text" class="form-control" id="jabatan_pelapor" name="jabatan_pelapor" placeholder="Masukkan Jabatan Pelapor" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pimpinan_monev">Nama Pimpinan Monev</label>
                                        <input type="text" class="form-control" id="nama_pimpinan_monev" name="nama_pimpinan_monev" placeholder="Masukkan Nama Pimpinan Monev" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan_pimpinan_monev">Jabatan Pimpinan Monev</label>
                                        <input type="text" class="form-control" id="jabatan_pimpinan_monev" name="jabatan_pimpinan_monev" placeholder="Masukkan Jabatan Pimpinan Monev" required>
                                    </div>
                                </div>
                            </div> 
                            {{-- 2 - PROGRAM KINERJA --}}
                            <div class="program-container">
                                <div class="program-item border p-3 mb-3 rounded">
                                    <p class="text">Kinerja</p>
                                    <div class="form-group">
                                        <label for="program">Program</label>
                                        <input type="text" class="form-control" id="program" name="program" placeholder="Masukkan Program" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="indikator_program">Indikator Program</label>
                                        <input type="text" class="form-control" id="indikator_program" name="indikator_program" placeholder="Masukkan Indikator Program" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <select class="form-control" id="satuan" name="satuan" required>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Persen">Persen</option>
                                                    <option value="Dokumen">Dokumen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="target">Target</label>
                                                <input type="number" class="form-control" id="target" name="target" step="0.01" placeholder="Masukkan Target" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="program_realisasi_kinerja">Realisasi</label>
                                                <input type="number" class="form-control" id="program_realisasi_kinerja" name="program_realisasi_kinerja" placeholder="Masukkan Realisasi" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="%">%</label>
                                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- 2 - PROGRAM KEUANGAN --}}
                                    <p class="text">Keuangan</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pagu">Pagu</label>
                                                <input type="number" class="form-control" id="pagu" name="pagu" placeholder="Masukkan Pagu" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="program_realisasi_keuangan">Realisasi</label>
                                                <input type="number" class="form-control" id="program_realisasi_keuangan" name="program_realisasi_keuangan" placeholder="Masukkan Realisasi" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="%">%</label>
                                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- 2 - PROGRAM KETERANGAN --}}
                                    <p class="text">Keterangan</p>
                                    <div class="form-group">
                                        <label for="faktor_pendorong">Faktor Pendorong</label>
                                        <input type="text" class="form-control" id="faktor_pendorong" name="faktor_pendorong" placeholder="Masukkan Faktor Pendorong" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="faktor_penghambat">Faktor Penghambat</label>
                                        <input type="text" class="form-control" id="faktor_penghambat" name="faktor_penghambat" placeholder="Masukkan Faktor Penghambat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rekomendasi">Rekomendasi</label>
                                        <input type="text" class="form-control" id="rekomendasi" name="rekomendasi" placeholder="Masukkan Rekomendasi" required>
                                    </div>
                                </div>
                            </div> 
                            <button type="button" class="btn btn-success mt-2" id="add-program">Tambah Program</button> 
                        </div>
                        
                        {{-- 3 - KEGIATAN --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">LAPORAN CAPAIAN KINERJA KEGIATAN INDIVIDU DAN REALISASI ANGGARAN</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pelapor">Nama Pelapor</label>
                                        <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan_pelapor">Jabatan Pelapor</label>
                                        <input type="text" class="form-control" id="jabatan_pelapor" name="jabatan_pelapor" placeholder="Masukkan Jabatan Pelapor" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pimpinan_monev">Nama Pimpinan Monev</label>
                                        <input type="text" class="form-control" id="nama_pimpinan_monev" name="nama_pimpinan_monev" placeholder="Masukkan Nama Pimpinan Monev" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan_pimpinan_monev">Jabatan Pimpinan Monev</label>
                                        <input type="text" class="form-control" id="jabatan_pimpinan_monev" name="jabatan_pimpinan_monev" placeholder="Masukkan Jabatan Pimpinan Monev" required>
                                    </div>
                                </div>
                            </div>
                            {{-- 3 - KEGIATAN KINERJA --}}
                            <div class="kegiatan-container">
                                <div class="kegiatan-item border p-3 mb-3 rounded">
                                    <p class="text">Kinerja</p>
                                    <div class="form-group">
                                        <label for="kegiatan">Kegiatan</label>
                                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Masukkan Kegiatan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="indikator_kegiatan">Indikator Kegiatan</label>
                                        <input type="text" class="form-control" id="indikator_kegiatan" name="indikator_kegiatan" placeholder="Masukkan Indikator Kegiatan" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <select class="form-control" id="satuan" name="satuan" required>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Persen">Persen</option>
                                                    <option value="Dokumen">Dokumen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="target">Target</label>
                                                <input type="number" class="form-control" id="target" name="target" step="0.01" placeholder="Masukkan Target" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kegiatan_realisasi_kinerja">Realisasi</label>
                                                <input type="number" class="form-control" id="kegiatan_realisasi_kinerja" name="kegiatan_realisasi_kinerja" placeholder="Masukkan Realisasi" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="%">%</label>
                                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- 3 - KEGIATAN KEUANGAN --}}
                                    <p class="text">Keuangan</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pagu">Pagu</label>
                                                <input type="number" class="form-control" id="pagu" name="pagu" placeholder="Masukkan Pagu" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="program_realisasi_keuangan">Realisasi</label>
                                                <input type="number" class="form-control" id="program_realisasi_keuangan" name="program_realisasi_keuangan" placeholder="Masukkan Realisasi" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="%">%</label>
                                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 3 - KEGIATAN KETERANGAN -->
                                    <p class="text">Keterangan</p>
                                    <div class="form-group">
                                        <label for="faktor_pendorong">Faktor Pendorong</label>
                                        <input type="text" class="form-control" id="faktor_pendorong" name="faktor_pendorong" placeholder="Masukkan Faktor Pendorong" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="faktor_penghambat">Faktor Penghambat</label>
                                        <input type="text" class="form-control" id="faktor_penghambat" name="faktor_penghambat" placeholder="Masukkan Faktor Penghambat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelurahan">Rekomendasi</label>
                                        <input type="text" class="form-control" id="rekomendasi" name="rekomendasi" placeholder="Masukkan Rekomendasi" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-kegiatan">Tambah Kegiatan</button>
                        </div>

                        {{-- 4 - SUBKEGIATAN --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">LAPORAN CAPAIAN KINERJA SUB KEGIATAN INDIVIDU DAN REALISASI ANGGARAN</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pelapor">Nama Pelapor</label>
                                        <input type="text" class="form-control" id="nama_pelapor"name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan_pelapor">Jabatan Pelapor</label>
                                        <input type="text" class="form-control" id="jabatan_pelapor" name="jabatan_pelapor" placeholder="Masukkan Jabatan Pelapor" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pimpinan_monev">Nama Pimpinan Monev</label>
                                        <input type="text" class="form-control" id="nama_pimpinan_monev" name="nama_pimpinan_monev" placeholder="Masukkan Nama Pimpinan Monev" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan_pimpinan_monev">Jabatan Pimpinan Monev</label>
                                        <input type="text" class="form-control" id="jabatan_pimpinan_monev" name="jabatan_pimpinan_monev" placeholder="Masukkan Jabatan Pimpinan Monev" required>
                                    </div>
                                </div>
                            </div>
                            <!-- 4 - SUBKEGIATAN KINERJA -->
                            <div class="kegiatan-container">
                                <div class="kegiatan-item border p-3 mb-3 rounded">
                                    <p class="text">Kinerja</p>
                                    <div class="form-group">
                                        <label for="sub_kegiatan">Sub Kegiatan</label>
                                        <input type="text" class="form-control" id="sub_kegiatan" name="sub_kegiatan" placeholder="Masukkan Sub Kegiatan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="indikator_sub_kegiatan">Indikator Sub Kegiatan</label>
                                        <input type="text" class="form-control" id="indikator_sub_kegiatan" name="indikator_sub_kegiatan" placeholder="Masukkan Indikator Sub Kegiatan" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <select class="form-control" id="satuan" name="satuan" required>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Persen">Persen</option>
                                                    <option value="Dokumen">Dokumen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="target">Target</label>
                                                <input type="number" class="form-control" id="target" name="target" step="0.01" placeholder="Masukkan Target" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subkegiatan_realisasi_kinerja">Realisasi</label>
                                                <input type="number" class="form-control" id="subkegiatan_realisasi_kinerja" name="subkegiatan_realisasi_kinerja" placeholder="Masukkan Realisasi" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="%">%</label>
                                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- 4 - SUBKEGIATAN KEUANGAN --}}
                                    <p class="text">Keuangan</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pagu">Pagu</label>
                                                <input type="number" class="form-control" id="pagu" name="pagu" placeholder="Masukkan Pagu" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subkegiatan_realisasi_keuangan">Realisasi</label>
                                                <input type="number" class="form-control" id="subkegiatan_realisasi_keuangan" name="subkegiatan_realisasi_keuangan" placeholder="Masukkan Realisasi" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="%">%</label>
                                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 4 - SUBKEGIATAN KETERANGAN -->
                                    <p class="text">Keterangan</p>
                                    <div class="form-group">
                                        <label for="faktor_pendorong">Faktor Pendukung</label>
                                        <input type="text" class="form-control" id="faktor_pendorong" name="faktor_pendorong" placeholder="Masukkan Faktor Pendorong" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="faktor_penghambat">Faktor Penghambat</label>
                                        <input type="text" class="form-control" id="faktor_penghambat" name="faktor_penghambat" placeholder="Masukkan Faktor Penghambat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rekomendasi">Rekomendasi</label>
                                        <input type="text" class="form-control" id="rekomendasi" name="rekomendasi" placeholder="Masukkan Rekomendasi" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-sub-kegiatan">Tambah Sub Kegiatan</button>
                        </div>

                        {{-- 5 - PENILAIAN PIMPINAN --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">PENILAIAN PIMPINAN</h5>
                            <div id="penilaian-container">
                                <div class="penilaian-item border p-3 mb-3 rounded">
                                    <div class="form-group">
                                        <label for="pimpinan">Pimpinan</label>
                                        <select class="form-control" id="pimpinan" name="pimpinan" required>
                                            <option value="">Pilih Pimpinan</option>
                                            <option value="Kepala Dinas">Kepala Dinas</option>
                                            <option value="Sekretaris/Kepala Bidang">Sekretaris/Kepala Bidang</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penilaian">Berdasarkan Capaian Kinerja yang diperjanjikan dan realisasi anggaran sampai dengan saat ini dapat disimpulkan bahwa dalam melaksanakan tugas dan fungsi saudara termasuk dalam kriteria:</label>
                                        <select class="form-control" id="penilaian" name="penilaian" required>
                                            <option value="">Pilih Penilaian</option>
                                            <option value="Kepala Dinas">Sangat Berhasil</option>
                                            <option value="Sekretaris/Kepala Bidang">Berhasil</option>
                                            <option value="Sekretaris/Kepala Bidang">Kurang Berhasil</option>
                                            <option value="Sekretaris/Kepala Bidang">Tidak Berhasil</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="add-penilaian">Tambah Penilaian</button>
                                </div>
                            </div>
                        </div>
                        {{-- 6 - ARAHAN/SOLUSI DARI PIMPINAN --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">ARAHAN/SOLUSI DARI PIMPINAN</h5>
                            <div id="arahan-container">
                                <div class="arahan-item border p-3 mb-3 rounded">
                                    <div class="form-group">
                                        <label for="pimpinan">Pimpinan</label>
                                        <select class="form-control" id="pimpinan" name="pimpinan" required>
                                            <option value="">Pilih Pimpinan</option>
                                            <option value="Kepala Dinas">Kepala Dinas</option>
                                            <option value="Sekretaris/Kepala Bidang">Sekretaris/Kepala Bidang</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penilaian">Untuk meningkatkan Capaian Kinerja dan Penyerapan anggaran, diminta agar Saudara melaksanakan hal-hal sebagai berikut:</label>
                                        <textarea class="form-control" id="penilaian" name="penilaian" placeholder="Masukkan Arahan/Solusi" required></textarea>
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="add-arahan">Tambah Arahan</button>
                                </div>
                            </div>
                        </div>

                        {{-- 7 - MELAPORKAN --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">MELAPORKAN</h5>
                            <div id="melaporkan-container">
                                <div class="melaporkan-item border p-3 mb-3 rounded">
                                    <div class="form-group">
                                        <label for="nama_pegawai">Nama</label>
                                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan Nama Pegawai" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip_pegawai">NIP</label>
                                        <input type="number" class="form-control" id="nip_pegawai" name="nip_pegawai" placeholder="Masukkan NIP Pegawai" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" required>
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="add-melaporkan">Tambah Melaporkan</button>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                            <button type="button" class="btn btn-success" id="nextBtn">Berikutnya <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <style>
        /* === Efek hijau sederhana untuk semua input, select, textarea === */
        .form-control:focus,
        .form-select:focus {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 0.15rem rgba(40, 167, 69, 0.25) !important;
            outline: none !important;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #28a745 !important;
        }

        .form-select:focus-visible {
            border-color: #28a745 !important;
            outline: none !important;
            box-shadow: 0 0 0 0.15rem rgba(40, 167, 69, 0.25) !important;
        }
    </style>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const steps = document.querySelectorAll(".step");
        const circles = document.querySelectorAll(".step-circle");
        const lines = document.querySelectorAll(".step-line");
        const nextBtn = document.getElementById("nextBtn");
        const prevBtn = document.getElementById("prevBtn");
        let current = 0;

        function showStep(index) {
            for (let i = 0; i < steps.length; i++) {

                // tampilkan step yang aktif saja
                steps[i].classList.toggle("d-none", i !== index);

                // lingkaran aktif (yang sudah dilewati + yang sekarang)
                circles[i].classList.toggle("active", i <= index);

                // garis hanya untuk langkah yang sudah dilewati
                if (lines[i]) {
                    lines[i].classList.toggle("active", i < index);
                }
            }
            // Simpan posisi step saat ini
            localStorage.setItem("monev_current_step", index);

            // scroll otomatis ke atas
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // setting tombol prev dan next
            prevBtn.style.visibility = index === 0 ? "hidden" : "visible";
            nextBtn.innerHTML =
                index === steps.length - 1
                    ? '<i class="fas fa-check"></i> Selesai'
                    : 'Berikutnya <i class="fas fa-arrow-right"></i>';
        }

        // ✅ Fungsi Validasi Step
        function validateStep(stepIndex) {
            const inputs = steps[stepIndex].querySelectorAll(
                "input[required], select[required], textarea[required]"
            );

            let valid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add("is-invalid");
                    valid = false;
                } else {
                    input.classList.remove("is-invalid");
                }
            });

            // ✅ Tambahkan alert jika tidak valid
            if (!valid) {
                Swal.fire({
                    icon: "warning",
                    title: "Lengkapi data terlebih dahulu!",
                    text: "Masih ada field wajib yang belum diisi."
                });
            }

            return valid;
        }


        nextBtn.addEventListener("click", () => {
            // panggil fungsi validasi
            if (!validateStep(current)) return;

            // pindah step
            if (current < steps.length - 1) {
                current++;
                showStep(current);
            } else {
                document.getElementById("monevForm").submit();
            }
        });

        prevBtn.addEventListener("click", () => {
            if (current > 0) current--;
            showStep(current);
        });

        // Bila ada step tersimpan, gunakan itu
        const savedStep = localStorage.getItem("monev_current_step");
        if (savedStep !== null) {
            current = parseInt(savedStep);
        }

        // SIMPAN DATA SETIAP ADA PERUBAHAN
        document.querySelectorAll("input, select, textarea").forEach(el => {
            el.addEventListener("input", () => {
                localStorage.setItem(`monev_${el.name}`, el.value);
            });
        });

        // LOAD DATA YANG PERNAH DISIMPAN
        document.querySelectorAll("input, select, textarea").forEach(el => {
            const savedValue = localStorage.getItem(`monev_${el.name}`);
            if (savedValue !== null) {
                el.value = savedValue;
            }
        });

        // tampilkan step awal
        showStep(current);
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const tahunInput = document.getElementById('Tahun');
        if (tahunInput) {
            const currentYear = new Date().getFullYear();
            tahunInput.setAttribute('max', currentYear);
            tahunInput.value = currentYear; 
        }
    });
    </script>

    <script>
        $(document).ready(function() {
            $('#monevForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('data-industri.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            // hapus semua cache form
                            Object.keys(localStorage)
                                .filter(key => key.startsWith("monev_"))
                                .forEach(key => localStorage.removeItem(key));

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                            }).then(function() {
                                window.location.href = "{{ url('/moka/data-laporan') }}";
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
    document.addEventListener("DOMContentLoaded", function() {
        // === Fungsi umum untuk duplikasi ===
        function addFormSection(buttonId, containerClass, templateSelector) {
            const addBtn = document.getElementById(buttonId);
            const stepContainer = addBtn.closest(".step");
            let container = stepContainer.querySelector(`.${containerClass}`);
            
            if (!container) {
                container = document.createElement("div");
                container.classList.add(containerClass, "mt-3");
                stepContainer.appendChild(container);
            }

            const template = stepContainer.querySelector(templateSelector);
            const clone = template.cloneNode(true);
            clone.querySelectorAll("input, select, textarea").forEach(el => {
                el.value = "";
                el.classList.remove("is-invalid");
                el.name = el.name.replace("[]", "") + "[]";
            });

            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "btn btn-danger mt-2";
            removeBtn.textContent = "Hapus";
            removeBtn.addEventListener("click", () => clone.remove());

            clone.appendChild(removeBtn);

            container.appendChild(clone);
        }

        // === Program ===
        document.getElementById("add-program").addEventListener("click", function() {
            addFormSection("add-program", "program-container", ".program-container");
        });

        // === Kegiatan ===
        document.getElementById("add-kegiatan").addEventListener("click", function() {
            addFormSection("add-kegiatan", "kegiatan-container", ".kegiatan-container");
        });

        // === Sub Kegiatan ===
        document.getElementById("add-sub-kegiatan").addEventListener("click", function() {
            addFormSection("add-sub-kegiatan", "subkegiatan-container", ".subkegiatan-container");
        });

        // === Penilaian ===
        document.getElementById("add-penilaian").addEventListener("click", function() {
            addFormSection("add-penilaian", "penilaian-container", ".penilaian-container");
        });

        // === Arahan ===
        document.getElementById("add-arahan").addEventListener("click", function() {
            addFormSection("add-arahan", "arahan-container", ".arahan-container");
        });

        // === Melaporkan ===
        document.getElementById("add-melaporkan").addEventListener("click", function() {
            addFormSection("add-melaporkan", "melaporkan-container", ".melaporkan-container");
        });
        
        // Event delegasi hapus melaporkan
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-item")) {
                e.target.closest(".melaporkan-item").remove();
            }
        });
    });
    </script>
@endsection
