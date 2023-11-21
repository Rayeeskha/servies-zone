<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models;
use CustomHelper;
use Auth;
class CommonController extends Controller
{
	public function deleteDataTableRow(){
        if(request()->ajax()){
            $chek_foreign = '';
            $data = '';
            $ex = explode('-',request()->data);
            if(count($ex) !=2){
                return response()->json(['status' => 'error', 'error' => 'Record not found']);
            }
            $table = isset($ex[1]) ? $ex[1]:'';
            $id = isset($ex[0]) ? $ex[0]:'';
            switch ($table) {
                case "role_masters":
                    $data = \App\Models\RoleMaster::find($id);
                    break;
                case "employees":
                    $data = \App\Models\User::find($id);
                    break; 
                case "service_activation":
                    $data = \App\Models\ServiceActivation::find($id);
                    \App\Models\ServiceActivation::whereid($id)->update(['deleted_by' => Auth::user()->id]);
                    break; 
                case "lead_inquiries":
                    $data = \App\Models\LeadInquiry::find($id);
                    break;                                 
            }
            if(!is_null($data)){
                if ($chek_foreign > 0) {
                    return response()->json(['status' => 'error', 'error' =>'delete first child']);
                }
                if($data->delete()){
                    return response()->json(['status' => 'success','message' => 'Record deleted successfully']);
                }else{
                    return response()->json(['status' => 'error', 'error' => 'Record not found']); 
                }
            }else{
                return response()->json(['status' => 'error', 'error' => 'Record not found']); 
            }
        }
    }

    public function changeDataTableStatus(Request $request){
        if(request()->ajax()){
            $data = '';
            $ex = explode('-',request()->data);
            if(count($ex) !=2){
                return response()->json(['success' =>false, 'error' => 'Record not found!'],201);
            }
            $table = isset($ex[1]) ? $ex[1]:'';
            $id = isset($ex[0]) ? $ex[0]:'';
            switch ($table) {
                case "role_masters":
                    $data = Models\RoleMaster::find($id);
                    break;
                case "employees":
                    $data = \App\Models\User::find($id);
                    break;                        
            }
            if(!is_null($data)){
                $data->status = $data->status == 1 ? 0 : 1;
                $data->save();
                return response()->json(['success' =>true, 'message' => 'Updated Successfully!','status'=>$data->status],200);
            }else{
                return response()->json(['success' =>'error', 'error' => 'opps! Something went wrong !'],201); 
            }
        }
    }

    public function getCities($state_id){
        $cities = \App\Models\City::orderBy('districts_name', 'ASC')->where(['states_id' => $state_id])->get();
        return response()->json([ 'cities' => $cities ]);
    }

}