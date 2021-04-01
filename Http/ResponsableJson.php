<?php

namespace HermesHerrera\Http;

use Illuminate\Contracts\Support\Responsable;

class ResponsableJson implements Responsable {

    protected $datos;
    protected $codeHtml;
    protected $mensaje;
    protected $otrosDatos;

    public function __construct($codeHtml, $datos = null, $mensaje = null, $otrosDatos = null){

        $this->datos        = $datos;
        $this->codeHtml     = $codeHtml;
        $this->mensaje      = $mensaje;
        $this->otrosDatos   = $otrosDatos;

    }

    public function toResponse($request){

        $datos = null;

        if ( $this->mensaje ) {

            $datos['mensaje'] =$this->mensaje;
        }

        if ( $this->datos ) {

            $datos['datos'] = $this->datos;

        }

        if ( $this->otrosDatos ) {

            $datos = $this->otrosDatos;

        }

        return response()->json($datos, $this->codeHtml);

    }
}
