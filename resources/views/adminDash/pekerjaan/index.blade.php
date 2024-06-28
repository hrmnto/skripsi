@extends("adminDash.layouts.main")

@section("container")
<style>
    .container.mx-4.my-4{
        background-color: #ffffff;
    }
</style>

<?php
use Carbon\Carbon;
?>
@if (session()->has('success'))
            <div class="mx-4 my-4 alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
@endif


<!-- Tabel -->

<h1 class="h2 text-primary">Tabel Pekerjaan</h1>
<div class=" mx-1 my-4 p-3 shadow rounded">
<div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<div class="">


        <button class="text-primary btn btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cloud-plus" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
        </svg>  Import data
        </button>

        
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Import From File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form action="{{ route('pekerjaan-import') }}" method="post" enctype="multipart/form-data">

                  @csrf
                  <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                      <div class="custom-file text-left">
                          <input type="file" name="file" class="custom-file-input" id="customFile">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Import</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <a href="{{ route('pekerjaan-export') }}" class="text-primary btn btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
  <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
  <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
</svg> Eksport Excel</a>
    </div>

</div>


<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No. </th>
      <th scope="col">Nama</th>
      <th scope="col">Kategori Pekerjaan</th>
      <th scope="col">Bekerja Sebagai</th>
      <th scope="col">Tahun Kelulusan</th>
      <th scope="col">Mulai bekerja</th>
      <th scope="col">Gaji</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody class="shadow rounded">
  @foreach ($pekerjaans as $pekerjaan)

    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $pekerjaan->biodata->name }}</td>
        <td>{{$pekerjaan->kategori_pekerjaan1 == 1 ? 'Kependidikan': ''}}, {{$pekerjaan->kategori_pekerjaan2 == 1 ? 'IT': ''}}, {{$pekerjaan->kategori_pekerjaan3 == 1 ? 'Wirausaha': ''}}</td>
        <td>{{ $pekerjaan->nama_pekerjaan }}</td>
        <td>{{date('d F Y', strtotime($pekerjaan->biodata->tglLulus))}}</td>
        @php
        $tgl2 = new DateTime($pekerjaan->tanggal_pekerjaan);
        $tgl1 = new DateTime($pekerjaan->biodata->tglLulus);
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
        <td>{{$str}} ~ {{date('d F Y', strtotime($pekerjaan->tanggal_pekerjaan))}}</td>


        <td>{{number_format($pekerjaan->gaji,2,",",".") }}</td>
      <td>
        <form action="/admin/pekerjaan/{{$pekerjaan->id}}" method="post">
          @method('delete')
          @csrf
          @if ($pekerjaan->biodata->name != "admin")
          <button class="btn btn-sm text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg></button>
        </form>
          @endif
    </tr>
  @endforeach

  </tbody>
</table>
</div>


@endsection