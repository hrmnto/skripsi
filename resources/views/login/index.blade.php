@extends("layouts.main")
@section("container")

<style>
    .container-login {
        background-image: url('/img/SAM_2141.JPG');
        background-attachment: fixed;
        background-size: cover;
    }

    .form-login {
        background-color: #000000ad;
    }
</style>

<div class=" d-flex justify-content-start align-items-center" style="height: 100vh">
    <div id="particles- js"></div>
    <div class="container">

        <div style="position: relative;" class="row justify-content-start align-items-center">
            <div class="col-sm-6 p-5">
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


            <h1 class="text-center" style="color: #222e64; line-height: 45px; margin-bottom:50px">Silahkan Login</h1>
            <form id="formLogin" action="/login" method="post" class="">
                @csrf

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Email" value="{{old('email')}}" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" value="{{old('password')}}" required>
                </div>

                <div class="mb-3  d-flex flex-column justify-content-center">
                    <button id="btnLogin" type="submit" style="background-color: #222e64; color: #ffffff;" class="btn btn-sm text-center">Login</button>
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
    document.getElementById("formLogin").onsubmit = () => {
        loader.style.display = "flex";
    }
</script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $(function() {
        $('#provinsi').on('change', () => {
            let id_provinsi = $('#provinsi').val();

            $.ajax({
                type: "POST",
                url: "{{route('getKabupaten')}}",
                data: {
                    id_provinsi: id_provinsi
                },
                cache: false,

                success: function(msg) {
                    $('#kabupaten').html(msg);
                    $('#kecamatan').html('');
                    $('#kelurahan').html('');
                },
                error: (data) => {
                    console.log('error', data)
                }
            })
        })

        $('#kabupaten').on('change', () => {
            let id_kabupaten = $('#kabupaten').val();

            $.ajax({
                type: "POST",
                url: "{{route('getKecamatan')}}",
                data: {
                    id_kabupaten: id_kabupaten
                },
                cache: false,

                success: function(msg) {
                    $('#kecamatan').html(msg);
                    $('#kelurahan').html('');
                },
                error: (data) => {
                    console.log('error', data)
                }
            })
        })

        $('#kecamatan').on('change', () => {
            let id_kecamatan = $('#kecamatan').val();

            $.ajax({
                type: "POST",
                url: "{{route('getKelurahan')}}",
                data: {
                    id_kecamatan: id_kecamatan
                },
                cache: false,

                success: function(msg) {
                    $('#kelurahan').html(msg);
                },
                error: (data) => {
                    console.log('error', data)
                }
            })
        })
    })
</script>

@endsection