<?php

require_once 'stocktotal.php';
require_once 'stocknodisp.php';
require_once 'mercaderia_antigua.php';
require_once 'tabla_retiquetado.php';
require_once 'calc_pm.php';
require_once 'comp_div.php';
require_once 'comp_pm.php';

ini_set("max_execution_time", 0);

$ubicacion = trim(strtoupper($_POST['ubicacion']));
$tipo = $_POST['tipo'];
$locacion = trim($_POST['locacion']);
$detalle = trim($_POST['detalle']);

if($ubicacion != '') {
    if($tipo != 'vacio') {
        if($locacion != 'vacio') {
            $con = new mysqli('localhost', 'root', '', 'mantigua');

            $query = "select ubicacion from locaciones where ubicacion = '$ubicacion'";

            $res = $con->query($query);

            $esta = mysqli_num_rows($res);

            if($esta == 0) {
                $zona = str_split($ubicacion);

                $zona = $zona[0] . $zona[1] . $zona[2];

                $query = "insert into locaciones values ('$zona', '$ubicacion', '$tipo', '$locacion', '$detalle')";

                $res = $con->query($query);

                if($res){
                    echo "¡Locación se agregó correctamente!";
                }else{
                    echo "Error al agregar ubicación. Error número " . $con->errno;
                }
            }else{
                echo "Esta ubicación ya se encuentra en la base.";
            }
        }else{
            echo "Seleccione locación válida";
        }
    }else{
        echo "Seleccione un tipo de ubicación válido.";
    }
}else{
    echo "Debe escribir una ubicación.";
}
