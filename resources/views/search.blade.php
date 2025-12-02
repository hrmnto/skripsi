<?php
use Carbon\Carbon;
?>
@extends("layouts.main")

@section("container")
<div class="container pb-5 pt-5 mt-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold mb-4 display-5 text-primary">Cari Alumni</h2>
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="" method="get">
                        <div class="input-group input-group-lg">
                            <input name="keyword" type="text" class="form-control border-end-0" placeholder="Masukkan Nama atau NIM..." aria-label="Masukkan nama / nim" value="{{ request('keyword') }}">
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if ($keyword == "")
                <div class="text-center opacity-50 mt-5">
                    <i class="bi bi-search display-1"></i>
                    <p class="mt-3 fs-5">Silakan masukkan kata kunci untuk mencari alumni.</p>
                </div>
            @else
                @if (count($biodatas) == 0)
                    <div class="alert alert-warning text-center shadow-sm border-0" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Nama atau NIM tidak ditemukan.
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">Hasil Pencarian</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach ($biodatas as $biodata)
                                <div class="list-group-item p-3 d-flex justify-content-between align-items-center action-hover">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-placeholder rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                            @if($biodata->foto)
                                                <img src="{{asset('storage/' . $biodata->foto) }}" class="rounded-circle w-100 h-100 object-fit-cover" alt="{{$biodata->name}}">
                                            @else
                                                <i class="bi bi-person-fill fs-4 text-secondary"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{$biodata->name}}</h6>
                                            <small class="text-muted">{{$biodata->nim}}</small>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#detal{{$biodata->nim}}">
                                        Lihat Detail
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="detal{{$biodata->nim}}" tabindex="-1" aria-labelledby="detal{{$biodata->nim}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title fw-bold" id="detal{{$biodata->nim}}Label">Detail Alumni</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <ul class="nav nav-tabs nav-fill" id="myTab{{$biodata->nim}}" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active rounded-0 py-3" id="foto-{{$biodata->nim}}-tab" data-bs-toggle="tab" data-bs-target="#foto-{{$biodata->nim}}-tab-pane" type="button" role="tab" aria-controls="foto-{{$biodata->nim}}-tab-pane" aria-selected="true"><i class="bi bi-image me-2"></i>Foto</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link rounded-0 py-3" id="biodata-{{$biodata->nim}}-tab" data-bs-toggle="tab" data-bs-target="#biodata-{{$biodata->nim}}-tab-pane" type="button" role="tab" aria-controls="biodata-{{$biodata->nim}}-tab-pane" aria-selected="false"><i class="bi bi-person-lines-fill me-2"></i>Biodata</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link rounded-0 py-3" id="pekerjaan-{{$biodata->nim}}-tab" data-bs-toggle="tab" data-bs-target="#pekerjaan-{{$biodata->nim}}-tab-pane" type="button" role="tab" aria-controls="pekerjaan-{{$biodata->nim}}-tab-pane" aria-selected="false"><i class="bi bi-briefcase-fill me-2"></i>Pekerjaan</button>
                                                    </li>
                                                </ul>
                                                
                                                <div class="tab-content p-4" id="myTabContent{{$biodata->nim}}">
                                                    <!-- Foto Tab -->
                                                    <div class="tab-pane fade show active text-center" id="foto-{{$biodata->nim}}-tab-pane" role="tabpanel" aria-labelledby="foto-{{$biodata->nim}}-tab" tabindex="0">
                                                        @if($biodata->foto)
                                                            <img src="{{asset('storage/' . $biodata->foto) }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;" alt="{{$biodata->name}}">
                                                        @else
                                                            <div class="py-5 text-muted">
                                                                <i class="bi bi-person-x fs-1 d-block mb-3"></i>
                                                                <p>Tidak ada foto tersedia</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Biodata Tab -->
                                                    <div class="tab-pane fade" id="biodata-{{$biodata->nim}}-tab-pane" role="tabpanel" aria-labelledby="biodata-{{$biodata->nim}}-tab" tabindex="0">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Nama</label>
                                                                <p class="fw-bold mb-0">{{$biodata->name}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">NIM</label>
                                                                <p class="fw-bold mb-0">{{$biodata->nim}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Kontak</label>
                                                                <p class="fw-bold mb-0">{{$biodata->kontak}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Tempat, Tanggal Lahir</label>
                                                                <p class="fw-bold mb-0">{{$biodata->tempatLahir}}, {{date('d F Y', strtotime($biodata->tglLahir))}}</p>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="small text-muted text-uppercase fw-bold">Alamat</label>
                                                                <p class="fw-bold mb-0">Kel. {{ucfirst(strtolower($biodata->kelurahan))}}, Kec. {{ucfirst(strtolower($biodata->kecamatan))}}, {{ucfirst(strtolower($biodata->kabupaten))}}, Prov. {{ucfirst(strtolower($biodata->provinsi))}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Jenis Kelamin</label>
                                                                <p class="fw-bold mb-0">{{$biodata->jk}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Agama</label>
                                                                <p class="fw-bold mb-0">{{$biodata->agama}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Status Pernikahan</label>
                                                                <p class="fw-bold mb-0">{{$biodata->kawin}} kawin</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">IPK</label>
                                                                <p class="fw-bold mb-0">{{$biodata->ipk}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Tanggal Masuk</label>
                                                                <p class="fw-bold mb-0">{{date('d F Y', strtotime($biodata->tglMasuk))}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="small text-muted text-uppercase fw-bold">Tanggal Kelulusan</label>
                                                                <p class="fw-bold mb-0">{{date('d F Y', strtotime($biodata->tglLulus))}}</p>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="small text-muted text-uppercase fw-bold">Lama Masa Studi</label>
                                                                @php
                                                                    $tgl1 = new DateTime($biodata->tglMasuk);
                                                                    $tgl2 = new DateTime($biodata->tglLulus);
                                                                    $jarak = $tgl2->diff($tgl1);
                                                                    $str = '';
                                                                    if($jarak->y != 0) $str .= $jarak->y . ' Tahun ';
                                                                    if($jarak->m != 0) $str .= $jarak->m . ' Bulan ';
                                                                    if($jarak->d != 0) $str .= $jarak->d . ' Hari ';
                                                                @endphp
                                                                <p class="fw-bold mb-0">{{$str}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Pekerjaan Tab -->
                                                    <div class="tab-pane fade" id="pekerjaan-{{$biodata->nim}}-tab-pane" role="tabpanel" aria-labelledby="pekerjaan-{{$biodata->nim}}-tab" tabindex="0">
                                                        @if (count($biodata->works) != 0)
                                                            @php $latestWork = $biodata->works[count($biodata->works)-1]; @endphp
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <div class="alert alert-info border-0 d-flex align-items-center">
                                                                        <i class="bi bi-info-circle-fill me-2"></i>
                                                                        <div>Menampilkan pekerjaan terakhir.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small text-muted text-uppercase fw-bold">Kategori Pekerjaan</label>
                                                                    <p class="fw-bold mb-0">
                                                                        {{$latestWork->kategori_pekerjaan1 == 1 ? 'Kependidikan': ''}}
                                                                        {{$latestWork->kategori_pekerjaan2 == 1 ? 'IT': ''}}
                                                                        {{$latestWork->kategori_pekerjaan3 == 1 ? 'Wirausaha': ''}}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small text-muted text-uppercase fw-bold">Bekerja Sebagai</label>
                                                                    <p class="fw-bold mb-0">{{$latestWork->nama_pekerjaan}}</p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="small text-muted text-uppercase fw-bold">Alamat Pekerjaan</label>
                                                                    <p class="fw-bold mb-0">{{$latestWork->tempat_pekerjaan}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small text-muted text-uppercase fw-bold">Mulai Bekerja</label>
                                                                    @php
                                                                        $tgl2 = new DateTime($latestWork->tanggal_pekerjaan);
                                                                        $tgl1 = new DateTime($biodata->tglLulus);
                                                                        $jarak = $tgl2->diff($tgl1);
                                                                        $str = '';
                                                                        if($jarak->y != 0) $str .= $jarak->y . ' Tahun ';
                                                                        if($jarak->m != 0) $str .= $jarak->m . ' Bulan ';
                                                                        if($jarak->d != 0) $str .= $jarak->d . ' Hari ';
                                                                        $status = ($tgl1 > $tgl2) ? "Sebelum Kelulusan" : "Setelah Kelulusan";
                                                                    @endphp
                                                                    <p class="fw-bold mb-0">{{date('d F Y', strtotime($latestWork->tanggal_pekerjaan))}} <br><small class="text-muted">({{$status}})</small></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small text-muted text-uppercase fw-bold">Kisaran Gaji</label>
                                                                    <p class="fw-bold mb-0 text-success">Rp. {{number_format($latestWork->gaji,2,",",".")}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small text-muted text-uppercase fw-bold">Relevansi</label>
                                                                    <p class="fw-bold mb-0">{{$latestWork->relevansi_pekerjaan}}</p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="py-5 text-center text-muted">
                                                                <i class="bi bi-briefcase-fill fs-1 d-block mb-3 opacity-25"></i>
                                                                <p>Belum ada data pekerjaan.</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2024 Computer Education</span>
        </div>
    </footer>
</div>
@endsection