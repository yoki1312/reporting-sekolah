<?php

namespace App\Http\Controllers;

use App\Models\KategoriUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkCOntroller extends Controller
{
    public function spk_smart(){
        $data = DB::select("SELECT * FROM m_user ta LEFT JOIN m_user_sekolah tb ON tb.id_user = ta.id_user LEFT JOIN m_sekolahan tc ON tc.id_sekolahan = tb.id_sekolah WHERE tc.id_jenjang = 2 AND tb.id_jabatan = 1 ORDER BY ta.nama_user ASC LIMIT 10");

        $matkul = KategoriUjian::where('id_jabatan',1)->get();

        $id_user = implode(',' , collect($data)->pluck('id_user')->toArray());

        $nilai = DB::select("select * from `t_nilai_ujian` where `id_user` in (". $id_user .")") ; 
        return view('spk.smart', compact('data', 'matkul', 'nilai'));
    }
    public function spk_saw(){
        $data = DB::select("SELECT * FROM m_user ta LEFT JOIN m_user_sekolah tb ON tb.id_user = ta.id_user LEFT JOIN m_sekolahan tc ON tc.id_sekolahan = tb.id_sekolah WHERE tc.id_jenjang = 2 AND tb.id_jabatan = 1 ORDER BY ta.nama_user ASC LIMIT 10");

        $matkul = KategoriUjian::where('id_jabatan',1)->get();

        $id_user = implode(',' , collect($data)->pluck('id_user')->toArray());

        $nilai = DB::select("select * from `t_nilai_ujian` where `id_user` in (". $id_user .")") ; 
        return view('spk.saw', compact('data', 'matkul', 'nilai'));
    }
}
