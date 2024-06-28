<?php
use Carbon\Carbon;
?>
@extends("layouts.main")
<style>
    span{
        color: #eca457;
    }
    nav{
        transition: 0.2s;
    }

    .container-home{
      background-image: url('/img/SAM_2141.JPG');
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
    }

    .welcome{
      /* background-color: rgba(0, 0, 0, 0.329); */
      padding: 20px;
    }

    body{
      background-image: url('/img/playstation-pattern.webp');
    }
</style>
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

  .b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
  }

  .b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
  }

  .bi {
    vertical-align: -.125em;
    fill: currentColor;
  }

  .nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
  }

  .nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }

  .btn-bd-primary {
    --bd-violet-bg: #712cf9;
    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

    --bs-btn-font-weight: 600;
    --bs-btn-color: var(--bs-white);
    --bs-btn-bg: var(--bd-violet-bg);
    --bs-btn-border-color: var(--bd-violet-bg);
    --bs-btn-hover-color: var(--bs-white);
    --bs-btn-hover-bg: #6528e0;
    --bs-btn-hover-border-color: #6528e0;
    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
    --bs-btn-active-color: var(--bs-btn-hover-color);
    --bs-btn-active-bg: #5a23c8;
    --bs-btn-active-border-color: #5a23c8;
  }
  .bd-mode-toggle {
    z-index: 1500;
  }
</style>
@section("container")
  <div class="container">
        <div class="row flex-rows justify-content-center align-items-center" style="height: 90vh" id="about">
            <div class="col-sm-5 animate__animated animate__headShake">
                <h2 class="fw-bold">Cari Alumni</h2>

                <div>
                  <form action="" method="get">

                      <div class="input-group">
                        <input name="keyword" type="text" class="form-control" placeholder="Masukkan nama / nim" aria-label="Masukkan nama / nim" aria-describedby="basic-addon2">
                        <button class="input-group-text btn btn-outline-success" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg> </button>
                      </div> 
                    </form>
                  </div>
                
              </div>
            <div class="col-sm-5 ">
              @if ($keyword == "")
              <img class="img-fluid" src="/img/tracer.png" alt="">
              @else
                @if (count($biodatas) == 0)
                  <h4 class="text-center">Nama atau NIM tidak ditemukan</h4>
                @else
                <ul class="list-group">
                  @foreach ($biodatas as $biodata)
                    
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$biodata->name}}
                    <button class=" btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detal{{$biodata->nim}}"> Lihat</button>
                  </li>

                    {{-- modal --}}
                  <div class="modal fade" id="detal{{$biodata->nim}}" tabindex="-1" aria-labelledby="detal{{$biodata->nim}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered ">
                      <div class="modal-content ">
                        <div class="modal-header ">
                          <h1 class="modal-title fs-5" id="detal{{$biodata->nim}}Label">{{$biodata->nim}}</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                          <ul class="nav nav-tabs " id="myTab" role="tablist">
                            <li class="nav-item " role="presentation">
                              <button class="nav-link active" id="foto-tab" data-bs-toggle="tab" data-bs-target="#foto-{{$biodata->nim}}-tab-pane" type="button" role="tab" aria-controls="foto-{{$biodata->nim}}-tab-pane" aria-selected="true">Foto</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#biodata-{{$biodata->nim}}-tab-pane" type="button" role="tab" aria-controls="biodata-{{$biodata->nim}}-tab-pane" aria-selected="false">Biodata</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pekerjaan-tab" data-bs-toggle="tab" data-bs-target="#pekerjaan-{{$biodata->nim}}-tab-pane" type="button" role="tab" aria-controls="pekerjaan-{{$biodata->nim}}-tab-pane" aria-selected="false">Pekerjaan</button>
                            </li>

                          </ul>                        
                          
                          <div class="tab-content " id="myTabContent">
                            <div class="tab-pane fade show active" id="foto-{{$biodata->nim}}-tab-pane" role="tabpanel" aria-labelledby="foto-{{$biodata->nim}}-tab" tabindex="0">
                              @if($biodata->foto)
                              <img src="{{asset('storage/' . $biodata->foto) }}" class="img-thumbnail" alt="...">
                              @else
                              <img src="/img/noImage.png" class="img-thumbnail" alt="...">
                              @endif
                            </div>
                            
                            <div class="tab-pane fade" id="biodata-{{$biodata->nim}}-tab-pane" role="tabpanel" aria-labelledby="biodata-{{$biodata->nim}}-tab" tabindex="0">
                              
                              <div class=" bg-light p-4 rounded">
                              <label class="text-secondary" for="">Nama</label>
                              <h6 class="fw-bold">{{$biodata->name}}</h6>
                      
                              <label class="text-secondary" for="">NIM</label>
                              <h6 class="fw-bold">{{$biodata->nim}}</h6>
                      
                              <label class="text-secondary" for="">Kontak</label>
                              <h6 class="fw-bold">{{$biodata->kontak}}</h6>
                      
                              <label class="text-secondary" for="">Tempat Tanggal Lahir</label>
                              <h6 class="fw-bold">{{$biodata->tempatLahir}}, {{date('d F Y', strtotime($biodata->tglLahir))}}</h6>

                              <label class="text-secondary" for="">Alamat</label>
                              <h6 class="fw-bold">Kelurahan {{ucfirst(strtolower($biodata->kelurahan))}} Kecamatan {{ucfirst(strtolower($biodata->kecamatan))}} {{ucfirst(strtolower($biodata->kabupaten))}} Provinsi {{ucfirst(strtolower($biodata->provinsi))}}</h6>
                      
                              <label class="text-secondary" for="">Jenis Kelamin</label>
                              <h6 class="fw-bold">{{$biodata->jk}}</h6>
                      
                              <label class="text-secondary" for="">Agama</label>
                              <h6 class="fw-bold">{{$biodata->agama}}</h6>
                      
                              <label class="text-secondary" for="">Status Pernikahan</label>
                              <h6 class="fw-bold">{{$biodata->kawin}} kawin</h6>
                              
                              <label class="text-secondary" for="">Tanggal Masuk</label>
                              <h6 class="fw-bold">{{date('d F Y', strtotime($biodata->tglMasuk))}}</h6>

                              <label class="text-secondary" for="">Tanggal Kelulusan</label>
                              <h6 class="fw-bold">{{date('d F Y', strtotime($biodata->tglLulus))}}</h6>
                              
                              
                              <label class="text-secondary" for="">Lama Masa Studi</label>
                              @php
                                  $tgl1 = new DateTime($biodata->tglMasuk);
                                  $tgl2 = new DateTime($biodata->tglLulus);
                                  $jarak = $tgl2->diff($tgl1);

                                  $str = '';

                                  if($jarak->y != 0){
                                      $str .= $jarak->y . ' Tahun ';
                                  }

                                  if($jarak->m != 0){
                                      $str .= $jarak->m . ' Bulan ';
                                  }

                                  if($jarak->d != 0){
                                      $str .= $jarak->d . ' Hari ';
                                  }

                              @endphp
                              <h6 class="fw-bold">{{$str}}</h6>
                      
                              <label class="text-secondary" for="">IPK</label>
                              <h6 class="fw-bold">{{$biodata->ipk}}</h6>

                              <label class="text-secondary" for="">Status Pekerjaan</label>
                              <h6 class="fw-bold">{{$biodata->pekerjaan}} bekerja</h6>
                              </div>
                            </div>
                              
 
                            <div class="tab-pane fade" id="pekerjaan-{{$biodata->nim}}-tab-pane" role="tabpanel" aria-labelledby="pekerjaan-{{$biodata->nim}}-tab" tabindex="0">
                              @if (count($biodata->works) != 0)
                                  <div class="bg-light p-4 rounded">
                                    <label class="text-secondary" for="">Nama</label>
                                    <h6 class="fw-bold">{{$biodata->name}}</h6>
                            
                                    <label class="text-secondary" for="">Kategori Pekerjaan</label>
                                    <h6 class="fw-bold">{{$biodata->works[count($biodata->works)-1]->kategori_pekerjaan1 == 1 ? 'Kependidikan': ''}}, {{$biodata->works[count($biodata->works)-1]->kategori_pekerjaan2 == 1 ? 'IT': ''}}, {{$biodata->works[count($biodata->works)-1]->kategori_pekerjaan3 == 1 ? 'Wirausaha': ''}}</h6>
                            
                                    <label class="text-secondary" for="">Bekerja Sebagai</label>
                                    <h6 class="fw-bold">{{$biodata->works[count($biodata->works)-1]->nama_pekerjaan}}</h6>
                            
                                    <label class="text-secondary" for="">Alamat Pekerjaan</label>
                                    <h6 class="fw-bold">{{$biodata->works[count($biodata->works)-1]->tempat_pekerjaan}}</h6>
                            
                                    <label class="text-secondary" for="">Tanggal Kelulusan</label>
                                    
                                    <h6 class="fw-bold">{{date('d F Y', strtotime($biodata->tglLulus))}}</h6>

                                    <label class="text-secondary" for="">Mulai Bekerja</label>
                                    @php
                                    $tgl2 = new DateTime($biodata->works[count($biodata->works)-1]->tanggal_pekerjaan);
                                    $tgl1 = new DateTime($biodata->tglLulus);
                                    $jarak = $tgl2->diff($tgl1);
                        
                                    $str = '';
                        
                                    if($jarak->y != 0){
                                        $str .= $jarak->y . ' Tahun ';
                                    }
                        
                                    if($jarak->m != 0){
                                        $str .= $jarak->m . ' Bulan ';
                                    }
                        
                                    if($jarak->d != 0){
                                        $str .= $jarak->d . ' Hari ';
                                    }

                                    if($tgl1 > $tgl2){
                                        $str .= "Sebelum Kelulusan";
                                    }else{
                                        $str .= "Setelah Kelulusan";
                                    }
                        
                                @endphp
                                    <h6 class="fw-bold">{{$str}} ~ {{date('d F Y', strtotime($biodata->works[count($biodata->works)-1]->tanggal_pekerjaan))}}</h6>

                                    <label class="text-secondary" for="">Kisaran Gaji</label>
                                    <h6 class="fw-bold">Rp. {{number_format($biodata->works[count($biodata->works)-1]->gaji,2,",",".")}}</h6>
                
                                    <label class="text-secondary" for="">Relevansi</label>
                                    <h6 class="fw-bold">{{$biodata->works[count($biodata->works)-1]->relevansi_pekerjaan}}</h6>
                            
                            
                                    
                                </div>
                              @endif
                            </div>
                        
                          
                          </div>                      
           
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  @endforeach
                </ul>
                @endif
              @endif
          </div>
        </div>
      </div>
      <div class="b-example-divider"></div>

      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="bootstrap" viewBox="0 0 118 94">
          <title>Bootstrap</title>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
        <symbol id="facebook" viewBox="0 0 16 16">
          <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </symbol>
        <symbol id="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </symbol>
        <symbol id="twitter" viewBox="0 0 16 16">
          <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
        </symbol>
      </svg>
    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">

          <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Computer Education</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
        </ul>
      </footer>


@endsection