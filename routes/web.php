<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Anggota\ManageAnggota;
use App\Livewire\Kegiatan\ManageKegiatan;
use App\Livewire\Kegiatan\AturPanitia;
use App\Livewire\Laporan\LaporanKegiatan;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    
    $totalAnggota = \App\Models\Anggota::count();
    $totalKegiatan = \App\Models\Kegiatan::count();
    $totalOrganisasi = \App\Models\Organisasi::count();

    $kegiatanTerdekat = \App\Models\Kegiatan::where('tgl_pelaksanaan', '>=', now())
                                    ->orderBy('tgl_pelaksanaan', 'asc')
                                    ->limit(5)
                                    ->get();

    
    return view('dashboard', [
        'totalAnggota' => $totalAnggota,
        'totalKegiatan' => $totalKegiatan,
        'totalOrganisasi' => $totalOrganisasi,
        'kegiatanTerdekat' => $kegiatanTerdekat,
    ]);
})  ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grup route yang memerlukan login
Route::middleware(['auth'])->group(function () {
    
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('anggota', ManageAnggota::class)->name('anggota');
    Route::get('kegiatan', ManageKegiatan::class)->name('kegiatan');
    Route::get('kegiatan/{kegiatan}/panitia', AturPanitia::class)->name('kegiatan.panitia');
    Route::get('laporan/kegiatan', LaporanKegiatan::class)->name('laporan.kegiatan');
});