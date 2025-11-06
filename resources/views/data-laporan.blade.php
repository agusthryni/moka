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

            <!-- Filter Section -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Filter Data</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('data-industri') }}" class="row g-3">
                                <div class="col-md-3">
                                    <label for="triwulan" class="form-label">Triwulan</label>
                                    <select name="triwulan" id="triwulan" class="form-control">
                                        <option value="">Semua Triwulan</option>
                                        @foreach($triwulanList ?? [] as $t)
                                            <option value="{{ $t }}" {{ request('triwulan') == $t ? 'selected' : '' }}>
                                                {{ $t }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="">Semua Tahun</option>
                                        @foreach($tahunList ?? [] as $th)
                                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>
                                                {{ $th }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="bidang" class="form-label">Bidang</label>
                                    <select name="bidang" id="bidang" class="form-control">
                                        <option value="">Semua Bidang</option>
                                        @foreach($bidangList ?? [] as $b)
                                            <option value="{{ $b }}" {{ request('bidang') == $b ? 'selected' : '' }}>
                                                {{ $b }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-success me-2">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('data-industri') }}" class="btn btn-secondary">
                                        <i class="fas fa-redo"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                                    @forelse ($laporans as $laporan)
                                        @foreach ($laporan->programs as $program)
                                            <tr>
                                                <td>{{ optional($program->pegawaiPelapor)->nama_pegawai ?? '-' }}</td>
                                                <td>{{ optional($program->pegawaiPelapor)->jabatan ?? '-' }}</td>
                                                <td>{{ optional($program->pimpinanMonev)->nama_pegawai ?? '-' }}</td>
                                                <td>{{ optional($program->pimpinanMonev)->jabatan ?? '-' }}</td>
                                                <td>{{ $program->program }}</td>
                                                <td>{{ $program->indikator_program }}</td>
                                                <td>{{ $program->satuan_program }}</td>
                                                <td>{{ number_format($program->target_program, 2) }}</td>
                                                <td>{{ number_format($program->realisasi_kinerja_program, 2) }}</td>
                                                <td>{{ number_format($program->persen_kinerja_program, 2) }}%</td>
                                                <td>{{ number_format($program->pagu_program, 2) }}</td>
                                                <td>{{ number_format($program->realisasi_keuangan_program, 2) }}</td>
                                                <td>{{ number_format($program->persen_keuangan_program, 2) }}%</td>
                                                <td>{{ $program->keterangan_program }}</td>
                                                <td>{{ $program->faktor_pendorong_program }}</td>
                                                <td>{{ $program->faktor_penghambat_program }}</td>
                                                <td>{{ $program->rekomendasi_program }}</td>
                                                <td>
                                                    <a href="{{ route('data-industri.edit', $laporan->id_laporan) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete('{{ route('data-industri.delete', $laporan->id_laporan) }}')">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="18" class="text-center">Tidak ada data laporan</td>
                                        </tr>
                                    @endforelse
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
                scrollX: true,
                order: [[0, 'asc']],
                pageLength: 25
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
