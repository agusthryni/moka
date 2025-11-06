@extends('layout.main')

@section('title', 'MOKA | FORM DATA PEGAWAI')

@section('content')
<section class="content" style="padding-top: 100px;">
    <div class="container-fluid">
        {{-- <div class="card"> --}}
            <div class="card-header bg-white border-0 pb-0">
                <h4 class="card-title text-dark mb-0">DATA PEGAWAI</h4>
            </div>
            <div class="card-body">
                <form id="pegawai-form">
                    <div id="pegawai-container">
                        <div class="pegawai-item border p-3 mb-3 rounded">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" name="nama_pegawai[]" placeholder="Masukkan Nama Pegawai" required>
                            </div>
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="number" class="form-control" name="nip[]" placeholder="Masukkan NIP" required>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Jabatan" required>
                            </div>
                            <div class="form-group">
                                <label>Bidang</label>
                                <select class="form-control select2-success" name="bidang[]" required>
                                    <option value="">Pilih Bidang</option>
                                    <option value="Sekretariat">Sekretariat</option>
                                    <option value="TSDI">Teknologi Sumber Daya Industri</option>
                                    <option value="UMKM">UMKM</option>
                                    <option value="Koperasi">Koperasi</option>
                                    <option value="UPT">UPT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="add-pegawai">Tambah Pegawai</button>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success" id="saveBtn">Simpan</button>
                    </div>
                </form>
            </div>
        {{-- </div> --}}
    </div>
    
    <style>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-success').select2({
            theme: 'default select2-success',
            width: '100%'
        });
    });
</script>

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
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" class="form-control" name="nama_pegawai[]" placeholder="Masukkan nama pegawai" required>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="number" class="form-control" name="nip[]" placeholder="Masukkan NIP" required>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan jabatan" required>
                </div>
                <div class="form-group">
                    <label>Bidang</label>
                    <select class="form-control" name="bidang[]" required>
                        <option value="">-- Pilih Bidang --</option>
                        <option value="Sekretariat">Sekretariat</option>
                        <option value="TSDI">TSDI</option>
                        <option value="UMKM">UMKM</option>
                        <option value="Koperasi">Koperasi</option>
                        <option value="UPT">UPT</option>
                    </select>
                </div>
                <div class="text-end">
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