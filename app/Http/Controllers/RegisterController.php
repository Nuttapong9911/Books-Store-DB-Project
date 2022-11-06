<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Customer;

class RegisterController extends Controller
{

    /**
    * Display register page.
    * 
    * @return \Illuminate\Http\Response
    */
    public function show()
    {
        return view('auth.register');
    }


    /**
    * Handle account registration request
    * 
    * @param RegisterRequest $request
    * 
    * @return \Illuminate\Http\Response
    */
    public function register(RegisterRequest $request) 
    {
        $customer = Customer::create($request->validated());
        auth()->login($customer);
        return redirect('/')->with('success', "Account successfully registered.");
    }
}
