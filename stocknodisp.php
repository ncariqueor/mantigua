<?php
function stockNoDisp($local, $dia)
{
    date_default_timezone_set("America/Asuncion");

    $local->query("delete from stocknodisp where dia = $dia");

    $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua where locacion = 'Logistica inversa' and fecha = $dia";

    $res = $local->query($query);

    $costologinv = 0;

    $uloginv = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $costologinv = 0;
        if($row['total'] != NULL)
            $costologinv = $row['total'];

        $uloginv = 0;
        if($row['totunidades'] != NULL)
            $uloginv = $row['totunidades'];
    }

    $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua where locacion = 'Logistica inversa/ cobros' and fecha = $dia";

    $res = $local->query($query);

    $costologinvcob = 0;

    $uloginvcob = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $costologinvcob = 0;
        if($row['total'] != NULL)
            $costologinvcob = $row['total'];

        $uloginvcob = 0;
        if($row['totunidades'] != NULL)
            $uloginvcob = $row['totunidades'];
    }

    $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua where locacion = 'Venta empresa' and fecha = $dia";

    $res = $local->query($query);

    $costovempresa = 0;

    $uvempresa = 0;


    while ($row = mysqli_fetch_assoc($res)) {
        $costovempresa = 0;
        if($row['total'] != NULL)
            $costovempresa = $row['total'];

        $uvempresa = 0;
        if($row['totunidades'] != NULL)
            $uvempresa = $row['totunidades'];
    }


    $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua where locacion = 'Re-etiquetado' and fecha = $dia";

    $res = $local->query($query);

    $costoretiquetado = 0;

    $uretiquetado = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $costoretiquetado = 0;
        if($row['total'] != NULL)
            $costoretiquetado = $row['total'];

        $uretiquetado = 0;
        if($row['totunidades'] != NULL)
            $uretiquetado = $row['totunidades'];
    }

    $query = "select sum(disponible) as totunidades, sum(disponible*cosprom) as total from antigua

              where locacion not in ('Logistica inversa', 'Logistica inversa/ cobros', 'Venta empresa', 'Re-etiquetado')

                    and tipo = 'Reserva' and fecha = $dia";

    $res = $local->query($query);

    $costotros = 0;

    $uotros = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $costotros = 0;
        if($row['total'] != NULL)
            $costotros = $row['total'];

        $uotros = 0;
        if($row['totunidades'] != NULL)
            $uotros = $row['totunidades'];
    }

    $costototal = $costologinv + $costologinvcob + $costovempresa + $costoretiquetado + $costotros;

    $utotal = $uloginv + $uloginvcob + $uvempresa + $uretiquetado + $uotros;

    $pcosloginv = 0;

    $pcosloginvcob = 0;

    $pcosvempresa = 0;

    $pcosretiquetado = 0;

    $pcosotros = 0;

    if ($costototal > 0) {
        $pcosloginv = round(($costologinv / $costototal) * 100, 1);

        $pcosloginvcob = round(($costologinvcob / $costototal) * 100, 1);

        $pcosvempresa = round(($costovempresa / $costototal) * 100, 1);

        $pcosretiquetado = round(($costoretiquetado / $costototal) * 100, 1);

        $pcosotros = round(($costotros / $costototal) * 100, 1);
    }

    $pcostotal = round($pcosloginv + $pcosloginvcob + $pcosvempresa + $pcosretiquetado + $pcosotros, 1);

    $puloginv = 0;

    $puloginvcob = 0;

    $puvempresa = 0;

    $puretiquetado = 0;

    $puotros = 0;

    if($utotal > 0) {
        $puloginv = round(($uloginv / $utotal) * 100, 1);

        $puloginvcob = round(($uloginvcob / $utotal) * 100, 1);

        $puvempresa = round(($uvempresa / $utotal) * 100, 1);

        $puretiquetado = round(($uretiquetado / $utotal) * 100, 1);

        $puotros = round(($uotros / $utotal) * 100, 1);
    }

    $putotal = round($puloginv + $puloginvcob + $puvempresa + $puretiquetado + $puotros, 1);

    $query = "insert into stocknodisp values ($dia,
                                              $costologinv,
                                              $costologinvcob,
                                              $costovempresa,
                                              $costoretiquetado,
                                              $costotros,
                                              $costototal,
                                              $pcosloginv,
                                              $pcosloginvcob,
                                              $pcosvempresa,
                                              $pcosretiquetado,
                                              $pcosotros,
                                              $pcostotal,
                                              $uloginv,
                                              $uloginvcob,
                                              $uvempresa,
                                              $uretiquetado,
                                              $uotros,
                                              $utotal,
                                              $puloginv,
                                              $puloginvcob,
                                              $puvempresa,
                                              $puretiquetado,
                                              $puotros,
                                              $putotal)";

    $res = $local->query($query);

    if(!$res){
        echo "Error en Stock No Disponible. " . $local->error;
        return false;
    }


    return true;
}