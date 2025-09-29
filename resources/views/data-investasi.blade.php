@extends('layout.main')

@section('title', 'SIIBA | Data Investasi')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Investasi Industri</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Data Investasi Industri</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
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
                        <h3 class="card-title">Daftar Investasi Industri di Balikpapan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12">
                                <a href="{{ route('data-investasi') }}" class="btn btn-info ml-1">
                                    <img src="{{ asset('images/refresh.png') }}" alt="Refresh Icon"
                                        style="width: 21px; height: 21px; padding: 1px;"> Muat Ulang
                                </a>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-striped display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Modal Usaha</th>
                                    <th>Investasi Mesin</th>
                                    <th>Investasi Lainnya</th>
                                    <th>Total Investasi</th>
                                    <th>KBLI</th>
                                    <th>Jenis KBLI</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $usaha)
                                    <tr>
                                        <td>{{ $usaha->nama }}</td>
                                        <td>{{ $usaha->investasi->modal_usaha }}</td>
                                        <td>{{ $usaha->investasi->investasi_mesin }}</td>
                                        <td>{{ $usaha->investasi->investasi_lainnya }}</td>
                                        <td>{{ $usaha->investasi->modal_usaha + $usaha->investasi->investasi_mesin + $usaha->investasi->investasi_lainnya }}</td>
                                        <td>{{ $usaha->kbli->id_kbli }}</td>
                                        <td>{{ $usaha->kbli->jenis_kbli }}</td>
                                        <td>{{ $usaha->alamat->alamat_usaha }}</td>
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
                targets: [0, 1, 2, 3, 4, 5, 6],
                className: 'dt-head-center'
            }],
            columns: [
                { data: "nama" },
                { data: "modal_usaha" },
                { data: "investasi_mesin" },
                { data: "investasi_lainnya" },
                { data: "total_investasi" },
                { data: "id_kbli" },
                { data: "jenis_kbli" },
                { data: "alamat_usaha" }
            ]
        });
    });
</script>
@endsection
