<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SafePlaceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\WaterResourceController;
use App\Http\Controllers\WaterReportController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login'); // เปลี่ยนเส้นทางไปยังหน้า Login
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Public routes
Route::get('/home', [HomeController::class, 'index'])->name('home');

//forum
// Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
Route::post('forum/{forumPost}/comments', [CommentController::class, 'store'])->name('forum.comments.store');
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::delete('/forum/posts/{post}', [ForumController::class, 'destroy'])->name('forum.destroy');
Route::get('/forum/posts/{post}/edit', [ForumController::class, 'edit'])->name('forum.edit');
Route::put('/forum/posts/{post}', [ForumController::class, 'update'])->name('forum.update');

// Like a post
Route::post('/like-post/{postId}', [ForumController::class, 'likePost'])->name('forum.like');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');

// Report routes
Route::prefix('report')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('report.index');
    Route::post('/', [ReportController::class, 'store'])->name('report.store');
});

Route::prefix('request')->group(function () {
    Route::get('/', [ReportController::class, 'helpRequestIndex'])->name('request.index');
    Route::post('/', [ReportController::class, 'storeHelpRequest'])->name('request.store');
});

// Volunteer routes
Route::prefix('volunteer')->group(function () {
    Route::get('/', [VolunteerController::class, 'index'])->name('volunteer.index');
    Route::post('/', [VolunteerController::class, 'store'])->name('volunteer.store');
});

// Contact routes
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/', [ContactController::class, 'store'])->name('contact.store');
});

// safe
Route::group(['prefix' => 'safe-place'], function () {
    Route::get('/', [SafePlaceController::class, 'index'])->name('safe_place');
    Route::resource('safe-places', SafePlaceController::class);

});

// safe
Route::get('/safe-places/search', [SafePlaceController::class, 'search'])->name('safe-places.search');




Route::get('/apiwater-resources', [WaterResourceController::class, 'fetchWaterResources']);
Route::get('/water-resources', [WaterResourceController::class, 'index'])->name('water-resources');

Route::resource('water-reports', WaterReportController::class);
Route::get('water-reports', [WaterReportController::class, 'index'])->name('water-reports.index');
Route::get('/fetch-water-levels', [WaterReportController::class, 'fetchWaterLevels'])->name('fetch-water-levels');
Route::get('/rainfall-data', [WaterReportController::class, 'getRainfallData']);
