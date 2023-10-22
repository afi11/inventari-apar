<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apar;
use Yajra\DataTables\Facades\DataTables;

class CRUDController extends Controller
{
    
    public function getDataTable(Request $request)
    {
        if (request()->ajax()) {
            $apars = Apar::orderBy("tanggal_kadaluarsa", "ASC")->get();
            return DataTables::of($apars)
                ->addIndexColumn()
                ->addColumn('segitiga_apar', function($row){
                    $status = "";
                    if($row->segitiga_apar == 0){
                        $status = "Tidak Ada";
                    }else{
                        $status = "Ada";
                    }
                    return $status;
                })
                ->addColumn('kartu_pemeliharaan', function($row){
                    $status = "";
                    if($row->kartu_pemeliharaan == 0){
                        $status = "Tidak Ada";
                    }else{
                        $status = "Ada";
                    }
                    return $status;
                })
                ->addColumn('petunjuk_penggunaan', function($row){
                    $status = "";
                    if($row->petunjuk_penggunaan == 0){
                        $status = "Tidak Ada";
                    }else{
                        $status = "Ada";
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url("apar/detail/".$row->id).'" class="btn btn-info btn-sm">Lihat</a>';
                    $actionBtn .= '<button onclick="delete('.$row->id.')" class="btn btn-danger btn-sm">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'petunjuk_penggunaan', 'kartu_pemeliharaan', 'segitiga_apar'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $apar = new Apar();
        $apar->lokasi = $request->lokasi;
        $apar->kondisi = $request->kondisi;
        $apar->segitiga_apar = $request->segitiga_apar;
        $apar->kartu_pemeliharaan = $request->kartu_pemeliharaan;
        $apar->petunjuk_penggunaan = $request->petunjuk_penggunaan;
        $apar->jenis = $request->jenis;
        $apar->ukuran = $request->ukuran;
        $apar->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;
        $apar->keterangan = $request->keterangan;
        $apar->save();
        return redirect("/")->with("success", "Berhasil menambahkan data apar");
    }

    public function update(Request $request, $id)
    {
        $apar = Apar::find($id);
        $apar->lokasi = $request->lokasi;
        $apar->kondisi = $request->kondisi;
        $apar->segitiga_apar = $request->segitiga_apar;
        $apar->kartu_pemeliharaan = $request->kartu_pemeliharaan;
        $apar->petunjuk_penggunaan = $request->petunjuk_penggunaan;
        $apar->ukuran = $request->ukuran;
        $apar->jenis = $request->jenis;
        $apar->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;
        $apar->keterangan = $request->keterangan;
        $apar->save();
        return redirect("/")->with("success", "Berhasil mengubah data apar");
    }

    public function delete($id)
    {
        $apar = Apar::find($id);
        $apar->delete();
        return response()->json(["message" => "Berhasil menghapus data apar"]);
    }

}
