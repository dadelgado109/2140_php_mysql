<?php

    require_once("modelos/alumnos_modelo.php");

    class controlador_alumnos{

        public static function listarAlumnos($recibe){

            $pagina = 0;
            if(isset($recibe['pagina']) && $recibe['pagina'] != "" && $recibe['pagina'] >= 1 && is_int($recibe['pagina'])){
                $pagina = $recibe['pagina'] - 1;
            }


            $objAlumnos = new alumnos_modelo();

            $filtros = array("pagina"=>$pagina);
            $listaAlumno = $objAlumnos->listar($filtros);

            return $listaAlumno;

        }

    }


?>