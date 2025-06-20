<?php

use App\Livewire\Produtos\Lista;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => '');

Route::get('/produtos', Lista::class);
