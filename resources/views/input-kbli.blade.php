@extends('layout.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data KBLI Industri</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-kbli') }}">Data KBLI</a></li>
                    <li class="breadcrumb-item active">Tambah KBLI</li>
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
                    <h3 class="card-title">Input Data KBLI</h3>
                </div>
                <form id="kbli-form" action="{{ route('data-kbli.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div id="kbli-input-container">
                            <div class="row kbli-input-row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="id_kbli[]">ID KBLI</label>
                                        <input type="number" class="form-control" name="id_kbli[]" max="99999" title="ID KBLI harus terdiri dari maksimal 5 digit angka." required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="jenis_kbli[]">Jenis KBLI</label>
                                        <input type="text" class="form-control" name="jenis_kbli[]" required>
                                    </div>
                                </div>
                                <div class="col mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-row" onclick="removeKbliRow(this)">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-row">Tambah Data</button>
                        <div id="error-container"></div> <!-- Container untuk menampilkan pesan error -->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ml-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.getElementById('kbli-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
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
                    text: data.success,
                }).then(() => {
                    window.location.href = "{{ route('data-kbli') }}";
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat menyimpan data.',
            });
        });
    });

    function removeKbliRow(button) {
        var row = button.closest('.kbli-input-row');
        row.remove();
    }

    document.getElementById('add-row').addEventListener('click', function() {
        var container = document.getElementById('kbli-input-container');
        var newRow = document.createElement('div');
        newRow.classList.add('row', 'kbli-input-row');
        newRow.innerHTML = `
            <div class="col-md-2">
                <div class="form-group">
                    <label for="id_kbli[]">ID KBLI</label>
                    <input type="number" class="form-control" name="id_kbli[]" max="99999" title="ID KBLI harus terdiri dari maksimal 5 digit angka." required>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="jenis_kbli[]">Jenis KBLI</label>
                    <input type="text" class="form-control" name="jenis_kbli[]" required>
                </div>
            </div>
            <div class="col mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-row" onclick="removeKbliRow(this)">Hapus</button>
            </div>
        `;
        container.appendChild(newRow);
    });
</script>
@endsection
