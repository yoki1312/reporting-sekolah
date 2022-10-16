<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferensiSelect2Controller extends Controller
{
    public function select2sekolah(Request $request){
        $sql = "select * from m_sekolahan where 1 =1";
        if(isset($request->q)){
            $sql .= " and nama_sekolahan LIKE '%$request->q%' ";
        }
        return DB::select($sql);
    }

    public function select2kecamatan(Request $request){
        $sql = "select * from m_kecamatan where 1 =1";
        if(isset($request->q)){
            $sql .= " and nama_kecamatanan LIKE '%$request->q%' ";
        }
        return DB::select($sql);
    }
    public function select2jenjang(Request $request){
        $sql = "select * from m_jenjang where 1 =1";
        if(isset($request->q)){
            $sql .= " and nama_jenjang LIKE '%$request->q%' ";
        }
        return DB::select($sql);
    }

    public function select2bidang(Request $request){
        $sql = "select ta.*, tb.nama_jabatan from m_kategori_ujian ta left join m_jabatan tb on tb.id_jabatan = ta.id_jabatan where 1 =1";
        if(isset($request->id_jabatan)){
            $sql .= " and ta.id_jabatan = $request->id_jabatan ";
        }
        if(isset($request->q)){
            $sql .= " and ta.nama_bidang LIKE '%$request->q%' ";
        }
        // printJSON($sql);
        return DB::select($sql);
    }
}
