<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class GoogleLogin extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try{
            $googleUser=Socialite::driver('google')->stateless()->user();
        }catch(\GuzzleHttp\Exception\ClientException $e){
            if($e->getResponse()->getStatusCode()===400){
                return redirect()->route('google.redirect');
            }
        }
        $user=User::where('email',$googleUser->email)->first();

        if(!$user){
            $user=User::create(['name'=>$googleUser->name,'email'=>$googleUser->email,'password'=> Hash::make(rand(100000,999999))])->first();
        }

        Auth::login($user);
        return redirect()->route('livewire.menu');
        
    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
