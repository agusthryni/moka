@extends('layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data KBLI Industri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('data-kbli') }}">Data KBLI</a></li>
                        <li class="breadcrumb-item active">Edit KBLI</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <!-- Card for Data Pelaku Usaha -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Data KBLI</h3>
                    </div>
                    <form id="kbli-form" action="{{ route('data-kbli.update', $kbli->id_kbli) }}" method="post">
                        @csrf
                        @method('PUT') <!-- Tambahkan method PUT -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- ID KBLI -->
                                    <div class="form-group">
                                        <label for="id_kbli">ID KBLI</label>
                                        <input type="number" class="form-control" id="id_kbli" name="id_kbli"
                                            max="99999" value="{{ old('id_kbli', $kbli->id_kbli) }}" required>
                                        <div class="text-danger" id="error-id_kbli"></div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <!-- Jenis KBLI -->
                                    <div class="form-group">
                                        <label for="jenis_kbli">Jenis KBLI</label>
                                        <input type="text" class="form-control" id="jenis_kbli" name="jenis_kbli"
                                            value="{{ old('jenis_kbli', $kbli->jenis_kbli) }}" required>
                                        <div class="text-danger" id="error-jenis_kbli"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary ml-4">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- SweetAlert CDN -->

    <script>
        document.getElementById('kbli-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            var idKbli = document.getElementById('id_kbli').value;
            if (idKbli.length !== 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ID KBLI harus 5 digit.',
                });
                return;
            }

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
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data KBLI berhasil diperbarui.',
                        }).then(() => {
                            window.location.href = "{{ route('data-kbli') }}"; // Redirect to data-kbli
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memperbarui data.',
                    });
                });
        });
    </script>
@endsection
