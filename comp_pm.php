<?php

function compararPMmht($local, $fecha){
    ini_set('max_execution_time', 0);

    $ventas = new mysqli('localhost', 'root', '', 'ventas');

    $query = "select distinct pm from depto where pm <> '' order by pm asc";

    $res = $ventas->query($query);

    $pm = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $pm[$i] = $row['pm'];
        $i++;
    }

    $local->query("delete from com_pm_mht where fecha = $fecha");

    $query = "select sum(disponible*cosprom) as stockcosto, sum(disponible) as stockunidades, pm
              from antigua where antiguedad BETWEEN 0 and 3 and fecha = $fecha and tipo in ('Activo', 'Case Pick') group by pm";

    $res = $local->query($query);

    $verPM03 = array();
    $mht03   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM03[$i] = $row['pm'];
        $mht03[$i][0] = $row['stockcosto'];
        $mht03[$i][1] = $row['stockunidades'];
        $mht03[$i][2] = $fecha . $verPM03[$i] . "0 - 3";
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM03)) {
            $verPM03[$i] = $item;
            $mht03[$i][0] = 0;
            $mht03[$i][1] = 0;
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM03)){
            $k = array_search($item, $verPM03);
            $insertar = "insert into com_pm_mht values ($fecha, '" . $mht03[$k][2] . "', '$item', " . $mht03[$k][0] . ", " . $mht03[$k][1] . ", 0, 0, '0 - 3')" ;
            $res = $local->query($insertar);
            if(!$res) {
                echo "Error en com_pm_03. " . $local->error . "<br>";
            }
        }
    }

    $query = "select sum(disponible*cosprom) as stockcosto, sum(disponible) as stockunidades, pm
              from antigua where antiguedad BETWEEN 0 and 3 and fecha = $fecha and tipo in ('Reserva') group by pm";

    $res = $local->query($query);

    $verPM03 = array();
    $mht03   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM03[$i] = $row['pm'];
        $mht03[$i][0] = $row['stockcosto'];
        $mht03[$i][1] = $row['stockunidades'];
        $mht03[$i][2] = $fecha . $verPM03[$i] . "0 - 3";
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM03)) {
            $verPM03[$i] = $item;
            $mht03[$i][0] = 0;
            $mht03[$i][1] = 0;
            $mht03[$i][2] = $fecha . $verPM03[$i] . "0 - 3";
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM03)){
            $k = array_search($item, $verPM03);
            $actualizar = "update com_pm_mht set stockncosto = " . $mht03[$k][0] . " where llave = '" . $mht03[$k][2] . "'";
            $res = $local->query($actualizar);
            if(!$res)
                $local->error;
            $actualizar = "update com_pm_mht set stocknunidades = " . $mht03[$k][1] . " where llave = '" . $mht03[$k][2] . "'";
            $res = $local->query($actualizar);
            if(!$res)
                $local->error;
        }
    }

    $query = "select sum(disponible*cosprom) as stockcosto, sum(disponible) as stockunidades, pm
              from antigua where antiguedad BETWEEN 4 and 5 and fecha = $fecha and tipo in ('Activo', 'Case Pick') group by pm";

    $res = $local->query($query);

    $verPM45 = array();
    $mht45   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM45[$i] = $row['pm'];
        $mht45[$i][0] = $row['stockcosto'];
        $mht45[$i][1] = $row['stockunidades'];
        $mht45[$i][2] = $fecha . $verPM45[$i] . "4 - 5";
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM45)) {
            $verPM45[$i] = $item;
            $mht45[$i][0] = 0;
            $mht45[$i][1] = 0;
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM45)){
            $k = array_search($item, $verPM45);
            $insertar = "insert into com_pm_mht values ($fecha, '" . $mht45[$k][2] . "', '$item', " . $mht45[$k][0] . ", " . $mht45[$k][1] . ", 0, 0,  '4 - 5')" ;
            $res = $local->query($insertar);
            if(!$res) {
                echo "Error en com_pm_45. " . $local->error . "<br>";
            }
        }
    }

    $query = "select sum(disponible*cosprom) as stockcosto, sum(disponible) as stockunidades, pm
              from antigua where antiguedad BETWEEN 4 and 5 and fecha = $fecha and tipo in ('Reserva') group by pm";

    $res = $local->query($query);

    $verPM45 = array();
    $mht45   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM45[$i] = $row['pm'];
        $mht45[$i][0] = $row['stockcosto'];
        $mht45[$i][1] = $row['stockunidades'];
        $mht45[$i][2] = $fecha . $verPM45[$i] . "4 - 5";
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM45)) {
            $verPM45[$i] = $item;
            $mht45[$i][0] = 0;
            $mht45[$i][1] = 0;
            $mht45[$i][2] = $fecha . $verPM45[$i] . "4 - 5";
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM45)){
            $k = array_search($item, $verPM45);
            $actualizar = "update com_pm_mht set stockncosto = " . $mht45[$k][0] . " where llave = '" . $mht45[$k][2] . "'";
            $res = $local->query($actualizar);
            if(!$res)
                $local->error;
            $actualizar = "update com_pm_mht set stocknunidades = " . $mht45[$k][1] . " where llave = '" . $mht45[$k][2] . "'";
            $res = $local->query($actualizar);
            if(!$res)
                $local->error;
        }
    }

    $query = "select sum(disponible*cosprom) as stockcosto, sum(disponible) as stockunidades, pm
              from antigua where antiguedad >= 6 and fecha = $fecha and tipo in ('Activo', 'Case Pick') group by pm";

    $res = $local->query($query);

    $verPM6 = array();
    $mht6   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM6[$i] = $row['pm'];
        $mht6[$i][0] = $row['stockcosto'];
        $mht6[$i][1] = $row['stockunidades'];
        $mht6[$i][2] = $fecha . $verPM6[$i] . "+6";
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM6)) {
            $verPM6[$i] = $item;
            $mht6[$i][0] = 0;
            $mht6[$i][1] = 0;
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM6)){
            $k = array_search($item, $verPM6);
            $insertar = "insert into com_pm_mht values ($fecha, '" . $mht6[$k][2] . "', '$item', " . $mht6[$k][0] . ", " . $mht6[$k][1] . ", 0, 0, '+6')" ;
            $res = $local->query($insertar);
            if(!$res) {
                echo "Error en com_pm_6. " . $local->error . "<br>";
            }
        }
    }

    $query = "select sum(disponible*cosprom) as stockcosto, sum(disponible) as stockunidades, pm
              from antigua where antiguedad >= 6 and fecha = $fecha and tipo in ('Reserva') group by pm";

    $res = $local->query($query);

    $verPM6 = array();
    $mht6   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM6[$i] = $row['pm'];
        $mht6[$i][0] = $row['stockcosto'];
        $mht6[$i][1] = $row['stockunidades'];
        $mht6[$i][2] = $fecha . $verPM6[$i] . "+6";
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM6)) {
            $verPM6[$i] = $item;
            $mht6[$i][0] = 0;
            $mht6[$i][1] = 0;
            $mht6[$i][2] = $fecha . $verPM6[$i] . "+6";
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM6)){
            $k = array_search($item, $verPM6);
            $actualizar = "update com_pm_mht set stockncosto = " . $mht6[$k][0] . " where llave = '" . $mht6[$k][2] . "'";
            $res = $local->query($actualizar);
            if(!$res)
                $local->error;
            $actualizar = "update com_pm_mht set stocknunidades = " . $mht6[$k][1] . " where llave = '" . $mht6[$k][2] . "'";
            $res = $local->query($actualizar);
            if(!$res)
                $local->error;
        }
    }

    return true;
}

function compararPMeom($local, $fecha){
    ini_set('max_execution_time', 0);

    $ventas = new mysqli('localhost', 'root', '', 'ventas');

    $query = "select distinct pm from depto where pm <> '' order by pm asc";

    $res = $ventas->query($query);

    $pm = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $pm[$i] = $row['pm'];
        $i++;
    }

    $local->query("delete from com_pm_eom where fecha = $fecha");

    $query = "select sum(disp*cosprom) as stockdisp, sum(disp) as disp, sum(nodisp*cosprom) as stocknodisp, sum(nodisp) as nodisp,
                     sum(asignado*cosprom) as stockasig, sum(asignado) as asig, sum(stockseg*cosprom) as stockss, sum(stockseg) as ss, pm
              from eombase where antiguedad BETWEEN 0 and 3 and fecha = $fecha group by pm";

    $res = $local->query($query);

    $verPM03 = array();
    $mht03   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM03[$i] = $row['pm'];
        $mht03[$i][0] = $row['stockdisp'];
        $mht03[$i][1] = $row['disp'];
        $mht03[$i][2] = $fecha . $verPM03[$i] . "0 - 3";
        $mht03[$i][3] = $row['stocknodisp'];
        $mht03[$i][4] = $row['nodisp'];
        $mht03[$i][5] = $row['stockasig'];
        $mht03[$i][6] = $row['asig'];
        $mht03[$i][7] = $row['stockss'];
        $mht03[$i][8] = $row['ss'];
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM03)) {
            $verPM03[$i] = $item;
            $mht03[$i][0] = 0;
            $mht03[$i][1] = 0;
            $mht03[$i][2] = $fecha . $verPM03[$i] . "0 - 3";
            $mht03[$i][3] = 0;
            $mht03[$i][4] = 0;
            $mht03[$i][5] = 0;
            $mht03[$i][6] = 0;
            $mht03[$i][7] = 0;
            $mht03[$i][8] = 0;
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM03)){
            $k = array_search($item, $verPM03);
            $insertar = "insert into com_pm_eom values ($fecha, '" . $mht03[$k][2] . "', '$item', " . $mht03[$k][0] . ", " . $mht03[$k][1] . ", " . $mht03[$k][3] . ", " .
                         $mht03[$k][4] . ", " . $mht03[$k][5] . ", " . $mht03[$k][6] . ", " . $mht03[$k][7] . ", " . $mht03[$k][8] . ", '0 - 3')" ;
            $res = $local->query($insertar);
            if(!$res) {
                echo "Error en com_pm_03. " . $local->error . "<br>";
            }else
                echo "Se inserto con exito com_pm_03<br>";
        }
    }

    $query = "select sum(disp*cosprom) as stockdisp, sum(disp) as disp, sum(nodisp*cosprom) as stocknodisp, sum(nodisp) as nodisp,
                     sum(asignado*cosprom) as stockasig, sum(asignado) as asig, sum(stockseg*cosprom) as stockss, sum(stockseg) as ss, pm
              from eombase where antiguedad BETWEEN 4 and 5 and fecha = $fecha group by pm";

    $res = $local->query($query);

    $verPM03 = array();
    $mht03   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM03[$i] = $row['pm'];
        $mht03[$i][0] = $row['stockdisp'];
        $mht03[$i][1] = $row['disp'];
        $mht03[$i][2] = $fecha . $verPM03[$i] . "4 - 5";
        $mht03[$i][3] = $row['stocknodisp'];
        $mht03[$i][4] = $row['nodisp'];
        $mht03[$i][5] = $row['stockasig'];
        $mht03[$i][6] = $row['asig'];
        $mht03[$i][7] = $row['stockss'];
        $mht03[$i][8] = $row['ss'];
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM03)) {
            $verPM03[$i] = $item;
            $mht03[$i][0] = 0;
            $mht03[$i][1] = 0;
            $mht03[$i][2] = $fecha . $verPM03[$i] . "4 - 5";
            $mht03[$i][3] = 0;
            $mht03[$i][4] = 0;
            $mht03[$i][5] = 0;
            $mht03[$i][6] = 0;
            $mht03[$i][7] = 0;
            $mht03[$i][8] = 0;
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM03)){
            $k = array_search($item, $verPM03);
            $insertar = "insert into com_pm_eom values ($fecha, '" . $mht03[$k][2] . "', '$item', " . $mht03[$k][0] . ", " . $mht03[$k][1] . ", " . $mht03[$k][3] . ", " .
                $mht03[$k][4] . ", " . $mht03[$k][5] . ", " . $mht03[$k][6] . ", " . $mht03[$k][7] . ", " . $mht03[$k][8] . ", '4 - 5')" ;
            $res = $local->query($insertar);
            if(!$res) {
                echo "Error en com_pm_45. " . $local->error . "<br>";
            }else
                echo "Se inserto con exito com_pm_45<br>";
        }
    }

    $query = "select sum(disp*cosprom) as stockdisp, sum(disp) as disp, sum(nodisp*cosprom) as stocknodisp, sum(nodisp) as nodisp,
                     sum(asignado*cosprom) as stockasig, sum(asignado) as asig, sum(stockseg*cosprom) as stockss, sum(stockseg) as ss, pm
              from eombase where antiguedad >= 6 and fecha = $fecha group by pm";

    $res = $local->query($query);

    $verPM03 = array();
    $mht03   = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $verPM03[$i] = $row['pm'];
        $mht03[$i][0] = $row['stockdisp'];
        $mht03[$i][1] = $row['disp'];
        $mht03[$i][2] = $fecha . $verPM03[$i] . "+6";
        $mht03[$i][3] = $row['stocknodisp'];
        $mht03[$i][4] = $row['nodisp'];
        $mht03[$i][5] = $row['stockasig'];
        $mht03[$i][6] = $row['asig'];
        $mht03[$i][7] = $row['stockss'];
        $mht03[$i][8] = $row['ss'];
        $i++;
    }

    foreach($pm as $item){
        if(!in_array($item, $verPM03)) {
            $verPM03[$i] = $item;
            $mht03[$i][0] = 0;
            $mht03[$i][1] = 0;
            $mht03[$i][2] = $fecha . $verPM03[$i] . "+6";
            $mht03[$i][3] = 0;
            $mht03[$i][4] = 0;
            $mht03[$i][5] = 0;
            $mht03[$i][6] = 0;
            $mht03[$i][7] = 0;
            $mht03[$i][8] = 0;
            $i++;
        }
    }

    foreach($pm as $item){
        if(in_array($item, $verPM03)){
            $k = array_search($item, $verPM03);
            $insertar = "insert into com_pm_eom values ($fecha, '" . $mht03[$k][2] . "', '$item', " . $mht03[$k][0] . ", " . $mht03[$k][1] . ", " . $mht03[$k][3] . ", " .
                $mht03[$k][4] . ", " . $mht03[$k][5] . ", " . $mht03[$k][6] . ", " . $mht03[$k][7] . ", " . $mht03[$k][8] . ", '+6')" ;
            $res = $local->query($insertar);
            if(!$res) {
                echo "Error en com_pm_6. " . $local->error . "<br>";
            }else
                echo "Se inserto con exito com_pm_6<br>";
        }
    }

    return true;
}