<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function perform()
    {

        $date = Carbon::now();

        $user = User::where('id',auth()->user()->id)->first();

        $user->update([
            'last_logout' => $date

        ]);

        Session::flush();
        
        Auth::logout();

        return redirect(route("login_guest"));
    }
}
