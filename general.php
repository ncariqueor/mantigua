<?php

function General($dia, $mes, $anio, $diaant, $mesant, $anioant){
    $buscar = $anio . $mes . $dia;

    $buscarant = $anioant . $mesant . $diaant;

    $fecha = fecha($dia, $mes, $anio);

    $fechant = fecha($diaant, $mesant, $anioant);

    ini_set("max_execution_time", 0);

    $con = new mysqli('localhost', 'root', '', 'mantigua');

    //Inicio Stock Total

    $query = "select * from stocktotal where dia = $buscar";

    $res = $con->query($query);

    $costodisp     = 0;
    $costonodisp   = 0;
    $costotalstock = 0;
    $udisp         = 0;
    $unodisp       = 0;
    $utotalstock   = 0;
    $pcosdisp      = 0;
    $pcosnodisp    = 0;
    $pcostock      = 0;
    $pudisp        = 0;
    $punodisp      = 0;
    $pustock       = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $costodisp     = $row['costodisp'];
        $costonodisp   = $row['costonodisp'];
        $costotalstock = $row['costotalstock'];
        $udisp         = $row['udisp'];
        $unodisp       = $row['unodisp'];
        $utotalstock   = $row['utotalstock'];
        $pcosdisp      = $row['pcosdisp'];
        $pcosnodisp    = $row['pcosnodisp'];
        $pcostock      = $row['pcostock'];
        $pudisp        = $row['pudisp'];
        $punodisp      = $row['punodisp'];
        $pustock       = $row['pustock'];
    }

    echo "<div class='container'>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan='5' style='background-color: #337ab7; color: white;'><h6><b>Stock total</b></h6></th>";
    echo "<th rowspan='2' style='border-top-color: white;'></th>";
    echo "<th colspan='4'><h6><b>" . $fecha . "</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Costo $<b></h6></th>";
    echo "<th><h6><b>Unidades</b></th>";
    echo "<th><h6><b>% Costo</b></h6></th>";
    echo "<th><h6><b>% Unidades</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Disponible para la venta</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costodisp, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($udisp, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosdisp, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pudisp, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>No disponible para la venta</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costonodisp, 0, ',', '.') . "<h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($unodisp, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosnodisp, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($punodisp, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='background-color: #C8EFFA;'><h6><b>Total</b></h6></th>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($costotalstock, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($utotalstock, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($pcostock, 1, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format(round($pustock), 1, ',', '.') . "</h6></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";

    //Fin Stock Total

    //Inicio Mercadería Antigua

    $query = "select * from mercaderia_antigua where dia = $buscar";

    $res = $con->query($query);

    $cos05hombres      = 0;
    $cos05deportes     = 0;
    $cos05mujer        = 0;
    $cos05accesorios   = 0;
    $cos05infantil     = 0;
    $cos05tecnologia   = 0;
    $cos05decohogar    = 0;
    $cos05electrohogar = 0;
    $cos05otros        = 0;
    $cos05total        = 0;

    $cos6hombres      = 0;
    $cos6deportes     = 0;
    $cos6mujer        = 0;
    $cos6accesorios   = 0;
    $cos6infantil     = 0;
    $cos6tecnologia   = 0;
    $cos6decohogar    = 0;
    $cos6electrohogar = 0;
    $cos6otros        = 0;
    $cos6total        = 0;

    $totalhombres      = 0;
    $totaldeportes     = 0;
    $totalmujer        = 0;
    $totalaccesorios   = 0;
    $totalinfantil     = 0;
    $totaltecnologia   = 0;
    $totaldecohogar    = 0;
    $totalelectrohogar = 0;
    $totalotros        = 0;
    $total             = 0;

    $mastkhombres      = 0;
    $mastkdeportes     = 0;
    $mastkmujer        = 0;
    $mastkaccesorios   = 0;
    $mastkinfantil     = 0;
    $mastktecnologia   = 0;
    $mastkdecohogar    = 0;
    $mastkelectrohogar = 0;
    $mastkotros        = 0;
    $mastktotal        = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $cos05hombres      = $row['cos05hombres'];
        $cos05deportes     = $row['cos05deportes'];
        $cos05mujer        = $row['cos05mujer'];
        $cos05accesorios   = $row['cos05accesorios'];
        $cos05infantil     = $row['cos05infantil'];
        $cos05tecnologia   = $row['cos05tecnologia'];
        $cos05decohogar    = $row['cos05decohogar'];
        $cos05electrohogar = $row['cos05electrohogar'];
        $cos05otros        = $row['cos05otros'];
        $cos05total        = $row['cos05total'];

        $cos6hombres       = $row['cos6hombres'];
        $cos6deportes      = $row['cos6deportes'];
        $cos6mujer         = $row['cos6mujer'];
        $cos6accesorios    = $row['cos6accesorios'];
        $cos6infantil      = $row['cos6infantil'];
        $cos6tecnologia    = $row['cos6tecnologia'];
        $cos6decohogar     = $row['cos6decohogar'];
        $cos6electrohogar  = $row['cos6electrohogar'];
        $cos6otros         = $row['cos6otros'];
        $cos6total         = $row['cos6total'];

        $totalhombres      = $row['totalhombres'];
        $totaldeportes     = $row['totaldeportes'];
        $totalmujer        = $row['totalmujer'];
        $totalaccesorios   = $row['totalaccesorios'];
        $totalinfantil     = $row['totalinfantil'];
        $totaltecnologia   = $row['totaltecnologia'];
        $totaldecohogar    = $row['totaldecohogar'];
        $totalelectrohogar = $row['totalelectrohogar'];
        $totalotros        = $row['totalotros'];
        $total             = $row['total'];

        $mastkhombres      = $row['mastkhombres'];
        $mastkdeportes     = $row['mastkdeportes'];
        $mastkmujer        = $row['mastkmujer'];
        $mastkaccesorios   = $row['mastkaccesorios'];
        $mastkinfantil     = $row['mastkinfantil'];
        $mastktecnologia   = $row['mastktecnologia'];
        $mastkdecohogar    = $row['mastkdecohogar'];
        $mastkelectrohogar = $row['mastkelectrohogar'];
        $mastkotros        = $row['mastkotros'];
        $mastktotal        = $row['mastktotal'];
    }

    $query = "select * from mercaderia_antigua where dia = $buscarant";

    $res = $con->query($query);

    $cos6hombresAnt       = 0;
    $cos6deportesAnt      = 0;
    $cos6mujerAnt         = 0;
    $cos6accesoriosAnt    = 0;
    $cos6infantilAnt      = 0;
    $cos6tecnologiaAnt    = 0;
    $cos6decohogarAnt     = 0;
    $cos6electrohogarAnt  = 0;
    $cos6otrosAnt         = 0;
    $cos6totalAnt        = 0;

    $mastkhombresAnt      = 0;
    $mastkdeportesAnt     = 0;
    $mastkmujerAnt        = 0;
    $mastkaccesoriosAnt   = 0;
    $mastkinfantilAnt     = 0;
    $mastktecnologiaAnt   = 0;
    $mastkdecohogarAnt    = 0;
    $mastkelectrohogarAnt = 0;
    $mastkotrosAnt        = 0;
    $mastktotalAnt        = 0;

    while($row = mysqli_fetch_assoc($res)){
        $cos6hombresAnt       = $row['cos6hombres'];
        $cos6deportesAnt      = $row['cos6deportes'];
        $cos6mujerAnt         = $row['cos6mujer'];
        $cos6accesoriosAnt    = $row['cos6accesorios'];
        $cos6infantilAnt      = $row['cos6infantil'];
        $cos6tecnologiaAnt    = $row['cos6tecnologia'];
        $cos6decohogarAnt     = $row['cos6decohogar'];
        $cos6electrohogarAnt  = $row['cos6electrohogar'];
        $cos6otrosAnt         = $row['cos6otros'];
        $cos6totalAnt        = $row['cos6total'];

        $mastkhombresAnt      = $row['mastkhombres'];
        $mastkdeportesAnt     = $row['mastkdeportes'];
        $mastkmujerAnt        = $row['mastkmujer'];
        $mastkaccesoriosAnt   = $row['mastkaccesorios'];
        $mastkinfantilAnt     = $row['mastkinfantil'];
        $mastktecnologiaAnt   = $row['mastktecnologia'];
        $mastkdecohogarAnt    = $row['mastkdecohogar'];
        $mastkelectrohogarAnt = $row['mastkelectrohogar'];
        $mastkotrosAnt        = $row['mastkotros'];
        $mastktotalAnt        = $row['mastktotal'];
    }

    $varmahombres      = $cos6hombres - $cos6hombresAnt;
    $varmadeportes     = $cos6deportes - $cos6deportesAnt;
    $varmamujer        = $cos6mujer - $cos6mujerAnt;
    $varmaaccesorios   = $cos6accesorios - $cos6accesoriosAnt;
    $varmainfantil     = $cos6infantil - $cos6infantilAnt;
    $varmatecnologia   = $cos6tecnologia - $cos6tecnologiaAnt;
    $varmadecohogar    = $cos6decohogar - $cos6decohogarAnt;
    $varmaelectrohogar = $cos6electrohogar - $cos6electrohogarAnt;
    $varmaotros        = $cos6otros - $cos6otrosAnt;
    $varmatotal        = $cos6total - $cos6totalAnt;

    echo "<div class='container'>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan='13' style='background-color: #337ab7; color: white;'><h6><b>Mercadería Antigua</b></h6></th>";
    echo "<th rowspan='2' style='border-top-color: white;'></th>";
    echo "<th colspan='4' style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6><b>" . $fecha . "</b></h6></th>";
    echo "<th colspan='3'><h6><b>" . $fechant . "</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Costo $ (0 - 5 meses)<b></h6></th>";
    echo "<th><h6><b>Costo $ (+6 meses)</b></th>";
    echo "<th><h6><b>Costo $ Total Stock</b></h6></th>";
    echo "<th style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6><b>% MA / STK</b></h6></th>";
    echo "<th><h6><b>Costo $ (+6 meses)</b></h6></th>";
    echo "<th><h6><b>Var MA<b></h6></th>";
    echo "<th><h6><b>% MA / STK</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Hombres</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05hombres, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6hombres, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totalhombres, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkhombres, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6hombresAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmahombres, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkhombresAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Deportes</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05deportes, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6deportes, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totaldeportes, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkdeportes, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6deportesAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmadeportes, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkdeportesAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Mujer</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05mujer, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6mujer, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totalmujer, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkmujer, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6mujerAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmamujer, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkmujerAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Accesorios</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05accesorios, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6accesorios, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totalaccesorios, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkaccesorios, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6accesoriosAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmaaccesorios, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkaccesoriosAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Infantil</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05infantil, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6infantil, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totalinfantil, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkinfantil, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6infantilAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmainfantil, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkinfantilAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Tecnología</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05tecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6tecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totaltecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastktecnologia, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6tecnologiaAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmatecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastktecnologiaAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Deco-Hogar</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05decohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6decohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totaldecohogar, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkdecohogar, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6decohogarAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmadecohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkdecohogarAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Electro-Hogar</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05electrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6electrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totalelectrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkelectrohogar, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6electrohogarAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmaelectrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkelectrohogarAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Otros</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cos05otros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6otros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($totalotros, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mastkotros, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cos6otrosAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmaotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($mastkotrosAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='background-color: #C8EFFA;'><h6><b>Total</b></h6></th>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($cos05total, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($cos6total, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($total, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6; background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($mastktotal, 1, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($cos6totalAnt, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($varmatotal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($mastktotalAnt, 1, ',', '.') . "</h6></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";

    //Fin Mercadería Antigua

    //Inicio Stock No Disponible

    $query = "select * from stocknodisp where dia = $buscar";

    $res = $con->query($query);

    $costologinv      = 0;
    $costologinvcob   = 0;
    $costovempresa    = 0;
    $costoretiquetado = 0;
    $costotros        = 0;
    $costototal       = 0;
    $pcosloginv       = 0;
    $pcosloginvcob    = 0;
    $pcosvempresa     = 0;
    $pcosretiquetado  = 0;
    $pcosotros        = 0;
    $pcostotal        = 0;
    $uloginv          = 0;
    $uloginvcob       = 0;
    $uvempresa        = 0;
    $uretiquetado     = 0;
    $uotros           = 0;
    $utotal           = 0;
    $puloginv         = 0;
    $puloginvcob      = 0;
    $puvempresa       = 0;
    $puretiquetado    = 0;
    $puotros          = 0;
    $putotal          = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $costologinv      = $row['costologinv'];
        $costologinvcob   = $row['costologinvcob'];
        $costovempresa    = $row['costovempresa'];
        $costoretiquetado = $row['costoretiquetado'];
        $costotros        = $row['costotros'];
        $costototal       = $row['costototal'];
        $pcosloginv       = $row['pcosloginv'];
        $pcosloginvcob    = $row['pcosloginvcob'];
        $pcosvempresa     = $row['pcosvempresa'];
        $pcosretiquetado  = $row['pcosretiquetado'];
        $pcosotros        = $row['pcosotros'];
        $pcostotal        = $row['pcostotal'];
        $uloginv          = $row['uloginv'];
        $uloginvcob       = $row['uloginvcob'];
        $uvempresa        = $row['uvempresa'];
        $uretiquetado     = $row['uretiquetado'];
        $uotros           = $row['uotros'];
        $utotal           = $row['utotal'];
        $puloginv         = $row['puloginv'];
        $puloginvcob      = $row['puloginvcob'];
        $puvempresa       = $row['puvempresa'];
        $puretiquetado    = $row['puretiquetado'];
        $puotros          = $row['puotros'];
        $putotal          = $row['putotal'];
    }

    $query = "select * from stocknodisp where dia = $buscarant";

    $res = $con->query($query);

    $costologinvAnt       = 0;
    $costologinvcobAnt    = 0;
    $costovempresaAnt     = 0;
    $costoretiquetadoAnt  = 0;
    $costotrosAnt         = 0;
    $costototalAnt        = 0;

    $uloginvAnt       = 0;
    $uloginvcobAnt    = 0;
    $uvempresaAnt     = 0;
    $uretiquetadoAnt  = 0;
    $uotrosAnt        = 0;
    $utotalAnt        = 0;

    while($row = mysqli_fetch_assoc($res)){
        $costologinvAnt      = $row['costologinv'];
        $costologinvcobAnt   = $row['costologinvcob'];
        $costovempresaAnt    = $row['costovempresa'];
        $costoretiquetadoAnt = $row['costoretiquetado'];
        $costotrosAnt        = $row['costotros'];
        $costototalAnt       = $row['costototal'];

        $uloginvAnt          = $row['uloginv'];
        $uloginvcobAnt       = $row['uloginvcob'];
        $uvempresaAnt        = $row['uvempresa'];
        $uretiquetadoAnt     = $row['uretiquetado'];
        $uotrosAnt           = $row['uotros'];
        $utotalAnt           = $row['utotal'];
    }

    $pcosloginv = $costologinv - $costologinvAnt;
    $pcosloginvcob = $costologinvcob - $costologinvcobAnt;
    $pcosvempresa = $costovempresa - $costovempresaAnt;
    $pcosretiquetado = $costoretiquetado - $costoretiquetadoAnt;
    $pcosotros = $costotros - $costotrosAnt;
    $pcostotal = $costototal - $costototalAnt;

    $varloginv = 0;
    if($costologinvAnt > 0)
        $varloginv = round((($costologinv / $costologinvAnt) - 1) * 100);

    $varloginvcob = 0;
    if($costologinvcobAnt > 0)
        $varloginvcob = round((($costologinvcob / $costologinvcobAnt) - 1) * 100);

    $varvempresa = 0;
    if($costovempresaAnt > 0)
        $varvempresa = round((($costovempresa / $costovempresaAnt) - 1)*100);

    $varretiquetado = 0;
    if($costoretiquetadoAnt > 0)
        $varretiquetado = round((($costoretiquetado / $costoretiquetadoAnt) - 1)*100);

    $varotros = 0;
    if($costotrosAnt > 0)
        $varotros = round((($costotros / $costotrosAnt) - 1) * 100);

    $vartotal = 0;
    if($costototalAnt > 0)
        $vartotal = round((($costototal / $costototalAnt) - 1) * 100);


    $varuloginv = 0;
    if($uloginvAnt > 0)
        $varuloginv = round((($uloginv / $uloginvAnt) - 1) * 100);

    $varuloginvcob = 0;
    if($uloginvcobAnt > 0)
        $varuloginvcob = round((($uloginvcob / $uloginvcobAnt) - 1) * 100);


    $varuvempresa = 0;
    if($uvempresaAnt > 0)
        $varuvempresa = round((($uvempresa / $uvempresaAnt) - 1) * 100);

    $varuretiquetado = 0;
    if($uretiquetadoAnt > 0)
        $varuretiquetado = round((($uretiquetado / $uretiquetadoAnt) - 1) * 100);

    $varuotros = 0;
    if($uotrosAnt > 0)
        $varuotros = round((($uotros / $uotrosAnt) - 1) * 100);

    $varutotal = 0;
    if($utotalAnt > 0)
        $varutotal = round((($utotal / $utotalAnt) - 1) * 100);

    echo "<div class='container'>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan='8' style='background-color: #337ab7; color: white;'><h6><b>Stock <br> no <br> disponible</b></h6></th>";
    echo "<th rowspan='2' style='border-top-color: white;'></th>";
    echo "<th colspan='6' style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6><b>" . $fecha . "</b></h6></th>";
    echo "<th colspan='2'><h6><b>" . $fechant . "</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Costo $<b></h6></th>";
    echo "<th><h6><b>Var % Costo</b></th>";
    echo "<th><h6><b>Var $ Costo</b></h6></th>";
    echo "<th><h6><b>Unidades</b></h6></th>";
    echo "<th><h6><b>% Unidades</b></h6></th>";
    echo "<th style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6><b>Var Unidades</b></h6></th>";
    echo "<th><h6><b>Costo $<b></h6></th>";
    echo "<th><h6><b>Unidades</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Logística Inversa</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costologinv, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varloginv, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosloginv, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uloginv, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($puloginv, 1, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($varuloginv, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costologinvAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uloginvAnt) . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Logística Inversa/ cobros</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costologinvcob, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varloginvcob, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosloginvcob, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uloginvcob, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($puloginvcob, 1, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($varuloginvcob, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costologinvcobAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uloginvcobAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Venta Empresa</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costovempresa, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varvempresa, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosvempresa, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uvempresa, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($puvempresa, 1, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($varuvempresa, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costovempresaAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uvempresaAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Re-etiquetado</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costoretiquetado, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varretiquetado, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosretiquetado, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uretiquetado, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($puretiquetado, 1, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($varuretiquetado, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costoretiquetadoAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uretiquetadoAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Otros</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($puotros, 1, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($varuotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costotrosAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uotrosAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='background-color: #C8EFFA;'><h6><b>Total</b></h6></th>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($costototal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($vartotal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format(round($pcostotal), 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($utotal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format(round($putotal), 1, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA; border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($varutotal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($costototalAnt, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($utotalAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";

    //Fin Stock No Disponible

    
}

function informePM($dia, $mes, $anio, $pm, $locacion){
    $buscar = $anio . $mes . $dia;

    $cant = count($locacion);

    ini_set("max_execution_time", 0);

    $con = new mysqli('localhost', 'root', '', 'mantigua');

    $query = "select sum(costo03) as costo03, sum(costo45) as costo45,
                     sum(costo612) as costo612, sum(costo13) as costo13,
                     sum(u03) as u03, sum(u45) as u45, sum(u612) as u612, sum(u13) as u13, pm

              from informe_pm

              where fecha = $buscar";

    $in = "()";

    if($cant > 0){
        if(!in_array('Total', $locacion)){
            $in = "(";

            for($i=0; $i<$cant; $i++){
                $in = $in . "'$locacion[$i]'";
                if($i<$cant-1)
                    $in = $in . ", ";
            }

            $in = $in . ")";

            $query = $query . " and locacion in " . $in;
        }
    }

    if($pm != 'Todos'){
        $query = $query . " and pm = '$pm'";
    }else{
        $query = $query . " group by pm";
    }

    $res = $con->query($query);

    $costo03 = 0;
    $costo45 = 0;
    $costo612 = 0;
    $costo13 = 0;

    $u03 = 0;
    $u45 = 0;
    $u612 = 0;
    $u13 = 0;

    $pm = "";

    echo "<div>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan = '2' style='background-color: #337ab7; color: white;'><h6><b>PM</b></h6></th>";
    echo "<th colspan = '6' style='background-color: #337ab7; color: white;'><h6><b>Stock Costo</b></h6></th>";
    echo "<th colspan = '6' style='background-color: #83ADE4; color: white;'><h6><b>Stock Unidades</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ 0 - 3 meses<b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ 4 - 5 meses</b></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ 6 - 12 meses</b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ + 13 meses</b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>Total Stock Costo</b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>% MA / STK</b></h6></th>";

    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>0 - 3 meses<b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>4 - 5 meses</b></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>6 - 12 meses</b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>+ 13 meses</b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>Total Stock Unidades</b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>% UA /STK</b></h6></th>";
    echo "</tr>";

    $sumTot03 = 0;
    $sumTot45 = 0;
    $sumTot612 = 0;
    $sumTot13 = 0;

    $sumUn03 = 0;
    $sumUn45 = 0;
    $sumUn612 = 0;
    $sumUn13 = 0;

    while($row = mysqli_fetch_assoc($res)){
        $costo03 = $row['costo03'];
        $costo45 = $row['costo45'];
        $costo612 = $row['costo612'];
        $costo13 = $row['costo13'];

        $sumTot03 = $sumTot03 + $costo03;
        $sumTot45 = $sumTot45 + $costo45;
        $sumTot612 = $sumTot612 + $costo612;
        $sumTot13 = $sumTot13 + $costo13;

        $totalStock = $costo03 + $costo45 + $costo612 + $costo13;

        $stockAnt = $costo612 + $costo13;

        $mastk = 0;
        if($totalStock > 0)
            $mastk = round(($stockAnt / $totalStock) * 100);

        $u03 = $row['u03'];
        $u45 = $row['u45'];
        $u612 = $row['u612'];
        $u13 = $row['u13'];

        $sumUn03 = $sumUn03 + $u03;
        $sumUn45 = $sumUn45 + $u45;
        $sumUn612 = $sumUn612 + $u612;
        $sumUn13 = $sumUn13 + $u13;

        $totalUnidades = $u03 + $u45 + $u612 + $u13;

        $stockUni = $u612 + $u13;

        $mauni = 0;
        if($totalUnidades > 0)
            $mauni = round(($stockUni / $totalUnidades) * 100);

        $pm = $row['pm'];

        echo "<tr><td class='text-center'><h6><a href='exportar.php?mes=$mes&anio=$anio&dia=$dia&pm=$pm&locacion=" . serialize($locacion) . "'>$pm</a></h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo03, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo45, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo612, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo13, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($totalStock, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($mastk, 0, ',', '.') . " %</h6></td>";

        echo "<td class='text-center'><h6>" . number_format($u03, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($u45, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($u612, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($u13, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($totalUnidades, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($mauni, 0, ',', '.') . " %</h6></td></tr>";
    }

    $totalS = $sumTot03 + $sumTot45 + $sumTot612 + $sumTot13;

    $stockAnt = $sumTot612 + $sumTot13;

    $mastk = 0;
    if($totalS > 0)
        $mastk = round(($stockAnt / $totalS) * 100);

    $totalU = $sumUn03 + $sumUn45 + $sumUn612 + $sumUn13;

    $stockUni = $sumUn612 + $sumUn13;

    $mauni = 0;
    if($totalU > 0)
        $mauni = round(($stockUni / $totalU) * 100);

    echo "<tr><td class='text-center' style='background-color: #C8EFFA;'><h6>Total</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot03, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot45, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot612, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot13, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($totalS, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($mastk, 0, ',', '.') . " %</h6></td>";

    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn03, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn45, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn612, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn13, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($totalU, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($mauni, 0, ',', '.') . " %</h6></td></tr>";

    echo "</table>";
    echo "</div>";
}

function informeDepto($dia, $mes, $anio, $pm, $locacion){
    $buscar = $anio . $mes . $dia;

    $cant = count($locacion);

    ini_set("max_execution_time", 0);

    $ventas = new mysqli('localhost', 'root', '', 'ventas');

    $query = "select depto1, nomdepto from depto where pm = '$pm'";

    $res = $ventas->query($query);

    $depto = array();
    $nomdepto = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $depto[$i] = $row['depto1'];
        $nomdepto[$i] = $row['nomdepto'];
        $i++;
    }

    $con = new mysqli('localhost', 'root', '', 'mantigua');

    $costo03 = array();
    $u03     = array();

    $i = 0;

    foreach($depto as $item) {
        $costo03[$i] = 0;
        $u03[$i]     = 0;
        $i++;
    }

    $i = 0;

    foreach($depto as $item) {
        $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad between 0 and 3";

        if ($cant > 0) {
            if (!in_array('Total', $locacion)) {
                $in = "(";

                for ($j = 0; $j < $cant; $j++) {
                    $in = $in . "'$locacion[$j]'";
                    if ($j < $cant - 1)
                        $in = $in . ", ";
                }

                $in = $in . ")";

                $query = $query . " and locacion in " . $in;
            }


        }

        $res = $con->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $costo03[$i] = $row['costo'];
            $u03[$i] = $row['unidades'];
        }

        if ($cant > 0) {
            if (in_array('Otros', $locacion)) {
                $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad between 0 and 3";

                $in = "'Disponible para la venta', 'Fotografia', 'Productos Danados', 'Logistica inversa', 'Zona de transito',
                  'Re-etiquetado', 'Logistica inversa/ cobros', 'Venta empresa', 'De baja', 'Extraviado'";

                $query = $query . " and locacion not in ($in)";

                $res = $con->query($query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $costo03[$i] = $costo03[$i] + $row['costo'];
                    $u03[$i] = $u03[$i] + $row['unidades'];
                }
            }
        }

        $i++;
    }

    $costo45 = array();
    $u45     = array();

    $i = 0;

    foreach($depto as $item) {
        $costo45[$i] = 0;
        $u45[$i]     = 0;
        $i++;
    }

    $i = 0;

    foreach($depto as $item) {
        $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad between 4 and 5";

        if ($cant > 0) {
            if (!in_array('Total', $locacion)) {
                $in = "(";

                for ($j = 0; $j < $cant; $j++) {
                    $in = $in . "'$locacion[$j]'";
                    if ($j < $cant - 1)
                        $in = $in . ", ";
                }

                $in = $in . ")";

                $query = $query . " and locacion in " . $in;
            }
        }

        $res = $con->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $costo45[$i] = $row['costo'];
            $u45[$i] = $row['unidades'];
        }

        if ($cant > 0) {
            if (in_array('Otros', $locacion)) {
                $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad between 4 and 5";

                $in = "'Disponible para la venta', 'Fotografia', 'Productos Danados', 'Logistica inversa', 'Zona de transito',
                  'Re-etiquetado', 'Logistica inversa/ cobros', 'Venta empresa', 'De baja', 'Extraviado'";

                $query = $query . " and locacion not in ($in)";

                $res = $con->query($query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $costo45[$i] = $costo45[$i] + $row['costo'];
                    $u45[$i] = $u45[$i] + $row['unidades'];
                }
            }
        }

        $i++;
    }

    $costo612 = array();
    $u612     = array();

    $i = 0;

    foreach($depto as $item) {
        $costo612[$i] = 0;
        $u612[$i]     = 0;
        $i++;
    }

    $i = 0;

    foreach($depto as $item) {
        $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad between 6 and 12";

        if ($cant > 0) {
            if (!in_array('Total', $locacion)) {
                $in = "(";

                for ($j = 0; $j < $cant; $j++) {
                    $in = $in . "'$locacion[$j]'";
                    if ($j < $cant - 1)
                        $in = $in . ", ";
                }

                $in = $in . ")";

                $query = $query . " and locacion in " . $in;
            }
        }

        $res = $con->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $costo612[$i] = $row['costo'];
            $u612[$i] = $row['unidades'];
        }

        if ($cant > 0) {
            if (in_array('Otros', $locacion)) {
                $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad between 6 and 12";

                $in = "'Disponible para la venta', 'Fotografia', 'Productos Danados', 'Logistica inversa', 'Zona de transito',
                  'Re-etiquetado', 'Logistica inversa/ cobros', 'Venta empresa', 'De baja', 'Extraviado'";

                $query = $query . " and locacion not in ($in)";

                $res = $con->query($query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $costo612[$i] = $costo612[$i] + $row['costo'];
                    $u612[$i] = $u612[$i] + $row['unidades'];
                }
            }
        }

        $i++;
    }

    $costo13 = array();
    $u13     = array();

    $i = 0;

    foreach($depto as $item) {
        $costo13[$i] = 0;
        $u13[$i]     = 0;
        $i++;
    }

    $i = 0;

    foreach($depto as $item) {
        $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad >= 13";

        if ($cant > 0) {
            if (!in_array('Total', $locacion)) {
                $in = "(";

                for ($j = 0; $j < $cant; $j++) {
                    $in = $in . "'$locacion[$j]'";
                    if ($j < $cant - 1)
                        $in = $in . ", ";
                }

                $in = $in . ")";

                $query = $query . " and locacion in " . $in;
            }
        }

        $res = $con->query($query);

        while ($row = mysqli_fetch_assoc($res)) {
            $costo13[$i] = $row['costo'];
            $u13[$i] = $row['unidades'];
        }

        if ($cant > 0) {
            if (in_array('Otros', $locacion)) {
                $query = "select sum(disponible * cosprom) as costo, sum(disponible) as unidades

                  from antigua

                  where fecha = $buscar and pm = '$pm' and dep = $item and antiguedad >= 13";

                $in = "'Disponible para la venta', 'Fotografia', 'Productos Danados', 'Logistica inversa', 'Zona de transito',
                  'Re-etiquetado', 'Logistica inversa/ cobros', 'Venta empresa', 'De baja', 'Extraviado'";

                $query = $query . " and locacion not in ($in)";

                $res = $con->query($query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $costo13[$i] = $costo13[$i] + $row['costo'];
                    $u13[$i] = $u13[$i] + $row['unidades'];
                }
            }
        }

        $i++;
    }

    echo "<div>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan = '2' style='background-color: #337ab7; color: white;'><h6><b>Departamento</b></h6></th>";
    echo "<th colspan = '6' style='background-color: #337ab7; color: white;'><h6><b>Stock Costo</b></h6></th>";
    echo "<th colspan = '6' style='background-color: #83ADE4; color: white;'><h6><b>Stock Unidades</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ 0 - 3 meses<b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ 4 - 5 meses</b></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ 6 - 12 meses</b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>$ + 13 meses</b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>Total Stock Costo</b></h6></th>";
    echo "<th style='background-color: #337ab7; color: white;'><h6><b>% MA / STK</b></h6></th>";

    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>0 - 3 meses<b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>4 - 5 meses</b></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>6 - 12 meses</b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>+ 13 meses</b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>Total Stock Unidades</b></h6></th>";
    echo "<th style='background-color: #83ADE4; color: white;'><h6><b>% UA /STK</b></h6></th>";
    echo "</tr>";

    $sumTot03 = 0;
    $sumTot45 = 0;
    $sumTot612 = 0;
    $sumTot13 = 0;

    $sumUn03 = 0;
    $sumUn45 = 0;
    $sumUn612 = 0;
    $sumUn13 = 0;

    $cant = count($depto);

    for($j=0; $j<$cant; $j++){
        $totalStock = $costo03[$j] + $costo45[$j] + $costo612[$j] + $costo13[$j];

        $sumTot03 = $sumTot03 + $costo03[$j];
        $sumTot45 = $sumTot45 + $costo45[$j];
        $sumTot612 = $sumTot612 + $costo612[$j];
        $sumTot13 = $sumTot13 + $costo13[$j];

        $totalUnidades = $u03[$j] + $u45[$j] + $u612[$j] + $u13[$j];

        $sumUn03 = $sumUn03 + $u03[$j];
        $sumUn45 = $sumUn45 + $u45[$j];
        $sumUn612 = $sumUn612 + $u612[$j];
        $sumUn13 = $sumUn13 + $u13[$j];

        $stockAnt = $costo612[$j] + $costo13[$j];

        $uniAnt = $u612[$j] + $u13[$j];

        $mastk = 0;
        if($totalUnidades > 0)
            $mastk = round(($stockAnt / $totalStock) * 100);

        $mauni = 0;
        if($totalUnidades > 0)
            $mauni = round(($uniAnt / $totalUnidades) * 100);


        echo "<tr><td class='text-center'><h6>" . $depto[$j] . " - " . $nomdepto[$j] . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo03[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo45[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo612[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($costo13[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($totalStock, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($mastk, 0, ',', '.') . " %</h6></td>";

        echo "<td class='text-center'><h6>" . number_format($u03[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($u45[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($u612[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($u13[$j], 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($totalUnidades, 0, ',', '.') . "</h6></td>";
        echo "<td class='text-center'><h6>" . number_format($mauni, 0, ',', '.') . " %</h6></td></tr>";
    }

    $totalS = $sumTot03 + $sumTot45 + $sumTot612 + $sumTot13;

    $stockAnt = $sumTot612 + $sumTot13;

    $mastk = 0;
    if($totalS > 0)
        $mastk = round(($stockAnt / $totalS) * 100);

    $totalU = $sumUn03 + $sumUn45 + $sumUn612 + $sumUn13;

    $stockUni = $sumUn612 + $sumUn13;

    $mauni = 0;
    if($totalU > 0)
        $mauni = round(($stockUni / $totalU) * 100);

    echo "<tr><td class='text-center' style='background-color: #C8EFFA;'><h6>Total</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot03, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot45, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot612, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($sumTot13, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($totalS, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #C8EFFA;'><h6>" . number_format($mastk, 0, ',', '.') . " %</h6></td>";

    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn03, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn45, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn612, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($sumUn13, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($totalU, 0, ',', '.') . "</h6></td>";
    echo "<td class='text-center' style='background-color: #B3D5DE;'><h6>" . number_format($mauni, 0, ',', '.') . " %</h6></td></tr>";

    echo "</table>";
    echo "</div>";
}

function comparar($dia, $mes, $anio, $mercaderia){
    $buscar = $anio . $mes . $dia;

    ini_set("max_execution_time", 0);

    $con = new mysqli('localhost', 'root', '', 'mantigua');

    //Stock Total

    $query = "select sum(mht.stockdisp) as stockdispmht, sum(mht.disp) as dispmht, sum(mht.stocknodisp) as stocknodispmht, sum(mht.nodisp) as nodispmht

              from com_div_mht mht where mht.fecha = $buscar";

    if($mercaderia != 'todos')
        $query = $query . " and antiguedad = '$mercaderia'";

    $res = $con->query($query);

    $stockdispMHT = 0;
    $stocknodispMHT = 0;
    $totalMHT = 0;

    $dispMHT = 0;
    $nodispMHT = 0;
    $totaluMHT = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $stockdispMHT = $row['stockdispmht'];
        $stocknodispMHT = $row['stocknodispmht'];

        $dispMHT = $row['dispmht'];
        $nodispMHT = $row['nodispmht'];
    }

    $totalMHT = $stockdispMHT + $stocknodispMHT;

    $totaluMHT = $dispMHT + $nodispMHT;

    $query = "select sum(eom.stockdisp) as stockdispeom, sum(eom.disp) as dispeom, sum(eom.stocknodisp) as stocknodispeom, sum(eom.nodisp) as nodispeom

              from com_div_eom eom where eom.fecha = $buscar";

    if($mercaderia != 'todos')
        $query = $query . " and antiguedad = '$mercaderia'";

    $res = $con->query($query);

    $stockdispEOM = 0;
    $stocknodispEOM = 0;
    $totalEOM = 0;

    $dispEOM = 0;
    $nodispEOM = 0;
    $totaluEOM = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $stockdispEOM = $row['stockdispeom'];
        $stocknodispEOM = $row['stocknodispeom'];

        $dispEOM = $row['dispeom'];
        $nodispEOM = $row['nodispeom'];
    }

    $totalEOM = $stockdispEOM + $stocknodispEOM;

    $totaluEOM = $dispEOM + $nodispEOM;

    echo "<div class='container'>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan='5' style='background-color: #337ab7; color: white;'><h6><b>Stock total</b></h6></th>";
    echo "<th rowspan='2' style='border-top-color: white;'></th>";
    echo "<th colspan='2'><h6><b>MHT</b></h6></th>";
    echo "<th colspan='2'><h6><b>EOM</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo</b></h6></th>";
    echo "<th><h6><b>Stock Unidades</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Disponible para la venta</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($stockdispMHT, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($dispMHT, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($stockdispEOM, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($dispEOM, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>No Disponible para la venta</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($stocknodispMHT, 0, ',', '.') . "<h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($nodispMHT, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($stocknodispEOM, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($nodispEOM, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='background-color: #C8EFFA;'><h6><b>Total</b></h6></th>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($totalMHT, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($totaluMHT, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($totalEOM, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($totaluEOM, 0, ',', '.') . "</h6></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";

    //Fin Stock Total

    $query = "select sum(mht.stockdisp) as stockdispmht, sum(mht.disp) as dispmht, division

              from com_div_mht mht where mht.fecha = $buscar";

    if($mercaderia != 'todos')
        $query = $query . " and antiguedad = '$mercaderia'";

    $query = $query . " group by division";

    $res = $con->query($query);

    $divmht = array();

    $com_div_mht = array();

    $totalMHT = 0;

    $totaluMHT = 0;

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $divmht[$i] = $row['division'];
        $com_div_mht[$i][0] = $row['stockdispmht'];
        $com_div_mht[$i][1] = $row['dispmht'];
        $totalMHT += $com_div_mht[$i][0];
        $totaluMHT += $com_div_mht[$i][1];
        $i++;
    }

    $query = "select sum(eom.stockdisp) as stockdispeom, sum(eom.disp) as dispeom, sum(eom.stockasig) as stockasigeom, sum(eom.asig) as asigeom,
                     sum(eom.stockss) as stocksseom, sum(eom.ss) as sseom, division

              from com_div_eom eom where eom.fecha = $buscar";

    if($mercaderia != 'todos')
        $query = $query . " and antiguedad = '$mercaderia'";

    $query = $query . " group by division";

    $res = $con->query($query);

    $diveom = array();

    $com_div_eom = array();

    $totalstockdispEOM = 0;

    $totaldispEOM = 0;

    $totalstockasigEOM = 0;

    $totalasigEOM = 0;

    $totalstockssEOM = 0;

    $totalssEOM = 0;

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $diveom[$i] = $row['division'];
        $com_div_eom[$i][0] = $row['stockdispeom'];
        $com_div_eom[$i][1] = $row['dispeom'];
        $com_div_eom[$i][2] = $row['stockasigeom'];
        $com_div_eom[$i][3] = $row['asigeom'];
        $com_div_eom[$i][4] = $row['stocksseom'];
        $com_div_eom[$i][5] = $row['sseom'];

        $totalstockdispEOM += $com_div_eom[$i][0];
        $totaldispEOM      += $com_div_eom[$i][1];
        $totalstockasigEOM += $com_div_eom[$i][2];
        $totalasigEOM      += $com_div_eom[$i][3];
        $totalstockssEOM   += $com_div_eom[$i][4];
        $totalssEOM        += $com_div_eom[$i][5];
        $i++;
    }

    $division = array('HOMBRES', 'DEPORTES', 'MUJER', 'ACCESORIOS', 'INFANTIL', 'TECNOLOGIA', 'DECO-HOGAR', 'ELECTRO-HOGAR', 'OTROS', 'TOTAL');

    echo "<div class='container'>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan='13' style='background-color: #337ab7; color: white;'><h6><b>Comparación<br>por División</br></h6></th>";
    echo "<th rowspan='3' style='border-top-color: white;'></th>";
    echo "<th colspan='2' style='border-right-color: black;'><h6><b>MHT</b></h6></th>";
    echo "<th colspan='8'><h6><b>EOM</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th colspan='2' style='border-right-color: black;'><h6><b>Disponible<b></h6></th>";
    echo "<th colspan='2' style='border-right-color: #337ab7;'><h6><b>Disponible</b></th>";
    echo "<th colspan='2' style='border-right-color: #337ab7;'><h6><b>Asignado</b></h6></th>";
    echo "<th colspan='2' style='border-right-color: #337ab7;'><h6><b>Stock de Seguridad</b></h6></th>";
    echo "<th colspan='2'><h6><b>Disponible para la venta</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: black;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: #337ab7;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: #337ab7;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: #337ab7;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th><h6><b>Stock Unidades</b></th>";
    echo "</tr>";

    foreach($division as $item){
        if(in_array($item, $divmht) && in_array($item, $diveom)){
            $mht = array_search($item, $divmht);
            $eom = array_search($item, $diveom);
            echo "<tr>";
            echo "<th><h6><b>" . ucfirst(strtolower($item)) . "<b></h6></th>";
            echo "<th><h6>" . number_format($com_div_mht[$mht][0], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: black;'><h6>" . number_format($com_div_mht[$mht][1], 0, ',', '.') . "</th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][0], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: #337ab7;'><h6>" . number_format($com_div_eom[$eom][1], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][2], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: #337ab7;'><h6>" . number_format($com_div_eom[$eom][3], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][4], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: #337ab7;'><h6>" . number_format($com_div_eom[$eom][5], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][0] - $com_div_eom[$eom][2] - $com_div_eom[$eom][4], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][1] - $com_div_eom[$eom][3] - $com_div_eom[$eom][5], 0, ',', '.') . "</h6></th>";
            echo "</tr>";
        }
    }

    echo "<tr>";
    echo "<th style='background-color: #C8EFFA;'><h6><b>Total<b></h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalMHT, 0, ',', '.') . "</h6></th>";
    echo "<th style='border-right-color: black; background-color: #C8EFFA;'><h6>" . number_format($totaluMHT, 0, ',', '.') . "</th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockdispEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA; border-right-color: #337ab7;'><h6>" . number_format($totaldispEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockasigEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA; border-right-color: #337ab7;'><h6>" . number_format($totalasigEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockssEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA; border-right-color: #337ab7;'><h6>" . number_format($totalssEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockdispEOM - $totalstockasigEOM - $totalstockssEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totaldispEOM - $totalasigEOM - $totalssEOM, 0, ',', '.') . "</h6></th>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";

    /*
     * Fin
     * de
     * Comparacion
     * por
     * division
     *
     */

    $query = "select sum(mht.stockcosto) as stockcostomht, sum(mht.stockunidades) as dispmht, pm

              from com_pm_mht mht where mht.fecha = $buscar";

    if($mercaderia != 'todos')
        $query = $query . " and antiguedad = '$mercaderia'";

    $query = $query . " group by pm";

    $res = $con->query($query);

    $divmht = array();

    $com_div_mht = array();

    $totalMHT = 0;

    $totaluMHT = 0;

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $divmht[$i] = $row['pm'];
        $com_div_mht[$i][0] = $row['stockcostomht'];
        $com_div_mht[$i][1] = $row['dispmht'];
        $totalMHT += $com_div_mht[$i][0];
        $totaluMHT += $com_div_mht[$i][1];
        $i++;
    }

    $query = "select sum(eom.stockdisp) as stockdispeom, sum(eom.disp) as dispeom, sum(eom.stockasig) as stockasigeom, sum(eom.asig) as asigeom,
                     sum(eom.stockss) as stocksseom, sum(eom.ss) as sseom, pm

              from com_pm_eom eom where eom.fecha = $buscar";

    if($mercaderia != 'todos')
        $query = $query . " and antiguedad = '$mercaderia'";

    $query = $query . " group by pm";

    $res = $con->query($query);

    $diveom = array();

    $com_div_eom = array();

    $totalstockdispEOM = 0;

    $totaldispEOM = 0;

    $totalstockasigEOM = 0;

    $totalasigEOM = 0;

    $totalstockssEOM = 0;

    $totalssEOM = 0;

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $diveom[$i] = $row['pm'];
        $com_div_eom[$i][0] = $row['stockdispeom'];
        $com_div_eom[$i][1] = $row['dispeom'];
        $com_div_eom[$i][2] = $row['stockasigeom'];
        $com_div_eom[$i][3] = $row['asigeom'];
        $com_div_eom[$i][4] = $row['stocksseom'];
        $com_div_eom[$i][5] = $row['sseom'];

        $totalstockdispEOM += $com_div_eom[$i][0];
        $totaldispEOM      += $com_div_eom[$i][1];
        $totalstockasigEOM += $com_div_eom[$i][2];
        $totalasigEOM      += $com_div_eom[$i][3];
        $totalstockssEOM   += $com_div_eom[$i][4];
        $totalssEOM        += $com_div_eom[$i][5];
        $i++;
    }

    $con = new mysqli('localhost', 'root', '', 'ventas');

    $query = "select distinct pm from depto where pm <> '' order by pm asc";

    $res = $con->query($query);

    $division = array();

    $i = 0;

    while($row = mysqli_fetch_assoc($res)){
        $division[$i] = $row['pm'];
        $i++;
    }

    echo "<div class='container'>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan='13' style='background-color: #337ab7; color: white;'><h6><b>Comparación<br>por PM</br></h6></th>";
    echo "<th rowspan='3' style='border-top-color: white;'></th>";
    echo "<th colspan='2' style='border-right-color: black;'><h6><b>MHT</b></h6></th>";
    echo "<th colspan='8'><h6><b>EOM</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th colspan='2' style='border-right-color: black;'><h6><b>Disponible<b></h6></th>";
    echo "<th colspan='2' style='border-right-color: #337ab7;'><h6><b>Disponible</b></th>";
    echo "<th colspan='2' style='border-right-color: #337ab7;'><h6><b>Asignado</b></h6></th>";
    echo "<th colspan='2' style='border-right-color: #337ab7;'><h6><b>Stock de Seguridad</b></h6></th>";
    echo "<th colspan='2'><h6><b>Disponible para la venta</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: black;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: #337ab7;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: #337ab7;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th style='border-right-color: #337ab7;'><h6><b>Stock Unidades</b></th>";
    echo "<th><h6><b>Stock Costo<b></h6></th>";
    echo "<th><h6><b>Stock Unidades</b></th>";
    echo "</tr>";

    foreach($division as $item){
        if(in_array($item, $divmht) && in_array($item, $diveom)){
            $mht = array_search($item, $divmht);
            $eom = array_search($item, $diveom);
            echo "<tr>";
            echo "<th><h6><b>" . ucwords($item) . "<b></h6></th>";
            echo "<th><h6>" . number_format($com_div_mht[$mht][0], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: black;'><h6>" . number_format($com_div_mht[$mht][1], 0, ',', '.') . "</th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][0], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: #337ab7;'><h6>" . number_format($com_div_eom[$eom][1], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][2], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: #337ab7;'><h6>" . number_format($com_div_eom[$eom][3], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][4], 0, ',', '.') . "</h6></th>";
            echo "<th style='border-right-color: #337ab7;'><h6>" . number_format($com_div_eom[$eom][5], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][0] - $com_div_eom[$eom][2] - $com_div_eom[$eom][4], 0, ',', '.') . "</h6></th>";
            echo "<th><h6>" . number_format($com_div_eom[$eom][1] - $com_div_eom[$eom][3] - $com_div_eom[$eom][5], 0, ',', '.') . "</h6></th>";
            echo "</tr>";
        }
    }

    echo "<tr>";
    echo "<th style='background-color: #C8EFFA;'><h6><b>Total<b></h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalMHT, 0, ',', '.') . "</h6></th>";
    echo "<th style='border-right-color: black; background-color: #C8EFFA;'><h6>" . number_format($totaluMHT, 0, ',', '.') . "</th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockdispEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA; border-right-color: #337ab7;'><h6>" . number_format($totaldispEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockasigEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA; border-right-color: #337ab7;'><h6>" . number_format($totalasigEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockssEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA; border-right-color: #337ab7;'><h6>" . number_format($totalssEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totalstockdispEOM - $totalstockasigEOM - $totalstockssEOM, 0, ',', '.') . "</h6></th>";
    echo "<th style='background-color: #C8EFFA;'><h6>" . number_format($totaldispEOM - $totalasigEOM - $totalssEOM, 0, ',', '.') . "</h6></th>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";
}

function fecha($dia, $mes, $anio){
    if($mes == '01')
        $mes = 'enero';
    if($mes == '02')
        $mes = 'febrero';
    if($mes == '03')
        $mes = 'marzo';
    if($mes == '04')
        $mes = 'abril';
    if($mes == '05')
        $mes = 'mayo';
    if($mes == '06')
        $mes = 'junio';
    if($mes == '07')
        $mes = 'julio';
    if($mes == '08')
        $mes = 'agosto';
    if($mes == '09')
        $mes = 'septiembre';
    if($mes == '10')
        $mes = 'octubre';
    if($mes == '11')
        $mes = 'noviembre';
    if($mes == '12')
        $mes = 'diciembre';

    return $dia . " de " . $mes . " de " . $anio;
}