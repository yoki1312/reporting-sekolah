<?php

namespace App\Http\Controllers;

use App\Models\SekolahModels;
use Yajra\DataTables\Facades\DataTables;
use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Decimal;
// User
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
            $ar[] = array($nama_kecamatan,floatval($tk), floatval($tk),floatval($sd), floatval($sd),floatval($smp), floatval($smp));
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
            $ar[] = array($nama_kecamatan,floatval($tk), floatval($tk),floatval($sd), floatval($sd),floatval($smp), floatval($smp));
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
        $data = DB::select("SELECT
        tc.id_kecamatan,
        ta.id_kategori_ujian,
        sum( jumlah_benar ) nilai,
        sum( jumlah_benar ) / ty.total_peserta AS rata_rata,
        td.nama_kecamatan 
    FROM
        t_nilai_ujian ta
        LEFT JOIN m_user tb ON tb.id_user = ta.id_user
        left join m_user_sekolah tx on tx.id_user = tb.id_user
        LEFT JOIN m_sekolahan tc ON tc.id_sekolahan = tx.id_sekolah
        LEFT JOIN m_kecamatan td ON td.id_kecamatan = tc.id_kecamatan
        left join (SELECT
        tc.id_kecamatan,
        count( ta.nama_user ) total_peserta 
    FROM
        m_user ta
        LEFT JOIN m_user_sekolah tb ON tb.id_user = ta.id_user
        LEFT JOIN m_sekolahan tc ON tc.id_sekolahan = tb.id_sekolah 
    WHERE
        tc.id_jenjang = $request->id_jenjang 
        AND tb.id_jabatan = $request->id_jabatan 
    GROUP BY
        tc.id_kecamatan) ty on ty.id_kecamatan = td.id_kecamatan
    WHERE
        tc.id_jenjang = $request->id_jenjang
        and tx.id_jabatan = $request->id_jabatan
    GROUP BY
        tc.id_kecamatan");
        $data = collect($data)->groupBy(['id_kecamatan'])->toArray();
        $arr = array();
        $arr[] = array('Kecamatan',
        'Rata Rata',array( 'type' => 'string', 'role' => 'annotation' ));
        foreach($data as $key => $val){
            $nama_kec = $val[0]->nama_kecamatan;
            $arr[] = array(
                $nama_kec,
                floatval($val[0]->rata_rata),
                floatval($val[0]->rata_rata),
            );
        }
        return $arr;
    }

    public function hasil_ujian(Request $request)
    {
        if (request()->ajax()) {
            $users = SekolahModels::leftjoin('m_user_sekolah as tb','tb.id_sekolah','m_sekolahan.id_sekolahan')
            ->leftjoin('m_user as tf','tf.id_user','tb.id_user')
            ->leftjoin('m_kecamatan as td', 'td.id_kecamatan','m_sekolahan.id_kecamatan')
            ->leftjoin('m_jenjang as te','te.id_jenjang','m_sekolahan.id_jenjang')
            ->leftjoin(DB::RAW(" (SELECT sum( jumlah_benar ) nilai, id_user FROM t_nilai_ujian GROUP BY id_user ) pa"), function($join){
                    $join->on('pa.id_user','=','tf.id_user');
            })
            ->select(DB::RAW('m_sekolahan.*, td.nama_kecamatan, te.nama_jenjang, sum(pa.nilai) / count( tf.id_user )  nilai_rata_rata, count( tf.id_user )'));
           
            if(!empty($request->id_sekolah)){
                $users->where('m_sekolahan.id_sekolahan', $request->id_sekolah);
            }
            if(!empty($request->id_jenjang)){
                $users->where('m_sekolahan.id_jenjang', $request->id_jenjang);
            }

            if(!empty($request->id_kecamatan)){
                $id_kec = implode(",",$request->id_kecamatan);
                $users->whereRaw("td.id_kecamatan in ($id_kec)");
            }


            $users->groupby('m_sekolahan.id_sekolahan');
            $users->orderByRaw('sum(pa.nilai) / count( tf.id_user ) desc')->limit('10')->get();
        
            $users = $users->get();


            return DataTables::of($users)
                ->addColumn('action', function($row) {
                    return '<a href="'. url('hasil_ujian/detail/'.$row->id_user) .'" class="btn btn-sm btn-warning"> Detail</a>';
                })
                ->withQuery('count', function($filteredQuery) {
                    return $filteredQuery->count();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('hasil_ujian.view');
    }

    public function hasil_ujian_rata2(Request $request)
    {
        if (request()->ajax()) {
            $users = SekolahModels::leftjoin('m_user_sekolah as tb','tb.id_sekolah','m_sekolahan.id_sekolahan')
            ->leftjoin('m_user as tf','tf.id_user','tb.id_user')
            ->leftjoin('m_kecamatan as td', 'td.id_kecamatan','m_sekolahan.id_kecamatan')
            ->leftjoin('m_jenjang as te','te.id_jenjang','m_sekolahan.id_jenjang')
            ->leftjoin(DB::RAW(" (SELECT sum( jumlah_benar ) nilai, id_user FROM t_nilai_ujian GROUP BY id_user ) pa"), function($join){
                    $join->on('pa.id_user','=','tf.id_user');
            })
            ->select(DB::RAW('m_sekolahan.*, td.nama_kecamatan, te.nama_jenjang, sum(pa.nilai) / count( tf.id_user )  nilai_rata_rata, count( tf.id_user )'));
           
            if(!empty($request->id_sekolah)){
                $users->where('m_sekolahan.id_sekolahan', $request->id_sekolah);
            }
            if(!empty($request->id_jenjang)){
                $users->where('m_sekolahan.id_jenjang', $request->id_jenjang);
            }

            if(!empty($request->id_kecamatan)){
                if(is_array($request->id_kecamatan)){
                    $id_kec = implode(",",$request->id_kecamatan);
                    $users->whereRaw("td.id_kecamatan in ($id_kec)");
                }else{
                    $users->where("td.id_kecamatan" ,$request->id_kecamatan);
                }
            }


            $users->groupby('m_sekolahan.id_sekolahan');
            $users->orderByRaw('sum(pa.nilai) / count( tf.id_user ) desc')->get();
        
            $users = $users->get();


            return DataTables::of($users)
                ->addColumn('action', function($row) {
                    return '<a href="'. url('hasil_ujian/detail/'.$row->id_user) .'" class="btn btn-sm btn-warning"> Detail</a>';
                })
                ->withQuery('count', function($filteredQuery) {
                    return $filteredQuery->count();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('hasil_ujian.view');
    }

    public function hasil_ujian_guru(Request $request)
    {
        if (request()->ajax()) {
            $users = UserModels::leftjoin('t_nilai_ujian as ta','ta.id_user','m_user.id_user')
            ->leftjoin('m_user_sekolah as tb','tb.id_user','m_user.id_user')
            ->leftjoin("m_sekolahan as tc", 'tc.id_sekolahan','tb.id_sekolah')
            ->leftjoin("m_jenjang as td", "td.id_jenjang","tc.id_jenjang")
            ->leftjoin("m_kecamatan as te", "te.id_kecamatan","tc.id_kecamatan")
            ->leftjoin(DB::RAW( "(SELECT count(id_user) peserta, id_sekolah from m_user_sekolah where id_jabatan = $request->id_jabatan GROUP BY id_sekolah) pa" ), function($join){
                $join->on('pa.id_sekolah','=','tc.id_sekolahan');
            })
            ->select(DB::RAW("m_user.* , tc.nama_sekolahan , td.nama_jenjang, te.nama_kecamatan, sum(ta.jumlah_benar) / pa.peserta as nilai_rata_rata "));

            $users->where('tb.id_jabatan', $request->id_jabatan);
            if(!empty($request->id_sekolah)){
                $users->where('tc.id_sekolahan', $request->id_sekolah);
            }
            if(!empty($request->id_jenjang)){
                $users->where('tc.id_jenjang', $request->id_jenjang);
            }

            if(!empty($request->id_kecamatan)){
                $id_kec = implode(",",$request->id_kecamatan);
                $users->whereRaw("te.id_kecamatan in ($id_kec)");
            }


            $users->groupby('m_user.id_user');
            $users->orderByRaw('sum(ta.jumlah_benar) / pa.peserta desc')->limit('10')->get();
        
            $users = $users->get();


            return DataTables::of($users)
                ->addColumn('action', function($row) {
                    return '<a href="'. url('hasil_ujian/detail/'.$row->id_user) .'" class="btn btn-sm btn-warning"> Detail</a>';
                })
                ->withQuery('count', function($filteredQuery) {
                    return $filteredQuery->count();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('hasil_ujian.view');
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
