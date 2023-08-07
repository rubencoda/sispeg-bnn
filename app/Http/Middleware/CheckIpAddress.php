<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $officeNetworkIPRange = '127.0.0.1'; // Replace with your office network's IP range

            if (!$this->isOfficeNetwork($request->ip(), $officeNetworkIPRange)) {
                return redirect()->back()->with('error', 'Tidak Dapat Diakses karena anda diluar jaringan kantor');
            }
        } else {
            return redirect()->route('login')->with('error', 'Access denied. Please log in.');
        }

        return $next($request);
    }

    private function isOfficeNetwork($ip, $ipRange)
    {
        $officeNetworkCIDR = ip2long($ipRange);
        $userIP = ip2long($ip);

        return ($userIP & $officeNetworkCIDR) === ($officeNetworkCIDR & $officeNetworkCIDR);
    }
}
