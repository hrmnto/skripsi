@extends("layouts.main")
@section("container")

<style>
    .container-login{
        background-image: url('/img/SAM_2141.JPG');
        background-attachment: fixed;
        background-size: cover;
    }
    .form-login{
        background-color: #000000ad;
    }
</style>

    <div class=" d-flex justify-content-start align-items-center" style="height: 100vh">
        <div id="particles- js"></div>
        <div class="container">

            <div style="position: relative;" class="row justify-content-start align-items-center">
                <div class="col-sm-6 p-5" >
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <script>
                            Swal.fire({
                                title: 'Login Berhasil',
                                icon: 'success',
                                })
                        </script>
                    </div>
                    @endif
                    @if (session()->has('loginError'))
                    <script>
                        Swal.fire({
                            title: 'Login Gagal',
                            text: 'Email / Password yang anda masukkan salah.',
                            icon: 'error',
                            })
                    </script>
                    {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('loginError')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> --}}
                    @endif


                    <h1 class="text-center" style="color: #222e64; line-height: 45px; margin-bottom:50px" >Silahkan Login</h1>
                    <form id="formLogin" action="/login" method="post" class="">
                        @csrf
                    
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Email" required>
                      </div>

                      <div class="mb-3">
                        <input type="password" name="password" class="form-control"  placeholder="Masukkan Password" required>
                      </div>

                      <div class="mb-3  d-flex flex-column justify-content-center">
                        <button id="btnLogin" type="submit"  style="background-color: #222e64; color: #ffffff;" class="btn btn-sm text-center">Login</button>
                      </div>
                    </form>
                      
                </div>
                <div class="col-sm-6">
                    <img style="height: 45vh;" src="img/alumni.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("formLogin").onsubmit = ()=>{
            loader.style.display = "flex";
        }
 
    </script>

@endsection