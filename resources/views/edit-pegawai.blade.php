@extends('layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data Pegawai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('data-pegawai') }}">Data pegawai</a></li>
                        <li class="breadcrumb-item active">Edit Pegawai</li>
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
                        <h3 class="card-title">Input Data Pegawai</h3>
                    </div>
                    <form id="pegawai-form" action="{{ route('data-pegawai.update', $pegawai->id_pegawai) }}" method="post">
                        @csrf
                        @method('PUT') <!-- Tambahkan method PUT -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- ID pegawai -->
                                    <div class="form-group">
                                        <label for="id_pegawai">Nama Pegawai</label>
                                        <input type="number" class="form-control" id="id_pegawai" name="id_pegawai"
                                            max="99999" value="{{ old('id_pegawai', $pegawai->id_pegawai) }}" required>
                                        <div class="text-danger" id="error-id_pegawai"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Jenis pegawai -->
                                    <div class="form-group">
                                        <label for="jenis_pegawai">NIP</label>
                                        <input type="text" class="form-control" id="jenis_pegawai" name="jenis_pegawai"
                                            value="{{ old('jenis_pegawai', $pegawai->jenis_pegawai) }}" required>
                                        <div class="text-danger" id="error-jenis_pegawai"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- ID pegawai -->
                                    <div class="form-group">
                                        <label for="id_pegawai">Jabatan</label>
                                        <input type="number" class="form-control" id="id_pegawai" name="id_pegawai"
                                            max="99999" value="{{ old('id_pegawai', $pegawai->id_pegawai) }}" required>
                                        <div class="text-danger" id="error-id_pegawai"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Jenis pegawai -->
                                    <div class="form-group">
                                        <label for="jenis_pegawai">Bidang</label>
                                        <input type="text" class="form-control" id="jenis_pegawai" name="jenis_pegawai"
                                            value="{{ old('jenis_pegawai', $pegawai->jenis_pegawai) }}" required>
                                        <div class="text-danger" id="error-jenis_pegawai"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.getElementById('pegawai-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            var idpegawai = document.getElementById('id_pegawai').value;
            if (idpegawai.length !== 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ID pegawai harus 5 digit.',
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
                            text: 'Data pegawai berhasil diperbarui.',
                        }).then(() => {
                            window.location.href = "{{ route('data-pegawai') }}";
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