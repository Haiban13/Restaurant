<?php

namespace App\Http\Controllers;

use App\Models\UserCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserCookieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        
    }

    /**
     * Display the specified resource.
     */
    public function show(UserCookie $userCookie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserCookie $userCookie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserCookie $userCookie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserCookie $userCookie)
    {
        //
    }


    public function searchUser(){
        $cookie=Cookie::get("user_session");
        $user = UserCookie::where('cookie', $cookie)->first();

        if ($user === null) {
            // No user was found with this cookie
            dd('No user found with this cookie: ' . $cookie);
        }

        return $user;
    }
}
