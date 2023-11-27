<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadFileController;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mockery\Undefined;

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

Route::get('/', function (Request $request) {

    $name = $request->query('search');

   if(!empty($name)){

    $files = UploadFile::where('name','LIKE','%'.$name.'%')->get();

    if($files->count() === 0){
       
        return redirect()->back()->with('error', 'No search Result');

    }else{  

        return view('welcome',compact('files'));
    }

   }else{

    $files = UploadFile::all();
    return view('welcome',compact('files'));
   }
    
});

Route::get('/dashboard', function () {
    $files = UploadFile::all();
    return view('dashboard',compact('files'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/upload', [UploadFileController::class,'store'])->name('upload.store');
Route::get('/download/{file}', [UploadFileController::class,'downloads'])->name('file.downloads');
Route::get('/delete/{file}', [UploadFileController::class,'destroy'])->name('file.delete');
Route::get('/view/{id}', [UploadFileController::class,'view'])->name('file.view');

require __DIR__.'/auth.php';
