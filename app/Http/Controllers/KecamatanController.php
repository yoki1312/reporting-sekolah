<?php

namespace App\Http\Controllers;

use App\Models\KecamatanModels;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SekolahModels;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $users = KecamatanModels::leftjoin('m_sekolahan as ta','ta.id_kecamatan','m_kecamatan.id_kecamatan')
            ->select(DB::RAW('m_kecamatan.*, count(ta.id_kecamatan) total_sekolah'))
            ->groupBy('m_kecamatan.id_kecamatan')
            ->get();


            return DataTables::of($users)
                ->withQuery('count', function($filteredQuery) {
                    return $filteredQuery->count();
                })
                ->make(true);
        }
        return view('master.kecamatan.view');
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
