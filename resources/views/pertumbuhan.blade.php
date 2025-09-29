@extends('layout.main')

@section('title', 'SIIBA | Pertumbuhan Kegiatan Industri')

@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pertumbuhan Kegiatan Industri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Pertumbuhan Kegiatan Industri</li>
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
                            <h3 class="card-title">Pertumbuhan Kegiatan Industri</h3>
                        </div>

                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <a href="{{ route('data-pertumbuhan.input') }}" class="btn btn-primary">Tambah Data</a>
                                    <a href="{{ route('data-pertumbuhan') }}" class="btn btn-info ml-1">
                                        <img src="{{ asset('images/refresh.png') }}" alt="Refresh Icon"
                                            style="width: 21px; height: 21px; padding: 1px;"> Muat Ulang
                                    </a>
                                </div>
                            </div>
                            <table id="example1" class="table table-bordered table-striped display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Jenis Data</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pertumbuhan as $item)
                                        <tr>
                                            <td>{{ $item->periode }}</td>
                                            <td>{{ $item->jenis_data }}</td>
                                            <td>{{ $item->total}}</td>
                                            <td>
                                                <a href="{{ Route('data-pertumbuhan.edit', $item->id_pertumbuhan) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('data-pertumbuhan.delete', $item->id_pertumbuhan) }}')">Hapus</button>
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
                    targets: [0, 1, 2, 3, 4],
                    className: 'dt-head-center'
                }],
                columns: [
                    {data: "id_pertumbuhan"},
                    {data: "jenis_data"},
                    {data: "periode"},
                    {data: "total"}
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
