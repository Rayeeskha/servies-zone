<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CustomHelper;

class SettingsController extends Controller
{
    public function __invoke($page){
    	$data = [];
    	switch ($page) {
            case 'services':
                $data['services'] = CustomHelper::getBookingLeadService();
                break;
        }
        return view('frontend.pages.static.'.$page, $data);
    }
}
