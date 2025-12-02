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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Isi Data Pekerjaan</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Data Pekerjaan</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="/alumni/works">
                    @csrf
                    <input type="hidden" name="nim" value="{{ auth()->user()->nim }}">

                    <div class="mb-3">
                        <label for="kategori_pekerjaan" class="form-label">Kategori Pekerjaan</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input type="hidden" name="kategori_pekerjaan1" value="0">
                                        <input id="Kependidikan" class="form-check-input mt-0" type="checkbox" name="kategori_pekerjaan1" value="1">
                                    </div>
                                    <label for="Kependidikan" class="form-control">Kependidikan</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input type="hidden" name="kategori_pekerjaan2" value="0">
                                        <input id="IT" class="form-check-input mt-0" type="checkbox" name="kategori_pekerjaan2" value="1">
                                    </div>
                                    <label for="IT" class="form-control">IT</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input type="hidden" name="kategori_pekerjaan3" value="0">
                                        <input id="Wirausaha" class="form-check-input mt-0" type="checkbox" name="kategori_pekerjaan3" value="1">
                                    </div>
                                    <label for="Wirausaha" class="form-control">Wirausaha</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_pekerjaan" class="form-label">Bekerja Sebagai</label>
                                <input type="text" class="form-control @error('nama_pekerjaan') is-invalid @enderror" id="nama_pekerjaan" aria-describedby="nameHelp" name="nama_pekerjaan" placeholder="Contoh : Guru / Programmer / FrontEnd Developer">
                                @error('nama_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempat_pekerjaan" class="form-label">Nama Perusahaan Bekerja</label>
                                <input type="text" class="form-control @error('tempat_pekerjaan') is-invalid @enderror" id="tempat_pekerjaan" aria-describedby="nameHelp" name="tempat_pekerjaan">
                                @error('tempat_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h6 class="heading-small text-muted mb-4">Informasi Alamat Pekerjaan</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                                    <option selected>--Pilih Provinsi--</option>
                                    @foreach ($provinces as $provinsi )
                                    <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                    @endforeach
                                </select>
                                @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kabupaten">Kabupaten</label>
                                <select class="form-select @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten"></select>
                                @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kecamatan">Kecamatan</label>
                                <select class="form-select @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan"></select>
                                @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kelurahan">Kelurahan</label>
                                <select class="form-select @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan"></select>
                                @error('kelurahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="koordinat">Koordinat Tempat Kerja</label>
                        <input type="text" id="koordinat" class="form-control @error('koordinat') is-invalid @enderror" name="koordinat" placeholder="latitude, longitude" value="-3.298618801108944, 114.58542404981114">
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
                                <label for="tanggal_pekerjaan" class="form-label">Tanggal Mendapatkan Pekerjaan</label>
                                <input type="date" id="tanggal_pekerjaan" class="form-control @error('tanggal_pekerjaan') is-invalid @enderror" name="tanggal_pekerjaan">
                                @error('tanggal_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="relevansi_pekerjaan" class="form-label">Relevansi Pekerjaan (Menurut Anda)</label>
                                <select id="relevansi_pekerjaan" class="form-select" name="relevansi_pekerjaan">
                                    <option selected>--Pilih Relevansi--</option>
                                    <option value="tinggi">Tinggi</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="rendah">Rendah</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="gaji" class="form-label">Besaran Kisaran Gaji</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('gaji') is-invalid @enderror" id="gaji" name="gaji" placeholder="5000000">
                            @error('gaji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="text" class="form-control mt-2" id="nominal" value="" disabled>
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
    let nominal = document.getElementById("nominal"),
        gaji = document.getElementById("gaji"),
        check1 = document.getElementById("Kependidikan"),
        check2 = document.getElementById("Kependidikan"),
        check3 = document.getElementById("Kependidikan");



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