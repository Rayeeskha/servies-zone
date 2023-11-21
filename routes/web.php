<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  \App\Http\Controllers\Frontend\HomeController;
use  \App\Http\Controllers\Frontend\InquiryController;
use App\Services\CustomService;



Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::get('/', HomeController::class)->name('home');

// Inquiry
Route::group(['prefix'=>'lead-inquiry','as'=> 'inquiry.'],function(){

	Route::get('lead-services',[InquiryController::class,'index'])->name('lead_services');

	Route::match(['POST','GET'],'book-lead-service', [InquiryController::class, 'bookLeadService'])->name('book_service');

    Route::match(['POST','GET'],'contact-us', [InquiryController::class, 'contactUs'])->name('contact_us');
}); 

// Get Cities
Route::match(['POST','GET'],'/get-cities/{id?}', [\App\Http\Controllers\CommonController::class, 'getCities']);

// Services
Route::match(['POST','GET'],'/{slug}',  [InquiryController::class, 'servicesRouting'])
            ->name('services')->where('service',(new CustomService())->proxyUrl());

// Settings
Route::match(['POST','GET'],'/page/{page}', \App\Http\Controllers\Settings\SettingsController::class)
            ->name('page')->where('page',"about-us|services|contact-us");

// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

