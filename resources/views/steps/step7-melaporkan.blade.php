{{-- 7 - MELAPORKAN --}}
<div class="step d-none">
    <h5 class="text-success mb-3">MELAPORKAN</h5>
    <div id="melaporkan-container">
        <div class="melaporkan-item border p-3 mb-3 rounded">
            <div class="form-group">
                <label for="id_pegawai">Nama Pegawai</label>
                <select class="form-control select2-pegawai" name="id_pegawai[]" required>
                    <option value="">Pilih Pegawai</option>
                    @foreach($pegawai as $p)
                        <option value="{{ $p->id_pegawai }}" data-jabatan="{{ $p->jabatan }}" data-nip="{{ $p->nip }}">{{ $p->nama_pegawai }} - {{ $p->nip }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" name="jabatan[]" placeholder="Akan terisi otomatis" readonly required>
            </div>
            <button type="button" class="btn btn-success mt-2" id="add-melaporkan">Tambah Melaporkan</button>
        </div>
    </div>
</div>

