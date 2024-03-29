<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\UserModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class HasilUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $users = UserModels::leftjoin('t_nilai_ujian as ta','ta.id_user','=','m_user.id_user')
            ->leftjoin('m_user_sekolah as tb','tb.id_user','m_user.id_user')
            ->leftjoin('m_sekolahan as tc', 'tc.id_sekolahan','tb.id_sekolah')
            ->leftjoin('m_kecamatan as td', 'td.id_kecamatan','tc.id_kecamatan')
            ->leftjoin('m_jenjang as te','te.id_jenjang','tc.id_jenjang')
            ->leftjoin('m_kategori_ujian as tf','tf.id_kategori_ujian','ta.id_kategori_ujian')
            ->select(DB::RAW('sum(ta.jumlah_benar) as total_nilai,tc.id_sekolahan, td.id_kecamatan, m_user.*, tc.nama_sekolahan, td.nama_kecamatan, tc.id_jenjang, te.nama_jenjang'))
            ->where('tf.is_type',0);
           
            if(!empty($request->id_sekolah)){
                $users->where('tc.id_sekolahan', $request->id_sekolah);
            }
            if(!empty($request->id_jenjang)){
                $users->where('tc.id_jenjang', $request->id_jenjang);
            }
            if(!empty($request->id_jabatan)){
                $users->where('tb.id_jabatan', $request->id_jabatan);
            }

            
            if(!empty($request->id_kecamatan)){
                $id_kec = implode(",",$request->id_kecamatan);
                $users->whereRaw("td.id_kecamatan in ($id_kec)");
            }
            
            if( !empty(Auth::user()->id_status) && Auth::user()->id_status  == 1){
                $users->whereRaw('m_user.id_user in ('.id_user_sekolah().')');  
            }
            
            if( !empty(Auth::user()->id_jenjang_pengawas)){
                $users->where('tc.id_jenjang', Auth::user()->id_jenjang_pengawas); 
            }


            $users->groupby('m_user.id_user');
            $users->get();
        
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
    public function hasil_ujianExportPdf(Request $request)
    {
            $users = UserModels::leftjoin('t_nilai_ujian as ta','ta.id_user','=','m_user.id_user')
            ->leftjoin('m_user_sekolah as tb','tb.id_user','m_user.id_user')
            ->leftjoin('m_sekolahan as tc', 'tc.id_sekolahan','tb.id_sekolah')
            ->leftjoin('m_kecamatan as td', 'td.id_kecamatan','tc.id_kecamatan')
            ->leftjoin('m_jenjang as te','te.id_jenjang','tc.id_jenjang')
            ->select(DB::RAW('sum(ta.jumlah_benar) as total_nilai,tc.id_sekolahan, td.id_kecamatan, te.nama_jenjang, m_user.*, tc.nama_sekolahan, td.nama_kecamatan, tc.id_jenjang'));
            
            if(!empty($request->id_sekolah)){
                $users->where('tc.id_sekolahan', $request->id_sekolah);
            }
            if(!empty($request->id_jenjang)){
                $users->where('tc.id_jenjang', $request->id_jenjang);
            }
            if(!empty($request->id_jabatan)){
                $users->where('tb.id_jabatan', $request->id_jabatan);
            }

            if(!empty($request->id_kecamatan)){
                $id_kec = implode(",",$request->id_kecamatan);
                $users->whereRaw("td.id_kecamatan in ($id_kec)");
            }

            if(Auth::user()->id_status == 1){
                $users->whereRaw('m_user.id_user in ('.id_user_sekolah().')');  
            }


            if( !empty(Auth::user()->id_jenjang_pengawas)){
                $users->where('tc.id_jenjang', Auth::user()->id_jenjang_pengawas); 
            }

            $users->groupby('m_user.id_user');
            $users->get();
        
            $users = $users->get();

            // printJSON($users);
            $pdf = PDF::loadview('hasil_ujian.hasil_ujian_pdf',['data'=>$users]);
            return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $users = UserModels::leftjoin('t_nilai_ujian as ta','ta.id_user','m_user.id_user')
        ->leftjoin('m_user_sekolah as tb','tb.id_user','m_user.id_user')
        ->leftjoin('m_sekolahan as tc', 'tc.id_sekolahan','tb.id_sekolah')
        ->leftjoin('m_kecamatan as td', 'td.id_kecamatan','tc.id_kecamatan')
        ->leftjoin('m_jenjang as te', 'te.id_jenjang','tc.id_jenjang')
        ->select(DB::RAW('sum(ta.jumlah_benar) as total_nilai,te.nama_jenjang, tc.id_sekolahan, td.id_kecamatan, m_user.*, tc.nama_sekolahan, td.nama_kecamatan'))
        ->where('m_user.id_user', $id)
        ->groupby('m_user.id_user')
        ->first();
        
        $nilai = DB::table('t_nilai_ujian as ta')
        ->leftjoin('m_kategori_ujian as tb','tb.id_kategori_ujian','ta.id_kategori_ujian')
        ->select('ta.jumlah_benar', 'tb.jumlah_soal','tb.nama_kategori_ujian')
        ->where('tb.is_type',0)
        ->where('ta.id_user', $id)
        ->get();
        // dd($nilai);


        return view('hasil_ujian.detail', compact('users','nilai'));
    }

    public function hasil_ujian_pdf_detail($id)
    {
        $users = UserModels::leftjoin('t_nilai_ujian as ta','ta.id_user','m_user.id_user')
        ->leftjoin('m_user_sekolah as tb','tb.id_user','m_user.id_user')
        ->leftjoin('m_sekolahan as tc', 'tc.id_sekolahan','tb.id_sekolah')
        ->leftjoin('m_kecamatan as td', 'td.id_kecamatan','tc.id_kecamatan')
        ->leftjoin('m_jenjang as te', 'te.id_jenjang','tc.id_jenjang')
        ->select(DB::RAW('sum(ta.jumlah_benar) as total_nilai,te.nama_jenjang, tc.id_sekolahan, td.id_kecamatan, m_user.*, tc.nama_sekolahan, td.nama_kecamatan'))
        ->where('m_user.id_user', $id)
        ->groupby('m_user.id_user')
        ->first();

        $nilai = DB::table('t_nilai_ujian as ta')
        ->leftjoin('m_kategori_ujian as tb','tb.id_kategori_ujian','ta.id_kategori_ujian')
        ->select('ta.jumlah_benar', 'tb.jumlah_soal','tb.nama_kategori_ujian')
        ->where('ta.id_user', $id)
        ->get();
        // dd($nilai);  
        $pdf = PDF::loadview('hasil_ujian.hasil_ujian_pdf_detail',['data'=>$users, 'nilai'=>$nilai]);
        return $pdf->stream();


        // return view('hasil_ujian.detail', compact('users','nilai'));
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
