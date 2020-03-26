<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Auth;
use Illuminate\Http\Request;

class Controller extends BaseController {

    private $__apiKey = NULL;
    protected $auth;


    public function __construct(Request $request) {
        $this->__apiKey = $request->headers->has('API-KEY')?$request->header('API-KEY'):NULL;
        $this->auth = Auth::where('API_Key', $this->__apiKey)->first();
    }
    /**
     * Create a api key
     * @param $length the length of the string to create
     * @return $str the string
     */
    protected function generateApiKey($length = 20) {
        $key = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $key .= $characters[$rand];
        }
        if ($this->__apiKeyExists($key)) {
            return $this->generateApiKey();
        }
        return $key;
    }

    /**
     * Check api key
     * @param string $key
     * @return boolean
     */
    private function __apiKeyExists($key) {
        return Auth::where('API_Key', $key)->exists();
    }
    
    /**
     * Check is array multidimensional or not
     * @param array $arr
     * @return boolean
     */
    protected function isMultiArray($arr) {
        return isset($arr[0]) && is_array($arr[0]);
    }
    
    /**
     * Check is central office or not
     * @return boolean
     */
    protected function isCentralOffice(){
        return (trim($this->auth->Branch_Code) == trim(env('CENTRAL_OFFICE_CODE')));
    }

}
