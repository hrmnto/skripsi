@extends("alumni.layouts.main")

@section("container")
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Selamat Datang {{auth()->user()->name}}</h1>
        </div>
        <p class="lead">Selamat datang di dashboard alumni. Silahkan lengkapi biodata dan data pekerjaan anda.</p>
    </div>
</div>
@endsection