@extends('layout.main')

@section('title', 'SIIBA | Data KBLI')

@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data KBLI Industri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Data KBLI</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Flash messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar KBLI Industri</h3>
                        </div>

                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <a href="{{ route('data-kbli.input') }}" class="btn btn-primary">Tambah Data</a>
                                    <a href="{{ route('data-kbli') }}" class="btn btn-info ml-1">
                                        <img src="{{ asset('images/refresh.png') }}" alt="Refresh Icon"
                                            style="width: 21px; height: 21px; padding: 1px;"> Muat Ulang
                                    </a>
                                </div>
                            </div>
                            <table id="example1" class="table table-bordered table-striped display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>KBLI</th>
                                        <th>Jenis KBLI</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kbli_industri as $kbli)
                                        <tr>
                                            <td>{{ $kbli->id_kbli }}</td>
                                            <td>{{ $kbli->jenis_kbli }}</td>
                                            <td>
                                                <a href="{{ Route('data-kbli.edit', $kbli->id_kbli) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('data-kbli.delete', $kbli->id_kbli) }}')">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                responsive: true,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                    className: 'dt-head-center'
                }],
                columns: [{
                        data: "id_kbli"
                    },
                    {
                        data: "jenis_kbli"
                    },
                    {
                        data: "aksi"
                    }
                ]
            });
        });

        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
