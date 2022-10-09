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