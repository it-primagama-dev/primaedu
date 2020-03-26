<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

/**
 * Description of Auth
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Closure;
use App\Auth as APIAuth;
use App\Logs;
class Auth {
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        if(!$request->headers->has('API-KEY')){
            return response('Bad Request.', 400);
        }
        
        $auth = APIAuth::where('API_Key', $request->header('API-KEY'))->first();
        if (!$auth) {
            return response('Unauthorized.', 401);
        }
        
        //Log everything incoming request
        $activity = array(
            "url" => $request->url(),
            "method" => $request->method(),
            "input" => $request->input()
        );
        Logs::create([
            "API_Key" => $request->header('API-KEY'),
            "Branch_Code" => $auth->Branch_Code,
            "Activity" => json_encode($activity)
        ]);

        return $next($request);
    }
}
