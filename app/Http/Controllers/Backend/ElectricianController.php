<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ElectricianRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use CustomHelper;
use DataTables;
use Auth;

class ElectricianController extends Controller
{
	private $module_id = 'Electrician';

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }

    public function index(Request $request){
    	if ($request->ajax()) {
            $data = User::with('state:id,states_name', 'city:id,districts_name', 'addedBy:id,name')->electricianPermission()->whereis_electrician('1')->select('id','electrician_id','lead_service_id','name','email','profile','number','work_experience','status','state_id','city_id','added_by','created_at',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $deletePermission = CustomHelper::checkPermission($this->module_id, 'delete_per');
                    $editPermission = CustomHelper::checkPermission($this->module_id, 'edit_per');
                    $btn = ''; 
                    if ($editPermission) {
                       $btn = '<a href="'.route('admin.electrician.edit', $row->id).'" class="edit btn btn-info btn-sm"><span class="fa fa-edit text-white"></span></a>';
                    }                                       
                    if ($deletePermission) {
                        $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-danger btn-sm deleteDataTableRow"><span class="fa fa-trash text-white"></span></a>';
                    }
                    return $btn;
                })->editColumn('status', function($row){
                    $statusPermission = CustomHelper::checkPermission($this->module_id, 'status_per');                    
                    $active = $row->status == '1' ? "checked" : '';
                    $x = ($active) ? " switch3-checked " : " ";
                    $permissionAction = $statusPermission ? "status_change_datatable" : '';
                    return '<label class="switch3'.$x.'" id="switch'.$row->id.'">
                        <input type="checkbox" '.$active.' name="status" id="status'.$row->id.'" class="'.$permissionAction.'">
                        <div></div></label>'; 

                })->editColumn('created_at', function($row){
                    return date('d M Y',strtotime($row->created_at));
                
                })->editColumn('added_by', function($row){
                    return $row->addedBy->name ?? "N/A";
                
                })->editColumn('state_id', function($row){
                    return $row->state->states_name ?? "N/A";
                
                })->editColumn('city_id', function($row){
                    return $row->city->districts_name ?? "N/A";
                
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

                })->addColumn('profile', function($row){
                  return '<img src="'.asset($row->profile).'" style="border-radius:50%; height:50px; width:50px" />';

                })->rawColumns(['action', 'status', 'profile'])->make(true);
        }
        $addPermission = CustomHelper::checkPermission($this->module_id, 'add_per');
        return view('admin.electrician.index', compact('addPermission'));
	}

	public function create(){
        return view('admin.electrician.create');
	}

	public function store(ElectricianRequest $request){
		$request->validated(); 
		try {
            $id = $request->id;
            $user = new User();
            $message = 'Added Successfully';
            if ($id > 0) {
                $user = User::find($id);
                $message = 'Updated Successfully';
            }  
            foreach ($request->all() as $key => $value) {
                if(in_array($key, $user->getFillable())){
                    $user->$key = $value;
                }
            }

            $user->lead_service_id = !empty($request->lead_services_id) ?  implode(',', $request->lead_services_id) : '';

            if ($request->hasfile('profile')) {
                $user->profile = $this->uploadImage($request->file('profile'), 'uploads/images/profile', 'users', ['id' => $id ], 'profile');                
            }

            $user->is_electrician = '1'; $user->role_id = 5; $user->added_by = Auth::user()->id; $user->save(); 

            $unque_id = 'E'.sprintf('%06d',$user->id); 

            User::whereid($user->id)->update(['electrician_id' => $unque_id, 'password' => Hash::make($unque_id)]);
            
            return response()->json(['success' => true,'message' => $message,'url'=>route('admin.electrician.index')],200);

        }catch (Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
	}

    public function edit($id){
        return view('admin.electrician.create')->with('user', User::with('city:id,districts_name')->find($id));
    }



}
