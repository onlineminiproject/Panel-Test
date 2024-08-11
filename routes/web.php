<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ApiLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DateTimeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ManualPushInsertController;

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


Route::middleware(['auth'])->group(function () {


    Route::get('/testing', [TestingController::class, 'index'])->name('testing');

    Route::get('/welcome', [WelcomeController::class, 'index'])->name('my_welcome');

    Route::resource('topics', TopicController::class);

    Route::get('api-logs/query/{queryType}', [ApiLogController::class, 'query'])->name('api-logs.query');




    Route::post('/send/notification', [NotificationController::class, 'send'])->name('send.notification');

    //Create Notification
    Route::get('/create/notification', [NotificationController::class, 'index'])->name('create.notification');
    //For Normal Show
    Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.show');
    //For Scheduled Notifications Show
    Route::get('/scheduled/notifications', [NotificationController::class, 'ScheduledNotifications'])->name('scheduled.notifications');

    //Other Three Operations
    Route::get('/notifications/{id}/edit', [NotificationController::class, 'edit'])->name('notifications.edit');
    Route::put('/notifications/{id}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');


    //View Single Notification
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('single.notifications.show');





    // Route to display the delete form page
    Route::get('/delete-news', [NotificationController::class, 'showDeleteForm'])->name('delete-news.form');
    // Route to handle the deletion of records from top_news
    Route::post('/delete-top-news', [NotificationController::class, 'deleteRecordsTopNews'])->name('delete-top-news');
    Route::post('/delete-api-log', [NotificationController::class, 'deleteRecordsApiLog'])->name('delete-api-log');




    //Manual Push Set For Latest News API
    //Create Notification
    Route::get('/manual/create/notification', [ManualPushInsertController::class, 'save_push'])->name('manual.create.notification');
    Route::post('/manual/save/notification', [ManualPushInsertController::class, 'send'])->name('manual.save');
    Route::get('/manual/show/notification', [ManualPushInsertController::class, 'showManualNotifications'])->name('manual.show.notification');
    Route::get('/manual/show/notification/single/{id}', [ManualPushInsertController::class, 'showSingleManualPush'])->name('manual.show.notification.single');
    Route::get('/manual/notifications/{id}/edit', [ManualPushInsertController::class, 'edit'])->name('manual.notifications.edit');
    Route::put('/manual/notifications/{id}', [ManualPushInsertController::class, 'update'])->name('manual.notifications.update');
    Route::delete('/manual/notifications/{id}', [ManualPushInsertController::class, 'destroy'])->name('manual.notifications.destroy');
    Route::get('/reset/datetime/status', [ManualPushInsertController::class, 'resetList'])->name('reset.dateTime.status');
    Route::get('/serve-image', [ManualPushInsertController::class, 'serveImage'])->name('serve-image');



    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    //Time Taken
    Route::resource('date-times', DateTimeController::class);
});


// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::get('/admin/user', [AdminController::class, 'show_user'])->name('admin.users');
//     Route::get('/admin/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
// });


// Route::get('/generate-token', function () {
//     $user = \App\Models\User::find(Auth::user()->id);
//     $token = $user->createToken('API Token')->plainTextToken;

//     return response()->json([
//         'token' => $token,
//         'id' => Auth::user()->id
//     ]);
// });


// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
