<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleMaster;
use Illuminate\Support\Facades\Validator;
use Auth;
use CustomHelper;
use DataTables;


class RoleMasterController extends Controller
{
    /**
     * Display a listing of the resource.
        Khan Rayees All right reserved
     */
    private $module_id = 'RolePermission';

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }

    public function index(Request $request)
    {        
        if ($request->ajax()) {
            $data = RoleMaster::select('id','name','permissions','status','created_at',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->whereNotIn('id',[5])->orderBy('id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $deletePermission = CustomHelper::checkPermission($this->module_id, 'delete_per');
                    $editPermission = CustomHelper::checkPermission($this->module_id, 'edit_per');
                    $btn = ''; 
                    if ($editPermission) {
                       $btn = '<a href="'.route('admin.role-master.edit', $row->id).'" class="edit btn btn-info btn-sm"><span class="fa fa-edit text-white"></span></a>';
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

                })->addColumn('permissions', function($row){
                    $permissionsData= [];
                    if (!empty($row->permissions)) {
                        $permissions = json_decode($row->permissions, true);
                        // Decode object when use true convert to arry
                        foreach($permissions as $value){
                            array_push($permissionsData, @$value['module_id']);
                        }
                    }
                    return implode(',', $permissionsData);
                    
                })->rawColumns(['action', 'status'])->make(true);
        }
        $addPermission = CustomHelper::checkPermission($this->module_id, 'add_per');
        return view('admin.role_master.index', compact('addPermission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role_master.create')->with('modules', CustomHelper::getModules());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
                'role_name' => 'required',
                'module_id' => 'required',
            ],
            ['module_id.required' => ' Atleast one previlege is required']
        );
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        try {
            $moduleData = [];
            if (!empty($data['module_id'])) {
                foreach($data['module_id'] as $key => $value){
                    $add = $value.'_add';
                    $edit = $value.'_edit';
                    $view = $value.'_view';                     
                    $status = $value.'_status';
                    $delete = $value.'_delete';
                    // $list = $value.'_view';
                    $add_per = (isset($request->$add))?1:0;
                    $edit_per = (isset($request->$edit))?1:0;
                    $view_per = (isset($request->$view))?1:0;
                    $status_per = (isset($request->$status))?1:0;
                    $delete_per = (isset($request->$delete))?1:0;
                    // $list_per = $list;
                    $moduleData[] =  [
                        'module_id' => $value,
                        'add_per' => $add_per,                        
                        'edit_per' => $edit_per,
                        'view_per' => $view_per,
                        'status_per' => $status_per,
                        'delete_per' => $delete_per,
                    ];
                }
            }
            $permissions = json_encode($moduleData);

            RoleMaster::updateOrCreate(['id' => $request->id], [
                'name' => $request->role_name,
                'description' => $request->role_description,
                'permissions' => $permissions,
                'status'      => 1
            ]);
            $message = $request->id > 0 ? 'Updated Sucessfully' : 'Added Successfully';

            return response()->json([ 'success' => true,'message' => $message,'url'=>route('admin.role-master.index')],200);

        }catch (\Throwable $e)  {
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleMaster $roleMaster)
    {
        $previllage = json_decode($roleMaster->permissions, true);
        $modules = CustomHelper::getModules();
        return view('admin.role_master.edit', compact('modules','roleMaster', 'previllage'));
    }

    
}
