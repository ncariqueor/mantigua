<?php

function stockTotal($local, $dia)
{
    date_default_timezone_set("America/Asuncion");

    $local->query("delete from stocktotal where dia = $dia");

    $query = "select sum(cosprom*disponible) as total, sum(disponible) as totunidades from antigua where tipo in ('Activo', 'Case Pick') and fecha = $dia";

    $res = $local->query($query);

    $totunidadesdisp = 0;

    $totaldisp = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $totunidadesdisp = $row['totunidades'];
        $totaldisp = $row['total'];
    }

    $query = "select sum(cosprom*disponible) as total, sum(disponible) as totunidades from antigua where tipo not in ('Activo', 'Case Pick') and fecha = $dia";

    $res = $local->query($query);

    $totunidadesnodisp = 0;

    $totalnodisp = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $totunidadesnodisp = $row['totunidades'];
        $totalnodisp = $row['total'];
    }

    $costotoalstock = $totaldisp + $totalnodisp;

    $utotalstock = $totunidadesdisp + $totunidadesnodisp;

    $pcosdisp = 0;

    $pcosnodisp = 0;

    $pcostock = 0;

    $pudisp = 0;

    $punodisp = 0;

    if($costotoalstock > 0) {
        $pcosdisp = round(($totaldisp / $costotoalstock) * 100, 1);

        $pcosnodisp = round(($totalnodisp / $costotoalstock) * 100, 1);

        $pcostock = round($pcosdisp + $pcosnodisp, 1);

        $pudisp = round(($totunidadesdisp / $utotalstock) * 100, 1);

        $punodisp = round(($totunidadesnodisp / $utotalstock) * 100, 1);
    }

    $pustock = round($pudisp + $punodisp, 1);

    $query = "insert into stocktotal values (
                                         $dia,
                                         $totaldisp,
                                         $totalnodisp,
                                         $costotoalstock,
                                         $totunidadesdisp,
                                         $totunidadesnodisp,
                                         $utotalstock,
                                         $pcosdisp,
                                         $pcosnodisp,
                                         $pcostock,
                                         $pudisp,
                                         $punodisp,
                                         $pustock)";

    $res = $local->query($query);

    if(!$res)
        return false;

    return true;
}

function stockTotalEOM($local, $dia)
{
    date_default_timezone_set("America/Asuncion");

    $local->query("delete from stocktotaleom where dia = $dia");

    $query = "select sum(cosprom*disp) as stockdisp, sum(disp) as disp, sum(cosprom*nodisp) as stocknodisp, sum(nodisp) as nodisp from eombase where fecha = $dia";

    $res = $local->query($query);

    $stockdisp = 0;

    $disp = 0;

    $stocknodisp = 0;

    $nodisp = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $stockdisp = $row['stockdisp'];
        $disp = $row['disp'];
        $stocknodisp = $row['stocknodisp'];
        $nodisp = $row['nodisp'];
    }

    $costotoalstock = $stockdisp + $stocknodisp;

    $utotalstock = $disp + $nodisp;

    $pcosdisp = 0;

    $pcosnodisp = 0;

    $pcostock = 0;

    $pudisp = 0;

    $punodisp = 0;

    if($costotoalstock > 0) {
        $pcosdisp = round(($stockdisp / $costotoalstock) * 100, 1);

        $pcosnodisp = round(($stocknodisp / $costotoalstock) * 100, 1);

        $pcostock = round($pcosdisp + $pcosnodisp, 1);

        $pudisp = round(($disp / $utotalstock) * 100, 1);

        $punodisp = round(($nodisp / $utotalstock) * 100, 1);
    }

    $pustock = round($pudisp + $punodisp, 1);

    $query = "insert into stocktotaleom values (
                                         $dia,
                                         $stockdisp,
                                         $stocknodisp,
                                         $costotoalstock,
                                         $disp,
                                         $nodisp,
                                         $utotalstock,
                                         $pcosdisp,
                                         $pcosnodisp,
                                         $pcostock,
                                         $pudisp,
                                         $punodisp,
                                         $pustock)";

    $res = $local->query($query);

    if(!$res)
        return false;

    return true;
}