<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Deposit
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model {

    protected $table = "FA_Deposit";
    protected $primaryKey = 'RecID';
    
    public $timestamps = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->EditDate = $model->freshTimestamp();
        });
    }

    protected $fillable = ['BranchCode', 'Nominal', 'EditBy'];
    public static $rules = [
        'BranchCode' => 'required',
        'Nominal' => 'required',
    ];

}
