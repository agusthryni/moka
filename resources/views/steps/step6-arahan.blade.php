{{-- 6 - ARAHAN/SOLUSI DARI PIMPINAN --}}
<div class="step d-none">
    <h5 class="text-success mb-3">ARAHAN/SOLUSI DARI PIMPINAN</h5>
    <div id="arahan-container">
        <div class="arahan-item border p-3 mb-3 rounded">
            <div class="form-group">
                <label for="pimpinan">Pimpinan</label>
                <select class="form-control" id="pimpinan" name="pimpinan[]" required>
                    <option value="">Pilih Pimpinan</option>
                    <option value="Kepala Dinas">Kepala Dinas</option>
                    <option value="Sekretaris/Kepala Bidang">Sekretaris/Kepala Bidang</option>
                </select>
            </div>
            <div class="form-group">
                <label for="arahan">Untuk meningkatkan Capaian Kinerja dan Penyerapan anggaran, diminta agar Saudara melaksanakan hal-hal sebagai berikut:</label>
                <textarea class="form-control" id="arahan" name="arahan[]" placeholder="Masukkan Arahan/Solusi" required></textarea>
            </div>
            <button type="button" class="btn btn-success mt-2" id="add-arahan">Tambah Arahan</button>
        </div>
    </div>
</div>

