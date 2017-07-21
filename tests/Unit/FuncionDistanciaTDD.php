<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FuncionDistanciaEntreDosPuntosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
          */

    public function testSiSonElMismoPuntoDeberiaSerCero()
    {
    	$point1_lat=-34.60375;
    	$point1_long=-58.378575;

    	$point2_lat=-34.60375;
    	$point2_long=-58.378575;

    	$result = app('App\Http\Controllers\ApiController')->distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long);
        $this->assertTrue($result==0.0);
    }

    public function testCatedralYCablidoDeberiaSerMenosDemedioKM(){
    	$point1_lat=-34.608739;
    	$point1_long=-58.373786;

    	$point2_lat=-34.607569;
    	$point2_long=-58.373257;

    	$result = app('App\Http\Controllers\ApiController')->distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long);
        $this->assertTrue($result<=0.5);

    }
}

