<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranslatorController extends Controller
{
    public function translate($words=null)
    {
        $client = new \Guzzle\Service\Client('https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180201T064355Z.d3bdc2bd4961c6ff.02ab67724a5fa2aeba4e406eb9ad5fafdd1f9cb1&text=yellow&lang=hi');

        $response = $client->get();

        dd($response);
    }
}
