<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function registerRequest($token, Request $request)
    {
        //return "<script>window.onload = function () {window.location = 'agendanikah://register-relation';}</script>";
        $user = \App\User::where('registered_token', $token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }
        
        if ($user->gender == \App\User::GENDER_MALE) {
            $relation = $user->userRelation->femaleUser;
        } else {
            $relation = $user->userRelation->maleUser;
        }
        
        return view('web.site.register-request', compact('user', 'relation'));
    }
    
    public function proccessRegisterRequest(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'registered_token' => 'required|exists:user,registered_token',
            'phone' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);
        
        $user = \App\User::where('registered_token', $request->registered_token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }
        
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->status = \App\User::STATUS_ACTIVE;
        $user->registered_token = null;
        $user->save();
        
        $user->sendRegisterNotification();
        
        \Session::flash('success', 'Registrasi telah sukses, Silahkan Anda menggunakan Akun ini untuk masuk ke Aplikasi ' . config('app.name') . '. (Available on the App Store)');
        
        return redirect('success');
    }
    
    public function resetPassword(Request $request)
    {
        $token = $request->get('token', null);
        if ($token == null) {
            abort(404, 'Page is not found.');
        }
        
        $user = \App\User::where('forgot_token', $token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }

        return view('web.site.reset-password', compact('user'));
    }
    
    public function proccessResetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);
        
        $user = \App\User::where('forgot_token', $request->forgot_token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }
        
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->forgot_token = null;
        $user->save();
        
        \Session::flash('success', 'Reset Password Sukses');
        
        return redirect('success');
    }
    
    public function success(Request $request)
    {
        return view('web.site.success');
    }
}
