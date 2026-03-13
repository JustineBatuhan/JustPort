<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\MessageController;

// ── Public Routes ───────────────────────────────────────────────
Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::post('/contact', [PortfolioController::class, 'sendMessage'])->name('contact.send');

// ── Auth Routes ─────────────────────────────────────────────────
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);
    if (\Illuminate\Support\Facades\Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }
    return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
})->middleware('guest');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ── Admin Routes (auth protected) ───────────────────────────────
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('skills',   SkillController::class)->except(['show']);
    Route::patch('skills/{skill}/update-level', [SkillController::class, 'updateLevel'])->name('skills.update-level');

    Route::get('/messages',              [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}',    [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});
