<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of AuthController
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Http\Request;
use App\Auth;
use Carbon\Carbon;

class AuthController extends Controller {

    public function index() {
        return response()->json([
                    "endpoint" => "Auth"
        ]);
    }

    public function store(Request $request) {
        $apiKey = "";
        $branchCode = $request->input('Branch_Code');
        $createdBy = $request->input('Created_By');

        $this->validate($request, Auth::$rules);

        $auth = Auth::where('Branch_Code', $branchCode)->first();
        if (!$auth) {
            $apiKey = $this->generateApiKey();
            Auth::create([
                'API_Key' => $apiKey,
                'Branch_Code' => $branchCode,
                'Created_By' => $createdBy,
            ]);
        } else {
            $apiKey = $auth->API_Key;
            $auth->update(['Updated_At' => Carbon::now()]);
        }

        return response()->json([
                    'api_key' => $apiKey,
//            'debug' => $request->method()
        ]);
    }

}
