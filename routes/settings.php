<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'customer/pengaturan');
    Route::redirect('settings/profile', 'customer/pengaturan');
    Route::redirect('settings/security', 'customer/pengaturan');
    Route::redirect('settings/appearance', 'customer/pengaturan');
});
