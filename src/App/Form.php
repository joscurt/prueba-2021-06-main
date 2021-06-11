<?php

namespace App;

class Form
{

    /**
     * Clase generadora de formulario
     */
     function __construct() {

	    }
    public static function generate(): string
    {
        // añade tu código aquí
        $dataform = file_get_contents("./schema.json");

        if( !is_array($dataform) ) {
			       $dataform = json_decode( $dataform, true );
        }
        // var_dump($dataform);exit;

        $formulario = '<form>';

        // Recorro el array que contiene los elementos q se crean en el formulario
        // dejo la variable $key pq el esquema los usa como label
        foreach($dataform["properties"] as $key => $datainput ){
          $myForm = new Form();
          $formulario .= $myForm->crearInput($datainput, $key);
        }

        $formulario .= '</form>';

        return $formulario;
    }

    function crearInput($datainput, $key){

      if( !is_array($datainput) ) {
			     $datainput = json_decode( $datainput, true );
        }
        $cinput = '';
        $cinputparametros = '';

        //ejecuto la funcion createLabel() para asignar al input respectivo , detecta el nombre posterior a la etiqueta properties que es la $key del array(formato schema xD)
        if( isset( $key ) ) {
          // var_dump($key);exit;
            $datainput["label"] = $key;
            $label = $this->crearLabel( $datainput["label"] );
            $cinput .= $label;
          }

        // Creo el Select del schema, consulto si existe la etiqueta "enum" y luego recorro para listar los values
        if(isset($datainput["enum"])) {
        // $cinputparametros = $datainput["enum"];
  			$cinput .= '<div class="select is-primary">'.PHP_EOL;
  			// $inputparams .= 'class="select is-primary"'.PHP_EOL;
  			$cinput .= '<select '.$cinputparametros.' />'.PHP_EOL;

  			foreach( $datainput["enum"] as $option ) {
  				// var_dump($option);exit;
  				$cinput .= '<option value="'.$option.'">'.$option.'</option>'.PHP_EOL;
  			}

  			$cinput .= '</select><br></div>'.PHP_EOL;

  		}

  		elseif (isset($datainput["format"])){
  			$cinput .= '<div class="select is-primary">'.PHP_EOL;
  			$cinputparametros = "type=date".PHP_EOL;
  			$cinputparametros .= "class=form-control".PHP_EOL;
  			$cinputparametros .= 'placeholder='.$key.PHP_EOL;
  			$cinput .= '<input '.$cinputparametros.'/>'.PHP_EOL;
  			$cinput .= '</select><br></div>'.PHP_EOL;
  		}
  		 else {
  			//Si no es un select creo un input clásico
  			$cinputparametros .= "class=input".PHP_EOL;
  			$cinputparametros .= 'placeholder='.$key.PHP_EOL;
  			$cinput .= '<input '.$cinputparametros.'/>'.PHP_EOL;
  		}
      return $cinput;
    }
    function crearLabel($datalabel){

      if(is_array($datalabel)){
        $datalabel = json_decode($datalabel,true);
      }
      $datalabel = '<label '.$datalabel.'>'.$datalabel.'</label>'.PHP_EOL;
      return $datalabel;
    }
}
