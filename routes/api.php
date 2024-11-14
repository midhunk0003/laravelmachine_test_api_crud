<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

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
Route::get('/getcontact', [ContactsController::class, 'getAllcontact']);
Route::post('/storecontact', [ContactsController::class, 'storecontact']);
Route::put('/updatecontact', [ContactsController::class, 'updatecontact']);
Route::delete('/deletecontact', [ContactsController::class, 'deletecontact']);

Route::middleware('auth:sanctum')->group(function () {
    // Get authenticated user's details
//    Route::apiResource('contacts', ContactsController::class);
//    Route::get('contacts/{contactModel}', [ContactsController::class, 'show']);


//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    });

//    // CRUD operations for Contact model
//    Route::get('/contacts', [ContactController::class, 'index']);           // Get all contacts
//    Route::post('/contacts', [ContactController::class, 'store']);          // Insert a new contact
//    Route::get('/contacts/{id}', [ContactController::class, 'show']);       // Get a single contact
//    Route::put('/contacts/{id}', [ContactController::class, 'update']);     // Update an existing contact
//    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']); // Delete a contact
});
