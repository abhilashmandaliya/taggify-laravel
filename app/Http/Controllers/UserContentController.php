<?php

namespace App\Http\Controllers;

use App\UserContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GCPVisionAPI;

class UserContentController extends Controller
{

    /**
     * Limit for paginated data
     * 
     * @var int $limit
     */
    private $limit;

    public function __construct()
    {
        $this->limit = 7;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->input('device'))
        {
            return json_encode([
                                'status' => 200,
                                'message' => 'Success! Get All user contents',
                                'data' => UserContent::get()
                                ]);
        }
        $unique_tags = DB::connection('mongodb')->collection('user_contents')->distinct('tags')->get();
        if(request()->input('tags'))
        { 
            $data = request()->all();            
            $filter_tags = json_decode($data['tags']);
            if(is_null($filter_tags))
            {
                $filter_tags = array($data['tags']);
            }
            $temp = $filter_tags;
            $filter_tags = array();
            for ($i = 0; $i < count($temp); ++$i) {
                array_push($filter_tags, (string)$temp[$i]);                
            }
            if(request()->input('first'))
            {
                $_REQUEST['page'] = 0;
            }
            //$user_contents = DB::connection('mongodb')->collection('user_contents')->whereIn('tags', $filter_tags)->get();
            $user_contents = DB::connection('mongodb')->collection('user_contents')->whereIn('tags', $filter_tags)->paginate($this->limit);
            if(request()->input('first'))
            {
                return view('user_contents.index', ['unique_tags' => $unique_tags, 'user_contents' => $user_contents, 'tags' => json_encode($filter_tags)]);
            }
            return json_encode($user_contents);
        }
        else
        {
            $user_contents = DB::connection('mongodb')->collection('user_contents')->paginate($this->limit);
        }
        if(request()->input('first'))
        {
            return view('user_contents.index', ['unique_tags' => $unique_tags, 'user_contents' => $user_contents]);
        }
        return json_encode($user_contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gcp_vision_api = new GCPVisionAPI();
        $fileName = $request->file('content')->store('/');
        Storage::move("$fileName", "public/$fileName");
        //$tags = $this->parseTags($request->input('tags'), $gcp_vision_api->getImageLabels($fileName));
        $tags = $this->parseTags($request->input('tags'));
        $user_id = $request->input('user_id');
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = $created_at;

        $user_content = [
            'user_id' => $user_id,
            'file_name' => $fileName,
            'tags' => $tags,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];

        $id = UserContent::create($user_content)->id;

        return json_encode(['status' => 200, 'id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserContent  $userContent
     * @return \Illuminate\Http\Response
     */
    public function show(UserContent $userContent)
    {
        return json_encode(request()->route('user_content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserContent  $userContent
     * @return \Illuminate\Http\Response
     */
    public function edit(UserContent $userContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserContent  $userContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserContent $userContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserContent  $userContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserContent $userContent)
    {
        //
    }

    public function parseTags($mobile_tags_string, $gcp_tags = array())
    {
        $mobile_tags = array_merge(explode(" ", $mobile_tags_string), $gcp_tags);
        $mobile_tags_final = array();

        foreach ($mobile_tags as $tag) 
        {
            if(strlen($tag) > 0)
            {
                array_push($mobile_tags_final, preg_replace('/\s+/', '', $tag));
            }
        }

        $temp =  $gcp_tags;
        $gcp_tags = array();

        foreach ($temp as $tag) 
        {
            if(strlen($tag) > 0)
            {
                array_push($gcp_tags, preg_replace('/\s+/', '', $tag));
            }
        }

        return array_values(array_unique(array_merge($mobile_tags_final, $gcp_tags)));
    }

}
