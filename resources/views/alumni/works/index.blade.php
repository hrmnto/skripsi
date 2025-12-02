@extends("alumni.layouts.main")
@section("container")

<?php use Carbon\Carbon; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Pekerjaan</h1>
    @if (count($biodata) != 0 && $biodata[0]['pekerjaan'] != "belum")
    <a href="/alumni/works/create" class="btn btn-sm btn-success shadow-sm">
        <span data-feather="plus-circle" class="align-text-bottom"></span> Tambah Pekerjaan
    </a>
    @endif
</div>

@if (count($biodata) == 0)
    <div class="card shadow mb-4">
        <div class="card-body text-center py-5">
            <div class="mb-3">
                <span data-feather="user-x" style="width: 64px; height: 64px; color: #f6c23e;"></span>
            </div>
            <h4 class="text-gray-800">Biodata Belum Ada</h4>
            <p class="text-muted mb-4">Anda belum mengisi biodata. Silahkan isi biodata terlebih dahulu sebelum mengisi data pekerjaan.</p>
            <a href="/alumni/bios/create" class="btn btn-primary px-4">Isi Biodata</a>
        </div>
    </div>
@elseif($biodata[0]['pekerjaan'] == "belum")
    <div class="card shadow mb-4">
        <div class="card-body text-center py-5">
            <div class="mb-3">
                <span data-feather="briefcase" style="width: 64px; height: 64px; color: #858796;"></span>
            </div>
            <h4 class="text-gray-800">Status Belum Bekerja</h4>
            <p class="text-muted mb-4">Berdasarkan biodata, status Anda saat ini adalah <strong>Belum Bekerja</strong>.</p>
            <p>Jika status Anda sudah berubah, silahkan update biodata Anda terlebih dahulu.</p>
            <a href="/alumni/bios/{{ $biodata[0]->nim }}/edit" class="btn btn-info text-white px-4">Update Biodata</a>
        </div>
    </div>
@else
    @if (count($pekerjaan) == 0)
        <div class="card shadow mb-4">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <span data-feather="folder-plus" style="width: 64px; height: 64px; color: #4e73df;"></span>
                </div>
                <h4 class="text-gray-800">Belum Ada Data Pekerjaan</h4>
                <p class="text-muted mb-4">Anda belum menambahkan riwayat pekerjaan. Silahkan tambahkan pekerjaan pertama Anda.</p>
                <a href="/alumni/works/create" class="btn btn-primary px-4">Tambah Pekerjaan</a>
            </div>
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <ul class="nav nav-pills card-header-pills" id="myTab" role="tablist">
                    @for ($i = 0; $i < count($pekerjaan); $i++)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{$i+1 == count($pekerjaan) ? 'active':''}}" id="pekerjaan{{$i+1}}-tab" data-bs-toggle="tab" data-bs-target="#pekerjaan{{$i+1}}-tab-pane" type="button" role="tab" aria-controls="pekerjaan{{$i+1}}-tab-pane" aria-selected="false">
                            {{$i == count($pekerjaan)-1 ? 'Pekerjaan Sekarang' : 'Pekerjaan ke-' . ($i+1)}}
                        </button>
                    </li>
                    @endfor
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    @foreach ($pekerjaan as $work)
                    <div class="tab-pane fade {{$loop->iteration == count($pekerjaan)? 'show active':''}}" id="pekerjaan{{$loop->iteration}}-tab-pane" role="tabpanel" aria-labelledby="pekerjaan{{$loop->iteration }}-tab" tabindex="0">
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <h4 class="font-weight-bold text-primary mb-4">{{$work->nama_pekerjaan}}</h4>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-secondary fw-bold">Nama Tempat Bekerja</div>
                                    <div class="col-sm-8">{{$work->tempat_pekerjaan}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-secondary fw-bold">Kategori Pekerjaan</div>
                                    <div class="col-sm-8">
                                        @if($work->kategori_pekerjaan1 == 1) <span class="badge bg-info me-1">Kependidikan</span> @endif
                                        @if($work->kategori_pekerjaan2 == 1) <span class="badge bg-info me-1">IT</span> @endif
                                        @if($work->kategori_pekerjaan3 == 1) <span class="badge bg-info me-1">Wirausaha</span> @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-secondary fw-bold">Alamat Bekerja</div>
                                    <div class="col-sm-8">
                                        Kelurahan {{ucfirst(strtolower($work->kelurahan))}}, 
                                        Kecamatan {{ucfirst(strtolower($work->kecamatan))}}, 
                                        {{ucfirst(strtolower($work->kabupaten))}}, 
                                        Provinsi {{ucfirst(strtolower($work->provinsi))}}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-secondary fw-bold">Periode Bekerja</div>
                                    <div class="col-sm-8">
                                        {{date('d F Y', strtotime($work->tanggal_pekerjaan))}} 
                                        <span class="text-muted fst-italic ms-2">
                                            (@php
                                            $tgl2 = new DateTime($work->tanggal_pekerjaan);
                                            $tgl1 = new DateTime($work->biodata->tglLulus);
                                            $jarak = $tgl2->diff($tgl1);
                                            $str = '';
                                            if($jarak->y != 0) $str .= $jarak->y . ' Tahun ';
                                            if($jarak->m != 0) $str .= $jarak->m . ' Bulan ';
                                            if($jarak->d != 0) $str .= $jarak->d . ' Hari ';
                                            echo $str;
                                            echo ($tgl1 > $tgl2) ? " Sebelum Kelulusan" : " Setelah Kelulusan";
                                            @endphp)
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-secondary fw-bold">Kisaran Gaji</div>
                                    <div class="col-sm-8">Rp. {{number_format($work->gaji,2,",",".")}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-secondary fw-bold">Relevansi</div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-secondary">{{$work->relevansi_pekerjaan}}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 border-start d-flex flex-column justify-content-center align-items-center mt-4 mt-lg-0">
                                <h6 class="text-muted mb-3">Aksi</h6>
                                <div class="d-grid gap-2 w-75">
                                    <a href="/alumni/works/{{$work->id}}/edit" class="btn btn-warning">
                                        <span data-feather="edit-2" class="align-text-bottom"></span> Edit Data
                                    </a>
                                    <form action="/alumni/works/{{$work->id}}" method="post" class="d-grid">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            <span data-feather="trash-2" class="align-text-bottom"></span> Hapus Data
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif

@endsection