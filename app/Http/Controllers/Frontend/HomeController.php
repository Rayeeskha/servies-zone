<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadService;

class HomeController extends Controller
{
    public function __invoke(){
    	session()->forget('SERVICE_ID');
    	$services = LeadService::wherestatus(1)->get();    	
		return view('frontend.index', compact('services'));
    }
}
