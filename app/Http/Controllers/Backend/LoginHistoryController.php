<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginHistoryLog;
use DataTables;

class LoginHistoryController extends Controller
{
	private $module_id = 'loginHistory';

	public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }

    public function index(Request $request){
    	if ($request->ajax()) {
            $data = LoginHistoryLog::with('user:id,name,role_id')->leftJoin('users', 'users.id', '=','login_histories_log.user_id')->select('login_histories_log.id','login_histories_log.user_id','login_histories_log.ip_address','login_histories_log.user_agent','login_histories_log.created_at','users.role_id', \DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->where('users.role_id', '!=', '1')->orderBy('login_histories_log.id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('created_at', function($row){
                    return date('d M Y h:i:s',strtotime($row->created_at));

                })->editColumn('user_id', function($row){
                    return $row->user->name ?? 'N/a';

                })->addColumn('role_id', function($row){
                    return $row->user->role->name ?? 'N/a';

                })->make(true);
        }
        return view('admin.login_logs.index');
    }
    
}
