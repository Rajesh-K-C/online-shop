<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $data['setting'] = Setting::where('status', 1)->first();
        $data['categories'] = Category::getActiveCategories()->get();
//        dd($data);
        return view('frontend.index', compact('data'));
    }
}
