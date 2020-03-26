<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of DepositDetailController
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Http\Request;
use App\DepositDetail;
use App\Deposit;

class DepositDetailController extends Controller {

    public function index() {
        return response()->json([
                    "endpoint" => "Deposit"
        ]);
    }

    public function getAll() {
        $depositDetail = array();
        
        if($this->isCentralOffice()){
            $depositDetail = DepositDetail::get();
        }else{
            $depositDetail = DepositDetail::where('BranchCode',$this->auth->Branch_Code)->get();
        }
        
        return response()->json($depositDetail);
    }

    public function getOne($id) {
        $depositDetail = DepositDetail::find($id);
        return response()->json($depositDetail);
    }

    public function store(Request $request) {
        $isMulti = $this->isMultiArray(json_decode($request->getContent(), true));

        if ($isMulti) {
            $requestList = json_decode($request->getContent(), true);
            foreach ($requestList as $key => $value) {
                $this->__store($value);
            }
        } else {
            $this->__store($request->all());
        }

        return response()->json([
                    'message' => 'Successfull create new deposit details',
        ]);
    }

    /**
     * Store deposit detail
     * @param array $arr
     */
    private function __store($arr) {
        DepositDetail::create($arr);

        $branchCode = $arr['BranchCode'];
        $nominal = $arr['Nominal'];

        $deposit = Deposit::where('BranchCode', $branchCode)->first();
        if (!$deposit) {
            Deposit::create([
                'BranchCode' => $branchCode,
                'Nominal' => $nominal,
            ]);
        } else {
            $nominal = $deposit->Nominal + $nominal;
            $deposit->update([
                'BranchCode' => $branchCode,
                'Nominal' => $nominal,
            ]);
        }
    }

    public function update(Request $request, $id) {
        $depositDetail = DepositDetail::find($id);
        $depositDetail->update($request->all());

        return response()->json([
                    'message' => 'Successfull update deposit details'
        ]);
    }

    public function delete($id) {
        DepositDetail::destroy($id);

        return response()->json([
                    'message' => 'Successfull delete deposit details'
        ]);
    }

}
