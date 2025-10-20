@extends('layout.main')

@section('title', 'MOKA | DASHBOARD')

@section('content')
    <section class="content-header text-center py-5 mt-5">
        <div class="container-fluid">
            <h1 class="text-success font-weight-bold mb-1">LAPORAN DAN MONEV KINERJA PEGAWAI</h1>
            <h6 class="text-success">Dinas Koperasi, UMKM, dan Perindustrian Kota Balikpapan</h6>
            <a href="{{ route('data-industri.input') }}" class="btn btn-success btn-lg mt-4">Input Laporan</a>
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
                                        <th>Program</th>
                                        <th>Indikator Program</th>
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
                                    @foreach ($pelakuUsaha as $usaha)
                                        <tr>
                                            <td>{{ $usaha->nama }}</td>
                                            <td>{{ $usaha->NIB }}</td>
                                            <td>{{ $usaha->jenis_badan_usaha }}</td>
                                            <td>{{ $usaha->id_kbli }}</td>
                                            <td>{{ optional($usaha->kbli)->jenis_kbli }}</td>
                                            <td>{{ $usaha->skala_usaha }}</td>
                                            <td>{{ $usaha->risiko }}</td>
                                            <td>{{ \Carbon\Carbon::parse($usaha->tanggal_permohonan)->format('Y-m-d') }}</td>
                                            <td>{{ $usaha->jenis_proyek }}</td>
                                            <td>{{ $usaha->email }}</td>
                                            <td>{{ $usaha->no_telp }}</td>
                                            <td>{{ $usaha->alamat->alamat_usaha }}</td>
                                            <td>{{ $usaha->alamat->kecamatan }}</td>
                                            <td>{{ $usaha->alamat->kelurahan }}</td>
                                            <td>{{ $usaha->tenagaKerja->jumlah_tki_perempuan + $usaha->tenagaKerja->jumlah_tki_laki_laki + $usaha->tenagaKerja->jumlah_tenaga_kerja_asing }}</td>
                                            <td>{{ $usaha->investasi->modal_usaha }}</td>
                                            <td>{{ $usaha->investasi->investasi_mesin }}</td>
                                            <td>
                                                <a href="{{ route('data-industri.edit', $usaha->id_usaha) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('data-industri.delete', $usaha->id_usaha) }}')">Hapus</button>
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
                    {data: "nama"},
                    {data: "NIB"},
                    {data: "jenis_badan_usaha"},
                    {data: "id_kbli"},
                    {data: "kbli.jenis_kbli"},
                    {data: "kbli.kode_kbli"},
                    {data: "skala_usaha"},
                    {data: "risiko"},
                    {data: "tanggal_permohonan", render: function(data, type, row) {return moment(data).format('YYYY-MM-DD');}},
                    {data: "jenis_proyek"},
                    {data: "email"},
                    {data: "no_telp"},
                    {data: "alamat.alamat_usaha"},
                    {data: "alamat.kecamatan"},
                    {data: "alamat.kelurahan"},
                    {data: "total_tenaga_kerja"},
                    {data: "investasi.modal_usaha"},
                    {data: "investasi.investasi_mesin"},
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
