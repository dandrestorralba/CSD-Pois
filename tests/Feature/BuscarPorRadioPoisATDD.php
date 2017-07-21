<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class BuscarPorRadioPoisTest extends TestCase
{


    private $x=-34.603739;
    private $y = -58.38157;
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

    public function testDadoServicioPizzeriayRadio2KmEstandoenObeliscoDebeResponderCuartitoCuartetaPalacio()
    {
        $response = $this->getPois();
        $result = $response->content();
        //dd(strpos($result,'cuarasasassa')!=false);    
        //dd(strpos($result,'cuartwww etas'));
        
        $this->assertTrue(strpos($result,'palacio')!=-1);
        $this->assertTrue(strpos($result,'cuartito')!=-1);
        $this->assertTrue(strpos($result,'cuarteta')!=-1);
	$this->assertTrue(false);
    
    }


    public function testDadoServicioPizzeriayRadio0KmEstandoenObeliscoDebeResponderError()
    {

        $response = $this->getPois();
        $result = $response->content();


        $this->assertTrue(strpos($result,'EC3')!=-1);
            
    
    }


    


   
}
