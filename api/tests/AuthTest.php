<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthTest
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
use Illuminate\Http\Response;
class AuthTest extends TestCase {

    private $secretKey = "";
    private $body = array();
    
    public function __construct(){
        $this->secretKey = "PR1M494M4@DIGISYS.ID";
        $this->body = array(
            "Branch_Code" => 0000,
            "Created_By" => 'eric',
        );
    }
    
    public function testRegisterShouldReturnBadRequestWhenGivenInvalidSecretKey() {
        $this->json('POST', 'auth/register', 
                $this->body, ['Content-Type' => 'application/json', 'SECRET-KEY' => '123456789']);
        $this->assertResponseStatus(400);
    }
    
    public function testRegisterShouldReturnUnprocessableEntityWhenGivenInvalidBody() {
        $this->json('POST', 'auth/register', [], ['Content-Type' => 'application/json', 'SECRET-KEY' => $this->secretKey]);
        $this->assertResponseStatus(422);
    }
    
    public function testRegisterShouldReturnOKWhenGivenValidSecretKey(){
        $this->json('POST', 'auth/register', 
                $this->body, ['Content-Type' => 'application/json', 'SECRET-KEY' => $this->secretKey]);
        $this->assertResponseOk();
    }
    
    public function testRegisterShouldReturnApiKeyWhenSuccess(){
        $response = $this->json('POST', 'auth/register', 
                $this->body, ['Content-Type' => 'application/json', 'SECRET-KEY' => $this->secretKey])
                ->seeStatusCode(200)
                ->response->getContent();
        $data = json_decode($response, true);
        $this->assertArrayHasKey('api_key', $data);
    }
    
}
