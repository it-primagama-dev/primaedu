<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of LogController
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Http\Request;
use App\Logs;
use Carbon\Carbon;

class LogController extends Controller {

    public function index() {
        if(!$this->isCentralOffice()){
            return response('Unauthorized.', 401);
        }
        $logs = Logs::all();
        return response()->json($logs);
    }

}
