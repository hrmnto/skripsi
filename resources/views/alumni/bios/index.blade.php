@extends("alumni.layouts.main")
@section("container")

<h1 class="mt-4">Halaman Biodata</h1>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('loginError')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (count($biodatas) < 1)
    
    
    <div class="col-sm-4 bg-light p-4 rounded mt-5">
        <h5>Anda belum mengisi biodata, silahkan <a href="/alumni/bios/create">isi biodata</a></h5>
    </div>
@else


@foreach ($biodatas as $biodata)
<div class="row">

    <div class="col-sm-4 bg-light p-4 rounded mt-5">
        
        <!-- <label class="text-secondary" for="">Nama</label> -->
        @if($biodata->foto)
        <img src="{{asset('storage/' . $biodata->foto) }}" class="img-thumbnail" alt="...">
        {{-- <img src="{{asset('storage/' . $biodata->fotoIjazah) }}" class="img-thumbnail" alt="..."> --}}
        @else
            <img src="/img/noImage.png" class="img-thumbnail" alt="...">
        @endif
    </div>

<div class="col-sm-6 bg-light p-4 rounded mt-5">
    
        <label class="text-secondary" for="">Nama</label>
        <h6 class="fw-bold">{{$biodata->name}}</h6>

        <label class="text-secondary" for="">NIM</label>
        <h6 class="fw-bold">{{$biodata->nim}}</h6>

        <label class="text-secondary" for="">Kontak</label>
        <h6 class="fw-bold">{{$biodata->kontak}}</h6>

        <label class="text-secondary" for="">Tempat Tanggal Lahir</label>
        <h6 class="fw-bold">{{$biodata->tempatLahir}}, {{date('d F Y', strtotime($biodata->tglLahir))}}</h6>

        <label class="text-secondary" for="">Alamat</label>
        <h6 class="fw-bold">Kelurahan {{ucfirst(strtolower($biodata->kelurahan))}} Kecamatan {{ucfirst(strtolower($biodata->kecamatan))}} {{ucfirst(strtolower($biodata->kabupaten))}} Provinsi {{ucfirst(strtolower($biodata->provinsi))}}</h6>

        <label class="text-secondary" for="">Jenis Kelamin</label>
        <h6 class="fw-bold">{{$biodata->jk}}</h6>

        <label class="text-secondary" for="">Agama</label>
        <h6 class="fw-bold">{{$biodata->agama}}</h6>

        <label class="text-secondary" for="">Status Pernikahan</label>
        <h6 class="fw-bold">{{$biodata->kawin}} kawin</h6>
        
        <label class="text-secondary" for="">Tanggal Masuk</label>
        <h6 class="fw-bold">{{date('d F Y', strtotime($biodata->tglMasuk))}}</h6>

        <label class="text-secondary" for="">Tanggal Kelulusan</label>
        <h6 class="fw-bold">{{date('d F Y', strtotime($biodata->tglLulus))}}</h6>
        
        
        <label class="text-secondary" for="">Lama Masa Studi</label>
        @php
            $tgl1 = new DateTime($biodata->tglMasuk);
            $tgl2 = new DateTime($biodata->tglLulus);
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

        @endphp
        <h6 class="fw-bold">{{$str}}</h6>

        <label class="text-secondary" for="">IPK</label>
        <h6 class="fw-bold">{{$biodata->ipk}}</h6>
        <a class="btn btn-primary"  href="/alumni/bios/{{ $biodata->nim }}/edit">Edit</a>
        
        
    </div>
</div>
    @endforeach

@endif

@endsection