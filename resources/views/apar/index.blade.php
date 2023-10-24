@extends("templates.master")
@section("title")
Kelola Apar
@endsection
@section("content")
<div class="row mt-5">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Segitiga Apar</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Ada</td>
                            <td>Tidak Ada</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $countPunyaSegitiga }}</td>
                            <td>{{ $countTakPunyaSegitiga }}</td>
                            <td>{{ $countPunyaSegitiga + $countTakPunyaSegitiga  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kartu Pemelirahan</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Ada</td>
                            <td>Tidak Ada</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $countPunyaKartuPemeliharaan }}</td>
                            <td>{{ $countTakPunyaKartuPemeliharaan }}</td>
                            <td>{{ $countPunyaKartuPemeliharaan + $countTakPunyaKartuPemeliharaan  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Petunjuk Penggunaan</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Ada</td>
                            <td>Tidak Ada</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $countPunyaPetunjuk }}</td>
                            <td>{{ $countTakPunyaPetunjuk }}</td>
                            <td>{{ $countPunyaPetunjuk + $countTakPunyaPetunjuk  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--  -->
<div class="card col-md-12 mt-5">
    <div class="card-header">Kelola Apar</div>
    <div class="card-body">
        <a href="{{ url('apar/create') }}" class="btn btn-primary mb-3">
            Tambah Data
        </a>
        <div class="table-responsive">
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Kondisi</th>
                        <th>Segitiga Apar</th>
                        <th>Kartu Pemeliharaan</th>
                        <th>Petunjuk Penggunaan</th>
                        <th>Jenis</th>
                        <th>Ukuran</th>
                        <th>Kadaluarsa</th>
                        <th>Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push("scripts")
<script>
$(function() {
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ajax: "{{ url('apar/datatable') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'lokasi',
                name: 'lokasi'
            },
            {
                data: 'kondisi',
                name: 'kondisi'
            },
            {
                data: 'segitiga_apar',
                name: 'segitiga_apar',
            },
            {
                data: 'kartu_pemeliharaan',
                name: 'kartu_pemeliharaan',
            },
            {
                data: 'petunjuk_penggunaan',
                name: 'petunjuk_penggunaan',
            },
            {
                data: 'jenis',
                name: 'jenis',
            },
            {
                data: 'ukuran',
                name: 'ukuran',
            },
            {
                data: 'tanggal_kadaluarsa',
                name: 'tanggal_kadaluarsa',
            },
            {
                data: 'keterangan',
                name: 'keterangan',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        createdRow: function(row, data, dataIndex) {
            if (data["status_kadaluarsa"] == "1") {
                $(row).css("background-color", "Orange");
                $(row).addClass("warning");
            }
        },
    });
});

function hapus(apar_id) {
    Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah yakin menghapus data ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('api/apar/delete') }}" + "/" + apar_id,
                type: "DELETE",
                success: function(res) {
                    Swal.fire('Berhasil', res.message, 'success');
                    $('#datatable').DataTable().ajax.reload();
                }
            })
        }
    })
}
</script>
@endpush