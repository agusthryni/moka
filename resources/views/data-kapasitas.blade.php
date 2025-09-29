@extends('layout.main')

@section('title', 'SIIBA | Data Kapasitas Produksi')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Kapasitas Produksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Data Kapasitas Produksi</li>
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
                        <h3 class="card-title">Daftar Kapasitas Produksi Industri</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12">
                                <a href="{{ route('data-kapasitas-produksi') }}" class="btn btn-info ml-1">
                                    <img src="{{ asset('images/refresh.png') }}" alt="Refresh Icon"
                                        style="width: 21px; height: 21px; padding: 1px;"> Muat Ulang
                                </a>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-striped display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Pelaku Usaha</th>
                                    <th>NIB</th>
                                    <th>KBLI</th>
                                    <th>Jenis KBLI</th>
                                    <th>Nama Produk</th>
                                    <th>Kapasitas</th>
                                    <th>Satuan</th>
                                    <th>ID KBLI Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $usaha)
                                    @foreach ($usaha->kapasitasProduksi as $produksi)
                                        <tr>
                                            <td>{{ $usaha->nama }}</td>
                                            <td>{{ $usaha->NIB }}</td>
                                            <td>{{ $produksi->kbli ? $produksi->kbli->id_kbli : 'N/A' }}</td>
                                            <td>{{ $produksi->kbli ? $produksi->kbli->jenis_kbli : 'N/A' }}</td>
                                            <td>{{ $produksi->nama_produk }}</td>
                                            <td>{{ $produksi->kapasitas }}</td>
                                            <td>{{ $produksi->satuan }}</td>
                                            <td>{{ $produksi->id_kbli ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
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
                { data: "nama_pelaku_usaha" },
                { data: "NIB" },
                { data: "kbli" },
                { data: "jenis_kbli" },
                { data: "nama_produk" },
                { data: "kapasitas" },
                { data: "satuan" },
                { data: "id_kbli_produk" }
            ]
        });
    });
</script>
@endsection
