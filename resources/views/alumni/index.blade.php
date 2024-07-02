@extends("alumni.layouts.main")

@section("container")
@if (session()->has('success'))
<div class="mx-4 my-4 alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2">Selamat Datang {{auth()->user()->name}}</h1>

</div>
@endsection