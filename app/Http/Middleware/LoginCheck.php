<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $emp = User::where('email',$request->email)->where('status',1)->first();

        if ($emp) {

            if (Hash::check($request->pass,$emp->password)) {
                session([
                    'name' => $emp->name,
                    'user_id' => $emp->user_id,
                    'email' => $emp->email,
                    'role' => $emp->is_admin,
                ]);

                if ($emp->is_admin == 1) {
                    return redirect()->route('dashboard');
                }
                elseif ($emp->is_admin == 2) {
                    return redirect()->route('profile');
                } else {
                    return redirect()->route('/')->with('msg','<div class="alert alert-warning" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Something is wrong!
                        </div>');
                }

            } else{
                return redirect()->route('/')->with('msg','<div class="alert alert-danger" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Email or Password did not matched!
                        </div>');
            }
        }
            return redirect()->route('/')->with('msg','<div class="alert alert-danger" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Your are not an user!
                        </div>');
        }

}
