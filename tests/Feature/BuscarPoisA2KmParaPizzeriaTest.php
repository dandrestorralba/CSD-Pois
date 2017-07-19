<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class BuscarPoisPorRadio extends TestCase
{


    private $x=1;
    private $y = 1;
    private $km = 2;
    /**
     * A basic test example.
     *
     * @return void
     */



    private function getPois() {

        $response = $this->get('/api/pizzerias/obtenerPoisPorRango/' . $this->x . '/' . $this->y . '/' . $this->km);

        return $response;

    }


    public function test1()
    {

        $response = $this->getPois();


        $result = $response->content();

        //dd(strpos($result,'cuarasasassa')!=false);    
        //dd(strpos($result,'cuartwww etas'));
        $this->assertTrue(strpos($result,'cuartetas')!=false);
          
       // $this->assertTrue(strpos($result,'palacio')!=false);
        




    
    }


   
}
