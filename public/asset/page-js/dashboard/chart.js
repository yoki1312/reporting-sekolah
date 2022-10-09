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
                    "id_jenjang": id_jenjang,
                    "id_jabatan": 1
                },
                success: function (result) {
                    let data = google.visualization.arrayToDataTable(result);
                    var options = {
                        colors: ['#e2431e', '#d3362d', '#e7711b',
                            '#e49307', '#e49307', '#b9c246'
                        ],
                        vAxis: {
                            title: 'Nilai Rata-rata ' + jenjang
                        },
                        hAxis: {
                            title: 'Kecamatan',

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
    $('.sec-rata-kepsek').each(function () {
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
                    "id_jenjang": id_jenjang,
                    "id_jabatan": 2
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
                        .getElementById('chart_div-jenjang-kepsek' + jenjang));
                    chart.draw(data, options);
                }

            });
            // Some raw data (not necessarily accurate)



        }
    })
})
