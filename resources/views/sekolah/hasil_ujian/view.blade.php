@extends('template_view')
@section('page')

<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> Hasil Ujian
        </h1>
    </div>
    <div class="fs-lg fw-300 p-3 bg-white border-faded rounded mb-g">
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Search</label>
                <div class="input-group input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fal fa fa-search"></i></span>
                    </div>
                    <input type="search" class="form-control" placeholder="Search" />
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Sekoah</label>
                <select class="id_sekolah filter"></select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Kecamatan</label>
                <select class="id_kecamatan filter"></select>
            </div>
            <div class="col-sm-12">
                <table class="table table-bordered table-sm" id="dt-hasil">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center" scope="col">No</th>
                            <th class="text-center" scope="col">Nama Guru</th>
                            <th class="text-center" scope="col">NIP</th>
                            <th class="text-center" scope="col">Nama Sekolah</th>
                            <th class="text-center" scope="col">Kecamatan</th>
                            <th class="text-center" scope="col">Nilai Ujian</th>
                            <th class="text-center" scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
