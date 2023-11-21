<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;


Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('dashboard', DashboardController::class)->name('dashboard');

	Route::resources([
        'role-master' => \App\Http\Controllers\RoleMasterController::class,
        'employee' => \App\Http\Controllers\Backend\EmployeeController::class,
        'login-log' => \App\Http\Controllers\Backend\LoginHistoryController::class,
        'lead-inquiry' => \App\Http\Controllers\Backend\LeadInquiryController::class,
        'electrician' => \App\Http\Controllers\Backend\ElectricianController::class,
        'contact-us' => \App\Http\Controllers\Backend\ContactusController::class,
        'service-activation' => \App\Http\Controllers\Backend\ServiceActivationController::class,
        'payment-details' => \App\Http\Controllers\Backend\PaymentController::class,
    ]);
    

    Route::match(['POST','GET'],'view-payment-details/{id?}', [\App\Http\Controllers\Backend\PaymentController::class, 'paymentDetails'])->name('view-payment-details');

    Route::match(['POST','GET'],'/get-electrician/{id?}', [\App\Http\Controllers\Backend\ServiceActivationController::class, 'getElectricianDetail']);

    Route::match(['POST','GET'],'get-all-electrician', [\App\Http\Controllers\Backend\ServiceActivationController::class, 'getAllElectrician']);

    Route::match(['POST','GET'],'/status-change', [\App\Http\Controllers\CommonController::class, 'changeDataTableStatus']);

    Route::match(['POST','GET'],'/delete-datatable-row', [\App\Http\Controllers\CommonController::class, 'deleteDataTableRow']);

    
});


?>