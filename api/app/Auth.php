<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Auth
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Auth extends Model {

    protected $table = "API_Auth";
    protected $primaryKey = 'RecID';

    //const CREATED_AT = 'Created_At';
    //const UPDATED_AT = 'Updated_At';
    
    public $timestamps = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->Created_At = Carbon::now();
        });
    }

    protected $fillable = ['API_Key', 'Branch_Code', 'Created_By', 'Updated_By', 'Updated_At'];
    public static $rules = [
        'Branch_Code' => 'required|max:7',
        'Created_By' => 'required|max:50'
    ];

}
