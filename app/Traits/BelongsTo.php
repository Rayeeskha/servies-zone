<?php 

namespace App\Traits;
use Auth;

trait BelongsTo{

	public function role(){
		return $this->belongsTo('App\Models\RoleMaster', 'role_id', 'id');
	}

	public function user(){
		return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}

    public function addedBy(){
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }

    public function electrician(){
        return $this->belongsTo('App\Models\User', 'electrician_id', 'id');
    }

    public function paymentBy(){
        return $this->belongsTo('App\Models\User', 'payment_by', 'id');
    }
	
	public function scopePermission($query){
    	if (Auth::user()->role_id == 1) {
    		return $query;
    	}elseif (Auth::user()->role_id == 5) {            
            return $query->whereassign_electrician_id(Auth::user()->id);
        }else{
    		return $query->whereIn('lead_service_id', explode(',',Auth::user()->lead_service_id));
    	}
    }

    public function scopeElectricianPermission($query){
        if (Auth::user()->role_id == 1) {
            return $query;
        }elseif (Auth::user()->role_id == 5) {            
            return $query->whereassign_electrician_id(Auth::user()->id);
        }else{
            return $query->where('added_by', Auth::user()->id);
        }
    }

    public function scopeLeadPermission($query){
        if (Auth::user()->role_id == 1) {
            return $query;
        }else{
            return $query->whereIn('id', explode(',',Auth::user()->lead_service_id));
        }
    }

    public function scopeServiceActivationPermission($query){
        if (Auth::user()->role_id == 1) {
            return $query;
        }else{
            return $query->where('payment_by', Auth::user()->id);
        }
    }


    public function state(){
    	return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    public function city(){
    	return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    public function leadService(){
    	return $this->belongsTo('App\Models\LeadService', 'lead_service_id', 'id');
    }
	

	

}