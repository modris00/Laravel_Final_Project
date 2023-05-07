<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FeedbackController;
use App\Mail\FeedbackCreatedEmail;
use App\Mail\ResponseAddedEmail;
use App\Mail\SupervisorWelcomeEmail;
use App\Models\Admin;
use App\Models\Feedback;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/ucas/feedbacks/create');
Route::redirect('/ucas/feedbacks', '/ucas/feedbacks/create');
Route::redirect('/admin', '/ucas/dashboard/');




Route::prefix('ucas/dashboard')->middleware('guest:supervisor')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('ucas.login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix("ucas/dashboard")->middleware(['auth:supervisor', 'verified'])->group(function () {
    Route::get('/feedbacks/trash', [FeedbackController::class, 'trash'])->name('feedbacks.trash');
    Route::put('/feedbacks/{id}/restore', [FeedbackController::class, 'restore'])->name('feedbacks.restore');
    Route::delete('/feedbacks/{id}/force-delete', [FeedbackController::class, 'forceDelete'])->name('feedbacks.force-delete');

    Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
});

Route::prefix("ucas")->group(function () {
    Route::get('/feedbacks/create', [FeedbackController::class, 'create'])->name('feedbacks.create');
    Route::post('/feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');

    Route::view('/feedbacks/search', 'track_feedback')->name('feedbacks.search');
    Route::get('/feedbacks/single', [FeedbackController::class, 'single'])->name('feedbacks.single');
    // Route::get('/feedbacks/{id}', [FeedbackController::class, 'single'])->name('feedbacks.single');
    Route::get('/feedbacks/{feedback_id}', [FeedbackController::class, 'show'])->name('feedbacks.show');
    // Route::delete()
});

Route::prefix("ucas/dashboard")->middleware(['auth:supervisor', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, 'homepage'])->name('ucas.starter');
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/{id}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit');
    Route::put('/feedbacks/{id}', [FeedbackController::class, 'update'])->name('feedbacks.update');
    Route::put('/feedbacks/{id}/update-status-close', [FeedbackController::class, 'updateStatusClose'])->name('feedbacks.updateStatusClose');
    Route::put('/feedbacks/{id}/update-status-open', [FeedbackController::class, 'updateStatusOpen'])->name('feedbacks.updateStatusOpen');

    Route::get('logout', [AuthController::class, 'logout'])->name('ucas.logout')->withoutMiddleware('verified');

    Route::resource('/admins', AdminController::class);
});
Route::prefix('email')->middleware('auth:supervisor')->group(function () {
    // Route::get('logout', [AuthController::class, 'logout'])->name('ucas.logout');

    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('verification-notification', [EmailVerificationController::class, 'send'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
});

// Route::get('e1', function () {
//     // return new FeedbackCreatedEmail();
//     $feedback = Feedback::first();
//     return new FeedbackCreatedEmail($feedback);
// });
// Route::get('e2', function () {
//     // return new FeedbackCreatedEmail();
//     $feedback = Feedback::first();
//     return new ResponseAddedEmail($feedback);
// });
// Route::get('e3', function () {
//     // return new FeedbackCreatedEmail();
//     $supervisor = Admin::first();
//     return new SupervisorWelcomeEmail($supervisor, 'NotRealPassword');
// });

// Route::view('tt', 'test1');
