<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


// Route::middleware(['auth'])->group(function () {
//     Route::get('/reviewer/dashboard', [App\Http\Controllers\ViewUserDashBoard::class, 'reviewer'])->name('reviewer.dashboard');
//     Route::get('/researcher/dashboard', [App\Http\Controllers\ViewUserDashBoard::class, 'researcher'])->name('researcher.dashboard');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/reviewer/dashboard', fn() => view('reviewer.dashboard'))->name('reviewer.dashboard');
    Route::get('/researcher/dashboard', fn() => view('researcher.dashboard'))->name('researcher.dashboard');
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});


///show all user in the admin dashboard ....

// use App\Http\Controllers\Admin\UserManagementController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/admin/dashboard/user-management', [UserManagementController::class, 'index'])->name('user.management');
//     Route::post('/admin/dashboard/user-management/{id}/update-role', [UserManagementController::class, 'updateRole'])->name('user.updateRole');
//     Route::delete('/admin/dashboard/user-management/{id}', [UserManagementController::class, 'destroy'])->name('user.delete');
// });

use App\Http\Controllers\Admin\UserManagementController;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/update-role', [UserManagementController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
});




////create paper , like , comment , access request
use App\Http\Controllers\ResearchPaperController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AccessRequestController;

Route::middleware(['auth'])->group(function () {
    Route::resource('papers', ResearchPaperController::class);
    Route::post('papers/{paper}/like', [LikeController::class, 'store'])->name('research-papers.like');
    Route::post('papers/{paper}/comment', [CommentController::class, 'store'])->name('research-papers.comment');
    Route::post('papers/{paper}/request-access', [AccessRequestController::class, 'store'])->name('papers.requestAccess');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/research-papers', [App\Http\Controllers\ResearchPaperController::class, 'index'])->name('research-papers.index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/research-papers/add', [ResearchPaperController::class, 'create'])->name('research-papers.create');
    Route::post('/research-papers/store', [ResearchPaperController::class, 'store'])->name('research-papers.store');
});
