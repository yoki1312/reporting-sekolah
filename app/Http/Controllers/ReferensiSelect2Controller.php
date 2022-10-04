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
}
