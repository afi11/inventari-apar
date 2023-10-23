<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apar;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CRUDController extends Controller
{
    
    public function getDataTable(Request $request)
    {
        if (request()->ajax()) {
            $apars = Apar::orderBy("tanggal_kadaluarsa", "ASC")->get();
            return DataTables::of($apars)
                ->addIndexColumn()
                ->addColumn('kondisi', function($row){
                    $kondisi = $row->kondisi;
                    return $kondisi;
                })
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
                ->addColumn('status_kadaluarsa', function($row){
                    $status = "";
                    $tglSekarang = strtotime(Carbon::now()->format("Y-m-d"));
                    $tglKadaluarsa = strtotime($row->tanggal_kadaluarsa);
                    if($tglSekarang >= $tglKadaluarsa){
                        $status = 1;
                    }else{
                        $status = 0;
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url("apar/detail/".$row->id).'" class="btn btn-info btn-sm">Lihat</a>';
                    $actionBtn .= '<button onclick="hapus('.$row->id.')" class="btn btn-danger btn-sm">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'petunjuk_penggunaan', 'kartu_pemeliharaan', 'segitiga_apar', 'kondisi', 'status_kadaluarsa'])
                ->make(true);
        }
    }

    public function getData($id)
    {
        $apar = Apar::find($id);
        return $apar;
    }

    public function getLokasi()
    {
        $apars = Apar::select("lokasi")->distinct()->orderBy("lokasi", "ASC")->get();
        return $apars;
    }

    public function getUkuran()
    {
        $apars = Apar::select("ukuran")->distinct()->orderBy("ukuran", "ASC")->get();
        return $apars;
    }

    public function getJenis()
    {
        $apars = Apar::select("jenis")->distinct()->orderBy("jenis", "ASC")->get();
        return $apars;
    }

    public function countSegitigaApar($status)
    {
        $apars = Apar::where("segitiga_apar", $status)->count();
        return $apars;
    }

    public function countPetunjukPenggunaan($status)
    {
        $apars = Apar::where("petunjuk_penggunaan", $status)->count();
        return $apars;
    }

    public function countKartuPemeliharaan($status)
    {
        $apars = Apar::where("kartu_pemeliharaan", $status)->count();
        return $apars;
    }

    public function store(Request $request)
    {
        $apar = new Apar();
        $apar->lokasi = $request->lokasi;
        $apar->kondisi = nl2br($request->kondisi);
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
        $apar->kondisi = nl2br($request->kondisi);
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
