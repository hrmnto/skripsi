@extends("alumni.layouts.main")
@section("container")

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Biodata Alumni</h1>
</div>

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
    <div class="card shadow mb-4">
        <div class="card-body text-center py-5">
            <div class="mb-3">
                <span data-feather="user-x" style="width: 64px; height: 64px; color: #e74a3b;"></span>
            </div>
            <h4 class="text-gray-800">Biodata Belum Lengkap</h4>
            <p class="text-muted mb-4">Anda belum mengisi biodata diri. Silahkan lengkapi data anda untuk melanjutkan.</p>
            <a href="/alumni/bios/create" class="btn btn-primary px-4">
                <span data-feather="edit" class="align-text-bottom"></span> Isi Biodata
            </a>
        </div>
    </div>
@else
    @foreach ($biodatas as $biodata)
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Detail Biodata</h6>
            <a href="/alumni/bios/{{ $biodata->nim }}/edit" class="btn btn-sm btn-primary shadow-sm">
                <span data-feather="edit" class="align-text-bottom"></span> Edit Biodata
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    @if($biodata->foto)
                        <img src="{{ asset('storage/' . $biodata->foto) }}" class="img-fluid rounded shadow-sm mb-3" style="max-height: 300px; width: auto;" alt="Foto Profil">
                    @else
                        <img src="/img/noImage.png" class="img-fluid rounded shadow-sm mb-3" alt="No Image">
                    @endif
                    <h5 class="font-weight-bold text-dark">{{$biodata->name}}</h5>
                    <p class="text-muted">{{$biodata->nim}}</p>
                </div>
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Kontak</div>
                        <div class="col-sm-8">{{$biodata->kontak}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Tempat, Tanggal Lahir</div>
                        <div class="col-sm-8">{{$biodata->tempatLahir}}, {{date('d F Y', strtotime($biodata->tglLahir))}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Alamat</div>
                        <div class="col-sm-8">
                            Kelurahan {{ucfirst(strtolower($biodata->kelurahan))}}, 
                            Kecamatan {{ucfirst(strtolower($biodata->kecamatan))}}, 
                            {{ucfirst(strtolower($biodata->kabupaten))}}, 
                            Provinsi {{ucfirst(strtolower($biodata->provinsi))}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Jenis Kelamin</div>
                        <div class="col-sm-8">{{$biodata->jk}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Agama</div>
                        <div class="col-sm-8">{{$biodata->agama}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Status Pernikahan</div>
                        <div class="col-sm-8">{{$biodata->kawin}} kawin</div>
                    </div>
                    <hr>
                    <h6 class="text-primary font-weight-bold mb-3">Data Akademik</h6>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Tanggal Masuk</div>
                        <div class="col-sm-8">{{date('d F Y', strtotime($biodata->tglMasuk))}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Tanggal Kelulusan</div>
                        <div class="col-sm-8">{{date('d F Y', strtotime($biodata->tglLulus))}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">Lama Masa Studi</div>
                        <div class="col-sm-8">
                            @php
                            $tgl1 = new DateTime($biodata->tglMasuk);
                            $tgl2 = new DateTime($biodata->tglLulus);
                            $jarak = $tgl2->diff($tgl1);
                            $str = '';
                            if($jarak->y != 0) $str .= $jarak->y . ' Tahun ';
                            if($jarak->m != 0) $str .= $jarak->m . ' Bulan ';
                            if($jarak->d != 0) $str .= $jarak->d . ' Hari ';
                            @endphp
                            {{$str}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-secondary fw-bold">IPK</div>
                        <div class="col-sm-8"><span class="badge bg-success">{{$biodata->ipk}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

@endsection