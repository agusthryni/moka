@extends('layout.main')

@section('title', 'MOKA | DATA PEGAWAI')

@section('content')
    <section class="content-header text-center py-5 mt-5">
        <div class="container-fluid">
            <h1 class="text-success font-weight-bold mb-1">LAPORAN DAN MONEV KINERJA PEGAWAI</h1>
            <h6 class="text-success">Dinas Koperasi, UMKM, dan Perindustrian Kota Balikpapan</h6>
            <a href="{{ route('data-pegawai.input') }}" class="btn btn-success btn-lg mt-4">Input Data Pegawai</a>
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

            <h5><span>Daftar Pegawai</span></h5>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-sm compact display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>NIP</th>
                                        <th>Jabatan</th>
                                        <th>Bidang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->nama_pegawai }}</td>
                                            <td>{{ $p->nip }}</td>
                                            <td>{{ $p->jabatan }}</td>
                                            <td>{{ $p->bidang }}</td>
                                            <td>
                                                <a href="{{ route('data-pegawai.edit', $p->id_pegawai) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('data-pegawai.delete', $p->id_pegawai) }}')">Hapus</button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                responsive: true,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5],
                    className: 'dt-head-center'
                }]
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

