<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepositDetailTest
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
class DepositDetailTest extends TestCase{
    private $apiKey = "";
    private $body = array();
    public function __construct() {
        $this->apiKey = "";
        $this->body = array(
            
        );
    }
    
    public function testGetAllShouldReturnUnauthorizedWhenGivenInvalidApiKey(){
        $this->json('GET', 'deposit/details', [], ['Content-Type' => 'application/json', 'API-KEY' => '123456789']);
        $this->assertResponseStatus(401);
    }
    
    public function testGetAllShouldReturnBadRequestWhenNotGivenApiKey(){
        $this->json('GET', 'deposit/details', [], ['Content-Type' => 'application/json']);
        $this->assertResponseStatus(400);
    }
}
