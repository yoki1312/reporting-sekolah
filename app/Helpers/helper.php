<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function printJSON($v){
    header('Access-Control-Allow-Origin: *');
    header("Content-type: application/json");
    echo json_encode($v, JSON_PRETTY_PRINT);
    exit;
}

function id_user_sekolah(){
    $id = DB::table('m_user_sekolah')->where('id_sekolah', Auth::user()->id_sekolahan)->get();
    $id_user = collect($id)->pluck("id_user")->all();
    return implode(",", $id_user);
}

function is_auth(){
    $data = DB::table('m_sekolahan as ta')->leftjoin('m_kecamatan as tb', 'tb.id_kecamatan','ta.id_kecamatan')->first();
    return $data;
}

function rangkingSpk($kriteria, $nilai){
    if( $kriteria == 1 || $kriteria == 2){
        if($nilai > 1 && $nilai <= 5){
            return 1;
        }
        if($nilai > 5 && $nilai <= 10){
            return 2;
        }
        if($nilai > 10 && $nilai <= 15){
            return 3;
        }
        if($nilai > 15 && $nilai <= 25){
            return 4;
        }
    }

    if( $kriteria == 3 || $kriteria == 4){
        if($nilai > 1 && $nilai <= 3){
            return 1;
        }
        if($nilai > 3 && $nilai <= 5){
            return 2;
        }
        if($nilai > 5 && $nilai <= 8){
            return 3;
        }
        if($nilai > 8 && $nilai <= 10){
            return 4;
        }
    }
    
    if( $kriteria == 5 || $kriteria == 6){
        if($nilai > 1 && $nilai <= 4){
            return 1;
        }
        if($nilai > 4 && $nilai <= 8){
            return 2;
        }
        if($nilai > 8 && $nilai <= 11){
            return 3;
        }
        if($nilai > 12 && $nilai <= 15){
            return 4;
        }
    }
}

function bobotSpk($kriteria){
    if( $kriteria == 1){
       return 1;
    }else{
        return 4;
    }

}