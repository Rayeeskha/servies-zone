<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceActivation;
use App\Models\PaymentDetail;
use App\Http\Requests\ServiceActivationRequest;
use CustomHelper;
use DataTables;
use Auth;
class ServiceActivationController extends Controller
{
    // Khan Rayees All right reserved
    
    private $module_id = 'ServiceActivation';

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }


    public function index(Request $request){
    	if ($request->ajax()) {
            $data = ServiceActivation::with('paymentBy:id,name as payment_by_name', 'electrician')->serviceActivationPermission()->select('id','electrician_id','payment_amount','number_of_leads','payment_by','created_at','service_activation_date','service_remarks',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $deletePermission = CustomHelper::checkPermission($this->module_id, 'delete_per');
                    $editPermission = CustomHelper::checkPermission($this->module_id, 'edit_per');
                    $viewPermission = CustomHelper::checkPermission($this->module_id, 'list_per');
                    $btn = ''; 
                    if ($viewPermission) {
                        $btn .= '<a href="'.route('admin.view-payment-details',@$row->electrician_id).'" class="btn btn-success btn-sm"><span class="fa fa-eye text-white"></span></a>';
                    }
                    if ($editPermission) {
                       $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="edit btn btn-info btn-sm editServiceActivationData"><span class="fa fa-edit text-white"></span></a>';
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
                    return '<label class="switch3'.$x.'" id="switch'.$row->id.'" onchange="xyz('.$row->id.')">
                        <input type="checkbox" '.$active.' name="status" id="status'.$row->id.'" class="'.$permissionAction.'">
                        <div></div></label>'; 

                })->editColumn('created_at', function($row){
                    return date('d M Y',strtotime($row->created_at));
                
                })->editColumn('service_activation_date', function($row){
                    return date('Y-m-d',strtotime($row->service_activation_date));
                
                })->editColumn('payment_by', function($row){
                    return $row->paymentBy->payment_by_name ?? "N/A";
                
                })->addColumn('electrician_unique_id', function($row){
                    return $row->electrician->electrician_id ?? "N/A";
                
                })->addColumn('electrician_name', function($row){
                    return $row->electrician->name ?? "N/A";
                
                })->addColumn('electrician_number', function($row){
                    return $row->electrician->number ?? "N/A";
                
                })->addColumn('state', function($row){
                    return $row->electrician->state->states_name ?? "N/A";
                
                })->addColumn('city', function($row){
                    return $row->electrician->city->districts_name ?? "N/A";
                
                })->addColumn('service_remarks', function($row){
                    $serviceType =  "<span class='badge badge-danger' style='background-color:green'>".$row->service_remarks."</span>";
                    if ($row->service_remarks == 'Reneval') {
                        $serviceType =   "<span class='badge badge-danger' style='background-color:orange'>".$row->service_remarks."</span>";
                    }                    
                    return $serviceType;                
                })->rawColumns(['action','service_remarks', 'status'])->make(true);
        }
        $addPermission = CustomHelper::checkPermission($this->module_id, 'add_per');
        return view('admin.service_activation.index', compact('addPermission'));
    }


    public function getElectricianDetail($electricianId){
        $electrician = \App\Models\User::with('state:id,states_name', 'city:id,districts_name')->whereid($electricianId)->first();
        $state = $electrician->state->states_name ?? "N/A";
        $city = $electrician->city->districts_name ?? "N/A";
        $electricianId = $electrician->electrician_id ?? 'N/A';
        return response()->json([ 'state' => $state, 'city' => $city, 'electricianId' => $electricianId ]);
    }

    public function getAllElectrician(){
      $electricians = \App\Models\User::select('id', 'name')->where(['is_electrician' => '1', 'status' => 1])->get();
      return response()->json([ 'electricians' => $electricians ]);  
    }

    public function store(ServiceActivationRequest $request){
        $input =  $request->validated();
        try {
            $id = $request->id;
            
            $input['payment_by'] = Auth::user()->id;

            $serviceActivation = ServiceActivation::updateOrCreate(['id' => $id], $input);

            $input['service_activation_id'] = @$serviceActivation->id;

            PaymentDetail::create($input);

            $message = $id > 0 ? 'Service Activated Updated Sucessfully' : 'Service Activated Successfully';

            return response()->json(['success' => true,'message' => $message,'url'=>route('admin.service-activation.index')],200);
        }catch (Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


}
