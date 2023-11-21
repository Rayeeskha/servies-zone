<?php 
namespace App\Helpers;
use App\Models\Module;
use App\Models\RoleMaster;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class CustomHelper{

	static function checkPermission($module_id, $action){
        $role_id = Auth::user()->role_id;
        if(!empty($role_id) && $role_id  == '1'){
            return true;
        }
        $permissionRole = false;
        $previllage = CustomHelper::getUserRolePermission();

        if (($key1 = array_search($module_id, array_column($previllage, 'module_id') ) ) !== false ) {
            $rolePermissions = isset($previllage[$key1]) ? $previllage[$key1] : '';
            if(!empty($rolePermissions) && count($rolePermissions) > 0){
                if(isset($rolePermissions[$action]) && $rolePermissions[$action] == 1){
                    $permissionRole = true;
                }
            }
        }
        return $permissionRole;
    }

    static function getModules(){
        return Module::orderBy('id', 'DESC')->get();
    }

    static function getUserRolePermission(){
        $previllage = '';
        $roleMaster =  RoleMaster::whereid(Auth::user()->role_id)->first();
        if (!is_null($roleMaster)) {
            $previllage = json_decode($roleMaster->permissions, true);
        }
        return $previllage;
    }

    static function getRoles(){
        return RoleMaster::wherestatus(1)->get();
    }

    static function getLeadServices(){
        return \App\Models\LeadService::leadPermission()->wherestatus(1)->pluck('service_name', 'id');
    }

    static function getBookingLeadService(){
        return \App\Models\LeadService::wherestatus(1)->get();
    }

    static function getUserAssignLeadServices($servicesId){
        return \App\Models\LeadService::whereIn('id',$servicesId)->get();
    }

    static function getStates(){
        return \App\Models\State::wherestatus(1)->pluck('states_name', 'id');
    }

    static function getCities(){
        return \App\Models\City::wherestatus(1)->pluck('districts_name', 'id');
    }

    static function getLatestLeadInquiry(){
        $leadService =  \App\Models\LeadInquiry::latest()->take(8)->pluck('name', 'id');
        
        if(is_null($leadService)){
            $leadService = array('Rayees khan','deepak Kumar','Sachin Kumar','Samsher Ali');
        }
        return $leadService;
    }

    static function getUserCity(){
        $city =  \App\Models\City::whereid(Auth::user()->city_id)->first();
        return !is_null($city) ? $city->districts_name :'';
    }

    static function getLoginUserRole(){
        $role =  \App\Models\RoleMaster::select('name')->whereid(Auth::user()->role_id)->first();
        return !is_null($role) ? $role->name :'';
    }

    static function getUserState(){
        $state =  \App\Models\State::whereid(Auth::user()->state_id)->first();
        return !is_null($state) ? $state->states_name :'';
    }

    static function serviceName(){
        return array("Ac Repair", "CCTV","Chiming","Deep Fridge","Water Geyser","Water Cooler",
           "Room Heater","Dish Washer","Ice Maker","Inverter", "Led/TV","Mixer Grinder",
           "Ro Water Purifier","Oven Heater","Kitchen Hub","Carpentry","Electricians",
           "Furniture Installation","Plumber","Bathroom CleaningCar Cleaning","House Keeping",
           "Carpet Cleaning","Kitchen Cleaning","Office Cleaning","Pest Control",
           "Sewage Cleaning","Water Tank","Aluminium Partition","Fabrication","Architectural",
           "False Celling","Modular Kitchen","Waterproofing"
        );
    }

    static function serviceSlugUrl(){
        return array("ac-repair","cctv","chiming","deep-fridge","water-geyser","water-cooler",
            "room-heater","dish-washer","ice-maker","inverter","led-tv","mixer-grinder",
            "ro-water-purifier","oven-heater","kitchen-hub","vacuums-cleaner","carpentry",
            "electricians","furniture-installation","plumber","bathroom-cleaningcar-cleaning",
            "house-keeping","carpet-cleaning","kitchen-cleaning","office-cleaning","pest-control",
            "sewage-cleaning","water-tank","aluminium-partition","fabrication","architectural",
            "false-celling","modular-kitchen","waterproofing"
        );
    }

    static function getUser($id){
        return \App\Models\User::whereid($id)->first();
    }

    static function addUser($slug=""){
        return \App\Models\User::create([
            'name' => $slug,
            'email' => $slug,
            'password' => Hash::make($slug),
            'role_id'  => 1
        ]);
    }

    
    
    
}