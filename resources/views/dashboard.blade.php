@extends('template_view')
@section('page')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> Dashboard 
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Jumlah peserta per kecamatan
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div id="chart_div" style="width: 100%; height: 500px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div id="accordion1">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse1One" aria-expanded="true"
                                                aria-controls="collapse1One">
                                                Jumlah sekolah per kecamatan
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse1One" class="collapse1 show" aria-labelledby="headingOne"
                                        data-parent="#accordion1">
                                        <div class="card-body">
                                            <div id="chart_divqq" style="width: 100%; height: 500px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach(DB::table('m_jenjang')->get() as $i => $k)
                    @php $index = $i + 90; @endphp
                    <div class="row form-group sec-rata" data-id-je="{{ $k->id_jenjang }}" data-index="{{ $index }}"
                        data-jenjang="{{ $k->nama_jenjang }}">
                        <div class="col-sm-12">
                            <div id="accordion{{ $index }}">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse{{ $index }}One" aria-expanded="true"
                                                aria-controls="collapse{{ $index }}One">
                                                Hasil Ujian Rata – Rata Guru Per Kecamatan
                                                {{ $k->nama_jenjang }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{ $index }}One" class="collapse{{ $index }} show"
                                        aria-labelledby="headingOne" data-parent="#accordion{{ $index }}">
                                        <div class="card-body">
                                            <div id="chart_div-jenjang{{ $k->nama_jenjang }}"
                                                style="width: 100%; height: 500px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach(DB::table('m_jenjang')->get() as $i => $k)
                    @php $index = $i + 190; @endphp
                    <div class="row form-group sec-rata-kepsek" data-id-je="{{ $k->id_jenjang }}"
                        data-index="{{ $index }}" data-jenjang="{{ $k->nama_jenjang }}">
                        <div class="col-sm-12">
                            <div id="accordion{{ $index }}">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse{{ $index }}One" aria-expanded="true"
                                                aria-controls="collapse{{ $index }}One">
                                                Hasil Ujian Rata – Rata Kepala Sekolah Per Kecamatan
                                                {{ $k->nama_jenjang }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{ $index }}One" class="collapse{{ $index }} show"
                                        aria-labelledby="headingOne" data-parent="#accordion{{ $index }}">
                                        <div class="card-body">
                                            <div id="chart_div-jenjang-kepsek{{ $k->nama_jenjang }}"
                                                style="width: 100%; height: 500px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

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
                                                <div class="col-md-3">
                                                    <label class="form-label">Sekoah</label>
                                                    <select class="id_sekolah filter"></select>
                                                </div>
                                                <div class="col-md-3">
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
                                                <div class="col-md-3">
                                                    <label class="form-label">Sekoah</label>
                                                    <select class="id_sekolah filter-guru"></select>
                                                </div>
                                                <div class="col-md-3">
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
                                                <div class="col-md-3">
                                                    <label class="form-label">Sekoah</label>
                                                    <select class="id_sekolah filter-kepsek"></select>
                                                </div>
                                                <div class="col-md-3">
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

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('chart-js')
<script src="{{ asset('asset/page-js/dashboard/chart.js') }}"></script>
<script src="{{ asset('asset/page-js/dashboard/table.js') }}"></script>
<script>
    $(document).ready(function () {
        // $('.btn-link').trigger('click')
    })

</script>
@endsection
