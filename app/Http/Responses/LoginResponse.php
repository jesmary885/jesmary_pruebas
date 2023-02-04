<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse {
  
       /* if ($request->user()->status == 'activo') {
            return redirect(route("home"));
        }
      
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route("login_guest"));*/

        if ($request->user()->status == 'activo') {

            $request->session()->regenerate();
            $previous_session = Auth::User()->session_id;
            if ($previous_session) {
                Session::getHandler()->destroy($previous_session);
            }

            $user= User::where('id',Auth::user()->id)->first();
            $user->session_id = Session::getId();
            $user->save();

            return redirect(route("home")) ?: redirect(route("login_guest"));
        }

        else{
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route("login_guest"));
        }
    }
}