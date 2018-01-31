<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserContent;

class DataAnalysisController extends Controller
{
    public function getTagWiseCount(Request $request)
    {
        //DB::connection('mongodb')->enableQueryLog();
        
    }
}
