<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller 
{ 
    /** 
     * Display login page. 
     * 
     * 
     * @return Renderable
     */
    public function show() {
        return view('auth.login');
    }


    /** 
     * Handle account login request 
     *  
     * @param LoginRequest $request 
     * 
     * @return \Illuminate\Http\Response 
    */
    public function login(LoginRequest $request) {
        $credentials = $request->getCredentials();
        
        if(!Auth::validate($credentials)):
            return redirect()->to('login') ->withErrors(trans('auth.failed'));
        endif; 

        $customer = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($customer);

        return $this->authenticated($request, $customer);
    }


    /** Handle response after customer authenticated * 
     *
     * @param Request $request * 
     * 
     * @param Auth $customer * 
     * 
     * @return \Illuminate\Http\Response 
     * 
     */
    protected function authenticated(Request $request, $customer) {
        return redirect()->intended();
    }



}
