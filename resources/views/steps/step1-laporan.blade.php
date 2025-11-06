{{-- 1 - LAPORAN --}}
<div class="step">
    <h5 class="text-success mb-3">LAPORAN</h5>
    <div class="form-group">
        <label for="bidang">Bidang</label>
        <select class="form-control" id="bidang" name="bidang" required>
            <option value="">Pilih Bidang</option>
            <option value="Sekretariat">Sekretariat</option>
            <option value="Teknologi Sumber Daya Industri">TSDI</option>
            <option value="UMKM">IKM</option>
            <option value="Koperasi">Koperasi</option>
            <option value="UPT Sumber">UPT</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tahun">Tahun</label>
        <select class="form-control select2-success" id="tahun" name="tahun" required>
            <option value="">Pilih Tahun</option>
            @php
                $currentYear = date('Y');
            @endphp
            @for ($year = $currentYear; $year >= 2020; $year--)
                <option value="{{ $year }}"{{ $year == $currentYear ? 'selected' : '' }}>{{ $year }}</option>
            @endfor
        </select>
    </div>
    <div class="form-group">
        <label for="triwulan">Triwulan</label>
        <select class="form-control" id="triwulan" name="triwulan" required>
            <option value="">Pilih Triwulan</option>
            @php
                $currentTri = ceil(date('n') / 3); // hitung triwulan sekarang (1–4)
            @endphp
            <option value="I" {{ $currentTri == 1 ? 'selected' : '' }}>Triwulan I</option>
            <option value="II" {{ $currentTri == 2 ? 'selected' : '' }}>Triwulan II</option>
            <option value="III" {{ $currentTri == 3 ? 'selected' : '' }}>Triwulan III</option>
            <option value="IV" {{ $currentTri == 4 ? 'selected' : '' }}>Triwulan IV</option>
        </select>
    </div>
</div>

