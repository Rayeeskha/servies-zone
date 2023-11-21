<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CustomHelper;
use DataTables;
use App\Models\LeadInquiry;
use Auth;
use Illuminate\Support\Facades\Validator;

class LeadInquiryController extends Controller
{
    private $module_id = 'Leads';

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }


    public function index(Request $request){
        if ($request->ajax()) {
    		$data = LeadInquiry::with('state:id,states_name', 'city:id,districts_name', 'leadService:id,service_name')->permission()->select('id','name','phone','lead_service_id','country_id','state_id','city_id','location','assign_electrician_id','employee_feedback','electrician_feedback','created_at',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC'); 

    		return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $deletePermission = CustomHelper::checkPermission($this->module_id, 'delete_per');
                    $btn = ''; 
                    if ($deletePermission) {
                        $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-danger btn-sm deleteDataTableRow"><span class="fa fa-trash text-white"></span></a>';
                    }
                    return $btn;
                })->editColumn('state_id', function($row){
                    return $row->state->states_name ?? "N/A";
                
                })->editColumn('city_id', function($row){
                    return $row->city->districts_name ?? "N/A";
                
                })->editColumn('lead_service_id', function($row){
                    return $row->leadService->service_name ?? "N/A";
                
                })->editColumn('created_at', function($row){
                    return date('d M Y',strtotime($row->created_at));
                
                })->editColumn('employee_feedback', function($row){
                    $employeeFeedBack = "<a href='javascript:void(0)' class='badges bg-lightgreen' style='color:white' onclick=feedBackModal(".$row->id.",'employee') >Feedback</a>";
                    if (!empty($row->employee_feedback)) {
                        $employeeFeedBack = $row->employee_feedback ?? 'N/A';
                    }
                    return $employeeFeedBack;
                
                })->editColumn('electrician_feedback', function($row){
                    $electricianFeedBack = "<a href='javascript:void(0)'  class='badges bg-lightgreen' style='color:white' onclick=feedBackModal(".$row->id.",'electronic')>Feedback</a>";
                    if (!empty($row->electrician_feedback)) {
                        $electricianFeedBack = $row->electrician_feedback ?? 'N/A';
                    }
                    return $electricianFeedBack;
                
                })->filter(function ($instance) use ($request) {
                    $instance->when($request->start_date, function($w) use ($request){
                        $w->dateFilter($request->start_date, $request->end_date);
                    
                    })->when($request->lead_service_id, function($w) use ($request){
                        $w->wherelead_service_id($request->lead_service_id);

                    })->when($request->state_id, function($w) use ($request){
                        $w->wherestate_id($request->state_id);

                    })->when($request->city_id, function($w) use ($request){
                        $w->wherecity_id($request->city_id);
                    });
                })->rawColumns(['action', 'employee_feedback', 'electrician_feedback'])->make(true);
    	}
    	return view('admin.lead_inquiry.index');
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'feedback'   => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        try {

            if ($request->slug == 'employee') {
                $data['employee_feedback'] = $request->feedback; 

            }elseif($request->slug == 'electronic'){
                $data['electrician_feedback'] = $request->feedback;
            }
            LeadInquiry::whereid($request->id)->update($data);
            
            return response()->json([ 'success' => true,'message' => 'Feedback added successfully !','url'=>''],200); 

        }catch (Throwable $e)  {
            return response()->json(['error'=>$e->getMessage()]);
        }
    }




}
