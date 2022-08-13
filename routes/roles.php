<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

route::resource('roles', RoleController::class)->names('roles');