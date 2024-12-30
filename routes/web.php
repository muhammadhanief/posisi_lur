<?php

use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use App\Livewire\First;
use App\Livewire\ManajemenAkun;
use App\Livewire\ManajemenMaster;
use App\Livewire\ManajemenPegawai;
use App\Livewire\ManajemenPetugas;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/monitoring', First::class)->name('monitoring');
    Route::get('/counter', Counter::class);
    Route::get('/manajemen-petugas', ManajemenPetugas::class)->name('manajemenPetugas');
    Route::get('/manajemen-master', ManajemenMaster::class)->name('manajemenMaster');
    Route::get('/manajemen-pegawai', ManajemenPegawai::class)->name('manajemenPegawai');
});
