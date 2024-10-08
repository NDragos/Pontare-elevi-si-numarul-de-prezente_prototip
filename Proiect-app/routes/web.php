<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresenceController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/prezenta', function () {
    $students = null;
    if (Auth::user()->is_teacher) {
        $students = User::with('accesses')->whereHas('accesses', function ($query) {
            $query->whereDate('accessed_at', now());
        })->get();
        $allStudents = User::where('class', Auth::user()->class)->where('is_teacher', false)->get();

        $students = $students->merge($allStudents);
    }
    $users = User::whereHas('accesses', function ($query) {
        $query->whereDate('accessed_at', now());
    })->whereId(Auth::id())->get();
    $submittedAccess = ($users->count() > 0) ? true : false;






    return view('dashboard')->with(compact('submittedAccess', 'students'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/prezente-totale', function () {

    if (Auth::user()->is_teacher) {
        $students = User::where('is_teacher', false)->withCount('accesses')->get();
    }
    $users = User::whereHas('accesses', function ($query) {
        $query->whereDate('accessed_at', now());
    })->whereId(Auth::id())->get();
    $submittedAccess = ($users->count() > 0) ? true : false;






    return view('dashboard2')->with(compact('submittedAccess', 'students'));
})->middleware(['auth', 'verified'])->name('dashboard2');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/presence', [PresenceController::class, 'store'])->name('presence.store');
});

require __DIR__ . '/auth.php';
