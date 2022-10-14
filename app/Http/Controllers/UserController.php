<?php

namespace App\Http\Controllers;

use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
// DB

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $users = UserModels::leftjoin('m_user_sekolah as ta','ta.id_user','m_user.id_user')
            ->leftjoin('m_sekolahan as tb','tb.id_sekolahan','ta.id_sekolah')
            ->leftjoin('m_jabatan as tc','tc.id_jabatan','ta.id_jabatan')
            ->leftjoin('m_kecamatan as td','td.id_kecamatan','tb.id_kecamatan')
            ->leftjoin('m_jenjang as te', 'te.id_jenjang','tb.id_jenjang' )
            ->leftjoin('t_absen as tf', 'tf.id_user','m_user.id_user')
            ->select(DB::RAW('m_user.*,tb.nama_sekolahan,tc.nama_jabatan,td.nama_kecamatan,te.nama_jenjang, IF(tf.id_status = 1,"HADIR", "TIDAK HADIR") status_absen, tf.keterangan'));
            if(!empty($request->id_sekolah)){
                $users->where('tb.id_sekolahan', $request->id_sekolah);
            }
            if(!empty($request->id_jenjang)){
                $q = implode(",",$request->id_jenjang);
                $users->whereRaw("tb.id_jenjang in ($q)");
            }
            if(!empty($request->id_jabatan)){
                $users->where('ta.id_jabatan', $request->id_jabatan);
            }
            if(!empty($request->status_hadir)){
                if($request->status_hadir == 2) $request->status_hadir = '0';
                $users->where('tf.id_status', $request->status_hadir);
            }

            if(!empty($request->id_kecamatan)){
                $id_kec = implode(",",$request->id_kecamatan);
                $users->whereRaw("td.id_kecamatan in ($id_kec)");
            }
            $users = $users->get();



            return DataTables::of($users)
            ->addColumn('action', function($row) {
                return '<button class="btn btn-sm btn-warning"> Edit Password</button>';
            })
            ->withQuery('count', function($filteredQuery) {
                return $filteredQuery->count();
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('master.user.view');
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
