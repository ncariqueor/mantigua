<?php
ini_set('memory_limit', '2048M');

$mes = $_GET['mes'];
$dia = $_GET['dia'];
$anio = $_GET['anio'];

$buscaract = $anio . $mes . $dia;

$con = new mysqli('localhost', 'root', '', 'mantigua');

function base($con, $buscaract)
{
    ini_set("max_execution_time", 0);

    $query = "select fecha, sku, sku_desc, disp, nodisp, asignado, stockseg, estilo, nomprv, vendor, dep, subdep, cla,
                     desdep, dessdp, descla, estacion, tempor, fecing, unitra, cosprom, prenor, preofe, rut, division,
                     pm, antiguedad, codmar, negocio

              from eombase where fecha = $buscaract";

    $res = $con->query($query);

    $i = 0;

    $arreglo = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $arreglo[$i][0] = $row['fecha'];
        $arreglo[$i][1] = $row['sku'];
        $arreglo[$i][2] = $row['sku_desc'];
        $arreglo[$i][3] = $row['disp'];
        $arreglo[$i][4] = $row['nodisp'];
        $arreglo[$i][5] = $row['asignado'];
        $arreglo[$i][6] = $row['stockseg'];
        $arreglo[$i][7] = $row['estilo'];
        $arreglo[$i][8] = $row['nomprv'];
        $arreglo[$i][9] = $row['vendor'];
        $arreglo[$i][10] = $row['dep'];
        $arreglo[$i][11] = $row['subdep'];
        $arreglo[$i][12] = $row['cla'];
        $arreglo[$i][13] = $row['desdep'];
        $arreglo[$i][14] = $row['dessdp'];
        $arreglo[$i][15] = $row['descla'];
        $arreglo[$i][16] = $row['estacion'];
        $arreglo[$i][17] = $row['tempor'];
        $arreglo[$i][18] = $row['fecing'];
        $arreglo[$i][19] = $row['unitra'];
        $arreglo[$i][20] = $row['cosprom'];
        $arreglo[$i][21] = $row['prenor'];
        $arreglo[$i][22] = $row['preofe'];
        $arreglo[$i][23] = $row['rut'];
        $arreglo[$i][24] = $row['division'];
        $arreglo[$i][25] = $row['pm'];
        $arreglo[$i][26] = $row['antiguedad'];
        $arreglo[$i][27] = $row['codmar'];
        $arreglo[$i][28] = $row['negocio'];

        $i++;
    }

    $name = "Stock_EOM_" . $buscaract . ".csv";

    header('Content-Type: application/vnd.ms-excel');
    header("Content-disposition: attachment; filename=" . $name);

    $f = fopen("php://output", "w");

    $linea = "fecha; sku; sku_desc; disp; nodisp; asignado; stockseg; estilo; nomprv; vendor; dep; subdep; cla; desdep; dessdp; descla; estacion; tempor; fecing; unitra; cosprom; prenor; preofe; rut; division; pm; antiguedad; codmar; negocio \n";

    fwrite($f, $linea);

    for ($j = 0; $j < $i; $j++) {
        $linea = '';
        for ($k = 0; $k < 29; $k++) {
            if ($k == 2) {
                $sku_desc = str_split($arreglo[$j][$k]);
                $arreglo[$j][$k] = "";
                $count = count($sku_desc);
                for ($l = 0; $l < $count; $l++) {
                    if ($sku_desc[$l] != "'" && $sku_desc[$l] != '"')
                        $arreglo[$j][$k] = $arreglo[$j][$k] . $sku_desc[$l];
                }
            }

            $linea = $linea . $arreglo[$j][$k];
            if ($k < 28)
                $linea = $linea . ';';
        }
        $linea = $linea . "\n";

        fwrite($f, $linea);
    }

    fclose($f);
    exit;
}

base($con, $buscaract);