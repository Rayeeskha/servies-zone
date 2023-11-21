<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use CustomHelper;
use DataTables;
use Auth;

class PaymentController extends Controller
{
	// Khan Rayees Senior Software Engineer All right reserved
    private $module_id = 'PaymentDetails';

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }

    public function index(Request $request){
    	if ($request->ajax()) {
            \DB::statement("SET SQL_MODE=''");
    		$data = PaymentDetail::latest()->with('paymentBy:id,name as payment_by_name', 'electrician')->serviceActivationPermission()->select('id','electrician_id','payment_amount','number_of_leads','payment_by','created_at','service_activation_date','service_remarks',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->groupBy('electrician_id');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $viewPermission = CustomHelper::checkPermission($this->module_id, 'list_per');
                    $btn = ''; 
                    if ($viewPermission) {
                        $btn .= '<a href="'.route('admin.view-payment-details',@$row->electrician_id).'" class="btn btn-success btn-sm"><span class="fa fa-eye text-white"></span></a>';
                    }                                        
                    return $btn;
                })
                ->editColumn('created_at', function($row){
                    return date('d M Y',strtotime($row->created_at));
                
                })->editColumn('service_activation_date', function($row){
                    return date('Y-m-d',strtotime($row->service_activation_date));
                
                })->editColumn('payment_by', function($row){
                    return $row->paymentBy->payment_by_name ?? "N/A";
                
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
                })->rawColumns(['service_remarks', 'action'])->make(true);
        }
        return view('admin.service_activation.payment_details');
    }


    public function paymentDetails(Request $request, $electricianId=""){
        $paymentDetails = PaymentDetail::with('paymentBy:id,name as payment_by_name', 'electrician')->serviceActivationPermission()->select('id','electrician_id','payment_amount','number_of_leads','payment_by','created_at','service_activation_date','service_remarks')->whereelectrician_id($electricianId)->get();
        $electrician = CustomHelper::getUser($electricianId);
        return view('admin.service_activation.view_payment_details', compact('electrician', 'paymentDetails'));
    }


}
