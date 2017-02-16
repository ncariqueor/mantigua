<?php
function General($dia, $mes, $anio, $diaant, $mesant, $anioant){
    require_once '../fecha_es.php';
    
    $con = new mysqli('localhost', 'root', '', 'mantigua');
    
    $buscar = $anio . $mes . $dia;
    
    $buscarant = $anioant . $mesant . $diaant;
    
    $query = "select * from tabla_retiquetado where dia = $buscar";

    $res = $con->query($query);

    $costohombres         = 0;
    $costodeportes        = 0;
    $costomujer           = 0;
    $costoaccesorios      = 0;
    $costoinfantil        = 0;
    $costotecnologia      = 0;
    $costodecohogar       = 0;
    $costoelectrohogar    = 0;
    $cosotros             = 0;
    $costototal           = 0;

    $pcoshombres          = 0;
    $pcosdeportes         = 0;
    $pcosmujer            = 0;
    $pcosaccesorios       = 0;
    $pcosinfantil         = 0;
    $pcostecnologia       = 0;
    $pcosdecohogar        = 0;
    $pcoselectrohogar     = 0;
    $pcosotros            = 0;
    $pcostotal            = 0;

    $promdiashombres      = 0;
    $promdiasdeportes     = 0;
    $promdiasmujer        = 0;
    $promdiasaccesorios   = 0;
    $promdiasinfantil     = 0;
    $promdiastecnologia   = 0;
    $promdiasdecohogar    = 0;
    $promdiaselectrohogar = 0;
    $promdiasotros        = 0;
    $promdiastotal        = 0;

    $maxdiashombres       = 0;
    $maxdiasdeportes      = 0;
    $maxdiasmujer         = 0;
    $maxdiasaccesorios    = 0;
    $maxdiasinfantil      = 0;
    $maxdiastecnologia    = 0;
    $maxdiasdecohogar     = 0;
    $maxdiaselectrohogar  = 0;
    $maxdiasotros         = 0;
    $maxdiastotal         = 0;

    $mayor7hombres        = 0;
    $mayor7deportes       = 0;
    $mayor7mujer          = 0;
    $mayor7accesorios     = 0;
    $mayor7infantil       = 0;
    $mayor7tecnologia     = 0;
    $mayor7decohogar      = 0;
    $mayor7electrohogar   = 0;
    $mayor7otros          = 0;
    $mayor7total          = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $costohombres         = $row['costohombres'];
        $costodeportes        = $row['costodeportes'];
        $costomujer           = $row['costomujer'];
        $costoaccesorios      = $row['costoaccesorios'];
        $costoinfantil        = $row['costoinfantil'];
        $costotecnologia      = $row['costotecnologia'];
        $costodecohogar       = $row['costodecohogar'];
        $costoelectrohogar    = $row['costoelectrohogar'];
        $cosotros             = $row['cosotros'];
        $costototal           = $row['costototal'];

        $pcoshombres          = $row['pcoshombres'];
        $pcosdeportes         = $row['pcosdeportes'];
        $pcosmujer            = $row['pcosmujer'];
        $pcosaccesorios       = $row['pcosaccesorios'];
        $pcosinfantil         = $row['pcosinfantil'];
        $pcostecnologia       = $row['pcostecnologia'];
        $pcosdecohogar        = $row['pcosdecohogar'];
        $pcoselectrohogar     = $row['pcoselectrohogar'];
        $pcosotros            = $row['pcosotros'];
        $pcostotal            = $row['pcostotal'];

        $promdiashombres      = $row['promdiashombres'];
        $promdiasdeportes     = $row['promdiasdeportes'];
        $promdiasmujer        = $row['promdiasmujer'];
        $promdiasaccesorios   = $row['promdiasaccesorios'];
        $promdiasinfantil     = $row['promdiasinfantil'];
        $promdiastecnologia   = $row['promdiastecnologia'];
        $promdiasdecohogar    = $row['promdiasdecohogar'];
        $promdiaselectrohogar = $row['promdiaselectrohogar'];
        $promdiasotros        = $row['promdiasotros'];
        $promdiastotal        = $row['promdiastotal'];

        $maxdiashombres       = $row['maxdiashombres'];
        $maxdiasdeportes      = $row['maxdiasdeportes'];
        $maxdiasmujer         = $row['maxdiasmujer'];
        $maxdiasaccesorios    = $row['maxdiasaccesorios'];
        $maxdiasinfantil      = $row['maxdiasinfantil'];
        $maxdiastecnologia    = $row['maxdiastecnologia'];
        $maxdiasdecohogar     = $row['maxdiasdecohogar'];
        $maxdiaselectrohogar  = $row['maxdiaselectrohogar'];
        $maxdiasotros         = $row['maxdiasotros'];
        $maxdiastotal         = $row['maxdiastotal'];

        $mayor7hombres        = $row['mayor7hombres'];
        $mayor7deportes       = $row['mayor7deportes'];
        $mayor7mujer          = $row['mayor7mujer'];
        $mayor7accesorios     = $row['mayor7accesorios'];
        $mayor7infantil       = $row['mayor7infantil'];
        $mayor7tecnologia     = $row['mayor7tecnologia'];
        $mayor7decohogar      = $row['mayor7decohogar'];
        $mayor7electrohogar   = $row['mayor7electrohogar'];
        $mayor7otros          = $row['mayor7otros'];
        $mayor7total          = $row['mayor7total'];
    }

    $query = "select * from tabla_retiquetado where dia = $buscarant";

    $res = $con->query($query);

    $costohombresAnt         = 0;
    $costodeportesAnt        = 0;
    $costomujerAnt           = 0;
    $costoaccesoriosAnt      = 0;
    $costoinfantilAnt        = 0;
    $costotecnologiaAnt      = 0;
    $costodecohogarAnt       = 0;
    $costoelectrohogarAnt    = 0;
    $cosotrosAnt             = 0;
    $costototalAnt           = 0;

    $uhombresAnt      = 0;
    $udeportesAnt     = 0;
    $umujerAnt        = 0;
    $uaccesoriosAnt   = 0;
    $uinfantilAnt     = 0;
    $utecnologiaAnt   = 0;
    $udecohogarAnt    = 0;
    $uelectrohogarAnt = 0;
    $uotrosAnt        = 0;
    $utotalAnt        = 0;

    while($row = mysqli_fetch_assoc($res)){
        $costohombresAnt         = $row['costohombres'];
        $costodeportesAnt        = $row['costodeportes'];
        $costomujerAnt           = $row['costomujer'];
        $costoaccesoriosAnt      = $row['costoaccesorios'];
        $costoinfantilAnt        = $row['costoinfantil'];
        $costotecnologiaAnt      = $row['costotecnologia'];
        $costodecohogarAnt       = $row['costodecohogar'];
        $costoelectrohogarAnt    = $row['costoelectrohogar'];
        $cosotrosAnt             = $row['cosotros'];
        $costototalAnt           = $row['costototal'];

        $uhombresAnt      = $row['uhombres'];
        $udeportesAnt     = $row['udeportes'];
        $umujerAnt        = $row['umujer'];
        $uaccesoriosAnt   = $row['uaccesorios'];
        $uinfantilAnt     = $row['uinfantil'];
        $utecnologiaAnt   = $row['utecnologia'];
        $udecohogarAnt    = $row['udecohogar'];
        $uelectrohogarAnt = $row['uelectrohogar'];
        $uotrosAnt        = $row['uotros'];
        $utotalAnt        = $row['utotal'];
    }

    $pcoshombres = $costohombres - $costohombresAnt;
    $pcosdeportes = $costodeportes - $costodeportesAnt;
    $pcosmujer = $costomujer - $costomujerAnt;
    $pcosaccesorios = $costoaccesorios - $costoaccesoriosAnt;
    $pcosinfantil = $costoinfantil - $costoinfantilAnt;
    $pcostecnologia = $costotecnologia- $costotecnologiaAnt;
    $pcosdecohogar = $costodecohogar - $costodecohogarAnt;
    $pcoselectrohogar = $costoelectrohogar - $costoelectrohogarAnt;
    $pcosotros = $cosotros - $cosotrosAnt;
    $pcostotal = $costototal - $costototalAnt;

    $varhombres = 0;
    if($costohombresAnt > 0)
        $varhombres = round((($costohombres / $costohombresAnt) - 1) * 100);

    $vardeportes = 0;
    if($costodeportesAnt > 0)
        $vardeportes = round((($costodeportes / $costodeportesAnt) - 1) * 100);

    $varmujer = 0;
    if($costomujerAnt > 0)
        $varmujer = round((($costomujer / $costomujerAnt) - 1) * 100);

    $varaccesorios = 0;
    if($costoaccesoriosAnt > 0)
        $varaccesorios = round((($costoaccesorios / $costoaccesoriosAnt) - 1) * 100);

    $varinfantil = 0;
    if($costoinfantilAnt > 0)
        $varinfantil = round((($costoinfantil / $costoinfantilAnt) - 1) * 100);

    $vartecnologia = 0;
    if($costotecnologiaAnt > 0)
        $vartecnologia = round((($costotecnologia / $costotecnologiaAnt) - 1) * 100);

    $vardecohogar = 0;
    if($costodecohogarAnt > 0)
        $vardecohogar = round((($costodecohogar / $costodecohogarAnt) - 1) * 100);

    $varelectrohogar = 0;
    if($costoelectrohogarAnt > 0)
        $varelectrohogar = round((($costoelectrohogar / $costoelectrohogarAnt) - 1) * 100);

    $varotros = 0;
    if($cosotrosAnt > 0)
        $varotros = round((($cosotros / $cosotrosAnt) - 1) * 100);

    $vartotal = 0;
    if($costototalAnt > 0)
        $vartotal = round((($costototal / $costototalAnt) - 1) * 100);

    echo "<div class='container'>";
    echo "<table class='table table-bordered table-condensed container'>";
    echo "<tr>";
    echo "<th rowspan='12' style='background-color: #337ab7; color: white;'><h6><b>Re-etiquetado</b></h6></th>";
    echo "<th rowspan='2' style='border-top-color: white;'></th>";
    echo "<th colspan='6' style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6><b>" . date("d", strtotime("{$buscar}")) . " de " . obtenerMes(date("m", strtotime("{$buscar}"))) . " de " . date("Y", strtotime("{$buscar}")) . "</b></h6></th>";
    echo "<th colspan='2'><h6><b>" . date("d", strtotime("{$buscarant}")) . " de " . obtenerMes(date("m", strtotime("{$buscarant}"))) . " de " . date("Y", strtotime("{$buscarant}")) . "</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Costo $<b></h6></th>";
    echo "<th><h6><b>Var % Costo</b></th>";
    echo "<th><h6><b>Var $ Costo</b></h6></th>";
    echo "<th><h6><b>Prom días</b></h6></th>";
    echo "<th><h6><b>Máx días</b></h6></th>";
    echo "<th style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6><b>Costo > 7 días</b></h6></th>";
    echo "<th><h6><b>Costo $<b></h6></th>";
    echo "<th><h6><b>Unidades</b></h6></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Hombres</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costohombres, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varhombres, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcoshombres, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiashombres, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiashombres, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7hombres, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costohombresAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uhombresAnt) . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Deportes</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costodeportes, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($vardeportes, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosdeportes, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiasdeportes, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiasdeportes, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7deportes, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costodeportesAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($udeportesAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Mujer</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costomujer, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varmujer, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosmujer, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiasmujer, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiasmujer, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7mujer, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costomujerAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($umujerAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Accesorios</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costoaccesorios, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varaccesorios, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosaccesorios, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiasaccesorios, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiasaccesorios, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7accesorios, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costoaccesoriosAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uaccesoriosAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Infantil</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costoinfantil, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varinfantil, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosinfantil, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiasinfantil, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiasinfantil, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7infantil, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costoinfantilAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uinfantilAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Tecnología</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costotecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($vartecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcostecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiastecnologia, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiastecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7tecnologia, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costotecnologiaAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($utecnologiaAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Deco-Hogar</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costodecohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($vardecohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosdecohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiasdecohogar, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiasdecohogar, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7decohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costodecohogarAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($udecohogarAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Electro-Hogar</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($costoelectrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varelectrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcoselectrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiaselectrohogar, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiaselectrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7electrohogar, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($costoelectrohogarAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uelectrohogarAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th><h6><b>Otros</b></h6></th>";
    echo "<td><h6 class='text-center'>" . number_format($cosotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($varotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($pcosotros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($promdiasotros, 1, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($maxdiasotros, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6;'><h6 class='text-center'>" . number_format($mayor7otros, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($cosotrosAnt, 0, ',', '.') . "</h6></td>";
    echo "<td><h6 class='text-center'>" . number_format($uotrosAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='background-color: #C8EFFA;'><h6><b>Total</b></h6></th>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($costototal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($vartotal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($pcostotal, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($promdiastotal, 1, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($maxdiastotal, 0, ',', '.') . "</h6></td>";
    echo "<td style='border-right-width: 5px; border-right-color: #E6E6E6; background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($mayor7total, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($costototalAnt, 0, ',', '.') . "</h6></td>";
    echo "<td style='background-color: #C8EFFA;'><h6 class='text-center'>" . number_format($utotalAnt, 0, ',', '.') . "</h6></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";
}
?>