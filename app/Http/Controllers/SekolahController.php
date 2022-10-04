<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\UserModels;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
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
            ->select(DB::RAW('sum(ta.jumlah_benar) as total_nilai,tc.id_sekolahan, td.id_kecamatan, m_user.*, tc.nama_sekolahan, td.nama_kecamatan'));
            
            if(!empty($request->id_kecamatan)){
                $users->where('td.id_kecamatan', $request->id_kecamatan);
            }
            if(!empty($request->id_sekolah)){
                $users->where('tc.id_sekolahan', $request->id_sekolah);
            }

            $users->groupby('m_user.id_user');
            $users->get();


            return DataTables::of($users)
                ->addColumn('action', function($row) {
                    return '<a href="'. url('hasil_ujian/detail/'.$row->id_user) .'" class="btn btn-sm btn-warning"> Detail</a>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('sekolah.hasil_ujian.view');
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
