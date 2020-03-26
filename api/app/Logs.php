<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Logs
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Logs extends Model {

    protected $table = "API_Logs";
    protected $primaryKey = "RecID";
    public $timestamps = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->Created_At = Carbon::now();
        });
    }
    
    protected $fillable = ['API_Key', 'Branch_Code', 'Activity'];
    public static $rules = [
        'API_Key' => 'required',
        'Branch_Code' => 'required',
        'Activity' => 'required',
    ];

}
