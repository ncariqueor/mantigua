<?php

ini_set('memory_limit', '2048M');

ini_set('max_execution_time', 0);

$eom   = odbc_connect('EOM', 'REPORTER', 'RptCyber2015');

$ventas = new mysqli('localhost', 'root', '', 'ventas');

$roble = odbc_connect('CECEBUGD', 'USRVNP', 'USRVNP');

$fecha = date("Ymd");

$name = "Stock_EOM_" . $fecha . ".csv";

header('Content-Type: application/vnd.ms-excel');
header("Content-disposition: attachment; filename=" . $name);

$f = fopen("php://output", "w");

$linea = "fecha; sku; sku_desc; disp; nodisp; asignado; stockseg; estilo; nomprv; vendor; dep; subdep; cla; desdep; dessdp; descla; estacion; tempor; fecing; unitra; cosprom; prenor; preofe; rut; division; pm; antiguedad; codmar; negocio \n";

fwrite($f, $linea);

$query = "SELECT CA14.ITEM_CBO.ITEM_NAME,
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

          WHERE (((CA14.I_PERPETUAL.OBJECT_TYPE_ID)=16661)) and COMM14.FACILITY_ALIAS.FACILITY_ALIAS_ID = 200
";

$result = odbc_exec($eom, $query);

if($result) {
    while (odbc_fetch_row($result)) {
        $facility_alias_id = odbc_result($result, 2);
        $facility_name = odbc_result($result, 3);
        $item_name = odbc_result($result, 1);
        $available_quantity = odbc_result($result, 4);
        $unavailable_quantity = odbc_result($result, 5);
        $allocated_quantity = odbc_result($result, 6);

        $inv_protection_1 = 0;
        if (odbc_result($result, 7) != NULL)
            $inv_protection_1 = odbc_result($result, 7);

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

        if($res) {
            while (odbc_fetch_row($res)) {
                $estilo = odbc_result($res, 1);
                $nomprv = odbc_result($res, 2);
                $vendor = odbc_result($res, 3);
                $dep    = odbc_result($res, 4);
                $subdep = odbc_result($res, 5);
                $cla    = odbc_result($res, 6);
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
                    if ($sku_desc[$k] == "'" || $sku_desc[$k] == "'")
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



                $linea = '';
                $linea = $linea . $fecha . ";";
                $linea = $linea . $item_name . ";";
                $linea = $linea . $sku_desctmp . ";";
                $linea = $linea . $available_quantity . ";";
                $linea = $linea . $unavailable_quantity . ";";
                $linea = $linea . $allocated_quantity . ";";
                $linea = $linea . $inv_protection_1 . ";";
                $linea = $linea . $estilo . ";";
                $linea = $linea . $nomprvtmp . ";";
                $linea = $linea . $vendor . ";";
                $linea = $linea . $dep . ";";
                $linea = $linea . $subdep . ";";
                $linea = $linea . $cla . ";";
                $linea = $linea . $desdep . ";";
                $linea = $linea . $dessdp . ";";
                $linea = $linea . $descla . ";";
                $linea = $linea . $estacion . ";";
                $linea = $linea . $tempor . ";";
                $linea = $linea . $fecing . ";";
                $linea = $linea . $unitra . ";";
                $linea = $linea . $cosprom . ";";
                $linea = $linea . $prenor . ";";
                $linea = $linea . $preofe . ";";
                $linea = $linea . $rut . ";";
                $linea = $linea . $division . ";";
                $linea = $linea . $pm . ";";
                $linea = $linea . $diferencia . ";";
                $linea = $linea . $codmar . ";";
                $linea = $linea . $negocio;
                $linea = $linea . "\n";

                fwrite($f, $linea);
            }
        }else{
            echo "Error en Roble";
            return false;
        }
    }
}
else {
    echo "Error en EOM";
    return false;
}

fclose($f);
exit;