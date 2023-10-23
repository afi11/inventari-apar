@extends("templates.master")
@section("title")
Tambah Apar
@endsection
@section("content")
<div class="card col-md-12 mt-5">
    <div class="card-header">Tambah Apar</div>
    <div class="card-body">
        <form method="POST" action="{{ url('api/apar/store') }}">
            @csrf
            <div class="row mb-2">
                <div class="form-group col-md-6">
                    <label>Lokasi</label>
                    <select style="width: 100%;" class="lokasi form-control" name="lokasi">
                        @foreach($lokasi as $row)
                        <option value="{{ $row->lokasi }}">{{ $row->lokasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Kondisi</label>
                    <textarea class="form-control" name="kondisi"></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col-md-6">
                    <label>Segitiga Apar</label>
                    <select class="form-select" name="segitiga_apar">
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Kartu Pemeliharaan</label>
                    <select class="form-select" name="kartu_pemeliharaan">
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col-md-6">
                    <label>Petunjuk Pemeliharaan</label>
                    <select class="form-select" name="petunjuk_penggunaan">
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Jenis</label>
                    <select style="width: 100%;" name="jenis" class="jenis">
                        @foreach($jenis as $row)
                        <option value="{{ $row->jenis }}">{{ $row->jenis }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col-md-6">
                    <label>Ukuran (kg)</label>
                    <select style="width: 100%;" name="ukuran" class="ukuran">
                        @foreach($ukuran as $row)
                        <option value="{{ $row->ukuran }}">{{ $row->ukuran }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Tanggal Kadaluarsa</label>
                    <input class="form-control" type="date" name="tanggal_kadaluarsa" />
                </div>
                <div class="form-group col-md-6 mt-3">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push("scripts")
<script>
$(".lokasi").select2({
    tags: true,
    selectOnClose: true
});

$(".jenis").select2({
    tags: true
});

$(".ukuran").select2({
    tags: true
});
</script>
@endpush