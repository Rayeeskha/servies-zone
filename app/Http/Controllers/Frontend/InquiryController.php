<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InquiryRequest;
use App\Http\Requests\ContactUsRequest;
use App\Models\LeadInquiry;
use App\Models\LeadService;
use App\Models\Contact;

class InquiryController extends Controller
{
    public function index(){
        $serviceId = session()->get('SERVICE_ID');
    	$view = view('frontend.pages.lead_inquiry_services', compact('serviceId'))->render();
    	return response()->json(['status' => 200,'inquiryPage' => $view]);
    }

    public function bookLeadService(InquiryRequest $request){
    	$input = $request->validated();
    	try {
    		LeadInquiry::create($input);
            return response()->json([ 'success' => true,'message' => 'Inquiry send successfully !','url'=>''],200);
    	}catch (Throwable $e)  {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()]);
        }
    }

    public function servicesRouting($slug){
        $service = LeadService::whereslug($slug)->first();
        session()->put('SERVICE_ID', @$service->id);
        return view('frontend.pages.service_roting', compact('service'));
    }

    public function contactUs(ContactUsRequest $request){
        $input = $request->validated();
        try {
            Contact::create($input);
            return response()->json([ 'success' => true,'message' => 'Inquiry send successfully !','url'=>''],200);
        }catch (Throwable $e)  {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()]);
        }
    }
    



}
