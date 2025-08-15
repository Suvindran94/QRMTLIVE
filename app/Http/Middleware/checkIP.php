<?php

namespace App\Http\Middleware;

use Closure;

class checkIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
{
  
		/*
		$allowedIPs = [
        'plwconf.tplinkdns.com',
        'polywarevpn2017.ddns.net',
        'plantm.tplinkdns.com',
		'plantm2.tplinkdns.com',
        'polywarevpn2021.ddns.net',
        'plantp.ddns.net',
        'plantp2.ddns.net',
        'polywarevpn2019.ddns.net',
        'polywarevpn2022.ddns.net',
        'plantp.tplinkdns.com',
		'pws2024.ddns.net',
		'115.132.124.13',
		'60.49.188.185',
		'115.133.243.177',
		'27.125.240.20'
    ];
	*/
	

    $userIP = $_SERVER['REMOTE_ADDR'];
	
		
	
    //if (in_array(gethostbyname($userIP), array_map('gethostbyname', $allowedIPs))) {
        return $next($request);
    //}
    
    //abort(403,'Unauthorized Access! Please Contact BIS.');
		
		
}

    
}
