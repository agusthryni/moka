{{-- 3 - KEGIATAN --}}
<div class="step d-none">
    <h5 class="text-success mb-3">LAPORAN CAPAIAN KINERJA KEGIATAN INDIVIDU DAN REALISASI ANGGARAN</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_pegawai_pelapor">Nama Pelapor</label>
                <select class="form-control select2-pegawai" id="id_pegawai_pelapor" name="id_pegawai_pelapor" required>
                    <option value="">Pilih Pegawai</option>
                    @foreach($pegawai as $p)
                        <option value="{{ $p->id_pegawai }}" data-jabatan="{{ $p->jabatan }}">{{ $p->nama_pegawai }} - {{ $p->nip }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="jabatan_pelapor">Jabatan Pelapor</label>
                <input type="text" class="form-control" id="jabatan_pelapor" name="jabatan_pelapor" placeholder="Akan terisi otomatis" readonly required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_pegawai_monev">Nama Pimpinan Monev</label>
                <select class="form-control select2-pegawai" id="id_pegawai_monev" name="id_pegawai_monev" required>
                    <option value="">Pilih Pegawai</option>
                    @foreach($pegawai as $p)
                        <option value="{{ $p->id_pegawai }}" data-jabatan="{{ $p->jabatan }}">{{ $p->nama_pegawai }} - {{ $p->nip }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="jabatan_pimpinan_monev">Jabatan Pimpinan Monev</label>
                <input type="text" class="form-control" id="jabatan_pimpinan_monev" name="jabatan_pimpinan_monev" placeholder="Akan terisi otomatis" readonly required>
            </div>
        </div>
    </div>
    {{-- 3 - KEGIATAN KINERJA --}}
    <div class="kegiatan-container">
        <div class="kegiatan-item border p-3 mb-3 rounded">
            <p class="text">Kinerja</p>
            <div class="form-group">
                <label for="kegiatan">Kegiatan</label>
                <input type="text" class="form-control" id="kegiatan" name="kegiatan[]" placeholder="Masukkan Kegiatan" required>
            </div>
            <div class="form-group">
                <label for="indikator_kegiatan">Indikator Kegiatan</label>
                <input type="text" class="form-control" id="indikator_kegiatan" name="indikator_kegiatan[]" placeholder="Masukkan Indikator Kegiatan" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select class="form-control" id="satuan" name="satuan[]" required>
                            <option value="">Pilih Satuan</option>
                            <option value="Persen">Persen</option>
                            <option value="Dokumen">Dokumen</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="target">Target</label>
                        <input type="number" class="form-control" id="target" name="target[]" step="0.01" placeholder="Masukkan Target" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kegiatan_realisasi_kinerja">Realisasi</label>
                        <input type="number" class="form-control" id="kegiatan_realisasi_kinerja" name="kegiatan_realisasi_kinerja[]" placeholder="Masukkan Realisasi" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"> 
                        <label>% Kinerja (Otomatis)</label>
                        <input type="number" class="form-control persen-kinerja" name="persen_kinerja_kegiatan[]" step="0.01" readonly placeholder="Akan dihitung otomatis">
                    </div>
                </div>
            </div>
            {{-- 3 - KEGIATAN KEUANGAN --}}
            <p class="text">Keuangan</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pagu">Pagu</label>
                        <input type="number" class="form-control" id="pagu" name="pagu[]" placeholder="Masukkan Pagu" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="program_realisasi_keuangan">Realisasi</label>
                        <input type="number" class="form-control" id="program_realisasi_keuangan" name="program_realisasi_keuangan[]" placeholder="Masukkan Realisasi" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"> 
                        <label>% Keuangan (Otomatis)</label>
                        <input type="number" class="form-control persen-keuangan" name="persen_keuangan_kegiatan[]" step="0.01" readonly placeholder="Akan dihitung otomatis">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"> 
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan[]" placeholder="Masukkan Keterangan" required>
                    </div>
                </div>
            </div>
            <!-- 3 - KEGIATAN KETERANGAN -->
            <p class="text">Keterangan</p>
            <div class="form-group">
                <label for="faktor_pendorong">Faktor Pendorong</label>
                <input type="text" class="form-control" id="faktor_pendorong" name="faktor_pendorong[]" placeholder="Masukkan Faktor Pendorong" required>
            </div>
            <div class="form-group">
                <label for="faktor_penghambat">Faktor Penghambat</label>
                <input type="text" class="form-control" id="faktor_penghambat" name="faktor_penghambat[]" placeholder="Masukkan Faktor Penghambat" required>
            </div>
            <div class="form-group">
                <label for="rekomendasi">Rekomendasi</label>
                <input type="text" class="form-control" id="rekomendasi" name="rekomendasi[]" placeholder="Masukkan Rekomendasi" required>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success mt-2" id="add-kegiatan">Tambah Kegiatan</button>
</div>

