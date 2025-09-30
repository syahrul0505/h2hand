<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OtherSettingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\JerseyController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\RaceEventNumberController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\MyClubController;
use App\Http\Controllers\Web\RegistrationEventController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\HomePageController  ;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//homepage
Route::get('/', function () {
    return view('web.homepage.index');
})->name('homepage');

// Direct Login
Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login');


// Sign Up
Route::get('/sign-up', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/sign-up', [AuthController::class, 'register']);

// Rute untuk halaman Tentang Kami
Route::get('/tentang-kami', function () {
    return view('web.homepage.tentang-kami'); 
})->name('tentang-kami');

// Rute untuk halaman Kontak
Route::get('/kontak', function () {
    return view('web.homepage.kontak'); 
})->name('kontak');

//homepage
Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/poster/{poster}', [HomePageController::class, 'show'])->name('posters.show');
// event homepage 
Route::get('/posters/{poster}', [HomePageController::class, 'show'])->name('posters.show');
Route::prefix('admin/homepage-posters')->name('admin.posters.')->group(function () {
        Route::get('/', [HomePageController::class, 'managePosters'])->name('manage');
        Route::get('/create', [HomePageController::class, 'create'])->name('create');
        Route::post('/store', [HomePageController::class, 'store'])->name('store');
        Route::get('/edit/{poster}', [HomePageController::class, 'edit'])->name('edit');
        Route::put('/update/{poster}', [HomePageController::class, 'update'])->name('update');
        Route::delete('/delete/{poster}', [HomePageController::class, 'destroy'])->name('destroy');
    });



// Route::get('/pos', function () {
//     return view('admin.pos.index');
// })->name('pos');

// Detail Transaction
// Route::get('/detail-transaction', [DetailTransactionController::class, 'index'])->name('detail-transaction');

Route::middleware(['auth'])->group(function () {
    // Dahsboard
    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard.index');
    // })->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('get-data', [UserController::class, 'getUsers'])->name('get-data');
        Route::get('modal-add', [UserController::class, 'getModalAdd'])->name('modal-add');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('modal-edit/{userId}', [UserController::class, 'getModalEdit'])->name('modal-edit');
        Route::put('update/{userId}', [UserController::class, 'update'])->name('update');
        Route::get('modal-delete/{userId}', [UserController::class, 'getModalDelete'])->name('modal-delete');
        Route::delete('delete/{userId}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Roles
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('get-data', [RoleController::class, 'getRoles'])->name('get-data');
        Route::get('modal-add', [RoleController::class, 'getModalAdd'])->name('modal-add');
        Route::post('store', [RoleController::class, 'store'])->name('store');
        Route::get('modal-edit/{roleId}', [RoleController::class, 'getModalEdit'])->name('modal-edit');
        Route::put('update/{roleId}', [RoleController::class, 'update'])->name('update');
        Route::get('modal-delete/{roleId}', [RoleController::class, 'getModalDelete'])->name('modal-delete');
        Route::delete('delete/{roleId}', [RoleController::class, 'destroy'])->name('destroy');
        Route::post('update-permission', [RoleController::class, 'updatePermissionByID'])->name('update.permission');
        Route::post('update-all-permissions', [RoleController::class, 'updateAllPermissions'])->name('update.permission');
    });

    // Other Setting
    Route::prefix('other-settings')->name('other-settings.')->group(function () {
        Route::get('/', [OtherSettingController::class, 'getModal'])->name('modal');
        Route::put('/{otherSettingId}', [OtherSettingController::class, 'update'])->name('update');
    });

    // Class
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('index'); // Halaman utama
        Route::get('get-data', [ClassController::class, 'getData'])->name('get-data');
        Route::get('modal-add', [ClassController::class, 'getModalAdd'])->name('modal-add');
        Route::post('store', [ClassController::class, 'store'])->name('store');
        Route::get('modal-edit/{class}', [ClassController::class, 'getModalEdit'])->name('modal-edit');
        Route::put('update/{class}', [ClassController::class, 'update'])->name('update');
        Route::get('modal-delete/{class}', [ClassController::class, 'getModalDelete'])->name('modal-delete');
        Route::delete('delete/{class}', [ClassController::class, 'destroy'])->name('destroy');
    });

    // Jerseys
    Route::prefix('jerseys')->name('jerseys.')->group(function () {
        Route::get('/', [JerseyController::class, 'index'])->name('index');
        Route::get('get-data', [JerseyController::class, 'getData'])->name('get-data');
        Route::get('modal-add', [JerseyController::class, 'getModalAdd'])->name('modal-add');
        Route::post('store', [JerseyController::class, 'store'])->name('store');
        Route::get('modal-edit/{jersey}', [JerseyController::class, 'getModalEdit'])->name('modal-edit');
        Route::put('update/{jersey}', [JerseyController::class, 'update'])->name('update');
        Route::get('modal-delete/{jersey}', [JerseyController::class, 'getModalDelete'])->name('modal-delete');
        Route::delete('delete/{jersey}', [JerseyController::class, 'destroy'])->name('destroy');
    });

    // Club
    Route::prefix('clubs')->name('clubs.')->group(function () {
        Route::get('/', [ClubController::class, 'index'])->name('index');
        Route::get('/get-data', [ClubController::class, 'getData'])->name('get-data');
        Route::get('/modal-add', [ClubController::class, 'create'])->name('modal-add');
        Route::post('/', [ClubController::class, 'store'])->name('store');
        Route::get('/modal-edit/{club}', [ClubController::class, 'edit'])->name('modal-edit');
        Route::put('/{club}', [ClubController::class, 'update'])->name('update');
        Route::get('/modal-delete/{club}', [ClubController::class, 'destroyView'])->name('modal-delete');
        Route::delete('/{club}', [ClubController::class, 'destroy'])->name('destroy');
    });

    //my club
    Route::middleware(['auth'])->group(function () {
        Route::get('my-club', [MyClubController::class, 'index'])->name('my-club.index');
    });

    //race event numbers
    Route::prefix('race-event-numbers')->name('race-event-numbers.')->middleware(['auth'])->group(function () {
        Route::get('/', [RaceEventNumberController::class, 'index'])->name('index');
        Route::get('get-data', [RaceEventNumberController::class, 'getData'])->name('get-data');
        Route::get('modal-add', [RaceEventNumberController::class, 'getModalAdd'])->name('modal-add');
        Route::post('store', [RaceEventNumberController::class, 'store'])->name('store');
        Route::get('modal-edit/{raceEventNumber}', [RaceEventNumberController::class, 'getModalEdit'])->name('modal-edit');
        Route::put('update/{raceEventNumber}', [RaceEventNumberController::class, 'update'])->name('update');
        Route::get('modal-delete/{raceEventNumber}', [RaceEventNumberController::class, 'getModalDelete'])->name('modal-delete');
        Route::delete('delete/{raceEventNumber}', [RaceEventNumberController::class, 'destroy'])->name('destroy');
        //update max partisipan
        Route::put('{raceEventNumber}/update-max', [RaceEventNumberController::class, 'updateMaxParticipants'])->name('update-max');
    });
    //events
    Route::prefix('events')->name('events.')->middleware(['auth'])->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('get-data', [EventController::class, 'getData'])->name('get-data');
        Route::get('modal-add', [EventController::class, 'getModalAdd'])->name('modal-add');
        Route::post('store', [EventController::class, 'store'])->name('store');
        Route::get('modal-edit/{event}', [EventController::class, 'getModalEdit'])->name('modal-edit');
        Route::put('update/{event}', [EventController::class, 'update'])->name('update');
        Route::get('modal-delete/{event}', [EventController::class, 'getModalDelete'])->name('modal-delete');
        Route::delete('delete/{event}', [EventController::class, 'destroy'])->name('destroy');
        Route::get('{event}/schedule', [EventController::class, 'showSchedule'])->name('schedule');
    });

    // Registration Events
    Route::prefix('registration-events')->name('registration-events.')->group(function () {
        Route::get('/', [RegistrationEventController::class, 'index'])->name('index');
        Route::get('/create/{encrypted_id}', [RegistrationEventController::class, 'create'])->name('create');
        Route::post('/store', [RegistrationEventController::class, 'store'])->name('store');
        //invoice
        Route::post('{event}/generate-invoice', [EventController::class, 'generateInvoice'])->name('generate-invoice');
    });

    // Partisipasi
    Route::prefix('my-participations')->name('my-participations.')->group(function () {
        Route::get('/', [RegistrationEventController::class, 'myParticipations'])->name('index');
        Route::get('/get-data', [RegistrationEventController::class, 'getMyParticipationsData'])->name('get-data');
        //dtail
        Route::get('/detail/{encrypted_id}', [RegistrationEventController::class, 'showParticipationDetail'])->name('show');
        Route::get('/get-detail-data/{event}', [RegistrationEventController::class, 'getParticipationDetailsData'])->name('get-detail-data');
        //susunan acara
        Route::get('/{encrypted_id}/schedule', [RegistrationEventController::class, 'showCompetitionSchedule'])->name('schedule');
        // Buku Acara
        Route::match(['GET', 'POST'], '/{encrypted_id}/event-book', [RegistrationEventController::class, 'showEventBook'])->name('event-book');
        // update hasil lomba
        Route::post('/{encrypted_id}/update-results', [RegistrationEventController::class, 'updateEventBookResults'])->name('event-book.update');
        // cetak pdf buku acara
        Route::get('/{encrypted_id}/event-book/cetak-pdf', [RegistrationEventController::class, 'cetakBukuAcaraPdf'])->name('event-book.cetak-pdf');
        //buku hasil
        Route::get('/{encrypted_id}/event-book/hasil', [RegistrationEventController::class, 'showBukuHasil'])->name('event-book.hasil');
        //cetak buku hasil
        Route::get('/{encrypted_id}/event-book/hasil/cetak-pdf', [RegistrationEventController::class, 'cetakBukuHasilPdf'])->name('event-book.hasil.cetak-pdf');
        //buku juara
        Route::get('/{encrypted_id}/juara', [RegistrationEventController::class, 'showJuara'])->name('juara');
        //cetak juara
        Route::get('/{encrypted_id}/juara/cetak-pdf', [RegistrationEventController::class, 'cetakJuaraPdf'])->name('juara.cetak-pdf');

    });

    //invoice
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index');
        Route::get('get-data', [InvoiceController::class, 'getData'])->name('get-data');
        Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('show');
        Route::get('/{invoice}/cetak-pdf', [InvoiceController::class, 'cetakPDF'])->name('cetak-pdf');

        //konfirmasi pembayaran
        Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('show');
        Route::get('/{invoice}/konfirmasi', [InvoiceController::class, 'showConfirmationForm'])->name('konfirmasi');
        Route::post('/{invoice}/konfirmasi', [InvoiceController::class, 'storeConfirmation'])->name('konfirmasi.store');
        //discount
        Route::get('/{invoice}/cetak-pdf', [InvoiceController::class, 'cetakPdf'])->name('cetak-pdf');

    });


    //expenses
    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::get('/', [ExpensesController::class, 'index'])->name('index');
        Route::get('get-data', [ExpensesController::class, 'getData'])->name('get-data');
        Route::get('modal-add', [ExpensesController::class, 'getModalAdd'])->name('modal-add');
        Route::post('store', [ExpensesController::class, 'store'])->name('store');
        Route::get('modal-edit/{expenses}', [ExpensesController::class, 'getModalEdit'])->name('modal-edit');
        Route::put('update/{expenses}', [ExpensesController::class, 'update'])->name('update');
        Route::get('modal-delete/{expenses}', [ExpensesController::class, 'getModalDelete'])->name('modal-delete');
        Route::delete('delete/{expenses}', [ExpensesController::class, 'destroy'])->name('destroy');
    });
});





