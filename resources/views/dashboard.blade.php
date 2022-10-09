@extends('template_view')
@section('page')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Application Intel</li>
        <li class="breadcrumb-item active">Introduction</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
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
                    <div class="row form-group sec-rata" data-id-je="{{ $k->id_jenjang }}" data-index="{{ $index }}" data-jenjang="{{ $k->nama_jenjang }}">
                        <div class="col-sm-12">
                            <div id="accordion{{ $index }}">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapse{{ $index }}One" aria-expanded="true"
                                                aria-controls="collapse{{ $index }}One">
                                                Hasil Ujian Rata – Rata Guru Per Kecamatan Jenjang
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

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('chart-js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        $.ajax({
            url: baseurl + 'dashboard/jumlah_peserta',
            type: "POST",
            async: true,
            data: {
                "tahun": $('.tahun_filter').val(),
            },
            success: function (result) {
                let data = google.visualization.arrayToDataTable(result);
                var options = {
                    vAxis: {
                        title: 'Jumlah Peserta'
                    },
                    hAxis: {
                        title: 'Kecamatan'
                    },
                    seriesType: 'bars',
                    series: {
                        5: {
                            type: 'line'
                        }
                    }
                };

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }

        });
        // Some raw data (not necessarily accurate)



    }

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawVisualization1);

    function drawVisualization1() {
        $.ajax({
            url: baseurl + 'dashboard/jumlah_sekolah',
            type: "POST",
            async: true,
            data: {
                "tahun": $('.tahun_filter').val(),
            },
            success: function (result) {
                let data = google.visualization.arrayToDataTable(result);
                var options = {
                    vAxis: {
                        title: 'Jumlah Sekolah'
                    },
                    hAxis: {
                        title: 'Kecamatan'
                    },
                    seriesType: 'bars',
                    series: {
                        5: {
                            type: 'line'
                        }
                    }
                };

                var chart = new google.visualization.ComboChart(document.getElementById('chart_divqq'));
                chart.draw(data, options);
            }

        });
        // Some raw data (not necessarily accurate)



    }

    $(document).ready(function () {
        $('.sec-rata').each(function () {
            let index = $(this).attr('data-index');
            let jenjang = $(this).attr('data-jenjang');
            let id_jenjang = $(this).attr('data-id-je');

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawVisualization1);

            function drawVisualization1() {
                $.ajax({
                    url: baseurl + 'dashboard/rata_rata_nilai',
                    type: "POST",
                    async: true,
                    data: {
                        "id_jenjang":id_jenjang,
                    },
                    success: function (result) {
                        let data = google.visualization.arrayToDataTable(result);
                        var options = {
                            vAxis: {
                                title: 'Nilai Rata-rata ' + jenjang
                            },
                            hAxis: {
                                title: 'Kecamatan'
                            },
                            seriesType: 'bars',
                            series: {
                                5: {
                                    type: 'line'
                                }
                            }
                        };

                        var chart = new google.visualization.ComboChart(document
                            .getElementById('chart_div-jenjang' + jenjang));
                        chart.draw(data, options);
                    }

                });
                // Some raw data (not necessarily accurate)



            }
        })
    })

</script>
@endsection
