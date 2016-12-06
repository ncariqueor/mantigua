<?php

function informePM($local, $dia)
{
    ini_set('max_execution_time', 0);

    date_default_timezone_get("America/Asuncion");

    $local->query("delete from informe_pm where fecha = $dia");

    $con = new mysqli('localhost', 'root', '', 'ventas');

    $query = "select distinct pm from depto where pm <> '' order by pm asc";

    $res = $con->query($query);

    $pm = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $pm[$i] = $row['pm'];
        $i++;
    }

    //Disponible para la venta

    foreach($pm as $item){
        $locacion = 'Disponible para la venta';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            $cos03 = $row['total'];
            $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            $cos45 = $row['total'];
            $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            $cos612 = $row['total'];
            $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            $cos13 = $row['total'];
            $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en Disponible para la venta. " . $local->error . ". <br> ";
    }

    //Fin disponible para la venta

    //Fotografia

    foreach($pm as $item){
        $locacion = 'Fotografia';

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $cos03 = 0;

        $u03 = 0;

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res) {
            echo "Error en Fotografia. " . $local->error . ". <br> ";
            echo $query . "<br><br>";
        }
    }

    //Fin Fotografia

    //Productos Danados

    foreach($pm as $item){
        $locacion = 'Productos Danados';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
            $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en Productos Danados. " . $local->error . ". <br> ";
    }

    //Fin Productos Danados

    //Logistica inversa

    foreach($pm as $item){
        $locacion = 'Logistica inversa';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en logistica inversa. " . $local->error . ". <br> ";
    }

    //Fin Logistica inversa

    //Zona de transito

    foreach($pm as $item){
        $locacion = 'Zona de transito';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en zona de transito. " . $local->error . ". <br> ";
    }

    //Fin zona de transito

    //Re-etiquetado

    foreach($pm as $item){
        $locacion = 'Re-etiquetado';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en Re-etiquetado" . $local->error . ". <br> ";
    }

    //Fin Re-etiquetado

    //Logistica inversa/ cobros

    foreach($pm as $item){
        $locacion = 'Logistica inversa/ cobros';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en Logistica inversa/ cobros. " . $local->error . ". <br> ";
    }

    //Fin Logistica inversa/ cobros

    //Venta empresa

    foreach($pm as $item){
        $locacion = 'Venta empresa';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['total'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en Venta Empresa. " . $local->error . ". <br> ";
    }

    //Fin Venta empresa

    //De baja

    foreach($pm as $item){
        $locacion = 'De baja';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en de baja" . $local->error . ". <br> ";
    }

    //Fin De baja

    //Extraviado

    foreach($pm as $item){
        $locacion = 'Extraviado';

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion = '$locacion' and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res)
            echo "Error en extraviado. " . $local->error . ". <br> ";
    }

    //Fin Extraviado

    //otros

    foreach($pm as $item){
        $locacion = 'Otros';

        $otros = "'Disponible para la venta', 'Fotografia', 'Productos Danados', 'Logistica inversa', 'Zona de transito',
                  'Re-etiquetado', 'Logistica inversa/ cobros', 'Venta empresa', 'De baja', 'Extraviado'";

        $cos03 = 0;

        $u03 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion not in ($otros) and pm = '$item' and antiguedad between 0 and 3";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos03 = $row['total'];

            if($row['totunidades'] != NULL)
                $u03   = $row['totunidades'];
        }

        $cos45 = 0;

        $u45 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion not in ($otros) and pm = '$item' and antiguedad between 4 and 5";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos45 = $row['total'];

            if($row['totunidades'] != NULL)
                $u45   = $row['totunidades'];
        }

        $cos612 = 0;

        $u612 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion not in ($otros) and pm = '$item' and antiguedad between 6 and 12";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos612 = $row['total'];

            if($row['totunidades'] != NULL)
                $u612   = $row['totunidades'];
        }

        $cos13 = 0;

        $u13 = 0;

        $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

                  where fecha = $dia and locacion not in ($otros) and pm = '$item' and antiguedad >= 13";

        $res = $local->query($query);

        while($row = mysqli_fetch_assoc($res)){
            if($row['total'] != NULL)
                $cos13 = $row['total'];

            if($row['totunidades'] != NULL)
                $u13   = $row['totunidades'];
        }

        $llave = trim($dia . $item . $locacion);

        $query = "insert into informe_pm values('$llave',
                                                 $dia,
                                                '$item',
                                                '$locacion',
                                                 $cos03,
                                                 $cos45,
                                                 $cos612,
                                                 $cos13,
                                                 $u03,
                                                 $u45,
                                                 $u612,
                                                 $u13)";

        $res = $local->query($query);

        if(!$res) {
            echo "Error en otros. " . $local->error . ". <br> ";
            return false;
        }
    }

    return true;
}

