<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Decimal;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function jumlah_peserta()
    {
        $data = DB::table('m_user as ta')
        ->join('m_sekolahan as tc', 'tc.id_sekolahan', 'ta.id_sekolah')
        ->join('m_kecamatan as td', 'td.id_kecamatan','tc.id_kecamatan')
        ->join('m_jenjang as te', 'te.id_jenjang','tc.id_jenjang')
        ->select(DB::RAW('count(ta.id_user) as total_peserta,te.nama_jenjang, tc.id_jenjang, td.id_kecamatan, td.nama_kecamatan'))
        ->groupby('td.id_kecamatan','tc.id_jenjang')
        ->get();

        $data = collect($data)->groupBy(['id_kecamatan','id_jenjang'])->toArray();
        $ar = array();
        $ar[] = array('Kecamatan','TK',array( 'type' => 'string', 'role' => 'annotation' ),'SD',array( 'type' => 'string', 'role' => 'annotation' ),'SMP',array( 'type' => 'string', 'role' => 'annotation' )); 
        foreach($data as $k => $val){
            $nama_kecamatan = $val[1][0]->nama_kecamatan;
            $tk = $val[1][0]->total_peserta;
            $sd = $val[2][0]->total_peserta;
            $smp = $val[3][0]->total_peserta;
            $ar[] = array($nama_kecamatan,$tk, $tk,$sd, $sd,$smp, $smp);
        }
        // printJSON($ar);
        // // dd($data);
        return $ar;
    }
    public function jumlah_sekolah()
    {
        $data = DB::table('m_sekolahan as ta')
        ->join('m_kecamatan as td', 'td.id_kecamatan','ta.id_kecamatan')
        ->select(DB::RAW('count(ta.id_sekolahan) as total_sekolah, ta.id_jenjang, td.id_kecamatan, td.nama_kecamatan'))
        ->groupby('td.id_kecamatan','ta.id_jenjang')
        ->get();

        $data = collect($data)->groupBy(['id_kecamatan','id_jenjang'])->toArray();
        $ar = array();
        $ar[] = array('Kecamatan','TK',array( 'type' => 'string', 'role' => 'annotation' ),'SD',array( 'type' => 'string', 'role' => 'annotation' ),'SMP',array( 'type' => 'string', 'role' => 'annotation' )); 
        foreach($data as $k => $val){
            $nama_kecamatan = $val[1][0]->nama_kecamatan;
            $tk = $val[1][0]->total_sekolah;
            $sd = $val[2][0]->total_sekolah;
            $smp = $val[3][0]->total_sekolah;
            $ar[] = array($nama_kecamatan,$tk, $tk,$sd, $sd,$smp, $smp);
        }
        // printJSON($ar);
        // // dd($data);
        return $ar;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rata_rata_nilai(Request $request)
    {
        $data = DB::select("SELECT tc.id_kecamatan, ta.id_kategori_ujian, sum( jumlah_benar ) nilai, tx.total_peserta, sum( jumlah_benar ) / tx.total_peserta as rata_rata, td.nama_kecamatan FROM t_nilai_ujian ta LEFT JOIN m_user tb ON tb.id_user = ta.id_user LEFT JOIN m_sekolahan tc ON tc.id_sekolahan = tb.id_sekolah left join m_kecamatan td on td.id_kecamatan = tc.id_kecamatan left join (SELECT id_kecamatan, count( ta.id_user ) total_peserta FROM m_user ta LEFT JOIN m_sekolahan tb ON tb.id_sekolahan = ta.id_sekolah WHERE tb.id_jenjang = $request->id_jenjang GROUP BY tb.id_kecamatan ) tx on tx.id_kecamatan = tc.id_kecamatan WHERE tc.id_jenjang = 1 GROUP BY tc.id_kecamatan, tc.id_jenjang, ta.id_kategori_ujian");
        $data = collect($data)->groupBy(['id_kecamatan','id_kategori_ujian'])->toArray();
        $arr = array();
        $arr[] = array('Kecamatan',
        'Pedagogik',array( 'type' => 'string', 'role' => 'annotation' ),
        'Profesional Umum',array( 'type' => 'string', 'role' => 'annotation' ),
        'Kepribadian',array( 'type' => 'string', 'role' => 'annotation' ),
        'Sosial',array( 'type' => 'string', 'role' => 'annotation' ),
        'Merdeka Belajar',array( 'type' => 'string', 'role' => 'annotation' ),
        'PKB',array( 'type' => 'string', 'role' => 'annotation' ));
        foreach($data as $key => $val){
            $nama_kec = $val[1][0]->nama_kecamatan;
            $arr[] = array(
                $nama_kec,
                floatval($val[1][0]->rata_rata),
                floatval($val[1][0]->rata_rata),
                floatval($val[2][0]->rata_rata),
                floatval($val[2][0]->rata_rata),
                floatval($val[3][0]->rata_rata),
                floatval($val[3][0]->rata_rata),
                floatval($val[4][0]->rata_rata),
                floatval($val[4][0]->rata_rata),
                floatval($val[5][0]->rata_rata),
                floatval($val[5][0]->rata_rata),
                floatval($val[6][0]->rata_rata),
                floatval($val[6][0]->rata_rata),
            );
        }
        return $arr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
