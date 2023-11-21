<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use CustomHelper;
use DataTables;

class EmployeeController extends Controller
{
	/**
     * Display a listing of the resource.
        Khan Rayees All right reserved
     */
    private $module_id = 'Employee';

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }

	public function index(Request $request){
		if ($request->ajax()) {
            $data = User::with('role:id,name')->select('id','name','email','profile','number','role_id','lead_service_id','status','created_at',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->whereis_electrician('0')->where('role_id', '!=', 1)->orderBy('id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $deletePermission = CustomHelper::checkPermission($this->module_id, 'delete_per');
                    $editPermission = CustomHelper::checkPermission($this->module_id, 'edit_per');
                    $btn = ''; 
                    if ($editPermission) {
                       $btn = '<a href="'.route('admin.employee.edit', $row->id).'" class="edit btn btn-info btn-sm"><span class="fa fa-edit text-white"></span></a>';
                    }                                       
                    if ($deletePermission) {
                        $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-danger btn-sm deleteDataTableRow"><span class="fa fa-trash text-white"></span></a>';
                    }
                    return $btn;
                })->editColumn('status', function($row){
                    $statusPermission = CustomHelper::checkPermission($this->module_id, 'status_per');
                    
                    $active = $row->status == 1 ? "checked" : '';
                    $x = ($active) ? " switch3-checked " : " ";
                    $permissionAction = $statusPermission ? "status_change_datatable" : '';
                    return '<label class="switch3'.$x.'" id="switch'.$row->id.'" onchange="xyz('.$row->id.')">
                        <input type="checkbox" '.$active.' name="status" id="status'.$row->id.'" class="'.$permissionAction.'">
                        <div></div></label>'; 

                })->editColumn('created_at', function($row){
                    return date('d M Y',strtotime($row->created_at));
                })->addColumn('role_id', function($row){
                    return $row->role->name ?? 'N/a';
                })->addColumn('profile', function($row){
                  return '<img src="'.asset($row->profile).'" style="border-radius:50%; height:50px; width:50px" />';
                })->addColumn('lead_service_id', function($row){
                    $servicesData = [];
                    $leadServiceId = !empty($row->lead_service_id) ? explode(',',$row->lead_service_id) : '';
                    if (!empty($row->lead_service_id)) {
                        $services = CustomHelper::getUserAssignLeadServices($leadServiceId);
                        if (isset($services)) {
                            foreach($services as $service){
                                array_push($servicesData, $service->service_name);
                            }
                        }                        
                    }
                    return implode(',', $servicesData);                    

                })->rawColumns(['action', 'status', 'profile'])->make(true);
        }
        $addPermission = CustomHelper::checkPermission($this->module_id, 'add_per');
        return view('admin.employees.index', compact('addPermission'));
	}

	public function create(){
        return view('admin.employees.create')->with('roles', CustomHelper::getRoles());
	}

    public function store(EmployeeRequest $request){
        $input = $request->validated(); 
        try {
            $id = $request->id;
            
            if ($request->hasfile('profile')) {
                $image = $this->uploadImage($request->file('profile'), 'uploads/images/profile', 'users', ['id' => $id ], 'profile');                
                $input['profile'] = $image;
            }

            $input['password'] = Hash::make($request->password); 
            
            if (empty($request->password) || $request->password  == '') {
                $userDetail =  User::whereid($id)->first();
                $input['password']   = $userDetail->password;
            }

            $input['lead_service_id'] = !empty($request->lead_services_id) ?  implode(',', $request->lead_services_id) : '';
            
            User::updateOrCreate(['id' => $id], $input);

            $message = $id > 0 ? 'Updated Sucessfully' : 'Added Successfully';

            return response()->json(['success' => true,'message' => $message,'url'=>route('admin.employee.index')],200);

        }catch (Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }        
    }

    public function edit($id){
        $user = User::find($id);
        $roles = CustomHelper::getRoles();
        return view('admin.employees.create', compact('user', 'roles'));
    }


    
}
