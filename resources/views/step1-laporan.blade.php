{{-- 2 - PROGRAM KINERJA --}}
<div class="step d-none">
    <h5 class="text-success mb-3">PROGRAM KINERJA</h5>

    <!-- CONTAINER UNTUK SEMUA PROGRAM -->
    <div class="program-container">

        <!-- ITEM PROGRAM (TEMPLATE) -->
        <div class="program-item border p-3 mb-3 rounded">

            {{-- KINERJA --}}
            <p class="text font-weight-bold">Kinerja</p>

            <div class="form-group">
                <label>Program</label>
                <input type="text" class="form-control" name="program[]" placeholder="Masukkan Program" required>
            </div>

            <div class="form-group">
                <label>Indikator Program</label>
                <input type="text" class="form-control" name="indikator_program[]" placeholder="Masukkan Indikator Program" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Satuan</label>
                    <select class="form-control" name="satuan[]" required>
                        <option value="">Pilih Satuan</option>
                        <option value="Persen">Persen</option>
                        <option value="Dokumen">Dokumen</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Target</label>
                    <input type="number" class="form-control" name="target[]" step="0.01" placeholder="Masukkan Target" required>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <label>Realisasi</label>
                    <input type="number" class="form-control" name="realisasi_kinerja[]" placeholder="Masukkan Realisasi" required>
                </div>

                <div class="col-md-6">
                    <label>%</label>
                    <input type="number" class="form-control" name="persen_kinerja[]" step="0.01" placeholder="Masukkan %" required>
                </div>
            </div>

            {{-- KEUANGAN --}}
            <p class="text font-weight-bold mt-3">Keuangan</p>

            <div class="row">
                <div class="col-md-6">
                    <label>Pagu</label>
                    <input type="number" class="form-control" name="pagu[]" placeholder="Masukkan Pagu" required>
                </div>

                <div class="col-md-6">
                    <label>Realisasi</label>
                    <input type="number" class="form-control" name="realisasi_keuangan[]" placeholder="Masukkan Realisasi" required>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <label>%</label>
                    <input type="number" class="form-control" name="persen_keuangan[]" step="0.01" placeholder="Masukkan %" required>
                </div>

                <div class="col-md-6">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="keterangan[]" placeholder="Masukkan Keterangan" required>
                </div>
            </div>

            {{-- KETERANGAN TAMBAHAN --}}
            <p class="text font-weight-bold mt-3">Keterangan</p>

            <div class="form-group">
                <label>Faktor Pendorong</label>
                <input type="text" class="form-control" name="faktor_pendorong[]" placeholder="Masukkan Faktor Pendorong" required>
            </div>

            <div class="form-group">
                <label>Faktor Penghambat</label>
                <input type="text" class="form-control" name="faktor_penghambat[]" placeholder="Masukkan Faktor Penghambat" required>
            </div>

            <div class="form-group">
                <label>Rekomendasi</label>
                <input type="text" class="form-control" name="rekomendasi[]" placeholder="Masukkan Rekomendasi" required>
            </div>

        </div>
        <!-- END PROGRAM ITEM -->

    </div>

    <button type="button" class="btn btn-success mt-2" id="add-program">Tambah Program</button>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const addProgramBtn = document.getElementById("add-program");
    const container = document.querySelector(".program-container");
    const template = container.querySelector(".program-item");

    addProgramBtn.addEventListener("click", function () {
        const clone = template.cloneNode(true);

        clone.querySelectorAll("input, select, textarea").forEach(el => {
            el.value = "";
            el.classList.remove("is-invalid");

            if (!el.name.endsWith("[]")) {
                el.name = el.name + "[]";
            }
        });

        const removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.className = "btn btn-danger mt-2";
        removeBtn.textContent = "Hapus Program";
        removeBtn.addEventListener("click", () => clone.remove());

        clone.appendChild(removeBtn);
        container.appendChild(clone);
    });

});
</script>
