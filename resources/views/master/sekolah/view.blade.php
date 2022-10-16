@extends('template_view')
@section('page')

<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> Sekolah
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="input-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                            class="fal fa fa-search"></i></span>
                                </div>
                                <input type="search" class="form-control" placeholder="Search" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jenjang</label>
                            <select class="id_jenjang filter"></select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kecamatan</label>
                            <select class="id_kecamatan filter" multiple></select>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-sm" id="dt-hasil">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" scope="col">No</th>
                                        <th class="text-center" scope="col">Nama Sekolah</th>
                                        <th class="text-center" scope="col">NPSN</th>
                                        <th class="text-center" scope="col">Nama Jenjang</th>
                                        <th class="text-center" scope="col">Kecamatan</th>
                                        <th class="text-center" scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
