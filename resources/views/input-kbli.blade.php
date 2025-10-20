@extends('layout.main')

@section('title', 'MOKA | FORM DATA PEGAWAI')

@section('content')
<section class="content" style="padding-top: 100px;">
    <div class="container-fluid">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-success text-white">
                <h5>DATA PEGAWAI</h5>
            </div>
            <div class="card-body">
                <form id="pegawai-form">
                    <div id="pegawai-container">
                        <div class="pegawai-item">
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
                        </div>
                    </div>

                    <button type="button" class="btn btn-success mt-2" id="add-pegawai">Tambah Pegawai</button>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success" id="saveBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#pegawai-form').on('submit', function(e) {
            e.preventDefault();

            // 🔹 Validasi input kosong (tampil border merah + ikon)
            let inputs = $('#pegawai-form').find('input[required], select[required]');
            let isValid = true;

            inputs.each(function() {
                if (!$(this).val().trim()) {
                    $(this).addClass('is-invalid');

                    // Tambahkan pesan error kecil kalau belum ada
                    if ($(this).next('.invalid-feedback').length === 0) {
                        $(this).after('<div class="invalid-feedback">Wajib diisi</div>');
                    }

                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                }
            });

            // 🔹 Jika ada input kosong, hentikan submit
            if (!isValid) return;

            // 🔹 Lanjutkan kirim data jika valid
            $.ajax({
                url: "{{ route('data-kbli.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        }).then(function() {
                            window.location.href = "{{ url('/siiba/data-kbli') }}";
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
document.addEventListener("DOMContentLoaded", function () {

    const addPegawaiBtn = document.getElementById("add-pegawai");
    const pegawaiContainer = document.getElementById("pegawai-container");

    // === Fungsi Tambah Form Pegawai ===
    addPegawaiBtn.addEventListener("click", function () {
        const pegawaiItem = document.createElement("div");
        pegawaiItem.classList.add("pegawai-item", "border", "p-3", "mb-3", "rounded");

        pegawaiItem.innerHTML = `
            <div class="form-group mb-2">
                <label>Nama Pegawai</label>
                <input type="text" class="form-control" name="nama_pegawai[]" placeholder="Masukkan nama pegawai" required>
            </div>
            <div class="form-group mb-2">
                <label>NIP</label>
                <input type="number" class="form-control" name="nip[]" placeholder="Masukkan NIP" required>
            </div>
            <div class="form-group mb-2">
                <label>Jabatan</label>
                <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan jabatan" required>
            </div>
            <div class="form-group mb-2">
                <label>Bidang</label>
                <select class="form-control" name="bidang[]" required>
                    <option value="">-- Pilih Bidang --</option>
                    <option value="Sekretariat">Sekretariat</option>
                    <option value="Teknologi Sumber Daya Industri">Teknologi Sumber Daya Industri</option>
                    <option value="UMKM">UMKM</option>
                    <option value="Koperasi">Koperasi</option>
                    <option value="UPT Somber">UPT Somber</option>
                    <option value="UPT Teritip">UPT Teritip</option>
                    <option value="Kepala Dinas">Kepala Dinas</option>
                </select>
            </div>
            <div class="text-end mt-2">
                <button type="button" class="btn btn-danger btn-sm remove-pegawai">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </div>
        `;

        pegawaiContainer.appendChild(pegawaiItem);
    });

    // === Fungsi Hapus Form Pegawai ===
    pegawaiContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-pegawai") || e.target.closest(".remove-pegawai")) {
            e.target.closest(".pegawai-item").remove();
        }
    });

});
</script>

@endsection
