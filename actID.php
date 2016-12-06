<?php

ini_set("max_execution_time", 0);

$con = new mysqli('localhost', 'root', '', 'mantigua');

$loc = odbc_connect('loc', '', '');

$query = "select loc.locn_brcd, loc.tipo from loc";

$res = odbc_exec($loc, $query);

while(odbc_fetch_row($res)){
    $locacion = odbc_result($res, 1);
    $tipo = odbc_result($res, 2);

    $zona = str_split($locacion);
    $zona = $zona[0] . $zona[1] . $zona[2];

    $insertar = "insert into locaciones values ('$zona', '$locacion', '$tipo', 'Disponible para la venta', '')";

    if($con->query($insertar))
        echo "Se actualizo con exito<br>";
    else
        echo "Error " . $con->error . "<br>";
}