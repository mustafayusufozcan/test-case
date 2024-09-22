<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tasks = Task::with('developer')->get();
    
    return view('welcome', compact('tasks'));
});
