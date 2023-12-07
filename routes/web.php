<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/roles' , function () {
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'client']);
});
Route::get('/assign' , function () {
    $user = User::first();
    $user->assignRole('admin');
    return response()->json([
        'data' => $user,
    ]);
});

Route::get('/register' , function() {
    $user = new User();
    $user->name = 'Aung';
    $user->email = 'aung@gmail.com';
    $user->password = Hash::make('internet');
    $user->save();
     $user->createToken('project')->plainTextToken;
    return $user;
});
