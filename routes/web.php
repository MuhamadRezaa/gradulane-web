<?php

use App\Models\Sempro;
use App\Models\Bimbingan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SitaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TugasAkhirController;
use App\Http\Controllers\BidangdosenController;
use App\Http\Controllers\TahunajaranController;
use App\Http\Controllers\JabatanfungsionalController;

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

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('admin.pages.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.pages.dashboard');
    });

    // USER
    Route::resource('/admin/user', UserController::class);

    // JURUSAN
    // Route::resource('/admin/jurusan', JurusanController::class);
    Route::get('/admin/jurusan', [JurusanController::class, 'index']);
    Route::get('/admin/jurusan/create', [JurusanController::class, 'create']);
    Route::post('/admin/jurusan', [JurusanController::class, 'store']);
    Route::get('/admin/jurusan/{jurusan}/edit', [JurusanController::class, 'edit']);
    Route::put('/admin/jurusan/{jurusan}', [JurusanController::class, 'update']);
    Route::delete('/admin/jurusan/{jurusan}', [JurusanController::class, 'destroy']);


    // PANGKAT
    Route::resource('/admin/pangkat', PangkatController::class);

    // GOLONGAN
    Route::resource('/admin/golongan', GolonganController::class);

    // Prodi
    Route::resource('/admin/prodi', ProdiController::class);
    Route::post('/admin/getprodi', [MahasiswaController::class, 'getprodi'])->name('getprodi');

    // jabatan
    Route::resource('/admin/jabatan', JabatanController::class);

    // Jabatan Fungsional
    Route::resource('/admin/jabatanfungsional', JabatanfungsionalController::class);

    // Tahun Ajaran
    Route::resource('/admin/tahunajaran', TahunajaranController::class);

    // level
    Route::resource('/admin/level', LevelController::class);

    // mahasiswa
    Route::resource('/admin/mahasiswa', MahasiswaController::class);
    Route::get('/admin/mahasiswa/detail/{id}', [MahasiswaController::class, 'detail']);

    // dosen
    Route::resource('/admin/dosen', DosenController::class);
    Route::get('/admin/dosen/detail/{id}', [DosenController::class, 'detail']);

    // BIDANG
    Route::resource('/admin/bidang', BidangController::class);

    // BIDANG DOSEN
    Route::resource('/admin/bidangdosen', BidangdosenController::class);

    // ruangan
    Route::resource('/admin/ruangan', RuanganController::class);

    // sesi
    Route::get('/admin/session', [SesiController::class, 'index']);
    Route::get('/admin/session/create', [SesiController::class, 'create']);
    Route::post('/admin/session', [SesiController::class, 'store']);
    Route::get('/admin/session/{sesi}/edit', [SesiController::class, 'edit']);
    Route::put('/admin/session/{sesi}', [SesiController::class, 'update']);
    Route::delete('/admin/session/{sesi}', [SesiController::class, 'destroy']);

    // tugasakhir
    Route::resource('/admin/tugasakhir', TugasAkhirController::class);
    Route::get('/admin/tugasakhir/detail/{id}', [TugasAkhirController::class, 'detail']);
    Route::put('/admin/tugasakhir/mulaireview/{id}', [TugasAkhirController::class, 'mulaiReview']);
    Route::get('/admin/tugasakhir/review/{id}', [TugasAkhirController::class, 'reviewview']);
    Route::put('/admin/tugasakhir/review/{id}', [TugasAkhirController::class, 'reviewpost']);
    Route::get('/admin/tugasakhir/detaildosen/{id}', [DosenController::class, 'detail']);

    // BIMBINGAN
    Route::get('/admin/bimbingan/detail/{id}', [BimbinganController::class, 'detail']);

    Route::get('/admin/bimbingan/pembahasanp1', [BimbinganController::class, 'addpembahasanpembimbing1']);
    Route::post('/admin/bimbingan/tambahpembahasanp1', [BimbinganController::class, 'storepembahasanpembimbing1']);

    Route::get('/admin/bimbingan/editpembahasanp1/{id}', [BimbinganController::class, 'editPembahasanP1'])->name('bimbingan.edit');
    Route::put('/admin/bimbingan/editpembahasanp1/{id}', [BimbinganController::class, 'updatePembahasanP1'])->name('bimbingan.update');

    Route::get('/admin/bimbingan/pembahasanp2', [BimbinganController::class, 'addpembahasanpembimbing2']);
    Route::post('/admin/bimbingan/tambahpembahasanp2', [BimbinganController::class, 'storepembahasanpembimbing2']);

    Route::get('/admin/bimbingan/editpembahasanp2/{id}', [BimbinganController::class, 'editPembahasanP2'])->name('bimbingan.edit');
    Route::put('/admin/bimbingan/editpembahasanp2/{id}', [BimbinganController::class, 'updatePembahasanP2'])->name('bimbingan.update');

    Route::put('/bimbingan/{id}/validasi', [BimbinganController::class, 'validasibimbingan']);

    Route::resource('/admin/bimbingan', BimbinganController::class);

    // SEMINAR PROPOSAL
    Route::get('/admin/sempro/detail/{id}', [SemproController::class, 'detail']);

    Route::post('/admin/sempro/pengajuan', [SemproController::class, 'pengajuansempro']);
    Route::put('/sempro/{id}/validasisemp1', [SemproController::class, 'validasisemprop1']);
    Route::put('/sempro/{id}/validasisemp2', [SemproController::class, 'validasisemprop2']);

    Route::get('/sempro/penjadwalan/{id}', [SemproController::class, 'penjadwalansempro']);
    Route::put('/sempro/penjadwalan/{id}', [SemproController::class, 'storepenjadwalansempro']);

    Route::get('/sempro/penjadwalan/{id}/edit', [SemproController::class, 'editpenjadwalansempro']);
    Route::put('/sempro/editpenjadwalan/{id}', [SemproController::class, 'updatepenjadwalansempro']);

    Route::get('/sempro/penilaian/{id}', [SemproController::class, 'penilaiansempro']);
    Route::post('/sempro/inputpenilaian/{id}', [SemproController::class, 'storenilaisempro']);

    Route::resource('/admin/sempro', SemproController::class);

    //Sidang Tugas Akhir

    Route::get('/sitajadwal/{id}', [SitaController::class, 'formsitajadwal']);
    Route::get('/detailsita/{id}', [SitaController::class, 'detail']);
    Route::get('/fulltadownload/{id}', [SitaController::class, 'download']);
    Route::get('/sita/accsidangta/{id}', [SitaController::class, 'accsidangta']);
    Route::get('/validasidokumen/{id}', [SitaController::class, 'validasidokumen']);
    Route::post('/sitajadwal/{id}', [SitaController::class, 'storesitajadwal']);
    Route::get('/nilaisita/{id}', [SitaController::class, 'nilaisita']);
    Route::get('/tolakvalidasidokumen/{id}', [SitaController::class, 'tolakvalidasidokumen']);
    Route::post('/inputnilaisita/{id}', [SitaController::class, 'storenilaisita']);

    Route::resource('/sita', SitaController::class);
});
