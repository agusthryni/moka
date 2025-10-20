@extends('layout.main')

@section('title', 'MOKA | FORM LAPORAN')

@section('content')
    <section class="content" style="padding-top: 100px;">
        <div class="container-fluid">
            <div class="card shadow-lg border-0">
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
                                    <option value="Sekretariat">Sekretariat</option>
                                    <option value="Teknologi Sumber Daya Industri">TSDI</option>
                                    <option value="UMKM">IKM</option>
                                    <option value="Koperasi">Koperasi</option>
                                    <option value="UPT Sumber">UPT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" min="2010" placeholder="YYYY" required>
                            </div>
                            <div class="form-group">
                                <label for="triwulan">Triwulan</label>
                                <select class="form-control" id="triwulan" name="triwulan" required>
                                    <option value="I">Triwulan I</option>
                                    <option value="II">Triwulan II</option>
                                    <option value="III">Triwulan III</option>
                                    <option value="IV">Triwulan IV</option>
                                </select>
                            </div>
                        </div>

                        {{-- 2 - PROGRAM --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">LAPORAN CAPAIAN KINERJA PROGRAM INDIVIDU DAN REALISASI ANGGARAN</h5>
                            <div class="form-group">
                                <label for="nama_pelapor">Nama Pelapor</label>
                                <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_pelapor">Jabatan Pelapor</label>
                                <input type="text" class="form-control" id="jabatan_pelapor" name="jabatan_pelapor" placeholder="Masukkan Jabatan Pelapor" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_pimpinan_monev">Nama Pimpinan Monev</label>
                                <input type="text" class="form-control" id="nama_pimpinan_monev" name="nama_pimpinan_monev" placeholder="Masukkan Nama Pimpinan Monev" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_pimpinan_monev">Jabatan Pimpinan Monev</label>
                                <input type="text" class="form-control" id="jabatan_pimpinan_monev" name="jabatan_pimpinan_monev" placeholder="Masukkan Jabatan Pimpinan Monev" required>
                            </div>
                            {{-- Kinerja --}}
                            <div class="form-group">
                                <label for="program">Program</label>
                                <input type="text" class="form-control" id="program" name="program" placeholder="Masukkan Program" required>
                            </div>
                            <div class="form-group">
                                <label for="indikator_program">Indikator Program</label>
                                <input type="text" class="form-control" id="indikator_program" name="indikator_program" placeholder="Masukkan Indikator Program" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select class="form-control" id="satuan" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="Persen">Persen</option>
                                    <option value="Dokumen">Dokumen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="target">Target</label>
                                <input type="number" class="form-control" id="target" name="target" step="0.01" placeholder="Masukkan Target" required>
                            </div>
                            <div class="form-group">
                                <label for="realisasi">Realisasi</label>
                                <input type="number" class="form-control" id="realisasi" name="realisasi" placeholder="Masukkan Realisasi" required>
                            </div>
                            <div class="form-group"> 
                                <label for="%">%</label>
                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                            </div>
                            {{-- Keuangan --}}
                            <div class="form-group">
                                <label for="pagu">Pagu</label>
                                <input type="number" class="form-control" id="pagu" name="pagu" placeholder="Masukkan Pagu" required>
                            </div>
                            <div class="form-group">
                                <label for="realisasi">Realisasi</label>
                                <input type="number" class="form-control" id="realisasi" name="realisasi" placeholder="Masukkan Realisasi" required>
                            </div>
                            <div class="form-group"> 
                                <label for="%">%</label>
                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                            </div>
                            <div class="form-group"> 
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                            </div>
                            {{-- Keterangan --}}
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
                            <button type="button" class="btn btn-success mt-2" id="add-program">Tambah Program</button>
                        </div>
                        
                        {{-- 3 - KEGIATAN --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">LAPORAN CAPAIAN KINERJA KEGIATAN INDIVIDU DAN REALISASI ANGGARAN</h5>
                            <div class="form-group">
                                <label for="nama_pelapor">Nama Pelapor</label>
                                <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_pelapor">Jabatan Pelapor</label>
                                <input type="text" class="form-control" id="jabatan_pelapor" name="jabatan_pelapor" placeholder="Masukkan Jabatan Pelapor" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_pimpinan_monev">Nama Pimpinan Monev</label>
                                <input type="text" class="form-control" id="nama_pimpinan_monev" name="nama_pimpinan_monev" placeholder="Masukkan Nama Pimpinan Monev" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_pimpinan_monev">Jabatan Pimpinan Monev</label>
                                <input type="text" class="form-control" id="jabatan_pimpinan_monev" name="jabatan_pimpinan_monev" placeholder="Masukkan Jabatan Pimpinan Monev" required>
                            </div>
                            <div class="form-group">
                                <label for="kegiatan">Kegiatan</label>
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Masukkan Kegiatan" required>
                            </div>
                            <div class="form-group">
                                <label for="indikator_kegiatan">Indikator Kegiatan</label>
                                <input type="text" class="form-control" id="indikator_kegiatan" name="indikator_kegiatan" placeholder="Masukkan Indikator Kegiatan" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select class="form-control" id="satuan" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="Persen">Persen</option>
                                    <option value="Dokumen">Dokumen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="target">Target</label>
                                <input type="number" class="form-control" id="target" name="target" step="0.01" placeholder="Masukkan Target" required>
                            </div>
                            <div class="form-group">
                                <label for="realisasi">Realisasi</label>
                                <input type="number" class="form-control" id="realisasi" name="realisasi" placeholder="Masukkan Realisasi" required>
                            </div>
                            <div class="form-group"> 
                                <label for="%">%</label>
                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                            </div>
                            {{-- Keuangan --}}
                            <div class="form-group">
                                <label for="pagu">Pagu</label>
                                <input type="number" class="form-control" id="pagu" name="pagu" placeholder="Masukkan Pagu" required>
                            </div>
                            <div class="form-group">
                                <label for="realisasi">Realisasi</label>
                                <input type="number" class="form-control" id="realisasi" name="realisasi" placeholder="Masukkan Realisasi" required>
                            </div>
                            <div class="form-group"> 
                                <label for="%">%</label>
                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                            </div>
                            <!-- Keterangan -->
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
                            <button type="button" class="btn btn-success mt-2" id="add-kegiatan">Tambah Kegiatan</button>
                        </div>

                        {{-- Sub Kegiatan --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">LAPORAN CAPAIAN KINERJA SUB KEGIATAN INDIVIDU DAN REALISASI ANGGARAN</h5>
                            <div class="form-group">
                                <label for="nama_pelapor">Nama Pelapor</label>
                                <input type="text" class="form-control" id="nama_pelapor"name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_pelapor">Jabatan Pelapor</label>
                                <input type="text" class="form-control" id="jabatan_pelapor" name="jabatan_pelapor" placeholder="Masukkan Jabatan Pelapor" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_pimpinan_monev">Nama Pimpinan Monev</label>
                                <input type="text" class="form-control" id="nama_pimpinan_monev" name="nama_pimpinan_monev" placeholder="Masukkan Nama Pimpinan Monev" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_pimpinan_monev">Jabatan Pimpinan Monev</label>
                                <input type="text" class="form-control" id="jabatan_pimpinan_monev" name="jabatan_pimpinan_monev" placeholder="Masukkan Jabatan Pimpinan Monev" required>
                            </div>
                            <!-- Kinerja -->
                            <div class="form-group">
                                <label for="sub_kegiatan">Sub Kegiatan</label>
                                <input type="text" class="form-control" id="sub_kegiatan" name="sub_kegiatan" placeholder="Masukkan Sub Kegiatan" required>
                            </div>
                            <div class="form-group">
                                <label for="indikator_sub_kegiatan">Indikator Sub Kegiatan</label>
                                <input type="text" class="form-control" id="indikator_sub_kegiatan" name="indikator_sub_kegiatan" placeholder="Masukkan Indikator Sub Kegiatan" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select class="form-control" id="satuan" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="Persen">Persen</option>
                                    <option value="Dokumen">Dokumen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="target">Target</label>
                                <input type="number" class="form-control" id="target" name="target" step="0.01" placeholder="Masukkan Target" required>
                            </div>
                            <div class="form-group">
                                <label for="realisasi">Realisasi</label>
                                <input type="number" class="form-control" id="realisasi" name="realisasi" placeholder="Masukkan Realisasi" required>
                            </div>
                            <div class="form-group">
                                <label for="%">%</label>
                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                            </div>
                            {{-- Keuangan --}}
                            <div class="form-group">
                                <label for="pagu">Pagu</label>
                                <input type="number" class="form-control" id="pagu" name="pagu" placeholder="Masukkan Pagu" required>
                            </div>
                            <div class="form-group">
                                <label for="realisasi">Realisasi</label>
                                <input type="number" class="form-control" id="realisasi" name="realisasi" placeholder="Masukkan Realisasi" required>
                            </div>
                            <div class="form-group">
                                <label for="%">%</label>
                                <input type="number" class="form-control" id="%" name="%" step="0.01" placeholder="Masukkan %" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                            </div>
                            <!-- Keterangan -->
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
                            <button type="button" class="btn btn-success mt-2" id="add-sub-kegiatan">Tambah Sub Kegiatan</button>
                        </div>

                        {{-- Penilaian Pimpinan --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">PENILAIAN PIMPINAN</h5>
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

                        {{-- Arahan/Solusi Dari Pimpinan --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">ARAHAN/SOLUSI DARI PIMPINAN</h5>
                            <div class="form-group">
                                <label for="pimpinan">Pimpinan</label>
                                <input type="text" class="form-control" id="pimpinan" name="pimpinan" placeholder="Masukkan Nama Pimpinan" required>
                            </div>
                            <div class="form-group">
                                <label for="penilaian">Untuk meningkatkan Capaian Kinerja dan Penyerapan anggaran, diminta agar Saudara melaksanakan hal-hal sebagai berikut:</label>
                                <select class="form-control" id="penilaian" name="penilaian" required>
                                    <option value="">Pilih Penilaian</option>
                                    <option value="Kepala Dinas">Sangat Berhasil</option>
                                    <option value="Sekretaris/Kepala Bidang">Berhasil</option>
                                    <option value="Sekretaris/Kepala Bidang">Kurang Berhasil</option>
                                    <option value="Sekretaris/Kepala Bidang">Tidak Berhasil</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-arahan">Tambah Arahan</button>
                        </div>

                        {{-- Melaporkan --}}
                        <div class="step d-none">
                            <h5 class="text-success mb-3">MELAPORKAN</h5>
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

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                            <button type="button" class="btn btn-success" id="nextBtn">Berikutnya <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript: Step Navigation -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const steps = document.querySelectorAll(".step");
        const circles = document.querySelectorAll(".step-circle");
        const lines = document.querySelectorAll(".step-line");
        const nextBtn = document.getElementById("nextBtn");
        const prevBtn = document.getElementById("prevBtn");
        let current = 0;

        function showStep(index) {
            // tampilkan hanya step aktif
            steps.forEach((step, i) => {
                step.classList.toggle("d-none", i !== index);
            });

            // update lingkaran aktif
            circles.forEach((circle, i) => {
                if (i === index) {
                    circle.classList.add("active");
                } else if (i < index) {
                    circle.classList.add("active");
                } else {
                    circle.classList.remove("active");
                }
            });

            // update garis antar step
            lines.forEach((line, i) => {
                if (i < index) {
                    line.classList.add("active");
                } else {
                    line.classList.remove("active");
                }
            });

            // atur tombol prev dan next
            prevBtn.style.visibility = index === 0 ? "hidden" : "visible";
            nextBtn.innerHTML =
                index === steps.length - 1
                    ? '<i class="fas fa-check"></i> Selesai'
                    : 'Berikutnya <i class="fas fa-arrow-right"></i>';
        }

        nextBtn.addEventListener("click", () => {
            const inputs = steps[current].querySelectorAll(
                "input[required], select[required], textarea[required]"
            );

            // validasi sederhana
            for (const input of inputs) {
                if (!input.value.trim()) {
                    input.classList.add("is-invalid");
                    return;
                } else {
                    input.classList.remove("is-invalid");
                }
            }

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

        // tampilkan step awal
        showStep(current);
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
        // tambah pegawai
        document.getElementById('add-pegawai').addEventListener('click', function() {
            var pegawaiContainer = document.getElementById('pegawai-container');
            var newPegawaiItem = document.createElement('div');
            newPegawaiItem.classList.add('pegawai-item');
            newPegawaiItem.innerHTML = `
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" class="form-control" name="nama_pegawai[]" required>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="number" class="form-control" name="nip[]" required>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan[]" required>
                </div>
                <div class="form-group">
                    <label>Bidang</label>
                    <select class="form-control" name="bidang[]" required>
                        <option value="sekretariat">Sekretariat</option>
                        <option value="Teknologi Sumber Daya Industri">Teknologi Sumber Daya Industri</option>
                        <option value="UMKM">UMKM</option>
                        <option value="Koperasi">Koperasi</option>
                        <option value="UPT Somber">UPT Somber</option>
                        <option value="UPT Teritip">UPT Teritip</option>
                        <option value="Kepala Dinas">Kepala Dinas</option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger remove-pegawai">Hapus Pegawai</button>
            `;
            pegawaiContainer.appendChild(newPegawaiItem);
        });

        // hapus pegawai
        document.getElementById('pegawai-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-pegawai')) {
                e.target.closest('.pegawai-item').remove();
            }
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
            addFormSection("add-program", "program-container", ".form-group:first-child");
        });

        // === Kegiatan ===
        document.getElementById("add-kegiatan").addEventListener("click", function() {
            addFormSection("add-kegiatan", "kegiatan-container", ".form-group:first-child");
        });

        // === Sub Kegiatan ===
        document.getElementById("add-sub-kegiatan").addEventListener("click", function() {
            addFormSection("add-sub-kegiatan", "subkegiatan-container", ".form-group:first-child");
        });

        // === Penilaian ===
        document.getElementById("add-penilaian").addEventListener("click", function() {
            addFormSection("add-penilaian", "penilaian-container", ".form-group:first-child");
        });

        // === Arahan ===
        document.getElementById("add-arahan").addEventListener("click", function() {
            addFormSection("add-arahan", "arahan-container", ".form-group:first-child");
        });

        // === Melaporkan ===
        document.getElementById("add-produk").addEventListener("click", function() {
            const containerId = "melaporkan-container";
            const addBtn = document.getElementById("add-produk");
            const stepContainer = addBtn.closest(".step");
            let container = stepContainer.querySelector(`#${containerId}`);
            
            if (!container) {
                container = document.createElement("div");
                container.id = containerId;
                container.classList.add("mt-3");
                stepContainer.appendChild(container);
            }

            const newItem = document.createElement("div");
            newItem.classList.add("melaporkan-item");
            newItem.innerHTML = `
                <div class="form-group">
                    <label for="nama_pegawai">Nama</label>
                    <input type="text" class="form-control" name="nama_pegawai[]" placeholder="Masukkan Nama Pegawai" required>
                </div>
                <div class="form-group">
                    <label for="nip_pegawai">NIP</label>
                    <input type="number" class="form-control" name="nip_pegawai[]" placeholder="Masukkan NIP Pegawai" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Jabatan" required>
                </div>
                <button type="button" class="btn btn-danger remove-item">Hapus</button>
            `;
            container.appendChild(newItem);
        });

        // Event delegasi hapus melaporkan
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-item")) {
                e.target.closest(".melaporkan-item").remove();
            }
        });
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const tahunInput = document.getElementById('Tahun');
        if (tahunInput) { // cek biar aman
            const currentYear = new Date().getFullYear();
            tahunInput.setAttribute('max', currentYear);
            tahunInput.value = currentYear; // otomatis isi tahun sekarang
        }
    });
    </script>

@endsection
