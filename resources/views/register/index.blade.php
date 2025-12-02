@extends("layouts.main")
@section("container")

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image" style="background: url('/img/alumni.png'); background-position: center; background-size: contain; background-repeat: no-repeat; min-height: 400px;"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                        </div>
                        <form class="user" action="/register" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleFirstName"
                                    placeholder="Nama Lengkap" value="{{old('name')}}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="nim" class="form-control form-control-user @error('nim') is-invalid @enderror" id="exampleInputNim"
                                    placeholder="Nomor Induk Mahasiswa (NIM)" value="{{old('nim')}}">
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                                    placeholder="Alamat Email" value="{{old('email')}}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="exampleInputPassword" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block w-100">
                                Register Akun
                            </button>
                        </form>
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection