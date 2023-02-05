@extends('template_view')
@section('page')

<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='fal fa-info-circle'></i> SMART
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
                                    @foreach($data as $k)
                                    <tr>
                                        <td>{{ $k->nama_user }}</td>
                                        @foreach($matkul as $l)
                                        @php 
                                            $da = collect($nilai)->where('id_user', $k->id_user)->where('id_kategori_ujian', $l->id_kategori_ujian)->first();
                                            $rangking = rangkingSpk($l->id_kategori_ujian,$da->jumlah_benar);
                                            $totalData[$l->id_kategori_ujian][] = $rangking;
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
                                    @php $arrayNormalisasi = array(); @endphp
                                    @foreach($data as $k)
                                    <tr>
                                        <td>{{ $k->nama_user }}</td>
                                        @foreach($matkul as $l)
                                        @php 
                                            $da = collect($nilai)->where('id_user', $k->id_user)->where('id_kategori_ujian', $l->id_kategori_ujian)->first();
                                            $nilaiNormalisasi = ( rangkingSpk($l->id_kategori_ujian,$da->jumlah_benar) ) /  array_sum( $totalData[$l->id_kategori_ujian] );
                                            $arrayNormalisasi[$l->id_kategori_ujian][] = $nilaiNormalisasi;
                                        @endphp
                                           <td class="text-center">{{ $nilaiNormalisasi }}</td> 
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
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
                            Utility
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
                                            $nilaiNormalisasi = ( rangkingSpk($l->id_kategori_ujian,$da->jumlah_benar) ) /  array_sum( $totalData[$l->id_kategori_ujian] );
                                            $min = min($arrayNormalisasi[$l->id_kategori_ujian]);
                                            $max = max($arrayNormalisasi[$l->id_kategori_ujian]);
                                            if( ($nilaiNormalisasi-$min) > 0 && ($max-$min) > 0 ){
                                                $nilaiBagi =( (($nilaiNormalisasi-$min) / ($max-$min)) * 1 ) / 100 ; 
                                            }else{
                                                $nilaiBagi = 1;
                                            }
                                           
                                        @endphp
                                           <td class="text-center">{{ $nilaiBagi }}</td> 
                                           @endforeach  
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            Nilai akhir
                            <table class="table table-sm table-secondary">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        @foreach($matkul as $k)
                                        <th class="text-center">{{ $k->nama_kategori_ujian }}</th> 
                                        @endforeach 
                                        <th class="text-center">Jumlah</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($data as $k)
                                    <tr>
                                        <td>{{ $k->nama_user }}</td> 
                                        @php $nilaiTOtal = 0; @endphp
                                        @foreach($matkul as $l)
                                        @php 
                                            $da = collect($nilai)->where('id_user', $k->id_user)->where('id_kategori_ujian', $l->id_kategori_ujian)->first();
                                            $nilaiNormalisasi = ( rangkingSpk($l->id_kategori_ujian,$da->jumlah_benar) ) /  array_sum( $totalData[$l->id_kategori_ujian] );
                                            $min = min($arrayNormalisasi[$l->id_kategori_ujian]);
                                            $max = max($arrayNormalisasi[$l->id_kategori_ujian]);
                                            if( ($nilaiNormalisasi-$min) > 0 && ($max-$min) > 0 ){
                                                $nilaiBagi =( (($nilaiNormalisasi-$min) / ($max-$min)) * 1 ) / 100 ; 
                                                $nilaiBagi = $nilaiBagi * bobotSpk($l->id_kategori_ujian);
                                            }else{
                                                $nilaiBagi = 1;
                                            }
                                            $nilaiTOtal += $nilaiBagi;
                                        @endphp
                                           <td class="text-center">{{ $nilaiBagi }}</td> 
                                           @endforeach  
                                           <td class="text-center table-danger">{{ $nilaiTOtal }}</td> 
                                        
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
