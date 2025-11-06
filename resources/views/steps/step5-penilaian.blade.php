{{-- 5 - PENILAIAN PIMPINAN --}}
<div class="step d-none">
    <h5 class="text-success mb-3">PENILAIAN PIMPINAN</h5>
    <div id="penilaian-container">
        <div class="penilaian-item border p-3 mb-3 rounded">
            <div class="form-group">
                <label for="pimpinan">Pimpinan</label>
                <select class="form-control" id="pimpinan" name="pimpinan[]" required>
                    <option value="">Pilih Pimpinan</option>
                    <option value="Kepala Dinas">Kepala Dinas</option>
                    <option value="Sekretaris/Kepala Bidang">Sekretaris/Kepala Bidang</option>
                </select>
            </div>
            <div class="form-group">
                <label for="penilaian">Berdasarkan Capaian Kinerja yang diperjanjikan dan realisasi anggaran sampai dengan saat ini dapat disimpulkan bahwa dalam melaksanakan tugas dan fungsi saudara termasuk dalam kriteria:</label>
                <select class="form-control" id="penilaian" name="penilaian[]" required>
                    <option value="">Pilih Penilaian</option>
                    <option value="Sangat Berhasil">Sangat Berhasil</option>
                    <option value="Berhasil">Berhasil</option>
                    <option value="Kurang Berhasil">Kurang Berhasil</option>
                    <option value="Tidak Berhasil">Tidak Berhasil</option>
                </select>
            </div>
            <button type="button" class="btn btn-success mt-2" id="add-penilaian">Tambah Penilaian</button>
        </div>
    </div>
</div>

