<?php

namespace App\Http\Controllers;

use App\UserContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GCPVisionAPI;

class UserContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user_contents.index');
        $userContent = DB::connection('mongodb')->collection('user_contents')->get();
        return json_encode($userContent);
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
        $fileName = $request->file('content')->store('content');
        $tags = array_merge($request->input('tags'), $gcp_vision_api->getImageLabels($fileName));
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

        return json_encode(['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserContent  $userContent
     * @return \Illuminate\Http\Response
     */
    public function show(UserContent $userContent)
    {
        //
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
}
