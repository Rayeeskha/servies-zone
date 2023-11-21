<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Carbon\Carbon;
use  DB;
use CustomHelper;
class CustomService
{
	public function loginHistoryLog(User $userinfo){
		$current_timestamp = Carbon::now()->toDateTimeString();
		        
        DB::table('login_histories_log')->insert([
            'user_id'    => $userinfo->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
        ]);

        return true;
	}


    public function deleteLastOneMonthLogs(){
        return DB::table('login_histories_log')->where('created_at', '<',  Carbon::now()->subDays(30))->delete();
    }

    static function proxyUrl(){
        $servicesData = [];
        $services =  \App\Models\LeadService::wherestatus(1)->get();
        if (isset($services) && count($services) == 34) {
            foreach($services as $service){
                if (in_array($service->service_name, CustomHelper::serviceName()) && in_array($service->slug, CustomHelper::serviceSlugUrl())) {
                    array_push($servicesData, $service->slug);
                }                
            }
        } 
        return implode("|", $servicesData);
    }

    static function systemEmailAddress(){
        return ['wehome@gmail.com'];
    }

}
	