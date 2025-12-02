@extends("alumni.layouts.main")

@section("container")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Alumni</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row mb-4">
    <!-- Biodata Card -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100 py-2 border-start-primary border-3" style="border-left: 4px solid #4e73df;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Status Biodata</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if($biodata)
                                <span class="badge bg-success">Sudah Lengkap</span>
                            @else
                                <span class="badge bg-danger">Belum Lengkap</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <span data-feather="user" style="width: 40px; height: 40px; color: #dddfeb;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pekerjaan Card -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100 py-2 border-start-success border-3" style="border-left: 4px solid #1cc88a;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Riwayat Pekerjaan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pekerjaanCount }} Pekerjaan Tercatat</div>
                    </div>
                    <div class="col-auto">
                        <span data-feather="briefcase" style="width: 40px; height: 40px; color: #dddfeb;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang, {{ auth()->user()->name }}</h6>
            </div>
            <div class="card-body">
                <p>Selamat datang di Sistem Informasi Alumni. Mohon pastikan data diri Anda selalu diperbaharui untuk memudahkan pendataan alumni.</p>
                @if(!$biodata)
                    <div class="alert alert-warning">
                        <strong>Perhatian!</strong> Anda belum melengkapi biodata. Silahkan lengkapi biodata Anda terlebih dahulu.
                    </div>
                    <a href="/alumni/bios/create" class="btn btn-primary">
                        <span data-feather="edit" class="align-text-bottom"></span> Lengkapi Biodata
                    </a>
                @else
                    <p class="mb-0">Biodata Anda sudah tercatat. Jika ada perubahan data, silahkan lakukan pembaruan.</p>
                    <a href="/alumni/bios" class="btn btn-info mt-3 text-white">
                        <span data-feather="eye" class="align-text-bottom"></span> Lihat Biodata
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/alumni/works/create" class="btn btn-success btn-lg">
                        <span data-feather="plus-circle" class="align-text-bottom"></span> Tambah Pekerjaan Baru
                    </a>
                    <a href="/alumni/works" class="btn btn-secondary btn-lg">
                        <span data-feather="list" class="align-text-bottom"></span> Lihat Riwayat Pekerjaan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection