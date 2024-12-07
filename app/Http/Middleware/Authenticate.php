<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $timeout = 240 * 60;  
            $lastActivity = session('last_activity', time());

            if ((time() - $lastActivity) > $timeout) {
                Auth::logout();  
                session()->flush();  
                return redirect()->route('login')->with('message', 'Sesi Anda telah kedaluwarsa. Silakan login kembali.');
            }

            session(['last_activity' => time()]);
        }

        return $next($request);
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('msg', 'Anda Telah Berhasil Logout');
    }
}
