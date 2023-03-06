<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{     
      public function loginPage()
      {
            if ( ! Auth::check() )
                 return redirect()->route('msPageLogin'); 

            return redirect()->route('msHome');
      }

      public function login ( LoginRequest $request )
      {
            $data = $request->validated();

            if ( Auth::attempt(['email' => $data['email'], 'password' => $data['password'] ]) ) {
                  return redirect('/'); // ->with('msg', 'Successfully logged');
            }
            return back()->withErrors([
                  'email' => 'The Provided credentials do not match.',
            ]);
      } 

     /**
       * Log the user out of the application.
       * 
       * @param \Illuminate\Http\Request $request
       * @return \Illuminate\Http\Response
       */
       
       public function logout(Request $request)
       {
             Auth::logout();

             $request->session()->invalidate();

             $request->session()->regenerateToken();

             return redirect()->route('msPageLogin');
       }

            

}
