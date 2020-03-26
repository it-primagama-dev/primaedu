<?php

class outstanding extends \Phalcon\Mvc\Model
{

    
    public $KodeCabang;

   
    public $Area;

   
    public $NoPR;


    public $Tgl;

  
    public $jml;
	
	
	public $TotalPayment;
	  
	public $Payment;
		  
	public $OutstandingPayment;

    
    public function columnMap()
    {
        return array(
            'KodeCabang' => 'KodeCabang', 
            'Area' => 'Area', 
            'NoPR' => 'NoPR', 
            'Tgl' => 'Tgl', 
            'Jml' => 'Jml',
			'TotalPayment'=>'TotalPayment',
			'Payment'=>'Payment',
			'Outstandingpayment'=>'Outstandingpayment'
        );
    }

}
