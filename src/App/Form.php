<?php

namespace App;

class Form
{
    /**
     * Clase generadora de formulario
     */
    public static function generate(): string
    {
        // añade tu código aquí
        $dataform = file_get_contents("./schema.json");

        if( !is_array($dataform) ) {
			       $dataform = json_decode( $dataform, true );
        }
        // var_dump($dataform);exit;

        $formulario = '<form>';
        $formulario .= '</form>';

        return $formulario;
    }
}
