<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AbsenceController;
use App\HtTP\Controllers\EmailGoogleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('bvn');
});

Route::middleware('auth', 'admin')->group((function () {
    Route::resource('/Filieres', FiliereController::class);
    Route::resource('/Modules', ModuleController::class);
    Route::resource('/Teachers', TeacherController::class);
    Route::resource('/Students', StudentController::class);
    Route::get('gemail', [EmailGoogleController::class, 'googleMail'])->name('google_email');
    Route::post('send-gemail', [EmailGoogleController::class, 'sendGoogleMail'])->name('send.google_mail');
    // Route for user's search bar to show the user informations
    Route::get('user/{id}', function ($id) {
        $user = User::where('_id', '=', $id)->first();
        /*  $query = DB::table('files')
            ->join('users', 'files.user_id', '=', 'users._id')
            ->select('files.fileName')
            ->where('user.id', '=', $id)
            ->get();
            */
        $query = DB::collection('files')->where('user_id', '=', $id)->get();
        // dd($query);
        $photo = $query[0]["fileName"];
        return view('users.show', compact('user', 'photo'));
    })->name('user.show');
}));

Route::middleware('auth', 'student')->group((function () {
    Route::get('/Profile', [StudentController::class, 'Profile'])->name('student_profile');
    Route::get('/student/absence', [StudentController::class, 'absence'])->name('student_absence');
    Route::get('Notification', [NotificationController::class, 'index'])->name('notifications');
    Route::get('ReadNotification/{id}', [NotificationController::class, 'ReadNotification'])->name('ReadNotification');
    Route::post('/mark-presence', [AbsenceController::class, 'markPresence'])->name('markPresence');
    Route::get('email', [StudentController::class, 'createEmail'])->name('email');
    Route::post('send-email', [StudentController::class, 'sendEmail'])->name('send.mail');
}));

Route::middleware(['auth', 'teacher'])->name('teacher.')->prefix('Teacher')->group(function () {
    Route::resource('/absence', AbsenceController::class);
    Route::get('absence/seance/{id}', [AbsenceController::class, 'seanceSheet'])->name('seance');
    Route::post('absence/seanceStart/{id}', [AbsenceController::class, 'seanceStart']);
    Route::post('absence/seanceEnd/{id}', [AbsenceController::class, 'seanceEnd']);
    Route::get('/Profile', [TeacherController::class, 'Profile'])->name('teacher_profile');
});

Route::get('upload-photo', [FileController::class, 'form'])->name('uploadFile');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 /*
 * API ROUTES for email
 * Route::post('/subscribe-send', [SubscriberController::class, 'subscribe '])->name('subscribe_start');
 * Route::get('/subscribe', [SubscriberController::class, 'index'])->name('subscribe');
*/
