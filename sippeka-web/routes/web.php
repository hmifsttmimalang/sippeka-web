<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!assets|storage|images|css|js|favicon\.ico).*$');
