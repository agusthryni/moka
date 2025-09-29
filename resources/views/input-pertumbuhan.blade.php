@extends('layout.main')

@section('title', 'SIIBA | Data Pertumbuhan')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Pertumbuhan Kegiatan Industri - SIINAS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-pertumbuhan') }}">Data Pertumbuhan</a></li>
                    <li class="breadcrumb-item active">Tambah Pertumbuhan</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Periode</h3>
                </div>
                <form id="pertumbuhan-form" action="{{ route('data-pertumbuhan.store') }}" method="POST">
                    @csrf
                    {{-- Periode --}}
                    <div class="card-body">
                        <!-- Periode yang dilaporkan -->
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <input type="number" class="form-control" id="periode" name="periode[]" required>
                        </div>
                    </div>
                    {{-- Jenis Data --}}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Jenis Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="verifikasi">Verifikasi</label>
                                <input type="number" class="form-control" id="verifikasi"
                                    name="verifikasi" required>
                            </div>
                            <div class="form-group">
                                <label for="pengawasan">Pengawasan</label>
                                <input type="number" class="form-control" id="pengawasan"
                                    name="pengawasan" required>
                            </div>
                            <div class="form-group">
                                <label for="energi">Energi</label>
                                <input type="number" class="form-control" id="energi"
                                    name="energi" required>
                            </div>
                            <div class="form-group">
                                <label for="bahan_baku">Bahan Baku</label>
                                <input type="number" class="form-control" id="bahan_baku"
                                    name="bahan_baku" required>
                            </div>
                            <div class="form-group">
                                <label for="tenaga_kerja">Tenaga Kerja</label>
                                <input type="number" class="form-control" id="tenaga_kerja"
                                    name="tenaga_kerja" required>
                            </div>
                            <div class="form-group">
                                <label for="investasi">Investasi</label>
                                <input type="number" class="form-control" id="investasi"
                                    name="investasi" required>
                            </div>
                            <div class="form-group">
                                <label for="produksi">Produksi</label>
                                <input type="number" class="form-control" id="produksi"
                                    name="produksi" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                            <button type="submit" class="btn btn-primary ml-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#pertumbuhan-form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('data-pertumbuhan.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                }).then(function() {
                                    window.location.href = "{{ url('/siiba/data-pertumbuhan') }}";
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
    @endsection
                    <!-- <div class="card-body">
                        <div id="pertumbuhan-input-container">
                            <div class="row pertumbuhan-input-row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Periode</label>
                                        <input type="number" class="form-control" name="periode[]" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Data</label>
                                        <select class="form-control" name="jenis_data[]" required>
                                            <option value="">Pilih Jenis Data</option>
                                            <option value="Verifikasi">Verifikasi</option>
                                            <option value="Pengawasan">Pengawasan</option>
                                            <option value="Energi">Energi</option>
                                            <option value="Bahan Baku">Bahan Baku</option>
                                            <option value="Tenaga Kerja">Tenaga Kerja</option>
                                            <option value="Investasi">Investasi</option>
                                            <option value="Produksi">Produksi</option>
                                            <option value="Skala Usaha">Skala Usaha</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" class="form-control" name="total[]" required>
                                    </div>
                                </div>
                                <div class="col mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-row" onclick="removePertumbuhanRow(this)">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-row">Tambah Data</button>
                        <div id="error-container"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ml-4">Simpan</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Hapus row
    function removePertumbuhanRow(button) {
        var row = button.closest('.pertumbuhan-input-row');
        row.remove();
    }

    // Tambah row baru
    document.getElementById('add-row').addEventListener('click', function() {
        var container = document.getElementById('pertumbuhan-input-container');
        var newRow = document.createElement('div');
        newRow.classList.add('row', 'pertumbuhan-input-row');
        newRow.innerHTML = `
            <div class="col-md-2">
                <div class="form-group">
                    <label>Periode</label>
                    <input type="number" class="form-control" name="periode[]" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Data</label>
                    <select class="form-control" name="jenis_data[]" required>
                        <option value="">Pilih Jenis Data</option>
                        <option value="Verifikasi">Verifikasi</option>
                        <option value="Pengawasan">Pengawasan</option>
                        <option value="Energi">Energi</option>
                        <option value="Bahan Baku">Bahan Baku</option>
                        <option value="Tenaga Kerja">Tenaga Kerja</option>
                        <option value="Investasi">Investasi</option>
                        <option value="Produksi">Produksi</option>
                        <option value="Skala Usaha">Skala Usaha</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" class="form-control" name="total[]" required>
                </div>
            </div>
            <div class="col mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-row" onclick="removePertumbuhanRow(this)">Hapus</button>
            </div>
        `;
        container.appendChild(newRow);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Submit form pakai AJAX
    $(document).ready(function() {
        $('#pertumbuhan-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('data-pertumbuhan.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        }).then(function() {
                            window.location.href = "{{ url('/siiba/data-pertumbuhan') }}";
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
