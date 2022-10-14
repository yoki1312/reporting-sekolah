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
                            <div id="accordionpo">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapseOne11" aria-expanded="true"
                                                aria-controls="collapseOne11">
                                                Jumlah peserta tidak hadir per kecamatan
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne11" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionpo">
                                        <div class="card-body">
                                            <div id="chart_div_absen" style="width: 100%; height: 500px;"></div>
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


                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('chart-js')
<script src="{{ asset('asset/page-js/dashboard/chart.js?id=998989') }}"></script>
<!-- <script src="{{ asset('asset/page-js/dashboard/table.js') }}"></script> -->
<script>
    $(document).ready(function () {
        // $('.btn-link').trigger('click')
    })

</script>
@endsection
