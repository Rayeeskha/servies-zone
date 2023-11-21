<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use DataTables;

class ContactusController extends Controller
{
    private $module_id = 'contactus';

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }


    public function index(Request $request){
    	if ($request->ajax()) {
            $data = Contact::select('id','name','email','phone','subject','message','created_at',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('created_at', function($row){
                    return date('d M Y',strtotime($row->created_at));                
                })->make(true);
        }
        return view('admin.contact_us.index');
	}


}
