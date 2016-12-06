<?php

function reEtiquetado($local, $dia)
{
    date_default_timezone_set("America/Asuncion");

    $local->query("delete from tabla_retiquetado where dia = $dia");

    $division = array('HOMBRES', 'DEPORTES', 'MUJER', 'ACCESORIOS', 'INFANTIL', 'TECNOLOGIA', 'DECO-HOGAR', 'ELECTRO-HOGAR', 'OTROS');

    $retiquetado[] = array();

    $i = 0;

    foreach($division as $item) {
        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total,
                         avg(diasret) as promdias, max(diasret) as maxdias

                  from retiquetado

                  where division = '$item' and fecha = $dia";

        $res = $local->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $retiquetado[$i] = 0;
            if($row['totunidades'] != NULL)
                $retiquetado[$i] = $row['totunidades'];
            $i++;

            $retiquetado[$i] = 0;
            if($row['total'] != NULL)
                $retiquetado[$i] = $row['total'];
            $i++;

            $retiquetado[$i] = 0;
            if($row['promdias'] != NULL)
                $retiquetado[$i] = $row['promdias'];
            $i++;

            $retiquetado[$i] = 0;
            if($row['maxdias'] != NULL)
                $retiquetado[$i] = $row['maxdias'];
            $i++;
        }

        $query = "select sum(disponible*cosprom) as total

                  from retiquetado

                  where division = '$item' and diasret > 7 and fecha = $dia";

        $res = $local->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $retiquetado[$i] = 0;
            if($row['total'] != NULL)
                $retiquetado[$i] = $row['total'];
            $i++;
        }
    }

    $uhombres             = $retiquetado[0];
    $costohombres         = $retiquetado[1];
    $promdiashombres      = $retiquetado[2];
    $maxdiashombres       = $retiquetado[3];
    $mayor7hombres        = $retiquetado[4];

    $udeportes            = $retiquetado[5];
    $costodeportes        = $retiquetado[6];
    $promdiasdeportes     = $retiquetado[7];
    $maxdiasdeportes      = $retiquetado[8];
    $mayor7deportes       = $retiquetado[9];

    $umujer               = $retiquetado[10];
    $costomujer           = $retiquetado[11];
    $promdiasmujer        = $retiquetado[12];
    $maxdiasmujer         = $retiquetado[13];
    $mayor7mujer          = $retiquetado[14];

    $uaccesorios          = $retiquetado[15];
    $costoaccesorios      = $retiquetado[16];
    $promdiasaccesorios   = $retiquetado[17];
    $maxdiasaccesorios    = $retiquetado[18];
    $mayor7accesorios     = $retiquetado[19];

    $uinfantil            = $retiquetado[20];
    $costoinfantil        = $retiquetado[21];
    $promdiasinfantil     = $retiquetado[22];
    $maxdiasinfantil      = $retiquetado[23];
    $mayor7infantil       = $retiquetado[24];

    $utecnologia          = $retiquetado[25];
    $costotecnologia      = $retiquetado[26];
    $promdiastecnologia   = $retiquetado[27];
    $maxdiastecnologia    = $retiquetado[28];
    $mayor7tecnologia     = $retiquetado[29];

    $udecohogar           = $retiquetado[30];
    $costodecohogar       = $retiquetado[31];
    $promdiasdecohogar    = $retiquetado[32];
    $maxdiasdecohogar     = $retiquetado[33];
    $mayor7decohogar      = $retiquetado[34];

    $uelectrohogar        = $retiquetado[35];
    $costoelectrohogar    = $retiquetado[36];
    $promdiaselectrohogar = $retiquetado[37];
    $maxdiaselectrohogar  = $retiquetado[38];
    $mayor7electrohogar   = $retiquetado[39];

    $uotros               = $retiquetado[40];
    $costootros           = $retiquetado[41];
    $promdiasotros        = $retiquetado[42];
    $maxdiasotros         = $retiquetado[43];
    $mayor7otros          = $retiquetado[44];

    $query = "select avg(diasret) as promdias, max(diasret) as maxdias

              from retiquetado where fecha = $dia";

    $res = $local->query($query);

    $promdiastotal = 0;

    $maxdiastotal = 0;

    while($row = mysqli_fetch_assoc($res)){
        $promdiastotal = $row['promdias'];
        $maxdiastotal  = $row['maxdias'];
    }

    $query = "select sum(disponible*cosprom) as total

                  from retiquetado

                  where diasret > 7 and fecha = $dia";

    $res = $local->query($query);

    $mayor7total = 0;

    while($row = mysqli_fetch_assoc($res)){
        $mayor7total = $row['total'];
    }

    $costototal = $costohombres + $costodeportes + $costomujer + $costoaccesorios + $costoinfantil + $costotecnologia + $costodecohogar + $costoelectrohogar + $costootros;

    $utotal = $uhombres + $udeportes + $umujer + $uaccesorios + $uinfantil + $utecnologia + $udecohogar + $uelectrohogar + $uotros;

    $pcoshombres = 0;

    $pcosdeportes = 0;

    $pcosmujer = 0;

    $pcosaccesorios = 0;

    $pcosinfantil = 0;

    $pcostecnologia = 0;

    $pcosdecohogar = 0;

    $pcoselectrohogar = 0;

    $pcosotros = 0;

    if($costototal > 0){
        $pcoshombres = round(($costohombres / $costototal) * 100, 1);

        $pcosdeportes = round(($costodeportes / $costototal) * 100, 1);

        $pcosmujer = round(($costomujer / $costototal) * 100, 1);

        $pcosaccesorios = round(($costoaccesorios / $costototal) * 100, 1);

        $pcosinfantil = round(($costoinfantil / $costototal) * 100, 1);

        $pcostecnologia = round(($costotecnologia / $costototal) * 100, 1);

        $pcosdecohogar = round(($costodecohogar / $costototal) * 100, 1);

        $pcoselectrohogar = round(($costoelectrohogar / $costototal) * 100, 1);

        $pcosotros = round(($costootros / $costototal) * 100, 1);
    }

    $pcostotal = round($pcoshombres + $pcosdeportes + $pcosmujer + $pcosaccesorios + $pcosinfantil + $pcostecnologia + $pcosdecohogar + $pcoselectrohogar + $pcosotros, 1);

    $query = "insert into tabla_retiquetado values ($dia,
                                                    $costohombres,
                                                    $costodeportes,
                                                    $costomujer,
                                                    $costoaccesorios,
                                                    $costoinfantil,
                                                    $costotecnologia,
                                                    $costodecohogar,
                                                    $costoelectrohogar,
                                                    $costootros,
                                                    $costototal,
                                                    $pcoshombres,
                                                    $pcosdeportes,
                                                    $pcosmujer,
                                                    $pcosaccesorios,
                                                    $pcosinfantil,
                                                    $pcostecnologia,
                                                    $pcosdecohogar,
                                                    $pcoselectrohogar,
                                                    $pcosotros,
                                                    $pcostotal,
                                                    $uhombres,
                                                    $udeportes,
                                                    $umujer,
                                                    $uaccesorios,
                                                    $uinfantil,
                                                    $utecnologia,
                                                    $udecohogar,
                                                    $uelectrohogar,
                                                    $uotros,
                                                    $utotal,
                                                    $promdiashombres,
                                                    $promdiasdeportes,
                                                    $promdiasmujer,
                                                    $promdiasaccesorios,
                                                    $promdiasinfantil,
                                                    $promdiastecnologia,
                                                    $promdiasdecohogar,
                                                    $promdiaselectrohogar,
                                                    $promdiasotros,
                                                    $promdiastotal,
                                                    $maxdiashombres,
                                                    $maxdiasdeportes,
                                                    $maxdiasmujer,
                                                    $maxdiasaccesorios,
                                                    $maxdiasinfantil,
                                                    $maxdiastecnologia,
                                                    $maxdiasdecohogar,
                                                    $maxdiaselectrohogar,
                                                    $maxdiasotros,
                                                    $maxdiastotal,
                                                    $mayor7hombres,
                                                    $mayor7deportes,
                                                    $mayor7mujer,
                                                    $mayor7accesorios,
                                                    $mayor7infantil,
                                                    $mayor7tecnologia,
                                                    $mayor7decohogar,
                                                    $mayor7electrohogar,
                                                    $mayor7otros,
                                                    $mayor7total)";

    $res = $local->query($query);

    if($res)
        return true;
    else{
        echo $local->error;
        return false;
    }

}