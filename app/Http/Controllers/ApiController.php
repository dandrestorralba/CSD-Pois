<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Collection;


 

class ApiController extends Controller
{
	public $services;

	public function __construct() {
 
 		$this->services = collect([
 			'pizzerias'=>	['service'=> 'pizzerias',
                    'listPois'=>[
                        ['poi'=>'Las cuartetas', 'latX'=>'-34.60375', 'latY'=>'-58.378575'],
 				        ['poi'=>'El palacio de la pizza', 'latX'=>'-34.603325', 'latY'=>'-58.377335'],
 				        ['poi'=>'El cuartito', 'latX'=>'-34.597837', 'latY'=>'-58.385456']
                    ]],
 			'circuito-historico'=>	['service'=> 'circuito-historico',
                    'listPois'=>[
                        ['poi'=>'El cabildo', 'latX'=>'-34.608739', 'latY'=>'-58.373786'],
 				        ['poi'=>'San francisco', 'latX'=>'-34.610469', 'latY'=>'-58.371784'],
 				        ['poi'=>'Catedral BS AS', 'latX'=>'-34.607569', 'latY'=>'-58.373257']
                        ]
]                    ,
            'cablevision' => ['service'=> 'cablevision',
                'listPois'=>[
                    ]
                    ]
            ]
        );

	}



	public function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
	// Cálculo de la distancia en grados
	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
	// Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
	switch($unit) {
		case 'km':
			$distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
	}
	return round($distance, $decimals);
	}


 	function index($service, Request $request) {

 		$result = $this->services->where('service',$service)->all();

 		if (count($result))
 			return ["res"=>true, "code"=> "EC0", "items"=>$result];
 		return ["res"=>false, "code"=> "EC1", "msg"=>"El servicio no existe"];
 	


 	}



 	function poiMasCercano($service, $latX, $latY, Request $request) {


        if (!is_numeric($latX) or !is_numeric($latY) ){
            return ['res'=> false,"code"=> "EC2", 'msg'=>'Parametros invalidos'];
        }
        $result = $this->services->where('service',$service)->all();
        if (count($result)){



 		$min = 9999999;

 		$poiMin = [];
 		foreach ($result[$service]['listPois'] as $poi) {

 			$d = $this->distanceCalculation($latX, $latY, $poi['latX'], $poi['latY']);
 			
 			if ($d<=$min)	{

 				$min = $d;
 				$poiMin = $poi;
 			}
 		}

		return $poiMin;	

 	    }
        return ["res"=>false,"code"=> "EC1", "msg"=>"El servicio no existe"];
	}



 	function obtenerPoisPorRango($service, $latX, $latY, $km, Request $request) {


        if (!is_numeric($latX) or !is_numeric($latY) or !is_numeric($km)) {
            return ['res'=> false, 'code'=> "EC2", 'msg'=>'Parametros invalidos'];
        }

        if ($km<=0 ){
            return ['res'=> false, 'code'=> "EC3", 'msg'=>'KM debe ser mayor que 0'];
        }



        $result = $this->services->where('service',$service)->all();
        
        if (count($result)){

 		
	 		$pois = [];
	 		foreach ($result[$service]['listPois'] as $poi) {

	 			$d = $this->distanceCalculation($latX, $latY, $poi['latX'], $poi['latY']);
	 			
	 			if ($d<=$km)	{

	 				$min = $d;
	 				$pois[] = $poi;
	 			}
	 		}

	 		return ['res'=>true,"code"=> "EC0", 'items'=>$pois];	
	 	}

	 	return ["res"=>false, "code"=> "EC1", "msg"=>"El servicio no existe"];


 	 }		

}
