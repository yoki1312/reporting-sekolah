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