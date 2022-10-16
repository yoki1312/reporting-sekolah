@extends('template_view')
@section('page')

<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> Hasil Ujian
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form target="_blank" action="{{ url('exportPdf/hasil_ujian') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="form-label">Search</label>
                            <div class="input-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                            class="fal fa fa-search"></i></span>
                                </div>
                                <input type="search" class="form-control" placeholder="Search" />
                            </div>
                        </div>
                        <div style=" <?= Auth::user()->id_status == 1 ? 'display:none' : '' ?>" class="col-md-2 form-group">
                            <label class="form-label">Jabatan</label>
                            <select name="id_jabatan" class="id_jabatan filter select2">
                                <option value="">Tampilkan Semua</option>
                                <option value="1">Guru</option>
                                <option value="2">Kepala Sekoah</option>
                            </select>
                        </div>
                        <div style=" <?= Auth::user()->id_status == 1 ? 'display:none' : '' ?>" class="col-md-2 form-group">
                            <label class="form-label">Jenjang</label>
                            <select name="id_jenjang" class="id_jenjang filter"></select>
                        </div>
                        <div style=" <?= Auth::user()->id_status == 1 ? 'display:none' : '' ?>" class="col-md-4 form-group">
                            <label class="form-label">Sekoah</label>
                            <select name="id_sekolah" class="id_sekolah filter"></select>
                        </div>
                        <div style=" <?= Auth::user()->id_status == 1 ? 'display:none' : '' ?>" class="col-md-5 form-group">
                            <label class="form-label">Kecamatan</label>
                            <select name="id_kecamatan[]" class="id_kecamatan filter" multiple></select>
                        </div>
                        <div class="col-sm-2">
                            <label style="color: transparent !important ;" class="form-label">Kecamatan</label><br>
                            <button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-file"></i> Export to PDF</button>
                        </div>
                    </form>
                        <div class="col-sm-12 form-group">
                            <table class="table table-bordered table-sm" id="dt-hasil">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" scope="col">No</th>
                                        <th class="text-center" scope="col">Nama Guru</th>
                                        <th class="text-center" scope="col">NIP</th>
                                        <th class="text-center" scope="col">Nama Sekolah</th>
                                        <th class="text-center" scope="col">Nama Jenjang</th>
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
            </div>
        </div>
    </div>
</main>
@endsection
