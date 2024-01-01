<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MyMail;
use Mail;

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


Route::get('/mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
    
    Mail::to('faisol.ajifa@gmail.com')->send(new MyMail($details));
    
    dd("Email is Sent.");
    
});


Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'sign'])->name('sign');
Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('home');
Route::get('/daftar', [App\Http\Controllers\AuthController::class, 'reg'])->name('daftar');
Route::post('/daftar', [App\Http\Controllers\AuthController::class, 'daftar'])->name('reg');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {
    
    Route::resource('log', App\Http\Controllers\LogController::class);
    
    Route::group(['prefix'=>'home'],function() {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
        Route::post('account', [App\Http\Controllers\HomeController::class, 'account'])->name('account');
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::resource('class', App\Http\Controllers\KelasController::class);
        Route::get('kelas', [App\Http\Controllers\KelasController::class, 'verif'])->name('kelas.index');
        Route::post('kelas/{id}', [App\Http\Controllers\KelasController::class, 'verfied'])->name('kelas.update');
        Route::resource('third', App\Http\Controllers\ThirdController::class);
        Route::resource('student', App\Http\Controllers\StudentController::class);
        Route::resource('exam', App\Http\Controllers\ExamController::class);
        Route::resource('payment', App\Http\Controllers\PaymentController::class);
        Route::resource('paid', App\Http\Controllers\HeadController::class);
        Route::post('paid-reject/{id}', [App\Http\Controllers\HeadController::class, 'reject'])->name('paid.reject');
        Route::resource('job', App\Http\Controllers\JobController::class);
        Route::get('pekerjaan', [App\Http\Controllers\JobController::class, 'verif'])->name('apply.index');
        Route::post('pekerjaan-approve/{id}', [App\Http\Controllers\JobController::class, 'verfied'])->name('apply.update');
        Route::post('pekerjaan-reject/{id}', [App\Http\Controllers\JobController::class, 'reject'])->name('apply.reject');
        Route::get('interview', [App\Http\Controllers\JobController::class, 'interview'])->name('interview.index');
        Route::get('doc/{id}', [App\Http\Controllers\JobController::class, 'doc'])->name('doc');

        // participant
        Route::get('pendaftaran-kelas', [App\Http\Controllers\Participant::class, 'class'])->name('kelas');
        Route::post('pendaftaran-kelas/{id}', [App\Http\Controllers\Participant::class, 'store'])->name('daftar.store');
        Route::get('pendaftaran-kelas/{id}', [App\Http\Controllers\Participant::class, 'daftar'])->name('daftar.index');
        Route::get('exam-participant', [App\Http\Controllers\Participant::class, 'exam'])->name('xam');
        Route::post('test/{id}', [App\Http\Controllers\Participant::class, 'test'])->name('test');
        Route::post('data/{id}', [App\Http\Controllers\Participant::class, 'data'])->name('data');
        Route::post('tested/{id}', [App\Http\Controllers\Participant::class, 'tested'])->name('tested');
        Route::get('testing/{id}', [App\Http\Controllers\Participant::class, 'testing'])->name('testing');
        Route::post('file-transfer/{id}', [App\Http\Controllers\Participant::class, 'pile'])->name('pile');
        Route::get('payment-participant', [App\Http\Controllers\Participant::class, 'payment'])->name('pay');
        Route::get('job-participant', [App\Http\Controllers\Participant::class, 'job'])->name('jobs');
        Route::get('apply-job/{id}/{head}', [App\Http\Controllers\Participant::class, 'apply'])->name('apply');
        Route::post('cv', [App\Http\Controllers\Participant::class, 'cv'])->name('cv');
    });
});