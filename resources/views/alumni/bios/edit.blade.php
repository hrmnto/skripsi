@extends("alumni.layouts.main")
<style>
    #map2 {
        height: 35vh;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""></script>
@section("container")
<meta name="csrf-token" content="{{csrf_token()}}"/>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Biodata</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Biodata Alumni</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="/alumni/bios/{{$bio->nim}}" enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputname1" aria-describedby="nameHelp" value="{{$bio->name}} " name="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="NIM" value="{{$bio->nim}}">
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{asset('storage/' . $bio->foto) }}">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak (WA/HP)</label>
                                <input type="number" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" placeholder="Contoh : 0822xxxxxxxx" value="{{$bio->kontak}}">
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tglMasuk" class="form-label">Tanggal Masuk</label>
                                <input type="text" class="form-control @error('tglMasuk') is-invalid @enderror" id="tglMasuk" name="tglMasuk" placeholder="Contoh : 2015" value="{{$bio->tglMasuk}}">
                                @error('tglMasuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tglLulus" class="form-label">Tanggal Kelulusan</label>
                                <input type="text" class="form-control @error('tglLulus') is-invalid @enderror" id="tglLulus" name="tglLulus" placeholder="Contoh : 2015" value="{{$bio->tglLulus}}">
                                @error('tglLulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="noIjazah" class="form-label">Nomor Ijazah</label>
                                <input type="text" class="form-control @error('noIjazah') is-invalid @enderror" id="noIjazah" name="noIjazah" placeholder="Contoh : 2015" value="{{$bio->noIjazah}}">
                                @error('noIjazah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fotoIjazah" class="form-label">Scan Ijazah</label>
                                <input type="file" class="form-control @error('fotoIjazah') is-invalid @enderror" id="fotoIjazah" name="fotoIjazah" value="{{asset('storage/' . $bio->fotoIjazah) }}">
                                @error('fotoIjazah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ipk" class="form-label">IPK</label>
                                <input type="text" class="form-control @error('ipk') is-invalid @enderror" id="ipk" name="ipk" placeholder="Contoh : 3.8" value="{{$bio->ipk}}">
                                @error('ipk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Tempat, Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" aria-label="First name" class="form-control @error('tempatLahir') is-invalid @enderror" name="tempatLahir" placeholder="Tempat Lahir" value="{{$bio->tempatLahir}}">
                                    <input type="date" aria-label="Last name" class="form-control @error('tglLahir') is-invalid @enderror" name="tglLahir" value="{{$bio->tglLahir}}">
                                </div>
                                @error('tempatLahir')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                @error('tglLahir')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h6 class="heading-small text-muted mb-4">Informasi Alamat</h6>

                    @php
                        use App\Models\Province;
                        use App\Models\Regency;
                        use App\Models\District;
                        use App\Models\Village;
                    @endphp

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <select class="form-select" id="provinsi" name="provinsi">
                                    <option selected value="{{Province::where('name', $bio->provinsi)->first()->id;}}">{{$bio->provinsi}}</option>
                                    @foreach ($provinces as $provinsi )
                                    <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kabupaten">Kabupaten</label>
                                <select class="form-select" id="kabupaten" name="kabupaten">
                                    <option selected value="{{Regency::where('name', $bio->kabupaten)->first()->id;}}">{{$bio->kabupaten}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kecamatan">Kecamatan</label>
                                <select class="form-select" id="kecamatan" name="kecamatan">
                                    <option selected value="{{District::where('name', $bio->kecamatan)->first()->id;}}">{{$bio->kecamatan}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kelurahan">Kelurahan</label>
                                <select class="form-select" id="kelurahan" name="kelurahan">
                                    <option selected value="{{Village::where('name', $bio->kelurahan)->first()->id;}}">{{$bio->kelurahan}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="koordinat">Koordinat Tempat Tinggal</label>
                        <input type="text" id="koordinat" class="form-control @error('koordinat') is-invalid @enderror" name="koordinat" placeholder="latitude, longitude" value="{{$bio->koordinat}}">
                        @error('koordinat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="map2" class="mb-3 rounded border"></div>

                    <hr class="my-4">
                    <h6 class="heading-small text-muted mb-4">Informasi Lainnya</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select id="jk" class="form-select" name="jk">
                                    <option value="" disabled {{ $bio->jk ? '' : 'selected' }}>-- Silahkan Pilih --</option>
                                    <option value="laki-laki" {{ $bio->jk == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $bio->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-select" name="agama">
                                    <option value="" disabled {{ $bio->agama ? '' : 'selected' }}>-- Silahkan Pilih --</option>
                                    <option value="islam" {{ $bio->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ $bio->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="hindu" {{ $bio->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="buddha" {{ $bio->agama == 'buddha' ? 'selected' : '' }}>Buddha</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kawin" class="form-label">Status Perkawinan</label>
                                <select id="kawin" class="form-select" name="kawin">
                                    <option value="" selected disabled>-- Silakan Pilih --</option>
                                    <option value="belum" @if($bio->kawin == 'belum') selected @endif>Belum Menikah</option>
                                    <option value="sudah" @if($bio->kawin == 'sudah') selected @endif>Sudah Menikah</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">Status Pekerjaan</label>
                                <select class="form-select" name="pekerjaan">
                                    <option value="" selected disabled>-- Silahkan Pilih --</option>
                                    <option value="belum" @if($bio->pekerjaan == 'belum') selected @endif>Belum Bekerja</option>
                                    <option value="sudah" @if($bio->pekerjaan == 'sudah') selected @endif>Sudah Bekerja</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary px-4">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var map = L.map('map2').setView([-3.298618801108944,114.58542404981114], 16.86);
    var baseLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '© OpenStreetMap contributors'
              })
              baseLayer.addTo(map);

    // get location
    var inputKoordinat = document.querySelector("#koordinat"),
        curLocation = [{{$bio->koordinat}}]
    
        map.attributionControl.setPrefix(false)

        var marker = new L.marker(curLocation, {
            draggable : "true"
        });

        map.flyTo([{{$bio->koordinat}}]);
        marker.on("dragend", (event) => {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable : "true"
            }).bindPopup(position).update();
            $("#koordinat").val(`${position.lat}, ${position.lng}`).keyup();
        });

        map.addLayer(marker);

        map.on("click", (e) => {
            if(!marker){
                marker = L.marker(e.latlng).addTo(map);
            }else{
                console.log(e.latlng)
                marker.setLatLng(e.latlng);
            }
            map.flyTo([e.latlng.lat,e.latlng.lng]);
            inputKoordinat.value = `${e.latlng.lat}, ${e.latlng.lng}`;
        })

        inputKoordinat.addEventListener("input", (e) => {
            console.log(inputKoordinat.value)
            let koord = inputKoordinat.value.split(",")
            if(!marker){
                marker = L.marker(koord).addTo(map);
            }else{

                marker.setLatLng(new L.LatLng(koord[0], koord[1]));
                map.flyTo([koord[0],koord[1]]);

            }
        });
</script>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script>
    $(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
        });
    });

    $(function(){
        $('#provinsi').on('change', () => {
            let id_provinsi = $('#provinsi').val();
            
            $.ajax({
                type : "POST",
                url : "{{route('getKabupaten')}}",
                data : {id_provinsi:id_provinsi},
                cache : false,

                success: function(msg){
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
                type : "POST",
                url : "{{route('getKecamatan')}}",
                data : {id_kabupaten:id_kabupaten},
                cache : false,

                success: function(msg){
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
                type : "POST",
                url : "{{route('getKelurahan')}}",
                data : {id_kecamatan:id_kecamatan},
                cache : false,

                success: function(msg){
                    $('#kelurahan').html(msg);
                },
                error: (data) => {
                    console.log('error', data)
                }
            })
        })
    })
</script>