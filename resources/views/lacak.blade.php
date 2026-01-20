@extends('layouts.main')

@section('container')
    <div class="container-fluid pb-4 pt-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary"><i class="bi bi-geo-alt-fill me-2"></i>Persebaran Alumni</h4>
                    </div>
                    <div class="card-body p-0">
                        <div id="map" style="height: 85vh; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Alumni -->
    <div class="modal fade" id="alumniDetail" tabindex="-1" aria-labelledby="alumniDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="alumniDetailLabel">Detail Alumni</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4 class="fw-bold mb-1" id="nama"></h4>
                            <p class="text-muted mb-2"><i class="bi bi-card-heading me-2"></i><span id="nim"></span>
                            </p>
                            <span class="badge bg-info text-dark" id="jk"></span>
                        </div>
                    </div>

                    <h5 class="fw-bold border-bottom pb-2 mb-3">Riwayat Pekerjaan</h5>
                    <div id="riwayat-pekerjaan" class="list-group list-group-flush">
                        <!-- Content injected via JS -->
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .label-kecamatan {
            color: #333;
            text-align: center;
            font-weight: bold;
            text-shadow: 1px 1px 0 #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
        }

        .legend {
            padding: 10px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            line-height: 24px;
            color: #555;
        }

        .legend h5 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 0;
        }

        .legend div {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend span {
            margin-left: 8px;
            font-size: 14px;
        }
    </style>

    <script>
        // basemap
        var map = L.map('map').setView([-3.298618801108944, 114.58542404981114], 13.46);

        var ulmIcon = L.icon({
            iconUrl: "/img/Logo_ULM.png",
            iconSize: [50, 50],
        });

        var manIcon = L.icon({
            iconUrl: "/img/icon_man.png",
            iconSize: [50, 50],
        });

        var ceweIcon = L.icon({
            iconUrl: "/img/icon_cewe.png",
            iconSize: [70, 70],
        });

        var cowoIcon = L.icon({
            iconUrl: "/img/icon_cowo.png",
            iconSize: [70, 70],
        });

        var baseLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
        })
        baseLayer.addTo(map);

        var marker = L.marker([-3.298618801108944, 114.58542404981114], {
            icon: ulmIcon
        }).addTo(map);
        marker.bindPopup('FKIP ULM').openPopup();


        @foreach ($biodatas as $biodata)
            @php
                // Skip if koordinat is null or empty
                if (!$biodata['koordinat'] || trim($biodata['koordinat']) == '') {
                    continue;
                }

                $koordinats = explode(',', $biodata['koordinat']);

                // Skip if coordinates are invalid
                if (count($koordinats) < 2 || !is_numeric($koordinats[0]) || !is_numeric($koordinats[1])) {
                    continue;
                }

                $riwayatPekerjaan = $biodata->works->map(function ($work) {
                    return [
                        'nama_pekerjaan' => $work->nama_pekerjaan,
                        'tempat_pekerjaan' => $work->tempat_pekerjaan,
                        'tanggal_pekerjaan' => $work->tanggal_pekerjaan,
                        'gaji' => $work->gaji,
                        'relevansi_pekerjaan' => $work->relevansi_pekerjaan,
                        'latitude' => isset($work->koordinat) && strpos($work->koordinat, ',') !== false ? explode(',', $work->koordinat)[0] : 0,
                        'longitude' => isset($work->koordinat) && strpos($work->koordinat, ',') !== false ? explode(',', $work->koordinat)[1] : 0,
                    ];
                });
                $riwayatPekerjaanJSON = json_encode($riwayatPekerjaan);
            @endphp



            var latitude = {{ $koordinats[0] }},
                longitude = {{ $koordinats[1] }}
            @if ($biodata['jk'] == 'laki-laki')
                icon = cowoIcon
            @else
                icon = ceweIcon
            @endif
            L.marker([latitude, longitude], {
                    icon: icon
                })
                .addTo(map)
                .bindPopup(
                    `Biodata Alumni <br><br>
                Nama : {{ e($biodata->name) }} <br>
                NIM  : {{ e($biodata->nim) }} <br><br>
            <img src="{{ asset('storage/' . $biodata->foto) }}" class="img-thumbnail" alt="{{ $biodata['name'] }}"><br><br>
            <button class="btn btn-sm btn-outline-success" onclick = 'return showRute(${latitude}, ${longitude})'> Rute kesini </button>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="showDetailAlumni('{{ $biodata['name'] }}', '{{ $biodata['nim'] }}', '{{ $biodata['jk'] }}', {{ $riwayatPekerjaanJSON }})">Detail Alumni</button>
            `);
        @endforeach

        var control = L.Routing.control({
            waypoints: [
                L.latLng(-3.298618801108944, 114.58542404981114)
            ],
            routeWhileDragging: false,
            lineOptions: {
                styles: [{
                    color: 'red',
                    weight: 3
                }],
            },
            createMarker: function() {
                return null;
            }
        })
        control.addTo(map);

        function showRute(lat, lng) {
            // Validate coordinates
            if (!lat || !lng || lat == 0 || lng == 0) {
                alert('Koordinat tidak valid. Tidak dapat menampilkan rute.');
                return false;
            }

            // Check if coordinates are within reasonable bounds for Indonesia
            if (lat < -11 || lat > 6 || lng < 95 || lng > 141) {
                alert('Koordinat berada di luar Indonesia. Tidak dapat menampilkan rute.');
                return false;
            }

            var latLng = L.latLng(lat, lng);
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng);
            return true;
        }

        //   GeoJSON
        let batasKecamatan = [];
        let sub = [];
        let colors = ["#32b8a6", "#f5cb11", "#eb7200", "#c461eb", "#6c7000", "#bf2e2e", "#46e39c", "#9fd40c", "#ad00f2",
            "#fffb00", "#7ff2fa", "#e8a784"
        ];

        var kabupaten = []
        var listKabupaten = []
        var html = ``;

        getShape("kabBanjarmasin", "Banjarmasin");
        getShape("kabTapin", "Tapin");
        getShape("kabBanjarbaru", "Banjarbaru");
        getShape("kabBanjar", "Banjar");
        getShape("kabBaritoKuala", "BaritoKuala");
        getShape("kabHuluSungaiSelatan", "HuluSungaiSelatan");
        getShape("kabHuluSungaiTengah", "HuluSungaiTengah");
        getShape("kabHuluSungaiUtara", "HuluSungaiUtara");
        getShape("kabBalangan", "Balangan");
        getShape("kabTabalong", "Tabalong");
        getShape("kabTanahLaut", "TanahLaut");
        getShape("kabTanahBumbu", "TanahBumbu");
        getShape("kabKotabaru", "Kotabaru");

        function getShape(namaFile, kab) {

            $.getJSON('/geoJSON/' + namaFile + '.geojson', (json) => {
                html = html + `
                        <label for="${kab}" style="cursor:pointer;" class="fs-6"><b> Kabupaten ${kab} <span id="label${kab}" class="fa fa-chevron-left"></span></b></label>
                        <input id="${kab}" style="transform:scale(0)"  type="checkbox"  onclick="showKecamatan(this, ${batasKecamatan.length})">
                        <br>
                `;
                let i = 0;
                let j = 1;
                geoLayer = L.geoJSON(json, {

                    style: (feature) => {
                        return {
                            fillOpacity: 0.8,
                            weight: 3,
                            opacity: 1,
                            color: 'purple',
                            fillColor: colors[i]
                        };
                    },
                    onEachFeature: (feature, layer) => {
                        var iconLabel = L.divIcon({
                            className: 'label-kecamatan',
                            html: `${feature.properties.WADMKC}`

                        });

                        // if(feature.properties.WADMKC){

                        html = html + `
                        <div class="${kab}" style="display:none">
                        <input id="${sub.length}" type="checkbox" class="kec" onclick="showBatas(this, ${sub.length})">  <label class="text-capitalize" for="${sub.length}">${feature.properties.WADMKC}</label> <br>
                    </div>
                    `;


                        sub.push(L.markerClusterGroup().addLayer(layer));
                        L.marker(layer.getBounds().getCenter(), {
                            icon: iconLabel
                        }).addTo(sub[batasKecamatan.length]);

                        // batasKecamatan.addLayer(sub[i]);
                        //  sub[i].addTo(batasKecamatan);
                        // batasKecamatan.addLayer(layer);
                        batasKecamatan.push(L.markerClusterGroup().addLayer(sub[batasKecamatan
                            .length]));
                        i++;
                        // }

                    }
                })
                // console.log(batasKecamatan.length)
                for (let i = 0; i < batasKecamatan.length; i++) {
                    kabupaten.push(L.markerClusterGroup().addLayer(batasKecamatan[i]))
                }
                control2.setContents(html);
            })
        }
        var control2 = L.control.slideMenu("", {
            position: "topleft",
            menuposition: "topleft",

        }).addTo(map);

        var legend = L.control({
            position: "bottomright"
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create("div", "legend");

            div.innerHTML += "<h5>Keterangan : </h5>";
            div.innerHTML += '<div><img src="/img/Logo_ULM.png" width="35"><span> : FKIP ULM</span></div>';
            div.innerHTML += '<div><img src="/img/icon_cowo.png" width="35"><span> : Alumni (Laki-laki)</span></div>';
            div.innerHTML += '<div><img src="/img/icon_cewe.png" width="35"><span> : Alumni (Perempuan)</span></div>';
            div.innerHTML += '<div><i style="height:5px ;background:purple;"></i><span> : Batas Kecamatan</span></div>';
            div.innerHTML += '<div><i style="height:5px ;background:red;"></i><span> : Rute </span></div>';



            return div;
        };

        legend.addTo(map);

        // L.control.slideMenu(html).addTo(map);

        function showBatas(v, i) {
            if (v.checked === true) {
                // map.removeLayer(batasKecamatan);
                map.addLayer(sub[i]);
                map.flyTo(sub[i].getBounds().getCenter());

            } else {
                map.removeLayer(sub[i]);

            }
        }

        function showKecamatan(v, i) {
            let inp = v.parentElement.querySelectorAll("." + v.id),
                span = v.parentElement.querySelector("#label" + v.id);
            console.log(span)


            if (v.checked === true) {
                // map.addLayer(batasKecamatan);
                // var class = $(".Balangan");    
                for (let i = 0; i < inp.length; i++) {
                    inp[i].style.display = "";
                }

                span.className = "fa fa-chevron-down"


                // map.flyTo(batasKecamatan[i].getBounds().getCenter());


            } else {
                for (let i = 0; i < inp.length; i++) {
                    inp[i].style.display = "none";
                }
                // map.flyTo(batasKecamatan[i].getBounds().getCenter());
            }
        }


        //menampilkan detail alumni

        function showDetailAlumni(nama, nim, jk, riwayatPekerjaan) {
            document.getElementById('nama').innerText = nama;
            document.getElementById('nim').innerText = nim;
            document.getElementById('jk').innerText = jk;

            var riwayatPekerjaanList = document.getElementById('riwayat-pekerjaan');
            riwayatPekerjaanList.innerHTML = '';

            if (Array.isArray(riwayatPekerjaan) && riwayatPekerjaan.length > 0) {
                riwayatPekerjaan.forEach(function(pekerjaan) {
                    var item = document.createElement('div');
                    item.className = 'list-group-item border-0 px-0 py-3';

                    // Check if coordinates are valid
                    var hasValidCoords = pekerjaan.latitude && pekerjaan.longitude &&
                        pekerjaan.latitude != 0 && pekerjaan.longitude != 0 &&
                        pekerjaan.latitude >= -11 && pekerjaan.latitude <= 6 &&
                        pekerjaan.longitude >= 95 && pekerjaan.longitude <= 141;

                    var ruteButton = hasValidCoords ?
                        `<button class="btn btn-sm btn-outline-primary rounded-pill mt-2 mt-md-0" onclick="showRute(${pekerjaan.latitude}, ${pekerjaan.longitude}); closeModal()"><i class="bi bi-cursor-fill me-1"></i> Rute</button>` :
                        `<small class="text-muted">Koordinat tidak tersedia</small>`;

                    item.innerHTML = `
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="fw-bold mb-1">${pekerjaan.nama_pekerjaan}</h6>
                        <p class="mb-1 text-muted small"><i class="bi bi-building me-1"></i> ${pekerjaan.tempat_pekerjaan}</p>
                        <p class="mb-1 text-muted small"><i class="bi bi-calendar-event me-1"></i> ${pekerjaan.tanggal_pekerjaan}</p>
                    </div>
                    <span class="badge bg-light text-dark border">${pekerjaan.relevansi_pekerjaan}</span>
                </div>
                <div class="mt-2">
                     <span class="badge bg-success bg-opacity-10 text-success me-2">Gaji: ${pekerjaan.gaji}</span>
                     ${ruteButton}
                </div>
            `;
                    riwayatPekerjaanList.appendChild(item);
                });
            } else {
                var item = document.createElement('div');
                item.className = 'text-center py-4 text-muted';
                item.innerHTML =
                    '<i class="bi bi-briefcase-fill fs-1 d-block mb-2 opacity-25"></i> Belum ada data riwayat pekerjaan';
                riwayatPekerjaanList.appendChild(item);
            }

            var modal = new bootstrap.Modal(document.getElementById('alumniDetail'), {});
            modal.show();
        }

        function closeModal() {
            var modal = bootstrap.Modal.getInstance(document.getElementById('alumniDetail'));
            modal.hide();
        }
    </script>
@endsection
