{{-- @extends('layout.main')

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
                                        <th>Nama Pelapor</th>
                                        <th>Jabatan Pelapor</th>
                                        <th>Nama Pimpinan Monev</th>
                                        <th>Jabatan Pimpinan Monev</th>
                                        <th>Kegiatan</th>
                                        <th>Indikator Kegiatan</th>
                                        <th>Satuan</th>
                                        <th>Target</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Pagu</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Keterangan</th>
                                        <th>Faktor Pendorong</th>
                                        <th>Faktor Penghambat</th>
                                        <th>Rekomendasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_laporan as $laporan)
                                        <tr>
                                            <td>{{ $laporan->id_kegiatan }}</td>
                                            <td>{{ $laporan->id_laporan }}</td>
                                            <td>{{ $laporan->urutan }}</td>
                                            <td>{{ $laporan->level }}</td>
                                            <td>{{ $laporan->id_pegawai_pelapor }}</td>
                                            <td>{{ $laporan->id_pimpinan_monev }}</td>
                                            <td>{{ \Carbon\Carbon::parse($laporan->tanggal_permohonan)->format('Y-m-d') }}</td>
                                            <td>{{ $laporan->kegiatan }}</td>
                                            <td>{{ $laporan->indikator_kegiatan }}</td>
                                            <td>{{ $laporan->satuan_kegiatan }}</td>
                                            <td>{{ $laporan->target_kegiatan }}</td>
                                            <td>{{ $laporan->realisasi_kinerja_kegiatan }}</td>
                                            <td>{{ $laporan->persen_kinerja_kegiatan }}</td>
                                            <td>{{ $laporan->pagu_kegiatan }}</td>
                                            <td>{{ $laporan->realisasi_keuangan_kegiatan }}</td>
                                            <td>{{ $laporan->persen_keuangan_kegiatan }}</td>
                                            <td>{{ $laporan->keterangan_kegiatan }}</td>
                                            <td>{{ $laporan->faktor_pendorong_kegiatan }}</td>
                                            <td>{{ $laporan->faktor_penghambat_kegiatan }}</td>
                                            <td>{{ $laporan->rekomendasi_kegiatan }}</td>
                                            <td>
                                                <a href="{{ route('data-laporan.edit', $kegiatan->id_kegiatan) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('data-laporan.delete', $kegiatan->id_kegiatan) }}')">Hapus</button>
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
                    {data: "data_pegawai.nama_pegawai"},
                    {data: "data_pegawai.jabatan_pegawai"},
                    {data: "data_pegawai.nama_pegawai"},
                    {data: "data_pegawai.jabatan_pegawai"},
                    {data: "kegiatan"},
                    {data: "indikator_kegiatan"},
                    {data: "satuan_kegiatan"},
                    {data: "target_kegiatan"},
                    {data: "realisasi_kinerja_kegiatan"},
                    {data: "persen_kinerja_kegiatan"},
                    {data: "pagu_kegiatan"},
                    {data: "realisasi_keuangan_kegiatan"},
                    {data: "persen_keuangan_kegiatan"},
                    {data: "keterangan_kegiatan"},
                    {data: "faktor_pendorong_kegiatan"},
                    {data: "faktor_penghambat_kegiatan"},
                    {data: "rekomendasi_kegiatan"},
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
@endsection --}}
