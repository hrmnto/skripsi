@extends("alumni.layouts.main")
@section("container")

<?php
use Carbon\Carbon;
?>
<h1 class="mt-4">Halaman Pekerjaan</h1>

{{-- $work->biodata->name --}}
@if (count($biodata) != 0)
    @if($biodata[0]['pekerjaan'] == "belum")
    <div class="col-sm-4 bg-light p-4 rounded mt-5">
        <h5>Anda tidak bisa mengisi data pekerjaan karena status anda belum bekerja</h5>
    </div>
    @else

        @if (count($pekerjaan) != 0)


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @for ($i = 0; $i < count($pekerjaan); $i++)
            <li class="nav-item " role="presentation">
                <button class="nav-link  {{$i+1 == count($pekerjaan) ? 'active':''}}" id="pekerjaan{{$i+1}}-tab" data-bs-toggle="tab" data-bs-target="#pekerjaan{{$i+1}}-tab-pane" type="button" role="tab" aria-controls="pekerjaan{{$i+1}}-tab-pane" aria-selected="false">{{$i == count($pekerjaan)-1 ? 'Pekerjaan Sekarang':'Pekerjaan ke ' . $i+1}} </button>
            </li>
            @endfor
            <li class="nav-item " role="presentation">
                <a class="nav-link text-success" href="/alumni/works/create"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg> Tambah Pekerjaan</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
        @foreach ($pekerjaan as $work)

                <div class="tab-pane fade {{$loop->iteration == count($pekerjaan)? 'show active':''}} " id="pekerjaan{{$loop->iteration}}-tab-pane" role="tabpanel" aria-labelledby="pekerjaan{{$loop->iteration }}-tab" tabindex="0">
                
                    <div class="col-sm-4 bg-light p-4 rounded">
                        <label class="text-secondary" for="">Nama</label>
                        <h6 class="fw-bold">{{$work->biodata->name}}</h6>
                
                        <label class="text-secondary" for="">Kategori Pekerjaan</label>
                        <h6 class="fw-bold">{{$work->kategori_pekerjaan1 == 1 ? 'Kependidikan': ''}}, {{$work->kategori_pekerjaan2 == 1 ? 'IT': ''}}, {{$work->kategori_pekerjaan3 == 1 ? 'Wirausaha': ''}}</h6>
                
                        <label class="text-secondary" for="">Bekerja Sebagai</label>
                        <h6 class="fw-bold">{{$work->nama_pekerjaan}}</h6>
                
                        <label class="text-secondary" for="">Alamat Pekerjaan</label>
                        <h6 class="fw-bold">{{$work->tempat_pekerjaan}}</h6>
                
                        <label class="text-secondary" for="">Tanggal Kelulusan</label>
                        <h6 class="fw-bold">{{date('d F Y', strtotime($work->biodata->tglLulus))}}</h6>
                
                
                        <label class="text-secondary" for="">Mulai Bekerja</label>
                        @php
                        $tgl2 = new DateTime($work->tanggal_pekerjaan);
                        $tgl1 = new DateTime($work->biodata->tglLulus);
                        $jarak = $tgl2->diff($tgl1);
            
                        $str = '';
            
                        if($jarak->y != 0){
                            $str .= $jarak->y . ' Tahun ';
                        }
            
                        if($jarak->m != 0){
                            $str .= $jarak->m . ' Bulan ';
                        }
            
                        if($jarak->d != 0){
                            $str .= $jarak->d . ' Hari ';
                        }

                        if($tgl1 > $tgl2){
                            $str .= "Sebelum Kelulusan";
                        }else{
                            $str .= "Setelah Kelulusan";
                        }
            
                    @endphp
                        <h6 class="fw-bold">{{$str}} ~ {{date('d F Y', strtotime($work->tanggal_pekerjaan))}}</h6>
                
                
                        <label class="text-secondary" for="">Kisaran Gaji</label>
                        <h6 class="fw-bold">Rp. {{number_format($work->gaji,2,",",".")}}</h6>

                        <label class="text-secondary" for="">Relevansi</label>
                        <h6 class="fw-bold">{{$work->relevansi_pekerjaan}}</h6>
                
                
                        <h6 class="mt-5">
                            <form action="/alumni/works/{{$work->id}}" method="post">
                            <a class="btn btn-sm btn-outline-success" href="/alumni/works/{{$work->id}}/edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg> Edit</a>
                        
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-outline-danger ms-3">Hapus</a></h6>
                        </form>
                    </div>
                    
                </div>
                @endforeach
            </div>
        @else
                <div class="col-sm-4 bg-light p-4 rounded mt-5">
                    <h5>Anda belum mengisi data pekerjaan, silahkan <a href="/alumni/works/create">isi data pekerjaan</a></h5>
                </div>
        @endif
    @endif
@else
<div class="col-sm-4 bg-light p-4 rounded mt-5">
    <h5>Anda belum mengisi Biodata, silahkan <a href="/alumni/bios/create">isi biodata</a></h5>
</div>           
@endif

@endsection