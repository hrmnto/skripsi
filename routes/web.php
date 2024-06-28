<?php

use App\Models\Biodata;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LacakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\AlumniPostController;
use App\Http\Controllers\IndoRegionController;
use App\Http\Controllers\LaporanControllerPDF;
use App\Http\Controllers\AdminBiodataController;
use App\Http\Controllers\AlumniBiodataController;
use App\Http\Controllers\AdminPekerjaanController;
use App\Http\Controllers\DependantDropdownController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     $biodatas = Biodata::all();
//     $pekerjaans = Pekerjaan::all();
//     if(count($biodatas) >= 1 and count($pekerjaans) >= 1 ){
//         $total = 0;
//         $dataKuliah = [];
//         $dataNama = [];
//         $kelulusan_2020 = [];
//         $kelulusan_2021 = [];
//         $kelulusan_2022 = [];
//         $kelulusan_2023 = [];
//         $kelulusan_2024 = [];
//         $kelulusan_2025 = [];
//         $kelulusanLebih6Thn = [];
//         $kelulusanLebih5Thn = [];
//         $kelulusanKurang4Thn = [];
//         $alumniAngkatan2016 = [0,0,0,0,0,0,0,0];
//         $alumniAngkatan2017 = [0,0,0,0,0,0,0,0];
//         $alumniAngkatan2018 = [0,0,0,0,0,0,0,0];
//         $alumniAngkatan2019 = [0,0,0,0,0,0,0,0];
//         $alumniAngkatan2020 = [0,0,0,0,0,0,0,0];
//         $alumniAngkatan2021 = [0,0,0,0,0,0,0,0];
//         $alumniAngkatan2022 = [0,0,0,0,0,0,0,0];
//         $ipk = [0,0,0,0,0];
//         $totalIPK = 0;
    
//         foreach ($biodatas as $biodata) {
//             $tgl1 = new DateTime($biodata->tglMasuk);
//             $tgl2 = new DateTime($biodata->tglLulus);
//             $jarak = $tgl2->diff($tgl1);
//             $selisih = $jarak->y;
//             $dataKuliah[] = $selisih;
//             $dataNama[] = $biodata->name; 
//             $total += $selisih;
    
//             $totalIPK += $biodata->ipk;
//             if($biodata->ipk > 2.4 && $biodata->ipk <= 2.7){
//                 $ipk[0] += 1;
//             }else if($biodata->ipk > 2.7 && $biodata->ipk <= 3.0){
//                 $ipk[1] += 1;
//             }else if($biodata->ipk > 3.0 && $biodata->ipk <= 3.3){
//                 $ipk[2] += 1;
//             }else if($biodata->ipk > 3.3 && $biodata->ipk <= 3.6){
//                 $ipk[3] += 1;
//             }else if($biodata->ipk > 3.6 && $biodata->ipk <= 3.9){
//                 $ipk[4] += 1;
//             }
    
//             if($selisih > 6){
//                 $warnaBar[] = "#B70404";
//                 $kelulusanLebih6Thn[] = $selisih;
//             }else if($selisih > 4 && $selisih <= 6 ){
//                 $warnaBar[] = "#36A2EB";
//                 $kelulusanLebih5Thn[] = $selisih;
//             }else if($selisih < 5){
//                 $warnaBar[] = "#47A992";
//                 $kelulusanKurang4Thn[] = $selisih;
//             }
    
//             $tahunLulus = explode('-', $biodata->tglLulus);
//             $tahunLulus = $tahunLulus[0];
//             if($tahunLulus == 2020){
//                 $kelulusan_2020[] = $biodata->nim;
//             }else if($tahunLulus == 2021){
//                 $kelulusan_2021[] = $biodata->nim;
//             }else if($tahunLulus == 2022){
//                 $kelulusan_2022[] = $biodata->nim;
//             }else if($tahunLulus == 2023){
//                 $kelulusan_2023[] = $biodata->nim;
//             }else if($tahunLulus == 2024){
//                 $kelulusan_2024[] = $biodata->nim;
//             }else if($tahunLulus == 2025){
//                 $kelulusan_2025[] = $biodata->nim;
//             }
    
//             $tahunMasuk = explode('-', $biodata->tglMasuk);
//             $tahunMasuk = $tahunMasuk[0];
//             if($tahunMasuk == 2016){
//                 if($tahunLulus == 2020){
//                     $alumniAngkatan2016[0] += 1;
//                 }else if($tahunLulus == 2021){
//                     $alumniAngkatan2016[1] += 1;
//                 }else if($tahunLulus == 2022){
//                     $alumniAngkatan2016[2] += 1;
//                 }else if($tahunLulus == 2023){
//                     $alumniAngkatan2016[3] += 1;
//                 }else if($tahunLulus == 2024){
//                     $alumniAngkatan2016[4] += 1;
//                 }else if($tahunLulus == 2025){
//                     $alumniAngkatan2016[5] += 1;
//                 }            
//             }else if($tahunMasuk == 2017){
//                 if($tahunLulus == 2021){
//                     $alumniAngkatan2017[0] += 1;
//                 }else if($tahunLulus == 2021){
//                     $alumniAngkatan2017[1] += 1;
//                 }else if($tahunLulus == 2022){
//                     $alumniAngkatan2017[2] += 1;
//                 }else if($tahunLulus == 2023){
//                     $alumniAngkatan2017[3] += 1;
//                 }else if($tahunLulus == 2024){
//                     $alumniAngkatan2017[4] += 1;
//                 }else if($tahunLulus == 2025){
//                     $alumniAngkatan2017[5] += 1;
//                 }   
//             }else if($tahunMasuk == 2018){
//                 if($tahunLulus == 2021){
//                     $alumniAngkatan2018[0] += 1;
//                 }else if($tahunLulus == 2021){
//                     $alumniAngkatan2018[1] += 1;
//                 }else if($tahunLulus == 2022){
//                     $alumniAngkatan2018[2] += 1;
//                 }else if($tahunLulus == 2023){
//                     $alumniAngkatan2018[3] += 1;
//                 }else if($tahunLulus == 2024){
//                     $alumniAngkatan2018[4] += 1;
//                 }else if($tahunLulus == 2025){
//                     $alumniAngkatan2018[5] += 1;
//                 } 
//             }else if($tahunMasuk == 2019){
//                 if($tahunLulus == 2021){
//                     $alumniAngkatan2019[0] += 1;
//                 }else if($tahunLulus == 2021){
//                     $alumniAngkatan2019[1] += 1;
//                 }else if($tahunLulus == 2022){
//                     $alumniAngkatan2019[2] += 1;
//                 }else if($tahunLulus == 2023){
//                     $alumniAngkatan2019[3] += 1;
//                 }else if($tahunLulus == 2024){
//                     $alumniAngkatan2019[4] += 1;
//                 }else if($tahunLulus == 2025){
//                     $alumniAngkatan2019[5] += 1;
//                 } 
//             }else if($tahunMasuk == 2020){
//                 if($tahunLulus == 2021){
//                     $alumniAngkatan2020[0] += 1;
//                 }else if($tahunLulus == 2021){
//                     $alumniAngkatan2020[1] += 1;
//                 }else if($tahunLulus == 2022){
//                     $alumniAngkatan2020[2] += 1;
//                 }else if($tahunLulus == 2023){
//                     $alumniAngkatan2020[3] += 1;
//                 }else if($tahunLulus == 2024){
//                     $alumniAngkatan2020[4] += 1;
//                 }else if($tahunLulus == 2025){
//                     $alumniAngkatan2020[5] += 1;
//                 } 
//             }else if($tahunMasuk == 2021){
//                 if($tahunLulus == 2021){
//                     $alumniAngkatan2021[0] += 1;
//                 }else if($tahunLulus == 2021){
//                     $alumniAngkatan2021[1] += 1;
//                 }else if($tahunLulus == 2022){
//                     $alumniAngkatan2021[2] += 1;
//                 }else if($tahunLulus == 2023){
//                     $alumniAngkatan2021[3] += 1;
//                 }else if($tahunLulus == 2024){
//                     $alumniAngkatan2021[4] += 1;
//                 }else if($tahunLulus == 2025){
//                     $alumniAngkatan2021[5] += 1;
//                 } 
//             }else if($tahunMasuk == 2022){
//                 if($tahunLulus == 2021){
//                     $alumniAngkatan2022[0] += 1;
//                 }else if($tahunLulus == 2021){
//                     $alumniAngkatan2022[1] += 1;
//                 }else if($tahunLulus == 2022){
//                     $alumniAngkatan2022[2] += 1;
//                 }else if($tahunLulus == 2023){
//                     $alumniAngkatan2022[3] += 1;
//                 }else if($tahunLulus == 2024){
//                     $alumniAngkatan2022[4] += 1;
//                 }else if($tahunLulus == 2025){
//                     $alumniAngkatan2022[5] += 1;
//                 } 
//             }
//         }
       
    
//         $pRelevan = [0,0,0];
//         $kategoriPekerjaan1 = [];
//         $kategoriPekerjaan2 = [];
//         $kategoriPekerjaan3 = [];
//         $kategoriPekerjaan4 = [];
    
//         $gajiAlumni = [0,0,0,0,0,0,0,0,0];
    
//         $totalGaji = 0;
//         $rentangKerja = [0,0,0,0,0,0,0];
//         $totalTahunKerja = 0;
//         $nim = [];
//         for($i = count($pekerjaans)-1; $i > -1; $i--){
//             if(!(in_array($pekerjaans[$i]->nim, $nim))){
//                 $nim[] = $pekerjaans[$i]->nim;
                
//                 if($pekerjaans[$i]->relevansi_pekerjaan == "tinggi"){
//                     $pRelevan[0] += 1;
//                 }else if($pekerjaans[$i]->relevansi_pekerjaan == "sedang"){
//                     $pRelevan[1] += 1;
//                 }else if($pekerjaans[$i]->relevansi_pekerjaan == "rendah"){
//                     $pRelevan[2] += 1;
//                 }
    
    
//                 if($pekerjaans[$i]->kategori_pekerjaan1 == 1){
//                     $kategoriPekerjaan1[] = $pekerjaans[$i]->biodata->nim;
//                 }
//                 if($pekerjaans[$i]->kategori_pekerjaan2 == 1){
//                     $kategoriPekerjaan2[] = $pekerjaans[$i]->biodata->nim;
//                 }
//                 if($pekerjaans[$i]->kategori_pekerjaan3 == 1){
//                     $kategoriPekerjaan3[] = $pekerjaans[$i]->biodata->nim;
//                 }
    
                
//                 $tglKerja1 = new DateTime($pekerjaans[$i]->biodata->tglLulus);
//                 $tglKerja2 = new DateTime($pekerjaans[$i]->tanggal_pekerjaan);
//                 $jarakKerja = $tglKerja2->diff($tglKerja1);
    
//                 if($jarakKerja->y >= 6){
//                     $rentangKerja[6] += 1;
//                     $totalTahunKerja += $jarakKerja->y;
//                 }else if($jarakKerja->y >= 5 && $jarakKerja->y < 6){
//                     $rentangKerja[5] += 1;
//                     $totalTahunKerja += $jarakKerja->y;
//                 }else if($jarakKerja->y >= 4 && $jarakKerja->y < 5){
//                     $rentangKerja[4] += 1;
//                     $totalTahunKerja += $jarakKerja->y;
//                 }else if($jarakKerja->y >= 3 && $jarakKerja->y < 4){
//                     $rentangKerja[3] += 1;
//                     $totalTahunKerja += $jarakKerja->y;
//                 }else if($jarakKerja->y >= 2 && $jarakKerja->y < 3){
//                     $rentangKerja[2] += 1;
//                     $totalTahunKerja += $jarakKerja->y;
//                 }else if($jarakKerja->y >= 1 && $jarakKerja->y < 2){
//                     $rentangKerja[1] += 1;
//                     $totalTahunKerja += $jarakKerja->y;
//                 }else if($jarakKerja->y < 1){
//                     $rentangKerja[0] += 1;
//                     $totalTahunKerja += $jarakKerja->y;
//                 }
    
//                 if($pekerjaans[$i]->gaji >= 1000000 && $pekerjaans[$i]->gaji <= 3000000){
//                     $gajiAlumni[0] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji > 3000000 && $pekerjaans[$i]->gaji <= 8000000){
//                     $gajiAlumni[1] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji > 8000000 && $pekerjaans[$i]->gaji <= 13000000){
//                     $gajiAlumni[2] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji > 13000000 && $pekerjaans[$i]->gaji <= 18000000){
//                     $gajiAlumni[3] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji > 18000000 && $pekerjaans[$i]->gaji <= 25000000){
//                     $gajiAlumni[4] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji > 25000000 && $pekerjaans[$i]->gaji <= 50000000){
//                     $gajiAlumni[5] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji > 50000000 && $pekerjaans[$i]->gaji <= 100000000){
//                     $gajiAlumni[6] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji > 100000000 && $pekerjaans[$i]->gaji <= 250000000){
//                     $gajiAlumni[7] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }else if($pekerjaans[$i]->gaji >= 250000000){
//                     $gajiAlumni[8] += 1;
//                     $totalGaji += $pekerjaans[$i]->gaji;
//                 }
//             }
//         }
//         $avg = $total / count($biodatas);
    
    
//         $avgGaji = $totalGaji / count($nim);


    
//     return view('home', [
//         "title" => "home",
//         "biodatas" => $biodatas,
//         "pekerjaans" => $pRelevan,
//         "dataLamaKuliah" => json_encode($dataKuliah),
//         "rata2_kuliah" => $avg,
//         "kelulusan_2020" => $kelulusan_2020,
//         "kelulusan_2021" => $kelulusan_2021,
//         "kelulusan_2022" => $kelulusan_2022,
//         "kelulusan_2023" => $kelulusan_2023,
//         "kelulusan_2024" => $kelulusan_2024,
//         "kelulusan_2025" => $kelulusan_2025,
//         "belumBekerja" => Biodata::where("pekerjaan", "belum")->get(),
//         "sudahBekerja" => Biodata::where("pekerjaan", "sudah")->get(),
//         "dataNama" => json_encode($dataNama),
//         "K6tahun" => $kelulusanLebih6Thn,
//         "K5tahun" => $kelulusanLebih5Thn,
//         "K3tahun" => $kelulusanKurang4Thn,
//         "pRelevan" => $pRelevan,
//         "kategoriPekerjaan1" => $kategoriPekerjaan1,
//         "kategoriPekerjaan2" => $kategoriPekerjaan2,
//         "kategoriPekerjaan3" => $kategoriPekerjaan3,
//         "kategoriPekerjaan4" => $kategoriPekerjaan4,
//         "gajiAlumni" => $gajiAlumni,
//         "avgGaji" => $avgGaji,
//         "alumni2016" => $alumniAngkatan2016,
//         "alumni2017" => $alumniAngkatan2017,
//         "alumni2018" => $alumniAngkatan2018,
//         "alumni2019" => $alumniAngkatan2019,
//         "alumni2020" => $alumniAngkatan2020,
//         "alumni2021" => $alumniAngkatan2021,
//         "alumni2022" => $alumniAngkatan2022,
//         "rentangKerja" => $rentangKerja,
//         "ipk" => $ipk,
//         "avgIPK" => $totalIPK/count($biodatas),
//         "avgRKerja" => $totalTahunKerja/count(Biodata::where("pekerjaan", "sudah")->get()),
        
//     ]);
// }else{
//     return view('home', [
//         "title" => "home",
//         "biodatas" => Biodata::all(),
//         "pekerjaans" => Pekerjaan::all(),
    
//     ]);
// }
// });

Route::get('/', [LaporanControllerPDF::class, "home"]);
Route::get('/search', [PencarianController::class, "index"]);

Route::get('/login', [LoginController::class, "index"])->name('login')->middleware("guest");
Route::post('/login', [LoginController::class, "authenticate"]);
Route::post('/logout', [LoginController::class, "logout"]);


Route::get('/register', [RegisterController::class, "index"])->middleware("auth");
Route::post('/register', [RegisterController::class, "store"]);

Route::get('/alumni', function () {
    return view('alumni.index');
});

Route::resource('/alumni/bios', AlumniController::class)->middleware("auth");
Route::post('/getKabupaten', [IndoRegionController::class, "getKabupaten"])->name('getKabupaten')->middleware("auth");
Route::post('/getKecamatan', [IndoRegionController::class, "getKecamatan"])->name('getKecamatan')->middleware("auth");
Route::post('/getKelurahan', [IndoRegionController::class, "getKelurahan"])->name('getKelurahan')->middleware("auth");
// Route::get('/alumni/works/{work:id}', [PekerjaanController::class, 'show']); 
// Route::resource('/alumni/works', PekerjaanController::class)->middleware("auth");
Route::resource('/alumni/works', PekerjaanController::class)->middleware("auth");
Route::resource('/admin/user', AdminController::class)->middleware("auth");
Route::resource('/admin/biodata', AdminBiodataController::class)->middleware("auth");
Route::resource('/admin/pekerjaan', AdminPekerjaanController::class)->middleware("auth");
Route::get('/admin/laporan', [LaporanControllerPDF::class, "index"])->middleware("auth");
Route::get('/admin/laporan/cetak', [LaporanControllerPDF::class, 'cetakPDF']);
// Route::get('/alumni/works}', [WorkController::class, 'index']);
// Route::get('/alumni/works/{work}', [WorkController::class, 'show']);

// Route::get('/admin/pdf', [AdminController::class, 'exportPDF'])->name('export.pdf');

// user
Route::get('file-import-export', [AdminController::class, 'fileImportExport']);
Route::post('file-import', [AdminController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [AdminController::class, 'fileExport'])->name('file-export');

// biodata
Route::get('biodata-import-export', [AdminBiodataController::class, 'fileImportExport']);
Route::post('biodata-import', [AdminBiodataController::class, 'fileImport'])->name('biodata-import');
Route::get('biodata-export', [AdminBiodataController::class, 'fileExport'])->name('biodata-export');

// lacak
Route::get('/lacak', [LacakController::class, "index"]);
// pekerjaan
Route::get('pekerjaan-import-export', [AdminPekerjaanController::class, 'fileImportExport']);
Route::post('pekerjaan-import', [AdminPekerjaanController::class, 'fileImport'])->name('pekerjaan-import');
Route::get('pekerjaan-export', [AdminPekerjaanController::class, 'fileExport'])->name('pekerjaan-export');

