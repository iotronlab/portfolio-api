<?php

use App\Http\Controllers\api\Form\FormController;
use App\Http\Controllers\api\InternController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('businessform', [FormController::class, 'businessForm']);

Route::get('verify/{intern}', [InternController::class, 'show']);
Route::get('getQR/{intern:uid}', [InternController::class, 'getQR'])->name('getQR');
// Route::get('qr-code', function () {
//     return response()->download(storage_path('app/qr-code.svg'));
// });
