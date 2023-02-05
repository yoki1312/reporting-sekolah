@extends('template_view')
@section('page')

<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> SAW
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            Data Awal
                            <table class="table table-sm table-secondary">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        @foreach($matkul as $k)
                                        <th class="text-center">{{ $k->nama_kategori_ujian }}</th> 
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $k)
                                    <tr>
                                        <td>{{ $k->nama_user }}</td>
                                        @foreach($matkul as $l)
                                        @php $da = collect($nilai)->where('id_user', $k->id_user)->where('id_kategori_ujian', $l->id_kategori_ujian)->first()  @endphp
                                        <td class="text-center">{{ $da->jumlah_benar }}</td> 
                                        @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            Rangking
                            <table class="table table-sm table-secondary">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        @foreach($matkul as $k)
                                        <th class="text-center">{{ $k->nama_kategori_ujian }}</th> 
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalData = array(); @endphp
                                    @php $arrayNormalisasi = array(); @endphp
                                    @foreach($data as $k)
                                    <tr>
                                        <td>{{ $k->nama_user }}</td>
                                        @foreach($matkul as $l)
                                        @php 
                                            $da = collect($nilai)->where('id_user', $k->id_user)->where('id_kategori_ujian', $l->id_kategori_ujian)->first();
                                            $rangking = rangkingSpk($l->id_kategori_ujian,$da->jumlah_benar);
                                            $totalData[$l->id_kategori_ujian][] = $rangking;
                                            $arrayNormalisasi[$l->id_kategori_ujian][] = $rangking;
                                        @endphp
                                           <td class="text-center">{{ $rangking }}</td> 
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        @foreach($matkul as $l)
                                        @php  
                                            $total  = array_sum( $totalData[$l->id_kategori_ujian] ) ;
                                        @endphp
                                           <td class="text-center">{{ $total }}</td> 
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
                    <div class="row form-group">
                     
                        <div class="col-sm-12">
                            <table class="table table-sm table-secondary">
                                <thead>
                                    <tr>
                                        <th>MAX</th>
                                        @foreach($matkul as $l)
                                        @php 
                                           $nilaiMax =  max($arrayNormalisasi[$l->id_kategori_ujian]);
                                        @endphp
                                           <td class="text-center">{{ $nilaiMax }}</td> 
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>MIN</th>
                                        @foreach($matkul as $l)
                                        @php 
                                           $nilaiMin =  min($arrayNormalisasi[$l->id_kategori_ujian]);
                                        @endphp
                                           <td class="text-center">{{ $nilaiMin }}</td> 
                                        @endforeach
                                    </tr>
                                </thead> 
                            </table>
                        </div>
                    </div> 


                    <div class="row form-group">
                        <div class="col-sm-12">
                            Normalisasi
                            <table class="table table-sm table-secondary">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        @foreach($matkul as $k)
                                        <th class="text-center">{{ $k->nama_kategori_ujian }}</th> 
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($data as $k)
                                    <tr>
                                        <td>{{ $k->nama_user }}</td>
                                        @foreach($matkul as $l)
                                        @php 
                                            $da = collect($nilai)->where('id_user', $k->id_user)->where('id_kategori_ujian', $l->id_kategori_ujian)->first();
                                            $da = isset($da->jumlah_benar) ? $da->jumlah_benar : 0;
                                            $rangking = rangkingSpk($l->id_kategori_ujian,$da);
                                            $mx =  max($arrayNormalisasi[$l->id_kategori_ujian]);
                                            $mn =  min($arrayNormalisasi[$l->id_kategori_ujian]);

                                            $nilai1 = 0;
                                            if($l->id_kategori_ujian == 3){
                                                $nilai1 = $mn / $rangking;
                                            }else{
                                                $nilai1 = $rangking / $mx;
                                            }
                                        @endphp
                                           <td class="text-center">{{ $nilai1 }}</td> 
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            Normalisasi
                            <table class="table table-sm table-secondary">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($data as $k)
                                    <tr>
                                        <td>{{ $k->nama_user }}</td>
                                        @php $nilais = 0; @endphp
                                        @foreach($matkul as $l)
                                        @php 
                                            $da = collect($nilai)->where('id_user', $k->id_user)->where('id_kategori_ujian', $l->id_kategori_ujian)->first();
                                            $da = isset($da->jumlah_benar) ? $da->jumlah_benar : 0;
                                            $rangking = rangkingSpk($l->id_kategori_ujian,$da);
                                            $mx =  max($arrayNormalisasi[$l->id_kategori_ujian]);
                                            $mn =  min($arrayNormalisasi[$l->id_kategori_ujian]);

                                            $nilai1 = 0;
                                            if($l->id_kategori_ujian == 3){
                                                $nilai1 = $mn / $rangking;
                                            }else{
                                                $nilai1 = $rangking / $mx;
                                            }
                                            $nilais += ( $nilai1 * bobotSpk($l->id_kategori_ujian) );
                                        @endphp
                                        @endforeach
                                        <td class="text-center">{{ $nilais }}</td> 
                                    </tr>
                                    @endforeach
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
