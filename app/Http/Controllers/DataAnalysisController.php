<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserContent;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DataAnalysisController extends Controller
{
    public function getTagWiseCount(Request $request)
    {
        $process = new Process('call C:/Users/Public/test.bat');
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }

    public function getDistinctTags()
    {
        $tags = UserContent::distinct('tags')->get();
        return view('analysis.distinct', ['tags' => $tags]);
    }
}
