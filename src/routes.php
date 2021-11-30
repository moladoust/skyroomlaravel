<?php

use Moladoust\Skyroomlaravel\Facades\SkyroomLaravel;

Route::get('/test', function () {
    return $r = SkyroomLaravel::getServices();
});