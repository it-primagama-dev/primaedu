<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

/**
 * Description of Security
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Closure;

class Security {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->header('SECRET-KEY') !== env("SECRET_KEY")) {
            return response('Bad Request.', 400);
        }

        return $next($request);
    }

}
