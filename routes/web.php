<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

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

Auth::routes();

Route::resources([
    '/contacts' => ContactController::class,
    '/companies' => CompanyController::class
]);

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/download', function () {
    if (Storage::download('test.txt'))
        return Storage::download('test.txt');
});

#region Email Verification
// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
#endregion

#region Old
/*
// Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

// Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
// Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

// Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
// Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');

// Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

// Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Route::resource('/contacts', ContactController::class)->only([
//     'index',
//     'create',
//     'store',
// ]);
// Route::resource('/contacts', ContactController::class);
// Route::resource('/companies', CompanyController::class);

// Route::resource('/companies.contacts', ContactController::class);

// Route::get('/home', function(){
//     return redirect(route('home'));
// });
*/
#endregion