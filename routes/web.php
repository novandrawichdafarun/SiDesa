<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use App\http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\LetterRequestController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\VillageFundController;
use Illuminate\Support\Facades\DB;

//? Auth
Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/notification', function () {
    return view('pages.notifications');
});

Route::post('/notification/{id}/read', function ($id) {
    $notification = DB::table('notifications')->where('id', $id);
    $notification->update([
        'read_at' => DB::raw('CURRENT_TIMESTAMP'),
    ]);

    $dataArray = json_decode($notification->firstOrFail()->data, true);

    if (isset($dataArray['complaint_id'])) {
        return redirect('/complaint');
    }

    return back();
})->middleware('role:User');

Route::get('verify-letter/{id}/{hash}', [LetterRequestController::class, 'verify'])
    ->name('letter.verify');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/account-list', [UserController::class, 'accountListView'])
        ->name('account-list.index')
        ->middleware('role:Admin');

    Route::get('/account-request', [UserController::class, 'accountRequestView'])
        ->name('account-request.index')
        ->middleware('role:Admin');

    Route::post('/account-list/approval/{id}', [UserController::class, 'accountApproval'])
        ->name('account-list.approval')
        ->middleware('role:Admin');

    Route::post('/account-request/approval/{id}', [UserController::class, 'accountApproval'])
        ->name('account-request.approval');

    Route::get('/account-list/{id}', [UserController::class, 'edit'])
        ->name('account-list.edit')
        ->middleware('role:Admin');
    Route::put('/account-list/{id}', [UserController::class, 'update'])
        ->name('account-list.update')
        ->middleware('role:Admin');
    Route::delete('/account-list/{id}', [UserController::class, 'destroy'])
        ->name('account-list.destroy')
        ->middleware('role:Admin');

    Route::get('/profile', [UserController::class, 'profileView'])
        ->name('profile.index');
    Route::post('/profile/{id}', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    Route::get('/change-password', [UserController::class, 'changePasswordView'])
        ->name('change-password.index');
    Route::post('/change-password/{id}', [UserController::class, 'changePassword'])
        ->name('change-password.update');
});

Route::middleware(['auth', 'role:Admin,Kades,RT/RW'])->group(function () {
    Route::post('/resident', [ResidentController::class, 'store']);
    Route::get('/resident/create', [ResidentController::class, 'create']);

    Route::put('/resident/{id}', [ResidentController::class, 'update']);
    Route::get('/resident/{id}', [ResidentController::class, 'edit']);

    Route::delete('/resident/{id}', [ResidentController::class, 'destroy']);

    Route::get('/resident', [ResidentController::class, 'index']);
});


Route::middleware(['auth'])->group(function () {
    Route::post('/complaint', [ComplaintController::class, 'store'])
        ->middleware('role:User');
    Route::get('/complaint/create', [complaintController::class, 'create'])
        ->middleware('role:User');

    Route::put('/complaint/{id}', [complaintController::class, 'update'])
        ->middleware('role:User');
    Route::get('/complaint/{id}', [complaintController::class, 'edit'])
        ->middleware('role:User');

    Route::delete('/complaint/{id}', [complaintController::class, 'destroy'])
        ->middleware('role:User');

    Route::get('/complaint', [complaintController::class, 'index'])
        ->middleware('role:User,Kades,Admin,RT/RW');
    Route::post('/complaint/update-status/{id}', [complaintController::class, 'update_status'])
        ->middleware('role:Kades,Admin,RT/RW');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/letters', [LetterRequestController::class, 'store'])
        ->middleware('role:User');

    Route::get('/letters/create', [LetterRequestController::class, 'create'])
        ->middleware('role:User');

    Route::put('/letters/{id}', [LetterRequestController::class, 'update'])
        ->middleware('role:User');
    Route::get('/letters/{id}', [LetterRequestController::class, 'edit'])
        ->middleware('role:User');

    Route::delete('/letters/{id}', [LetterRequestController::class, 'destroy'])
        ->middleware('role:User');

    Route::get('/letters', [LetterRequestController::class, 'index'])
        ->middleware('role:User,RT/RW,Admin,Kades');

    Route::post('/letters/approve/{letter}', [LetterRequestController::class, 'approve'])
        ->name('letters-list.approval')
        ->middleware('role:RT/RW,Admin,Kades');

    Route::post('/letters/reject/{letter}', [LetterRequestController::class, 'reject'])
        ->name('letters-list.rejection')
        ->middleware('role:RT/RW,Admin,Kades');

    Route::get('/letters/{id}/download', [LetterRequestController::class, 'download'])->name('letter.download');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create')->middleware('role:Admin,Kades');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('role:Admin,Kades');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy')->middleware('role:Admin,Kades');
});

// Group untuk fitur yang butuh Login (Admin/Kades) untuk Mengelola Data
Route::middleware(['auth', 'role:Admin,Kades'])->group(function () {
    Route::post('/funds/category', [VillageFundController::class, 'storeCategory'])->name('funds.category.store');
    Route::put('/funds/category/{id}', [VillageFundController::class, 'updateCategory'])->name('funds.category.update');
    Route::delete('/funds/category/{id}', [VillageFundController::class, 'destroyCategory'])->name('funds.category.destroy');

    Route::post('/funds/transaction', [VillageFundController::class, 'storeTransaction'])->name('funds.transaction.store');
    Route::delete('/funds/transaction/{id}', [VillageFundController::class, 'destroyTransaction'])->name('funds.transaction.destroy');
});

// Group Public (Bisa diakses siapa saja atau user login)
// Jika ingin hanya user login yang bisa lihat, masukkan ke middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/funds', [VillageFundController::class, 'index'])->name('funds.index');
});


Route::get('/ajax-global-search', [GlobalSearchController::class, 'ajaxSearch'])
    ->name('global.ajax.search')
    ->middleware('auth');
