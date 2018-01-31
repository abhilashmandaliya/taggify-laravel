<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserContent;

class DataAnalysisController extends Controller
{
    public function getTagWiseCount(Request $request)
    {
        DB::connection('mongodb')->enableQueryLog();
        return json_encode(
                    UserContent::whereRaw(['aggregate' => array( [
                        'project' => array('tags' => 1), 
                        'unwind' => '$tags', 
                        'group' => array(
                            '_id' => '$tags', 
                            'count' => array(
                                'sum' => 1
                                )
                            )
                        ]
                    )
                ]
            )->get()
        );
        return json_encode( DB::connection('mongodb')->getQueryLog() );
    }
}
