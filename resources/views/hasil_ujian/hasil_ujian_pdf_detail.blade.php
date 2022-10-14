<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hasil Ujian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h5>Laporan Hasil Ujian {{ $data->nama_user }}</h4>
            <br>
            <hr>
    </center>

    <table class='table table-sm haha' style="border: none !important; " cellspacing="0" cellpadding="0">
        <thead>
            <tr style="text-align:left" style="border: none !important;">
                <th style="border: none !important; ">Nama Peserta</th>
                <th style="border: none !important; ">: {{ $data->nama_user }}</th>
            </tr>
            <tr style="text-align:left">
                <th style="border: none !important; ">NIP</th>
                <th style="border: none !important; ">: {{ $data->nip }}</th>
            </tr>
            <tr style="text-align:left">
                <th style="border: none !important; ">Nama Sekolah</th>
                <th style="border: none !important; ">: {{ $data->nama_sekolahan }}</th>
            </tr>
            <tr style="text-align:left">
                <th style="border: none !important; ">Jenjang</th>
                <th style="border: none !important; ">: {{ $data->nama_jenjang }}</th>
            </tr>
            <tr style="text-align:left">
                <th style="border: none !important; ">Kecamatan</th>
                <th style="border: none !important; ">: {{ $data->nama_kecamatan }}</th>
            </tr>
        </thead>
    </table>
    <h4>Hasil Ujian</h4>
    <table class="table table-sm table-bordered">
        <thead>
            <tr style="text-align:center">
                <th>No</th>
                <th>Bidang</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilai as $i => $k)
            <tr style="text-align:left">
                <th style="text-align:center">{{ $i+1 }}</th>
                <th>{{ $k->nama_kategori_ujian }}</th>
                <th style="text-align:center">{{ $k->jumlah_benar }}</th>
            </tr>
			
            @endforeach
            <tr style="text-align:left">
                <th colspan="2" style="text-align:center">Total Nilai</th>
                <th style="text-align:center">{{ collect($nilai)->sum('jumlah_benar') }}</th>
            </tr>

        </tbody>
    </table>

</body>

</html>
