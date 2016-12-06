<?php

ini_set('memory_limit', '2048M');

$tipo = $_GET['tipo'];

$mes = $_GET['mes'];
$dia = $_GET['dia'];
$anio = $_GET['anio'];

$buscaract = $anio . $mes . $dia;

$con = new mysqli('localhost', 'root', '', 'mantigua');

function base($con, $buscaract)
{
    ini_set("max_execution_time", 0);



    $query = "select * from antigua where fecha = $buscaract";

    $res = $con->query($query);

    $i = 0;

    $arreglo = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $arreglo[$i][0] = $row['fecha'];
        $arreglo[$i][1] = $row['lpn'];
        $arreglo[$i][2] = $row['sku'];
        $arreglo[$i][3] = $row['sku_desc'];
        $arreglo[$i][4] = $row['locn_brcd'];
        $arreglo[$i][5] = $row['disponible'];
        $arreglo[$i][6] = $row['tipo'];
        $arreglo[$i][7] = $row['whse'];
        $arreglo[$i][8] = $row['estilo'];
        $arreglo[$i][9] = $row['nomprv'];
        $arreglo[$i][10] = $row['vendor'];
        $arreglo[$i][11] = $row['dep'];
        $arreglo[$i][12] = $row['subdep'];
        $arreglo[$i][13] = $row['cla'];
        $arreglo[$i][14] = $row['desdep'];
        $arreglo[$i][15] = $row['dessdp'];
        $arreglo[$i][16] = $row['descla'];
        $arreglo[$i][17] = $row['estacion'];
        $arreglo[$i][18] = $row['tempor'];
        $arreglo[$i][19] = $row['fecing'];
        $arreglo[$i][20] = $row['unitra'];
        $arreglo[$i][21] = $row['cosprom'];
        $arreglo[$i][22] = $row['prenor'];
        $arreglo[$i][23] = $row['preofe'];
        $arreglo[$i][24] = $row['rut'];
        $arreglo[$i][25] = $row['division'];
        $arreglo[$i][26] = $row['pm'];
        $arreglo[$i][27] = $row['antiguedad'];
        $arreglo[$i][28] = $row['codmar'];
        $arreglo[$i][29] = $row['locacion'];
        $arreglo[$i][30] = $row['negocio'];

        $i++;
    }

    $name = "Stock_MHT" . $buscaract . ".csv";

    header('Content-Type: application/vnd.ms-excel');
    header("Content-disposition: attachment; filename=" . $name);

    $f = fopen("php://output", "w");

    $linea = "fecha; lpn; sku; sku_desc; locn_brcd; disponible; tipo; whse; estilo; nomprv; vendor; dep; subdep; cla; desdep; dessdp; descla; estacion; tempor; fecing; unitra; cosprom; prenor; preofe; rut; division; pm; antiguedad; codmar; locacion; negocio; \n";

    fwrite($f, $linea);

    for ($j = 0; $j < $i; $j++) {
        $linea = '';
        for ($k = 0; $k < 31; $k++) {
            if ($k == 3) {
                $sku_desc = str_split($arreglo[$j][$k]);
                $arreglo[$j][$k] = "";
                $count = count($sku_desc);
                for ($l = 0; $l < $count; $l++) {
                    if ($sku_desc[$l] != "'" && $sku_desc[$l] != '"')
                        $arreglo[$j][$k] = $arreglo[$j][$k] . $sku_desc[$l];
                }
            }

            $linea = $linea . $arreglo[$j][$k];
            if ($k < 30)
                $linea = $linea . ';';
        }
        $linea = $linea . "\n";

        fwrite($f, $linea);
    }

    fclose($f);
    exit;
}

function base2($con, $buscaract)
{

    $query = "select * from retiquetado where fecha = $buscaract";

    $res = $con->query($query);

    $i = 0;

    $arreglo = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $arreglo[$i][0] = $row['fecha'];
        $arreglo[$i][1] = $row['diasret'];
        $arreglo[$i][2] = $row['llave'];
        $arreglo[$i][3] = $row['fecingret'];
        $arreglo[$i][4] = $row['pm'];
        $arreglo[$i][5] = $row['ubicacion'];
        $arreglo[$i][6] = $row['detalle'];
        $arreglo[$i][7] = $row['negocio'];
        $arreglo[$i][8] = $row['division'];
        $arreglo[$i][9] = $row['dep'];
        $arreglo[$i][10] = $row['desdep'];
        $arreglo[$i][11] = $row['subdep'];
        $arreglo[$i][12] = $row['cla'];
        $arreglo[$i][13] = $row['descla'];
        $arreglo[$i][14] = $row['estilo'];
        $arreglo[$i][15] = $row['sku'];
        $arreglo[$i][16] = $row['sku_desc'];
        $arreglo[$i][17] = $row['codmar'];
        $arreglo[$i][18] = $row['estacion'];
        $arreglo[$i][19] = $row['tempor'];
        $arreglo[$i][20] = $row['dessdp'];
        $arreglo[$i][21] = $row['vendor'];
        $arreglo[$i][22] = $row['nomprv'];
        $arreglo[$i][23] = $row['antiguedad'];
        $arreglo[$i][24] = $row['cosprom'];
        $arreglo[$i][25] = $row['disponible'];
        $arreglo[$i][26] = $row['prenor'];
        $arreglo[$i][27] = $row['preofe'];

        $i++;
    }

    $name = "Re-etiquetado_" . $buscaract . ".csv";

    header('Content-Type: application/vnd.ms-excel');
    header("Content-disposition: attachment; filename=" . $name);

    $f = fopen("php://output", "w");

    $linea = "Fecha; Dias Re-etiquetado; llave; Fecha Ingreso; PM;	Ubicacion; Detalle ubicacion; Negocio; Division; Depto; Desc. Depto.;	Sub Depto.;	Clase; Desc. Clase; Estilo; SKU; Desc. SKU; Marca;	Estacion; Temporada; Desc. Sub Depto.; Cod. Proveedor; Nombre proveedor; Antiguedad; Stock Costo; Stock unidades; Precio Normal; Precio Oferta; \n";

    fwrite($f, $linea);

    for ($j = 0; $j < $i; $j++) {
        $linea = '';
        for ($k = 0; $k < 28; $k++) {
            if ($k == 16) {
                $sku_desc = str_split($arreglo[$j][$k]);
                $arreglo[$j][$k] = "";
                $count = count($sku_desc);
                for ($l = 0; $l < $count; $l++) {
                    if ($sku_desc[$l] != "'" && $sku_desc[$l] != '"')
                        $arreglo[$j][$k] = $arreglo[$j][$k] . $sku_desc[$l];
                }
            }

            if($k != 24)
                $linea = $linea . $arreglo[$j][$k];
            else
                $linea = $linea . ($arreglo[$j][24] * $arreglo[$j][25]);
            if ($k < 27)
                $linea = $linea . ';';
        }
        $linea = $linea . "\n";

        fwrite($f, $linea);
    }

    fclose($f);
    exit;
}

function base3($con, $buscaract)
{
    ini_set("max_execution_time", 0);

    $query = "select fecha, sku, sku_desc, locacion, sum(disponible) as disponible, tipo, estilo, nomprv, vendor, dep, subdep, cla, desdep, dessdp, descla,
                     estacion, tempor, fecing, unitra, cosprom, prenor, preofe, rut, division, pm, antiguedad, codmar, negocio from antigua where fecha = $buscaract group by sku, locacion";

    $res = $con->query($query);

    $i = 0;

    $arreglo = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $arreglo[$i][0] = $row['fecha'];
        $arreglo[$i][1] = $row['sku'];
        $arreglo[$i][2] = $row['sku_desc'];
        $arreglo[$i][3] = $row['locacion'];
        $arreglo[$i][4] = $row['disponible'];
        $arreglo[$i][5] = $row['cosprom'];
        $arreglo[$i][6] = $arreglo[$i][4] * $arreglo[$i][5];
        $arreglo[$i][7] = $row['tipo'];
        $arreglo[$i][8] = $row['estilo'];
        $arreglo[$i][9] = $row['nomprv'];
        $arreglo[$i][10] = $row['vendor'];
        $arreglo[$i][11] = $row['dep'];
        $arreglo[$i][12] = $row['subdep'];
        $arreglo[$i][13] = $row['cla'];
        $arreglo[$i][14] = $row['desdep'];
        $arreglo[$i][15] = $row['dessdp'];
        $arreglo[$i][16] = $row['descla'];
        $arreglo[$i][17] = $row['estacion'];
        $arreglo[$i][18] = $row['tempor'];
        $arreglo[$i][19] = $row['fecing'];
        $arreglo[$i][20] = $row['unitra'];
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

    $name = "Stock_Comercial_" . $buscaract . ".csv";

    header('Content-Type: application/vnd.ms-excel');
    header("Content-disposition: attachment; filename=" . $name);

    $f = fopen("php://output", "w");

    $linea = "fecha; sku; sku_desc; locacion; disponible; cosprom; stock costo; tipo; estilo; nomprv; vendor; dep; subdep; cla; desdep; dessdp; descla; estacion; tempor; fecing; unitra; prenor; preofe; rut; division; pm; antiguedad; codmar; negocio;\n";

    fwrite($f, $linea);

    for ($j = 0; $j < $i; $j++) {
        $linea = '';
        for ($k = 0; $k < 28; $k++) {
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
            if ($k < 27)
                $linea = $linea . ';';
        }
        $linea = $linea . "\n";

        fwrite($f, $linea);
    }

    fclose($f);
    exit;
}

if($tipo == 'base')
    base($con, $buscaract);

if($tipo == 'ret')
    base2($con, $buscaract);

if($tipo == 'comercial')
    base3($con, $buscaract);

