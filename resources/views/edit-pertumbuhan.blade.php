@extends('layout.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data Pertumbuhan Kegiatan Industri</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-pertumbuhan') }}">Data Pertumbuhan</a></li>
                    <li class="breadcrumb-item active">Edit Pertumbuhan</li>
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
                    <h3 class="card-title">Edit Pertumbuhan Kegiatan Industri</h3>
                </div>
                <form id="pertumbuhan-form" action="{{ route('data-pertumbuhan.update', $pertumbuhan->id_pertumbuhan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Periode -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="periode">Periode (Tahun)</label>
                                    <input type="number" class="form-control" id="periode" name="periode"
                                           value="{{ old('periode', $pertumbuhan->periode) }}" required>
                                </div>
                            </div>

                            <!-- Jenis Data -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="jenis_data">Jenis Data</label>
                                    <select class="form-control" id="jenis_data" name="jenis_data" required>
                                        <option value="">Pilih Jenis Data</option>
                                        <option value="Verifikasi" {{ $pertumbuhan->jenis_data == 'Verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                        <option value="Pengawasan" {{ $pertumbuhan->jenis_data == 'Pengawasan' ? 'selected' : '' }}>Pengawasan</option>
                                        <option value="Energi" {{ $pertumbuhan->jenis_data == 'Energi' ? 'selected' : '' }}>Energi</option>
                                        <option value="Bahan Baku" {{ $pertumbuhan->jenis_data == 'Bahan Baku' ? 'selected' : '' }}>Bahan Baku</option>
                                        <option value="Tenaga Kerja" {{ $pertumbuhan->jenis_data == 'Tenaga Kerja' ? 'selected' : '' }}>Tenaga Kerja</option>
                                        <option value="Investasi" {{ $pertumbuhan->jenis_data == 'Investasi' ? 'selected' : '' }}>Investasi</option>
                                        <option value="Produksi" {{ $pertumbuhan->jenis_data == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                                        <option value="Skala Usaha" {{ $pertumbuhan->jenis_data == 'Skala Usaha' ? 'selected' : '' }}>Skala Usaha</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="number" class="form-control" id="total" name="total"
                                           value="{{ old('total', $pertumbuhan->total) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ml-4 mb-3">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <a href="{{ route('data-pertumbuhan') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
document.getElementById('pertumbuhan-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let form = this;
    let formData = new FormData(form);

    fetch(form.action, {
        method: 'POST', 
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
            }).then(() => {
                window.location.href = "{{ route('data-pertumbuhan') }}";
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Terjadi kesalahan.',
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat menghubungi server.',
        });
    });
});
</script>
@endsection
