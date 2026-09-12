<?php

use Hawkiq\Hwkui\Http\Controllers\JoditUploaderController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('hwkui.editor.route.middleware', ['web', 'auth', 'throttle:60,1']))
    ->prefix(config('hwkui.editor.route.prefix', 'jodit'))
    ->group(function () {
        Route::any('connector', [JoditUploaderController::class, 'handle'])
            ->name(config('hwkui.editor.route.name', 'jodit.uploader'));
    });
