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
                    @csrf
                    <div id="pegawai-container">
                        <div class="pegawai-item border p-3 mb-3 rounded">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" name="nama_pegawai[]" placeholder="Masukkan Nama Pegawai" required>
                            </div>
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" class="form-control" name="nip[]" placeholder="Masukkan NIP" required>
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
                                    <option value="IKM">IKM</option>
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
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2-success').select2({
            width: '100%'
        });

        // Handle button click directly
        $('#saveBtn').on('click', function(e) {
            e.preventDefault();
            $('#pegawai-form').submit();
        });

        // Form submission handler
        $('#pegawai-form').on('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');

            // Clear previous validation
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            // 🔹 Validasi input kosong
            let isValid = true;
            let firstInvalidField = null;

            // Check all pegawai items
            $('.pegawai-item').each(function(index) {
                const item = $(this);
                
                // Check Nama Pegawai
                const namaInput = item.find('input[name="nama_pegawai[]"]');
                if (!namaInput.val() || !namaInput.val().trim()) {
                    namaInput.addClass('is-invalid');
                    if (namaInput.next('.invalid-feedback').length === 0) {
                        namaInput.after('<div class="invalid-feedback">Wajib diisi</div>');
                    }
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = namaInput;
                }

                // Check NIP
                const nipInput = item.find('input[name="nip[]"]');
                if (!nipInput.val() || !nipInput.val().trim()) {
                    nipInput.addClass('is-invalid');
                    if (nipInput.next('.invalid-feedback').length === 0) {
                        nipInput.after('<div class="invalid-feedback">Wajib diisi</div>');
                    }
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = nipInput;
                }

                // Check Jabatan
                const jabatanInput = item.find('input[name="jabatan[]"]');
                if (!jabatanInput.val() || !jabatanInput.val().trim()) {
                    jabatanInput.addClass('is-invalid');
                    if (jabatanInput.next('.invalid-feedback').length === 0) {
                        jabatanInput.after('<div class="invalid-feedback">Wajib diisi</div>');
                    }
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = jabatanInput;
                }

                // Check Bidang (Select2)
                const bidangSelect = item.find('select[name="bidang[]"]');
                const bidangValue = bidangSelect.val();
                if (!bidangValue || bidangValue === '') {
                    bidangSelect.addClass('is-invalid');
                    if (bidangSelect.next('.invalid-feedback').length === 0) {
                        bidangSelect.after('<div class="invalid-feedback">Wajib diisi</div>');
                    }
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = bidangSelect;
                }
            });

            // 🔹 Jika ada input kosong, hentikan submit
            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lengkapi Data',
                    text: 'Mohon lengkapi semua field yang wajib diisi.',
                });
                if (firstInvalidField) {
                    $('html, body').animate({
                        scrollTop: firstInvalidField.offset().top - 100
                    }, 500);
                    firstInvalidField.focus();
                }
                return false;
            }

            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // 🔹 Lanjutkan kirim data jika valid
            const formData = $(this).serialize();
            console.log('Sending data:', formData);
            
            $.ajax({
                url: "{{ route('data-pegawai.store') }}",
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    console.log('Success response:', response);
                    Swal.close();
                    
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        }).then(function() {
                            window.location.href = "{{ route('data-pegawai') }}";
                        });
                    } else if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.success,
                        }).then(function() {
                            window.location.href = "{{ route('data-pegawai') }}";
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Response tidak dikenali: ' + JSON.stringify(response),
                        });
                    }
                },
                error: function(xhr) {
                    console.log('Error response:', xhr);
                    Swal.close();
                    
                    let errorMessage = 'Terjadi kesalahan saat mengirim data.';
                    
                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors || {};
                        const firstError = Object.values(errors)[0];
                        errorMessage = Array.isArray(firstError) ? firstError[0] : firstError || xhr.responseJSON.message || 'Validasi gagal.';
                    } else if (xhr.status === 400) {
                        errorMessage = xhr.responseJSON.message || 'Data tidak valid.';
                    } else if (xhr.status === 419) {
                        errorMessage = 'Session expired. Silakan refresh halaman dan coba lagi.';
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });
        });

        // === Fungsi Tambah Form Pegawai ===
        $('#add-pegawai').on('click', function () {
            const pegawaiItem = $('<div class="pegawai-item border p-3 mb-3 rounded"></div>');
            
            pegawaiItem.html(`
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" class="form-control" name="nama_pegawai[]" placeholder="Masukkan nama pegawai" required>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip[]" placeholder="Masukkan NIP" required>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan jabatan" required>
                </div>
                <div class="form-group">
                    <label>Bidang</label>
                    <select class="form-control select2-success" name="bidang[]" required>
                        <option value="">Pilih Bidang</option>
                        <option value="Sekretariat">Sekretariat</option>
                        <option value="TSDI">Teknologi Sumber Daya Industri</option>
                        <option value="IKM">IKM</option>
                        <option value="Koperasi">Koperasi</option>
                        <option value="UPT">UPT</option>
                    </select>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-danger btn-sm remove-pegawai">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </div>
            `);

            $('#pegawai-container').append(pegawaiItem);
            
            // Initialize Select2 for the new select field
            pegawaiItem.find('.select2-success').select2({
                width: '100%'
            });
        });

        // === Fungsi Hapus Form Pegawai ===
        $(document).on('click', '.remove-pegawai', function () {
            $(this).closest('.pegawai-item').remove();
        });
    });
</script>
@endpush