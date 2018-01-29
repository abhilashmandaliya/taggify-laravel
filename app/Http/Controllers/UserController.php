<?php

namespace App\Http\Controllers;

use App\User;
use App\UserContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(request()->input('device'))
        {
            $user_contents = UserContent::where('user_id', (string) $user['id'])->get();
            return  json_encode([
                                'status' => 200,
                                'message' => 'Operation Successful',
                                'data' => $user_contents
                    ]);
        }
        $unique_tags = DB::connection('mongodb')->collection('user_contents')->distinct('tags')->get();
        $user_contents = UserContent::where('user_id', (string) $user['id'])->paginate($this->limit);
        if(request()->input('first'))
        {
            return view('user.index', ['unique_tags' => $unique_tags]);
        }
        return json_encode($user_contents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
