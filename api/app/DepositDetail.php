<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of DepositDetail
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Database\Eloquent\Model;

class DepositDetail extends Model {

    protected $table = 'FA_DepositDetail';
    protected $primaryKey = 'RecID';

    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'EditDate';

    protected $appends = ['BranchCode'];
    protected $fillable = ['BranchCode', 'Nominal', 'Description', 'IsInOrOut', 'Status', 'CreatedBy', 'EditBy'];
    public static $rules = [
        'BranchCode' => 'required',
        'Nominal' => 'required',
        'Description' => 'required',
        'IsInOrOut' => 'required',
        'Status' => 'required',
    ];

    public function getBranchCodeAttribute() {
        return trim($this->attributes['BranchCode']);
    }

}
