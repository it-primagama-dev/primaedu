<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Number
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Phalcon\Tag;
class Number extends Tag  {
    public function round($number, $precision = 0, $mode = PHP_ROUND_HALF_UP)
    {
        return round($number, $precision, $mode); 
    }
    
    public function absolute($number)
    {
        return abs($number); 
    }
}
