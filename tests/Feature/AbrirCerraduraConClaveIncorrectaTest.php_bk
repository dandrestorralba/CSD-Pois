<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
* 
*/
class Cerradura 
{
	
	function __construct($clave)
	{
		$this->clave = $clave;

	}

		public function abrir(){
			
		}

		public function estaAbierta(){
			return false;
		}

}

class AbrirCerraduraConClaveIncorrectaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAbrirCerraduraConClaveIncorrecta()
    {
    	//Creacion
    	$cerradura = new Cerradura(1234);
        //Ejecucion
        $cerradura->abrir(1233);
        //Validacion
        $this->assertFalse($cerradura->estaAbierta());
    }
}
