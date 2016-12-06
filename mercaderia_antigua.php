<?php

function mercaderiaAntigua($local, $dia)
{
    ini_set('max_execution_time', 0);
    date_default_timezone_set("America/Asuncion");

    $local->query("delete from mercaderia_antigua where dia = $dia");

    $division = array('HOMBRES', 'DEPORTES', 'MUJER', 'ACCESORIOS', 'INFANTIL', 'TECNOLOGIA', 'DECO-HOGAR', 'ELECTRO-HOGAR', 'OTROS');

    //Esto no es una matriz, es una arreglo unidireccional

    $antiguedad = array(0, 0, 0, 0, //HOMBRES
                        0, 0, 0, 0, //DEPORTES
                        0, 0, 0, 0, //MUJER
                        0, 0, 0, 0, //ACCESORIOS
                        0, 0, 0, 0, //INFANTIL
                        0, 0, 0, 0, //TECNOLOGIA
                        0, 0, 0, 0, //DECO-HOGAR
                        0, 0, 0, 0, //ELECTRO-HOGAR
                        0, 0, 0, 0); //OTROS

    $i = 0;

    foreach($division as $item){
        $query = "select sum(disponible*cosprom) as total from antigua where division = '$item' and antiguedad between 0 and 3 and fecha = $dia and tipo in ('Activo', 'Case Pick')";

        $res = $local->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $antiguedad[$i] = 0;
            if($row['total'] != NULL)
                $antiguedad[$i] = $row['total'];
            $i++;
        }

        $query = "select sum(disponible*cosprom) as total from antigua where division = '$item' and antiguedad between 4 and 5 and fecha = $dia and tipo in ('Activo', 'Case Pick')";

        $res = $local->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $antiguedad[$i] = 0;
            if($row['total'] != NULL)
                $antiguedad[$i] = $row['total'];
            $i++;
        }

        $query = "select sum(disponible*cosprom) as total from antigua where division = '$item' and antiguedad between 0 and 5 and fecha = $dia and tipo in ('Activo', 'Case Pick')";

        $res = $local->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $antiguedad[$i] = 0;
            if($row['total'] != NULL)
                $antiguedad[$i] = $row['total'];
            $i++;
        }

        $query = "select sum(disponible*cosprom) as total from antigua where division = '$item' and antiguedad >= 6 and fecha = $dia and tipo in ('Activo', 'Case Pick')";

        $res = $local->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $antiguedad[$i] = 0;
            if($row['total'] != NULL)
                $antiguedad[$i] = $row['total'];
            $i++;
        }
    }

    $cos03hombres = $antiguedad[0];
    $cos45hombres = $antiguedad[1];
    $cos05hombres = $antiguedad[2];
    $cos6hombres  = $antiguedad[3];

    $cos03deportes = $antiguedad[4];
    $cos45deportes = $antiguedad[5];
    $cos05deportes = $antiguedad[6];
    $cos6deportes  = $antiguedad[7];

    $cos03mujer = $antiguedad[8];
    $cos45mujer = $antiguedad[9];
    $cos05mujer = $antiguedad[10];
    $cos6mujer  = $antiguedad[11];

    $cos03accesorios = $antiguedad[12];
    $cos45accesorios = $antiguedad[13];
    $cos05accesorios = $antiguedad[14];
    $cos6accesorios  = $antiguedad[15];

    $cos03infantil = $antiguedad[16];
    $cos45infantil = $antiguedad[17];
    $cos05infantil = $antiguedad[18];
    $cos6infantil  = $antiguedad[19];

    $cos03tecnologia = $antiguedad[20];
    $cos45tecnologia = $antiguedad[21];
    $cos05tecnologia = $antiguedad[22];
    $cos6tecnologia  = $antiguedad[23];

    $cos03decohogar = $antiguedad[24];
    $cos45decohogar = $antiguedad[25];
    $cos05decohogar = $antiguedad[26];
    $cos6decohogar  = $antiguedad[27];

    $cos03electrohogar = $antiguedad[28];
    $cos45electrohogar = $antiguedad[29];
    $cos05electrohogar = $antiguedad[30];
    $cos6electrohogar  = $antiguedad[31];

    $cos03otros = $antiguedad[32];
    $cos45otros = $antiguedad[33];
    $cos05otros = $antiguedad[34];
    $cos6otros  = $antiguedad[35];

    $cos03total = $cos03hombres + $cos03deportes + $cos03mujer + $cos03accesorios + $cos03infantil + $cos03tecnologia + $cos03decohogar + $cos03electrohogar + $cos03otros;

    $cos45total = $cos45hombres + $cos45deportes + $cos45mujer + $cos45accesorios + $cos45infantil + $cos45tecnologia + $cos45decohogar + $cos45electrohogar + $cos45otros;

    $cos05total = $cos05hombres + $cos05deportes + $cos05mujer + $cos05accesorios + $cos05infantil + $cos05tecnologia + $cos05decohogar + $cos05electrohogar + $cos05otros;

    $cos6total = $cos6hombres + $cos6deportes + $cos6mujer + $cos6accesorios + $cos6infantil + $cos6tecnologia + $cos6decohogar + $cos6electrohogar + $cos6otros;

    $totalhombres = $cos05hombres + $cos6hombres;

    $totaldeportes = $cos05deportes + $cos6deportes;

    $totalmujer = $cos05mujer + $cos6mujer;

    $totalaccesorios = $cos05accesorios + $cos6accesorios;

    $totalinfantil = $cos05infantil + $cos6infantil;

    $totaltecnologia = $cos05tecnologia + $cos6tecnologia;

    $totaldecohogar = $cos05decohogar + $cos6decohogar;

    $totalelectrohogar = $cos05electrohogar + $cos6electrohogar;

    $totalotros = $cos05otros + $cos6otros;

    $total = $totalhombres + $totaldeportes + $totalmujer + $totalaccesorios + $totalinfantil + $totaltecnologia + $totaldecohogar + $totalelectrohogar + $totalotros;

    $mastkhombres = 0;
    if($totalhombres > 0)
        $mastkhombres = round(($cos6hombres / $totalhombres) * 100, 1);

    $mastkdeportes = 0;
    if($totaldeportes > 0)
        $mastkdeportes = round(($cos6deportes / $totaldeportes) * 100, 1);

    $mastkmujer = 0;
    if($totalmujer > 0)
        $mastkmujer = round(($cos6mujer / $totalmujer) * 100, 1);

    $mastkaccesorios = 0;
    if($totalaccesorios > 0)
        $mastkaccesorios = round(($cos6accesorios / $totalaccesorios) * 100, 1);

    $mastkinfantil = 0;
    if($totalinfantil > 0)
        $mastkinfantil = round(($cos6infantil / $totalinfantil) * 100, 1);

    $mastktecnologia = 0;
    if($totaltecnologia > 0)
        $mastktecnologia = round(($cos6tecnologia / $totaltecnologia) * 100, 1);

    $mastkdecohogar = 0;
    if($totaldecohogar > 0)
        $mastkdecohogar = round(($cos6decohogar / $totaldecohogar) * 100, 1);

    $mastkelectrohogar = 0;
    if($totalelectrohogar > 0)
        $mastkelectrohogar = round(($cos6electrohogar / $totalelectrohogar) * 100, 1);

    $mastkotros = 0;
    if($totalotros > 0)
        $mastkotros = round(($cos6otros / $totalotros) * 100, 1);

    $mastktotal = 0;
    if($total > 0)
        $mastktotal = round(($cos6total / $total) * 100, 1);

    $query = "insert into mercaderia_antigua values($dia,
                                                    $cos03hombres,
                                                    $cos03deportes,
                                                    $cos03mujer,
                                                    $cos03accesorios,
                                                    $cos03infantil,
                                                    $cos03tecnologia,
                                                    $cos03decohogar,
                                                    $cos03electrohogar,
                                                    $cos03otros,
                                                    $cos03total,
                                                    $cos45hombres,
                                                    $cos45deportes,
                                                    $cos45mujer,
                                                    $cos45accesorios,
                                                    $cos45infantil,
                                                    $cos45tecnologia,
                                                    $cos45decohogar,
                                                    $cos45electrohogar,
                                                    $cos45otros,
                                                    $cos45total,
                                                    $cos05hombres,
                                                    $cos05deportes,
                                                    $cos05mujer,
                                                    $cos05accesorios,
                                                    $cos05infantil,
                                                    $cos05tecnologia,
                                                    $cos05decohogar,
                                                    $cos05electrohogar,
                                                    $cos05otros,
                                                    $cos05total,
                                                    $cos6hombres,
                                                    $cos6deportes,
                                                    $cos6mujer,
                                                    $cos6accesorios,
                                                    $cos6infantil,
                                                    $cos6tecnologia,
                                                    $cos6decohogar,
                                                    $cos6electrohogar,
                                                    $cos6otros,
                                                    $cos6total,
                                                    $totalhombres,
                                                    $totaldeportes,
                                                    $totalmujer,
                                                    $totalaccesorios,
                                                    $totalinfantil,
                                                    $totaltecnologia,
                                                    $totaldecohogar,
                                                    $totalelectrohogar,
                                                    $totalotros,
                                                    $total,
                                                    $mastkhombres,
                                                    $mastkdeportes,
                                                    $mastkmujer,
                                                    $mastkaccesorios,
                                                    $mastkinfantil,
                                                    $mastktecnologia,
                                                    $mastkdecohogar,
                                                    $mastkelectrohogar,
                                                    $mastkotros,
                                                    $mastktotal)";

    $res = $local->query($query);

    if(!$res){
        echo "Hubo error. " . $local->error;
        return false;
    }

    return true;
}
