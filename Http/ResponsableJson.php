<?php

namespace HermesHerrera\LaravelTools\Http;

use Illuminate\Contracts\Support\Responsable;

class ResponsableJson implements Responsable {

    protected $datos;
    protected $codeHtml;
    protected $mensaje;
    protected $datosArray;

    public function __construct($codeHtml, $datos = null, $mensaje = null, $datosArray = null){

	$this->datos = $datos;
	$this->datosArray = $datosArray;
        $this->codeHtml = $codeHtml;
        $this->mensaje = $mensaje;
    }

    public function toResponse($request)
    {
	$datos = $this->datos;

	if ( $datos ) {
	    if ( property_exists( $datos, 'collection' ) && gettype( $datos->collection ) === 'object' ){
		$datos = $datos->resource;
	    } else if ( property_exists( $datos, 'resource' ) && gettype( $datos->resource ) === 'object' ){
		$datos = $datos;
	    }
	}

	if ( $this->mensaje ){
	    if ( $datos ){
		$datos = [
		    'mensaje' => $this->mensaje,
		    'datos' => $datos
		];
	    } else {
		$datos = [
		    'mensaje' => $this->mensaje
		];
	    }
	}

        return response()->json($datos, $this->codeHtml);
    }
}
