<?php
date_default_timezone_set("America/Santiago");

ini_set("max_execution_time", 0);

$mht = odbc_connect('wms2', 'SA', 'SA');

$roble = odbc_connect('CECEBUGD', 'USRVNP', 'USRVNP');

$local = new mysqli('localhost', 'root', '', 'mantigua');

$ventas = new mysqli('localhost', 'root', '', 'ventas');

$eom   = odbc_connect('EOM', 'REPORTER', 'RptCyber2015');

$fecha = date("Ymd");

echo "Actualizacion Mercaderia Antigua, fecha $fecha <br>";

require_once 'stocktotal.php';
require_once 'stocknodisp.php';
require_once 'mercaderia_antigua.php';
require_once 'tabla_retiquetado.php';
require_once 'calc_pm.php';
require_once 'comp_div.php';
require_once 'comp_pm.php';

function actualizarMHT($local, $roble, $mht, $ventas)
{
    $fecha = date("Ymd");

    $fechaAnt = date("Ymd", strtotime("-1 day"));

    $local->query("delete from antigua where fecha = $fecha");

    $query = "SELECT Stock701722730.SIZE_DESC, Stock701722730.LOCN_BRCD, Stock701722730.Disponible,
                 Stock701722730.Tipo, Stock701722730.WHSE, Stock701722730.LPN

          FROM   Stock_Cd.dbo.Stock701722730 Stock701722730

          WHERE  Stock701722730.WHSE = '200' and Stock701722730.Disponible > 0

          ORDER BY Stock701722730.DISPONIBLE ASC";

    $result = odbc_exec($mht, $query);

    $retiquetado[][] = array();

    $detalle = "";

    $i = 0;

    if($result) {
        while (odbc_fetch_row($result)) {
            $sku        = odbc_result($result, 1);
            $skuc       = odbc_result($result, 1);
            $locn_brcd  = odbc_result($result, 2);
            $disponible = odbc_result($result, 3);
            $tipo       = odbc_result($result, 4);
            $whse       = odbc_result($result, 5);
            $lpn        = odbc_result($result, 6);

            $sku = str_split($sku);

            $sku = $sku[0] . $sku[1] . $sku[2] . $sku[3] . $sku[4] . $sku[5];

            $query = "SELECT EXKPF01.ESTILO, EXKPF01.NOMPRV,  GGREFX.VENDOR,  GGREFX.DEP,
                             GGREFX.SUBDEP,  GGREFX.CLA,      EXKPF01.DESDEP, EXKPF01.DESSDP,
                             EXKPF01.DESCLA, GGREFX.ESTACION, EXKPF01.TEMPOR, GGREFX.FECING,
                             GGREFX.UNITRA,  GGREFX.COSPROM,  GGREFX.PRENOR,  GGREFX.PREOFE,
                             EXKPF01.RUT,    EXKPF01.CODMAR,  INVMST.IDESCR

                      FROM RDBPARIS2.EXGCBUGD.EXKPF01 EXKPF01, RDBPARIS2.EXGCBUGD.GGREFX GGREFX, RDBPARIS2.MMSP4LIB.INVMST INVMST

                      WHERE EXKPF01.ESTILO = '$sku' and EXKPF01.REF = GGREFX.REF and INVMST.INUMBR = '$skuc'";

            $res = odbc_exec($roble, $query);

            $division = "";

            $pm = "";

            $negocio = "";

            if($res) {
                while (odbc_fetch_row($res)) {
                    $estilo   = odbc_result($res, 1);
                    $nomprv   = odbc_result($res, 2);
                    $vendor   = odbc_result($res, 3);
                    $dep      = odbc_result($res, 4);
                    $subdep   = odbc_result($res, 5);
                    $cla      = odbc_result($res, 6);
                    $desdep   = odbc_result($res, 7);
                    $dessdp   = odbc_result($res, 8);
                    $descla   = odbc_result($res, 9);
                    $estacion = odbc_result($res, 10);
                    $tempor   = odbc_result($res, 11);
                    $fecing   = odbc_result($res, 12);
                    $unitra   = odbc_result($res, 13);
                    $cosprom  = odbc_result($res, 14);
                    $prenor   = odbc_result($res, 15);
                    $preofe   = odbc_result($res, 16);
                    $rut      = odbc_result($res, 17);
                    $codmar   = odbc_result($res, 18);
                    $idescr   = odbc_result($res, 19);

                    $nomprv = str_split($nomprv);
                    $nomprvtmp = "";
                    $count = count($nomprv);
                    for ($k = 0; $k < $count; $k++) {
                        if ($nomprv[$k] == "'")
                            $nomprvtmp = $nomprvtmp . "'" . $nomprv[$k];
                        else
                            $nomprvtmp = $nomprvtmp . $nomprv[$k];
                    }

                    $sku_desc = str_split($idescr);
                    $sku_desctmp = "";
                    $count = count($sku_desc);
                    for ($k = 0; $k < $count; $k++) {
                        if ($sku_desc[$k] == "'")
                            $sku_desctmp = $sku_desctmp . "'" . $sku_desc[$k];
                        else
                            $sku_desctmp = $sku_desctmp . $sku_desc[$k];
                    }

                    //Diferencia de Meses

                    $dia1 = new DateTime($fecing);

                    $dia2 = date("Ymd");

                    $dia2 = new DateTime($dia2);

                    $diferencia = ($dia2->format("Y") - $dia1->format("Y")) * 12 + ($dia2->format("m") - $dia1->format("m"));

                    //Fin diferencia de meses

                    //Asignacion de division y pm

                    $asignacion = "select division, pm, negocio from depto where depto1 = $dep";

                    $resultado = $ventas->query($asignacion);

                    while($row = mysqli_fetch_assoc($resultado)){
                        $division = $row['division'];
                        $pm       = $row['pm'];
                        $negocio  = $row['negocio'];
                    }

                    //Fin asignacion de division y pm

                    $locacion = "select locacion, detalle from locaciones where ubicacion = '$locn_brcd'";

                    $resultado = $local->query($locacion);

                    $locacion = "";

                    while($row = mysqli_fetch_assoc($resultado)){
                        $locacion = $row['locacion'];
                        $detalle = $row['detalle'];
                    }

                    $query = "insert into antigua values (
                                               $fecha,
                                              '$lpn',
                                               $skuc,
                                              '$sku_desctmp',
                                              '$locn_brcd',
                                               $disponible,
                                              '$tipo',
                                               $whse,
                                              '$estilo',
                                              '$nomprvtmp',
                                               $vendor,
                                               $dep,
                                               $subdep,
                                               $cla,
                                              '$desdep',
                                              '$dessdp',
                                              '$descla',
                                              '$estacion',
                                              '$tempor',
                                               $fecing,
                                               $unitra,
                                               $cosprom,
                                               $prenor,
                                               $preofe,
                                              '$rut',
                                              '$division',
                                              '$pm',
                                               $diferencia,
                                              '$codmar',
                                              '$locacion',
                                              '$negocio',
                                              '$detalle')";

                    $insertar = $local->query($query);

                    if (!$insertar){
                        echo "Se genero error " . $local->error . " <br> ";
                    }

                    if($locacion == 'Re-etiquetado'){
                        $retiquetado[$i][0] = 0;
                        $retiquetado[$i][1] = trim($locn_brcd) . $skuc;
                        $retiquetado[$i][2] = 0;
                        $retiquetado[$i][3] = $pm;
                        $retiquetado[$i][4] = $locn_brcd;
                        $retiquetado[$i][5] = $detalle;
                        $retiquetado[$i][6] = $negocio;
                        $retiquetado[$i][7] = $division;
                        $retiquetado[$i][8] = $dep;
                        $retiquetado[$i][9] = $desdep;
                        $retiquetado[$i][10] = $subdep;
                        $retiquetado[$i][11] = $cla;
                        $retiquetado[$i][12] = $descla;
                        $retiquetado[$i][13] = $estilo;
                        $retiquetado[$i][14] = $skuc;
                        $retiquetado[$i][15] = $sku_desctmp;
                        $retiquetado[$i][16] = $codmar;
                        $retiquetado[$i][17] = $estacion;
                        $retiquetado[$i][18] = $tempor;
                        $retiquetado[$i][19] = $dessdp;
                        $retiquetado[$i][20] = $vendor;
                        $retiquetado[$i][21] = $nomprvtmp;
                        $retiquetado[$i][22] = $diferencia;
                        $retiquetado[$i][23] = $cosprom;
                        $retiquetado[$i][24] = $disponible;
                        $retiquetado[$i][25] = $prenor;
                        $retiquetado[$i][26] = $preofe;

                        $i++;
                    }
                }
            }else{
                echo "Error en obtener de Roble. <br> ";
                return false;
            }
        }
    }
    else{
        echo "Error en obtener de Manhattan. <br>";
        return false;
    }

    for($j=0; $j<$i; $j++){
        $llave = $retiquetado[$j][1];

        $query = "select fecingret from retiquetado where llave = '$llave' and fecha = $fechaAnt";

        $res = $local->query($query);

        $cant = mysqli_num_rows($res);

        $dia1 = 0;

        if($cant > 0){
            while($row = mysqli_fetch_assoc($res))
                $dia1 = $row['fecingret'];

            $dia1 = new DateTime($dia1);

            $dia2 = new DateTime(date("Ymd"));

            $diferencia = $dia1->diff($dia2);

            $diferencia = $diferencia->format("%a");

            $retiquetado[$j][0] = $diferencia;

            $retiquetado[$j][2] = $dia1->format("Ymd");
        }
        else{
            $retiquetado[$j][2] = date("Ymd");
        }
    }

    $local->query("delete from retiquetado where fecha = $fecha");

    for($j=0; $j<$i; $j++){
        $diasret = $retiquetado[$j][0];
        $llave = $retiquetado[$j][1];
        $fecingret = $retiquetado[$j][2];
        $pm = $retiquetado[$j][3];
        $locn_brcd = $retiquetado[$j][4];
        $detalle = $retiquetado[$j][5];
        $negocio = $retiquetado[$j][6];
        $division = $retiquetado[$j][7];
        $dep = $retiquetado[$j][8];
        $desdep = $retiquetado[$j][9];
        $subdep = $retiquetado[$j][10];
        $cla = $retiquetado[$j][11];
        $descla = $retiquetado[$j][12];
        $estilo = $retiquetado[$j][13];
        $skuc = $retiquetado[$j][14];
        $sku_desc = $retiquetado[$j][15];
        $codmar = $retiquetado[$j][16];
        $estacion = $retiquetado[$j][17];
        $tempor = $retiquetado[$j][18];
        $dessdp = $retiquetado[$j][19];
        $vendor = $retiquetado[$j][20];
        $nomprv = $retiquetado[$j][21];
        $diferencia = $retiquetado[$j][22];
        $cosprom = $retiquetado[$j][23];
        $disponible = $retiquetado[$j][24];
        $prenor = $retiquetado[$j][25];
        $preofe = $retiquetado[$j][26];

        $insertar = "insert into retiquetado values($fecha,
                                                    $diasret,
                                                   '$llave',
                                                    $fecingret,
                                                   '$pm',
                                                   '$locn_brcd',
                                                   '$detalle',
                                                   '$negocio',
                                                   '$division',
                                                    $dep,
                                                   '$desdep',
                                                    $subdep,
                                                    $cla,
                                                   '$descla',
                                                    $estilo,
                                                    $skuc,
                                                   '$sku_desc',
                                                   '$codmar',
                                                   '$estacion',
                                                   '$tempor',
                                                   '$dessdp',
                                                    $vendor,
                                                   '$nomprv',
                                                    $diferencia,
                                                    $cosprom,
                                                    $disponible,
                                                    $prenor,
                                                    $preofe)";

        $local->query($insertar);

    }

    return true;
}

function actualizarEOM($local, $roble, $eom, $ventas){
    $fecha = date("Ymd");

    $local->query("delete from eombase where fecha = $fecha");

    $query = "SELECT distinct CA14.ITEM_CBO.ITEM_NAME,
                 COMM14.FACILITY_ALIAS.FACILITY_ALIAS_ID,
                 COMM14.FACILITY_ALIAS.FACILITY_NAME,
                 CA14.I_PERPETUAL.AVAILABLE_QUANTITY,
                 CA14.I_PERPETUAL.UNAVAILABLE_QUANTITY,
                 CA14.I_ALLOCATION.ALLOCATED_QUANTITY,
                 CA14.SKU_LOCATION.INV_PROTECTION_1

          FROM CA14.SKU_LOCATION RIGHT JOIN (COMM14.FACILITY_ALIAS INNER JOIN (CA14.I_ALLOCATION INNER JOIN
              (CA14.I_PERPETUAL INNER JOIN CA14.ITEM_CBO ON CA14.I_PERPETUAL.ITEM_ID = CA14.ITEM_CBO.ITEM_ID) ON
              CA14.I_ALLOCATION.INVENTORY_ID = CA14.I_PERPETUAL.INVENTORY_ID) ON
               COMM14.FACILITY_ALIAS.FACILITY_ID = CA14.I_PERPETUAL.FACILITY_ID) ON CA14.SKU_LOCATION.SKU_ID = CA14.I_PERPETUAL.ITEM_ID

          WHERE (((CA14.I_PERPETUAL.OBJECT_TYPE_ID)=16661)) and COMM14.FACILITY_ALIAS.FACILITY_ALIAS_ID = 200;
";

    $result = odbc_exec($eom, $query);

    if($result) {
        while (odbc_fetch_row($result)) {
            $facility_alias_id = odbc_result($result, 2);
            $facility_name = odbc_result($result, 3);
            $item_name = odbc_result($result, 1);
            $available_quantity = odbc_result($result, 4);

            $unavailable_quantity = 0;
            if(odbc_result($result, 5) != NULL)
                $unavailable_quantity = odbc_result($result, 5);

            $allocated_quantity = odbc_result($result, 6);

            $inv_protection_1 = 0;
            if (odbc_result($result, 7) != NULL)
                $inv_protection_1 = odbc_result($result, 7);

            $existe = $available_quantity + $unavailable_quantity + $allocated_quantity + $inv_protection_1;

            if($existe > 0) {
                $sku = str_split($item_name);

                $sku = $sku[0] . $sku[1] . $sku[2] . $sku[3] . $sku[4] . $sku[5];

                $query = "SELECT EXKPF01.ESTILO, EXKPF01.NOMPRV,  GGREFX.VENDOR,  GGREFX.DEP,
                                 GGREFX.SUBDEP,  GGREFX.CLA,      EXKPF01.DESDEP, EXKPF01.DESSDP,
                                 EXKPF01.DESCLA, GGREFX.ESTACION, EXKPF01.TEMPOR, GGREFX.FECING,
                                 GGREFX.UNITRA,  GGREFX.COSPROM,  GGREFX.PRENOR,  GGREFX.PREOFE,
                                 EXKPF01.RUT,    EXKPF01.CODMAR,  INVMST.IDESCR

                          FROM RDBPARIS2.EXGCBUGD.EXKPF01 EXKPF01, RDBPARIS2.EXGCBUGD.GGREFX GGREFX, RDBPARIS2.MMSP4LIB.INVMST INVMST

                          WHERE EXKPF01.ESTILO = '$sku' and EXKPF01.REF = GGREFX.REF and INVMST.INUMBR = '$item_name'";

                $res = odbc_exec($roble, $query);

                $division = "";

                $pm = "";

                $negocio = "";

                if ($res) {
                    while (odbc_fetch_row($res)) {
                        $estilo = odbc_result($res, 1);
                        $nomprv = odbc_result($res, 2);
                        $vendor = odbc_result($res, 3);
                        $dep = odbc_result($res, 4);
                        $subdep = odbc_result($res, 5);
                        $cla = odbc_result($res, 6);
                        $desdep = odbc_result($res, 7);
                        $dessdp = odbc_result($res, 8);
                        $descla = odbc_result($res, 9);
                        $estacion = odbc_result($res, 10);
                        $tempor = odbc_result($res, 11);
                        $fecing = odbc_result($res, 12);
                        $unitra = odbc_result($res, 13);
                        $cosprom = odbc_result($res, 14);
                        $prenor = odbc_result($res, 15);
                        $preofe = odbc_result($res, 16);
                        $rut = odbc_result($res, 17);
                        $codmar = odbc_result($res, 18);
                        $idescr = odbc_result($res, 19);

                        $nomprv = str_split($nomprv);
                        $nomprvtmp = "";
                        $count = count($nomprv);
                        for ($k = 0; $k < $count; $k++) {
                            if ($nomprv[$k] == "'")
                                $nomprvtmp = $nomprvtmp . "'" . $nomprv[$k];
                            else
                                $nomprvtmp = $nomprvtmp . $nomprv[$k];
                        }

                        $sku_desc = str_split($idescr);
                        $sku_desctmp = "";
                        $count = count($sku_desc);
                        for ($k = 0; $k < $count; $k++) {
                            if ($sku_desc[$k] == "'")
                                $sku_desctmp = $sku_desctmp . "'" . $sku_desc[$k];
                            else
                                $sku_desctmp = $sku_desctmp . $sku_desc[$k];
                        }

                        //Diferencia de Meses

                        $dia1 = new DateTime($fecing);

                        $dia2 = date("Ymd");

                        $dia2 = new DateTime($dia2);

                        $diferencia = ($dia2->format("Y") - $dia1->format("Y")) * 12 + ($dia2->format("m") - $dia1->format("m"));

                        //Fin diferencia de meses

                        //Asignacion de division y pm

                        $asignacion = "select division, pm, negocio from depto where depto1 = $dep";

                        $resultado = $ventas->query($asignacion);

                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $division = $row['division'];
                            $pm = $row['pm'];
                            $negocio = $row['negocio'];
                        }

                        //Fin asignacion de division y pm

                        $id = $item_name . $fecha;

                        $query = "insert into eombase values (
                                               '$id',
                                               '$id',
                                               $fecha,
                                               $item_name,
                                              '$sku_desctmp',
                                               $available_quantity,
                                               $unavailable_quantity,
                                               $allocated_quantity,
                                               $inv_protection_1,
                                              '$estilo',
                                              '$nomprvtmp',
                                               $vendor,
                                               $dep,
                                               $subdep,
                                               $cla,
                                              '$desdep',
                                              '$dessdp',
                                              '$descla',
                                              '$estacion',
                                              '$tempor',
                                               $fecing,
                                               $unitra,
                                               $cosprom,
                                               $prenor,
                                               $preofe,
                                              '$rut',
                                              '$division',
                                              '$pm',
                                               $diferencia,
                                              '$codmar',
                                              '$negocio',
                                               $facility_alias_id,
                                               $facility_name)";

                        $insertar = $local->query($query);

                        if (!$insertar) {
                            echo "Se genero error " . $local->error . " <br> Línea " . $query . "<br>";
                        } else {
                            echo "Se inserto con exito\n";
                        }
                    }
                } else {
                    echo "Error en Roble";
                    return false;
                }
            }
        }
    }
    else {
        echo "Error en EOM";
        return false;
    }

    return true;
}

if(actualizarMHT($local, $roble, $mht, $ventas))
    echo "Se actualizo con exito";
else
    echo "Error.";

if(stockTotal($local, $fecha))
    echo "Se inserto con exito<br>";
else
    echo "Hubo errores";

if(stockNoDisp($local, $fecha))
    echo "Se inserto con exito<br>";
else
    echo "Hubo errores";

if(reEtiquetado($local, $fecha))
    echo "Se inserto con exito<br>";
else
    echo "Hubo errores";

if (mercaderiaAntigua($local, $fecha))
    echo "Se inserto con exito<br>";
else
    echo "Hubo errores";

if(informePM($local, $fecha))
    echo "Se inserto con exito<br>";
else
    echo "Hubo errores";

$local->query("update estado set state = 1 where state = 0");

if(actualizarEOM($local, $roble, $eom, $ventas))
    echo "Se actualizo con exito <br> ";
else
    echo "Error. <br>";

if(compararDivisioneom($local, $fecha))
    echo "Se inserto con exito com_div_eom<br>";
else
    echo "Error. <br>";

if(compararDivisionmht($local, $fecha))
    echo "Se inserto con exito com_div_mht<br>";
else
    echo "Error. <br>";

if(compararPMeom($local, $fecha))
    echo "Se inserto con exito com_pm_eom<br>";
else
    echo "Error. <br>";

if(compararPMmht($local, $fecha))
    echo "Se inserto con exito com_pm_mht<br>";
else
    echo "Error. <br>";

$local->query("update estado set state = 0 where state = 1");