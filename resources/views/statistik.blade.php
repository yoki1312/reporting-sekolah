@extends('template_view')
@section('page')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> Statistics 
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div id="accordion133">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse133One" aria-expanded="true"
                                                aria-controls="collapse133One">
                                                Peringkat Sekolah 10 Tertinggi, TK, SD, SMP
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse133One" class="collapse133 show" aria-labelledby="headingOne"
                                        data-parent="#accordion133">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Search</label>
                                                    <div class="input-group input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                                    class="fal fa fa-search"></i></span>
                                                        </div>
                                                        <input type="search" name="search-peringkat"
                                                            class="form-control" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Jenjang</label>
                                                    <select class="id_jenjang filter"></select>
                                                </div>
                                                <!-- <div class="col-md-3">
                                                    <label class="form-label">Bidang</label>
                                                    <select class="id_bidang_all filter"></select>
                                                </div> -->
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
                                                                <th class="text-center" scope="col">Jenjang</th>
                                                                <th class="text-center" scope="col">Kecamatan</th>
                                                                <th class="text-center" scope="col">Nilai Rata-Rata</th>
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
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 sec-by-bidang">
                            <div id="accordion090">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse090One" aria-expanded="true"
                                                aria-controls="collapse090One">
                                                Peringkat Sekolah 10 Tertinggi, TK, SD, SMP BERDASARKAN NILAI BIDANG
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse090One" class="collapse090 show" aria-labelledby="headingOne"
                                        data-parent="#accordion090">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Search</label>
                                                    <div class="input-group input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                                    class="fal fa fa-search"></i></span>
                                                        </div>
                                                        <input type="search" name="search-peringkat-by-bidang"
                                                            class="form-control" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Jenjang</label>
                                                    <select class="id_jenjang filter_by_bidang"></select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Bidang</label>
                                                    <select class="id_bidang_all filter_by_bidang"></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Kecamatan</label>
                                                    <select class="id_kecamatan filter_by_bidang" multiple></select>
                                                </div>
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-sm" id="dt-hasil-by-bidang">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th class="text-center" scope="col">No</th>
                                                                <th class="text-center" scope="col">Nama Sekolah</th>
                                                                <th class="text-center" scope="col">Jenjang</th>
                                                                <th class="text-center" scope="col">Kecamatan</th>
                                                                <th class="text-center" scope="col">Nilai Rata-Rata</th>
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
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div id="accordion179">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse179One" aria-expanded="true"
                                                aria-controls="collapse179One">
                                                Peringkat Guru 10 Tertinggi, TK, SD, SMP
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse179One" class="collapse179 show sec-guru"
                                        aria-labelledby="headingOne" data-parent="#accordion179">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Search</label>
                                                    <div class="input-group input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                                    class="fal fa fa-search"></i></span>
                                                        </div>
                                                        <input type="search" name="search-guru" class="form-control"
                                                            placeholder="Search" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Jenjang</label>
                                                    <select class="id_jenjang filter-guru"></select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Bidang</label>
                                                    <select class="id_bidang_guru filter-guru"></select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Kecamatan</label>
                                                    <select class="id_kecamatan filter-guru" multiple></select>
                                                </div>
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-sm" id="dt-hasil-guru">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th class="text-center" scope="col">No</th>
                                                                <th class="text-center" scope="col">Nama Guru</th>
                                                                <th class="text-center" scope="col">Nama Sekolah</th>
                                                                <th class="text-center" scope="col">Jenjang</th>
                                                                <th class="text-center" scope="col">Kecamatan</th>
                                                                <th class="text-center" scope="col">Nilai Rata-Rata</th>
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
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div id="accordion100">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse100One" aria-expanded="true"
                                                aria-controls="collapse100One">
                                                Peringkat Kepala Sekolah 10 Tertinggi, TK, SD, SMP
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse100One" class="collapse100 show sec-kepsek"
                                        aria-labelledby="headingOne" data-parent="#accordion100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Search</label>
                                                    <div class="input-group input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                                    class="fal fa fa-search"></i></span>
                                                        </div>
                                                        <input type="search" name="search-kepsek" class="form-control"
                                                            placeholder="Search" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Jenjang</label>
                                                    <select class="id_jenjang filter-kepsek"></select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Bidang</label>
                                                    <select class="id_bidang_kepsek filter-kepsek"></select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Kecamatan</label>
                                                    <select class="id_kecamatan filter-kepsek" multiple></select>
                                                </div>
                                               
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-sm" id="dt-hasil-kepsek">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th class="text-center" scope="col">No</th>
                                                                <th class="text-center" scope="col">Nama Guru</th>
                                                                <th class="text-center" scope="col">Nama Sekolah</th>
                                                                <th class="text-center" scope="col">Jenjang</th>
                                                                <th class="text-center" scope="col">Kecamatan</th>
                                                                <th class="text-center" scope="col">Nilai Rata-Rata</th>
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
                        </div>
                    </div>
                    <div class="row form-group sec-nilai-rata2">
                        <div class="col-sm-12">
                            <div id="accordion140">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse140One" aria-expanded="true"
                                                aria-controls="collapse140One">
                                                Hasil Ujian Rata – rata Sekolah
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse140One" class="collapse140 show" aria-labelledby="headingOne"
                                        data-parent="#accordion140">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Search</label>
                                                    <div class="input-group input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                                    class="fal fa fa-search"></i></span>
                                                        </div>
                                                        <input type="search" name="hasil_ujian_rata2"
                                                            class="form-control" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Jenjang</label>
                                                    <select class="id_jenjang filter-nilai-rata2"></select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Bidang</label>
                                                    <select class="id_bidang_all filter-nilai-rata2"></select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Kecamatan</label>
                                                    <select class="id_kecamatan filter-nilai-rata2" multiple></select>
                                                </div>

                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-sm" id="dt-hasil-nilai-rata2">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th class="text-center" scope="col">No</th>
                                                                <th class="text-center" scope="col">Nama Sekolah</th>
                                                                <th class="text-center" scope="col">Jenjang</th>
                                                                <th class="text-center" scope="col">Kecamatan</th>
                                                                <th class="text-center" scope="col">Nilai Rata-Rata</th>
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('chart-js')
<!-- <script src="{{ asset('asset/page-js/dashboard/chart.js') }}"></script> -->
<script src="{{ asset('asset/page-js/dashboard/table.js?id=') .rand(90,100) }}"></script>
<script>
    $(document).ready(function () {
        // $('.btn-link').trigger('click')
    })

</script>
@endsection
