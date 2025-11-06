@extends('layout.main')

@section('title', 'MOKA | DASHBOARD')

@section('content')
    <section class="content-header text-center py-5 mt-5">
        <div class="container-fluid">
            <h1 class="text-success font-weight-bold mb-1">LAPORAN DAN MONEV KINERJA PEGAWAI</h1>
            <h6 class="text-success">Dinas Koperasi, UMKM, dan Perindustrian Kota Balikpapan</h6>
            <a href="{{ route('data-laporan.input') }}" class="btn btn-success btn-lg mt-4">Input Laporan</a>
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
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm compact display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Pimpinan</th>
                                        <th>Penilaian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_laporan as $laporan)
                                        <tr>
                                            <td>{{ $laporan->pimpinan }}</td>
                                            <td>{{ $laporan->penilaian }}</td>
                                            <td>
                                                <a href="{{ route('data-laporan.edit', $usaha->id_usaha) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('data-laporan.delete', $usaha->id_usaha) }}')">Hapus</button>
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
                responsive: false,
                scrollX: true
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                    className: 'dt-head-center'
                }],
                columns: [
                    {data: "pimpinan"},
                    {data: "penilaian"},
                    {data: "aksi"}
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
