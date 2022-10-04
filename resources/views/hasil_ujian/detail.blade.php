@extends('template_view')
@section('page')

<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> Detail Hasil Ujian
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="fs-lg fw-300 p-3 bg-white border-faded rounded mb-g">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Nama User</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                            value=": {{ $users->nama_user }}">
                    </div>
                    <label for="inputPassword" class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                            value=": {{ $users->nip }}">
                    </div>
                    <label for="inputPassword" class="col-sm-3 col-form-label">Nama Sekolah</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                            value=": {{ $users->nama_sekolahan }}">
                    </div>
                    <label for="inputPassword" class="col-sm-3 col-form-label">Jenjang</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                            value=": {{ $users->nama_jenjang }}">
                    </div>
                    <label for="inputPassword" class="col-sm-3 col-form-label">Kecamatan</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                            value=": {{ $users->nama_kecamatan }}">
                    </div>
                    <label for="inputPassword" class="col-sm-3 col-form-label">Nilai Ujian</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                            value=": {{ $users->total_nilai }}">
                    </div>

                    <div class="col-sm-12 form-group">
                        <hr>
                        <h4>Nilai Ujian Per Kategori </h4>
                        <table class="table table-bordered table-sm" id="dt-hasil">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Soal</th>
                                    <th>Jumlah Soal</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_nilai = 0; @endphp
                                @foreach($nilai as $i => $k)
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td class="text-left">{{ $k->nama_kategori_ujian }}</td>
                                    <td class="text-center">{{ $k->jumlah_soal }}</td>
                                    <td class="text-center">{{ $k->jumlah_benar }}</td>
                                </tr>
                                @php $total_nilai += $k->jumlah_benar; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan="3">Total</td>
                                    <td class="text-center">{{ $total_nilai }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-sm-12 form-group">
                        <a href="{{ url('hasil_ujian') }}" class="btn btn-sm btn-info"> <i class='fal fa-chevron-circle-left'></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
