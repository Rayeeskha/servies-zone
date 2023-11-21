<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use File;
use Auth;
use CustomHelper;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function uploadImage($fileName, $fileDirectory, $tablename= '', $args = '', $imageColumnName=''){
	   	if (empty($fileName) && empty($fileDirectory)) {
    		return false;
    	}

    	if (!empty($args)) {
    		$table = DB::table($tablename)->where($args)->first();
    		if(!empty($table->$imageColumnName)){
                if (session()->get('PROPERTY_ID_SESSION') !=  $args) {
                    if (file_exists($table->$imageColumnName)){
                        @unlink($table->$imageColumnName);
                        if ($tablename ==  'property_images') {
                            DB::table($tablename)->where($args)->delete();

                            session()->put('PROPERTY_ID_SESSION', $args);
                        }
                    }
                }
            }
    	}
    	$file_name = 'image_'.time().'_'.rand(1,100).'.'.$fileName->getClientOriginalExtension();

        $destinationPath = public_path($fileDirectory);
        if (! File::exists($destinationPath)){
            File::makeDirectory( $destinationPath );
        }
        $image_name = "$fileDirectory/".$file_name;
        $fileName->move( $destinationPath, $file_name );
       
        return $image_name;
	}

    public function authorizedAccessPermission($permission){
        $role_id = Auth::user()->role_id;
        $allPermission = false;
        if(!empty($role_id) && $role_id == '1'){
          $allPermission = true;
        }
        $group = CustomHelper::getUserRolePermission();

        if($allPermission || ((array_search($permission, array_column($group, 'module_id'))) !== false )){
            return true;
        }
        return abort(403);
    }






}
