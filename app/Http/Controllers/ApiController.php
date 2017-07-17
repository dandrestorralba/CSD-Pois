<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Collection;


 

class ApiController extends Controller
{
	public $services;

	public function __construct() {
 
 		$this->services = collect([
 				['service'=> 'pizzerias', 'poi'=>'Las cuartetas', 'latX'=>'-34.60375', 'latY'=>'-58.378575'],
 				['service'=> 'pizzerias', 'poi'=>'El palacio de la pizza', 'latX'=>'-34.603325', 'latY'=>'-58.377335'],
 				['service'=> 'pizzerias', 'poi'=>'El cuartito', 'latX'=>'-34.597837', 'latY'=>'-58.385456'],
 				['service'=> 'circuito historico', 'poi'=>'El cabildo', 'latX'=>'-34.608739', 'latY'=>'-58.373786'],
 				['service'=> 'circuito historico', 'poi'=>'San francisco', 'latX'=>'-34.610469', 'latY'=>'-58.371784'],
 				['service'=> 'circuito historico', 'poi'=>'Catedral BS AS', 'latX'=>'-34.607569', 'latY'=>'-58.373257'],
 				]);

}


 	function index($service, Request $request) {


 		$result = $this->services->where('service',$service)->all();
 		if (count($result))
 			return ["res"=>true,"pois"=>$result];
 		return ["res"=>false,"msg"=>"El servicio no existe"];
 			//dd($this->services->search());
 		//$this->services->search(function($item,$key) use ($service)	 {
 			//dd($item['service']);
 	


 	}
}
