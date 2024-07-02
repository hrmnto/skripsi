@extends("alumni.layouts.main")
<style>
    #map2 {
        height: 35vh;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@section("container")
<meta name="csrf-token" content="{{csrf_token()}}" />

<h1 class="mt-4">Isi Data Pekerjaan</h1>
<div class="col-sm-6">

    <form method="POST" action="/alumni/works/{{$pekerjaan->id}}">
        @method('put')
        @csrf

        <input type="hidden" name="nim" value="{{ auth()->user()->nim }}">

        <div class="mb-3">
            <label for="kategori_pekerjaan" class="form-label">Kategori Pekerjaan</label>
            <div class="row g-3">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input type="hidden" name="kategori_pekerjaan1" value="0">
                            <input id="Kependidikan" class="form-check-input mt-0" type="checkbox" name="kategori_pekerjaan1" value="1" @if ($pekerjaan->kategori_pekerjaan1 == 1)
                            checked
                            @endif>
                        </div>
                        <label for="Kependidikan" class="form-control">Kependidikan</label>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input type="hidden" name="kategori_pekerjaan2" value="0">
                            <input id="IT" class="form-check-input mt-0" type="checkbox" name="kategori_pekerjaan2" value="1" @if ($pekerjaan->kategori_pekerjaan2 == 1)
                            checked
                            @endif>
                        </div>
                        <label for="IT" class="form-control">IT</label>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input type="hidden" name="kategori_pekerjaan3" value="0">
                            <input id="Wirausaha" class="form-check-input mt-0" type="checkbox" name="kategori_pekerjaan3" value="1" @if ($pekerjaan->kategori_pekerjaan3 == 1)
                            checked
                            @endif>
                        </div>
                        <label for="Wirausaha" class="form-control">Wirausaha</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="nama_pekerjaan" class="form-label">Bekerja Sebagai</label>
            <input type="text" class="form-control" id="nama_pekerjaan" aria-describedby="nameHelp" name="nama_pekerjaan" placeholder="Contoh : Guru Honorer / Programmer / FrontEnd Developer" value="{{$pekerjaan->nama_pekerjaan}}">
        </div>

        <div class="mb-3">
            <label for="tempat_pekerjaan" class="form-label">Alamat Tempat Bekerja</label>
            <input type="text" class="form-control" id="tempat_pekerjaan" aria-describedby="nameHelp" name="tempat_pekerjaan" value="{{$pekerjaan->tempat_pekerjaan}}">
        </div>

        <label class="form-label">Alamat</label>
        @php
        use App\Models\Province;
        use App\Models\Regency;
        use App\Models\District;
        use App\Models\Village;
        @endphp
        <div class="input-group mb-3">
            <label class="input-group-text" for="provinsi">Provinsi</label>
            <select class="form-select" id="provinsi" name="provinsi">
                <option selected value="{{Province::where('name', $pekerjaan->provinsi)->first()->id;
        }}">{{$pekerjaan->provinsi}}</option>
                @foreach ($provinces as $provinsi )
                <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="kabupaten">Kabupaten</label>
            <select class="form-select" id="kabupaten" name="kabupaten">
                <option selected value="{{Regency::where('name', $pekerjaan->kabupaten)->first()->id;
        }}">{{$pekerjaan->kabupaten}}</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="kecamatan">Kecamatan</label>
            <select class="form-select" id="kecamatan" name="kecamatan">
                <option selected value="{{District::where('name', $pekerjaan->kecamatan)->first()->id;
        }}">{{$pekerjaan->kecamatan}}</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="kelurahan">Kelurahan</label>
            <select class="form-select" id="kelurahan" name="kelurahan">
                <option selected value="{{Village::where('name', $pekerjaan->kelurahan)->first()->id;
            }}">{{$pekerjaan->kelurahan}}</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="koordinat">Koordinat Tempat Kerja</label>
            <input type="text" aria-label="Last name" id="koordinat" class="form-control @error('koordinat')
        is-invalid
    @enderror" name="koordinat" placeholder="latitude, longitude" value="{{$pekerjaan->koordinat}}"><br>
        </div>
        <div id="map2"></div>


        <div class="mb-3">
            <label for="tanggal_pekerjaan" class="form-label">Tanggal Mendapatkan Pekerjaan</label>
            <div class="input-group">
                <input type="date" aria-label="Last name" id="tanggal_pekerjaan" class="form-control" name="tanggal_pekerjaan" value="{{$pekerjaan->tanggal_pekerjaan}}">
            </div>
        </div>

        <div class="mb-3">
            <label for="gaji" class="form-label">Besaran Kisaran Gaji</label>
            <div class="input-group">
                <input type="number" class="form-control" id="gaji" name="gaji" placeholder="5000000" value="{{$pekerjaan->gaji}}">
                <input type="text" class="form-control" id="nominal" value="" disabled>
            </div>
        </div>

        <div class="mb-3">
            <label for="relevansi_pekerjaan" class="form-label">Relevansi Pekerjaan (Menurut Anda)</label>
            <select id="relevansi_pekerjaan" class="form-select" aria-describedby="basic-addon4" name="relevansi_pekerjaan">
                <option selected value="{{$pekerjaan->relevansi_pekerjaan}}">{{$pekerjaan->relevansi_pekerjaan}}</option>
                <option value="relevan">Relevan</option>
                <option value="tinggi">Tinggi</option>
                <option value="sedang">Sedang</option>
                <option value="rendah">Rendah</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Selesai</button>
    </form>
</div>

<script>
    let nominal = document.getElementById("nominal"),
        gaji = document.getElementById("gaji");

    gaji.addEventListener("change", () => {
        if (gaji.value.length == 6) {
            nominal.value = `Rp. ${gaji.value[0]}${gaji.value[1]}${gaji.value[2]}.${gaji.value[3]}${gaji.value[4]}${gaji.value[5]}`
        } else if (gaji.value.length == 7) {
            nominal.value = `Rp. ${gaji.value[0]}.${gaji.value[1]}${gaji.value[2]}${gaji.value[3]}.${gaji.value[4]}${gaji.value[5]}${gaji.value[6]}`
        } else if (gaji.value.length == 8) {
            nominal.value = `Rp. ${gaji.value[0]}${gaji.value[1]}.${gaji.value[2]}${gaji.value[3]}${gaji.value[4]}.${gaji.value[5]}${gaji.value[6]}${gaji.value[7]}`
        }

    })
</script>
<script>
    var map = L.map('map2').setView([-3.298618801108944, 114.58542404981114], 16.86);
    var baseLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    })
    baseLayer.addTo(map);

    // get location
    var inputKoordinat = document.querySelector("#koordinat"),
        curLocation = [-3.298618801108944, 114.58542404981114]

    map.attributionControl.setPrefix(false)

    var marker = new L.marker(curLocation, {
        draggable: "true"
    });

    marker.on("dragend", (event) => {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: "true"
        }).bindPopup(position).update();
        $("#koordinat").val(`${position.lat}, ${position.lng}`).keyup();
    });

    map.addLayer(marker);

    map.on("click", (e) => {
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            console.log(e.latlng)
            marker.setLatLng(e.latlng);
        }
        map.flyTo([e.latlng.lat, e.latlng.lng]);
        inputKoordinat.value = `${e.latlng.lat}, ${e.latlng.lng}`;
    })

    inputKoordinat.addEventListener("input", (e) => {
        console.log(inputKoordinat.value)
        let koord = inputKoordinat.value.split(",")
        if (!marker) {
            marker = L.marker(koord).addTo(map);
        } else {

            marker.setLatLng(new L.LatLng(koord[0], koord[1]));
            map.flyTo([koord[0], koord[1]]);

        }
    });
</script>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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