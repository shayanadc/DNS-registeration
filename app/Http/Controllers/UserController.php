<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Http\Requests\UserRegisterRequest;
use App\Token;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAuthenticatedUser(){
        $user = Auth::user();
        if ($user) {
            $recordDomainIdsForUser = $user->records()->get()->pluck('domain_id');
            if(empty($recordDomainIdsForUser->toArray())){
                $user = $user->with('domains')->first();
            }else{
                $user = $user->with(['domains' => function ($query) use ($recordDomainIdsForUser){
                    $query->where('id', $recordDomainIdsForUser);
                }])->first();
            }
            return response()->json($user->toArray(),200);
        }
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                return response()->json(['api_token' => $user->api_token],200);
            }
        }
        return response()->json([
               'errors' => ['title' => 'Email or password is incorrect']
        ], 400);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(UserRegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'api_token' => Token::generate()
        ]);
        return response()->json($user, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
