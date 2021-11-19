<?php

use App\Http\Controllers\LoginController;
use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/checkin', function () {

        $checkin = CheckIn::where('tanggal', Carbon::now()->format('Y-m-d'))->get();

        return view('dashboard/checkin', compact('checkin'));
    });
    Route::get('/checkout', function () {

        $checkout = CheckOut::where('tanggal', Carbon::now()->format('Y-m-d'))->get();

        return view('dashboard/checkout', compact('checkout'));
    });
    Route::get('/user', function () {

        $user = User::all();

        return view('dashboard/user', compact('user'));
    });
    Route::get('/logout', [LoginController::class, 'logout']);
});



Route::get('/', function () {
    return view('login/login');
})->middleware("guest")->name('login');

Route::post('/login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect('/checkin');
    } else {
        return back()->with('ERR', 'Username atau Password salah');
    }
});
