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
<h1>Isi Biodata</h1>

<div class="col-sm-8">

    <form method="POST" action="/alumni/bios/{{$bio->nim}}" enctype="multipart/form-data">
        @method("put")
        @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Nama</label>
      <input type="name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp" value="{{$bio->name}} " name="name">
    </div>
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    <div class="mb-3">
        <label for="foto" class="form-label">foto</label>
        <input type="file" class="form-control" id="foto" name="foto" placeholder="foto" value="{{asset('storage/' . $bio->foto) }}">
    </div>
    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control @error('nim')
            is-invalid
        @enderror" id="nim" name="nim" placeholder="NIM" value="{{$bio->nim}}">
    </div>

    <div class="mb-3">
        <label for="kontak" class="form-label">Kontak</label>
        <input type="number" class="form-control @error('kontak')
            is-invalid
        @enderror" id="kontak" name="kontak" placeholder="Contoh : 0822xxxxxxxx" value="{{$bio->kontak}}">
    </div>

    <div class="mb-3">
        <label for="tglMasuk" class="form-label">Tanggal Masuk</label>
        <input type="text" class="form-control" id="tglMasuk" name="tglMasuk" placeholder="Contoh : 2015" value="{{$bio->tglMasuk}}">
    </div>

    <div class="mb-3">
        <label for="tglLulus" class="form-label">Tanggal Kelulusan</label>
        <input type="text" class="form-control" id="tglLulus" name="tglLulus" placeholder="Contoh : 2015" value="{{$bio->tglLulus}}">
    </div>

    <div class="mb-3">
        <label for="noIjazah" class="form-label">Nomor Ijazah</label>
        <input type="text" class="form-control" id="noIjazah" name="noIjazah" placeholder="Contoh : 2015" value="{{$bio->noIjazah}}">
    </div>

    <div class="mb-3">
        <label for="fotoIjazah" class="form-label">Scan Ijazah</label>
        <input type="file" class="form-control" id="fotoIjazah" name="fotoIjazah" placeholder="foto Ijazah" value="{{asset('storage/' . $bio->fotoIjazah) }}">
    </div>

    <div class="mb-3">
        <label for="ipk" class="form-label">IPK</label>
        <input type="text" class="form-control @error('ipk')
            is-invalid
        @enderror" id="ipk" name="ipk" placeholder="Contoh : 3.8" value="{{$bio->ipk}}">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Tempat, Tanggal Lahir</label>
        <div class="input-group">
            <input type="text" aria-label="First name" class="form-control" name="tempatLahir" placeholder="Tempat Lahir" value="{{$bio->tempatLahir}}">
            <input type="date" aria-label="Last name" class="form-control" name="tglLahir" value="{{$bio->tglLahir}}">
        </div>
    </div>

    <label class="form-label" >Alamat</label>
    @php
        use App\Models\Province;
        use App\Models\Regency;
        use App\Models\District;
        use App\Models\Village;
    @endphp
    <div class="input-group mb-3">
        <label class="input-group-text" for="provinsi">Provinsi</label>
        <select class="form-select" id="provinsi" name="provinsi">
          <option selected value="{{Province::where('name', $bio->provinsi)->first()->id;
        }}">{{$bio->provinsi}}</option>
          @foreach ($provinces as $provinsi )  
          <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="kabupaten">Kabupaten</label>
        <select class="form-select" id="kabupaten" name="kabupaten">
          <option selected value="{{Regency::where('name', $bio->kabupaten)->first()->id;
        }}">{{$bio->kabupaten}}</option>
        </select>
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="kecamatan">Kecamatan</label>
        <select class="form-select" id="kecamatan" name="kecamatan">
          <option selected value="{{District::where('name', $bio->kecamatan)->first()->id;
        }}">{{$bio->kecamatan}}</option>
        </select>
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="kelurahan">Kelurahan</label>
        <select class="form-select" id="kelurahan" name="kelurahan">
            <option selected value="{{Village::where('name', $bio->kelurahan)->first()->id;
            }}">{{$bio->kelurahan}}</option>
        </select>
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="koordinat">Koordinat Tempat Tinggal</label>
        <input type="text" aria-label="Last name" id="koordinat" class="form-control @error('koordinat')
        is-invalid
    @enderror"  name="koordinat" placeholder="latitude, longitude" value="{{$bio->koordinat}}"><br>
    </div>
    <div id="map2"></div>

    <div class="mb-3">
        <label for="jk" class="form-label">Jenis Kelamin</label>
        <select id="jk" class="form-select" aria-label="Default select example" name="jk" >
            <option selected value="{{ $bio->jk }}">{{ $bio->jk }}</option>
            <option value="laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
    </div>

    <div class="mb-3">
        <label for="agama" class="form-label">Agama</label>
        <select class="form-select" aria-label="Default select example" name="agama">
            <option selected value="{{ $bio->agama }}">{{ $bio->agama }}</option>
            <option value="islam">Islam</option>
            <option value="kristen">Kristen</option>
            <option value="hindu">Hindu</option>
            <option value="buddha">Buddha</option>
          </select>
    </div>

    <div class="mb-3">
        <label for="kawin" class="form-label">Status Perkawinan</label>
        <select id="kawin" class="form-select" aria-label="Default select example" name="kawin">
            <option selected value="{{ $bio->kawin }}">{{ $bio->kawin  }}</option>
            <option value="belum">Belum Menikah</option>
            <option value="sudah">Sudah Menikah</option>
          </select>
    </div>

    <div class="mb-3">
        <label for="pekerjaan" class="form-label">Status Pekerjaan</label>
        <select class="form-select" aria-label="Default select example" name="pekerjaan">
            <option selected value="{{ $bio->pekerjaan }}"> {{ $bio->pekerjaan }}</option>
            <option value="belum">Belum Bekerja</option>
            <option value="sudah">Sudah Bekerja</option>
          </select>
    </div>
    


    <button type="submit" class="btn btn-primary">Selesai</button>
</form>
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