<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SekolahModels;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;

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
            $users = SekolahModels::leftjoin('m_kecamatan AS ta','ta.id_kecamatan','=','m_sekolahan.id_kecamatan')
            ->leftjoin('m_jenjang AS tb','tb.id_jenjang','m_sekolahan.id_jenjang')
            ->select('m_sekolahan.*','ta.nama_kecamatan','tb.nama_jenjang');
            
            if(!empty($request->id_kecamatan)){
                foreach($request->id_kecamatan as $id){
                    $users->orWhere('ta.id_kecamatan', $id);
                }
            }
            if(!empty($request->id_jenjang)){
                $users->where('m_sekolahan.id_jenjang', $request->id_jenjang);
            }

            if(!empty(Auth::user()->id_jenjang_pengawas)){
                $users->where('m_sekolahan.id_jenjang', Auth::user()->id_jenjang_pengawas);
            }
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
        return view('master.sekolah.view');
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
    public function resetPassword($id)
    {
        User::where('id_user',$id)->update([
            'password' => Hash::make('tendikgresik'),
        ]);

        return 200;
    }
    public function gantiPassword(Request $request)
    {
        // printJSON($request);
        User::where('id_user',Auth::user()->id_user)->update([
            'password' => Hash::make($request->password),
        ]);
        Auth::logout();

        return redirect('/');
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
