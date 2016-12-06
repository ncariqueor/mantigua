<?php
$ubicacion = trim(strtoupper($_POST['ubicacion']));
$tipo = $_POST['tipo'];
$locacion = trim($_POST['locacion']);
$detalle = trim($_POST['detalle']);

if($ubicacion != '') {
    $con = new mysqli('localhost', 'root', '', 'mantigua');

    $query = "select ubicacion, tipo, locacion from locaciones where ubicacion = '$ubicacion'";

    $res = $con->query($query);

    $esta = mysqli_num_rows($res);

    if($esta > 0) {
        $type = "";
        $location = "";

        while($row = mysqli_fetch_assoc($res)){
            $type = $row['tipo'];
            $location = $row['locacion'];
        }

        if($tipo != 'vacio') {
            if(($tipo == 'Activo' || $tipo == 'Case Pick')){
                if($locacion == 'vacio'){
                    if($location == 'Disponible para la venta'){
                        $query = "update locaciones set tipo = '$tipo' where ubicacion = '$ubicacion'";

                        $res = $con->query($query);

                        if (!$res)
                            echo "Hubo errores al actualizar el tipo de ubicación.";
                    }
                }
            }else{
                if($locacion == 'vacio'){
                    if($location != 'Disponible para la venta'){
                        $query = "update locaciones set tipo = '$tipo' where ubicacion = '$ubicacion'";

                        $res = $con->query($query);

                        if (!$res)
                            echo "Hubo errores al actualizar el tipo de ubicación.";
                    }
                }
            }
        }

        /*if($locacion != 'vacio'){
            if($locacion == 'Disponible para la venta'){
                if($type == 'Activo' || $type == 'Case Pick') {
                    $query = "update locaciones set $locacion = '$locacion' where ubicacion = '$ubicacion' and tipo in ('Activo', 'Case Pick')";

                    $res = $con->query($query);

                    if(!$res)
                        echo "Error al actualizar la locación.";
                }else
                    echo "No se puede actualizar la locacion ya que el tipo de ubicación no corresponde a " . $locacion . ". Por favor, antes de continuar seleccione el nuevo tipo de ubicación.";
            }else{
                $query = "update locaciones set $locacion = '$locacion' where ubicacion = '$ubicacion'";

                $res = $con->query($query);

                if(!$res)
                    echo "Error al actualizar la locación.";

                if ($locacion == 'Re-etiquetado') {
                    $query = "select pm, locn_brcd, detalle, negocio, division, dep, desdep, subdep, cla, descla, estilo, sku, sku_desc, codmar,
                                     estacion, tempor, dessdp, vendor, nomprv, antiguedad, cosprom, disponible, prenor, preofe, min(fecha) as fecha

                              from antigua where locn_brcd = '$ubicacion' and locacion = 'Re-etiquetado' group by sku order by fecha asc";

                    $res = $con->query($query);

                    if (mysqli_num_rows($res) > 0) {
                        $arreglo = array();

                        $sku = array();

                        $i = 0;

                        while ($row = mysqli_fetch_assoc($res)) {
                            $arreglo[$i][0] = $row['pm'];
                            $arreglo[$i][1] = $row['locn_brcd'];
                            $arreglo[$i][2] = $row['detalle'];
                            $arreglo[$i][3] = $row['negocio'];
                            $arreglo[$i][4] = $row['division'];
                            $arreglo[$i][5] = $row['dep'];
                            $arreglo[$i][6] = $row['desdep'];
                            $arreglo[$i][7] = $row['subdep'];
                            $arreglo[$i][8] = $row['cla'];
                            $arreglo[$i][9] = $row['descla'];
                            $arreglo[$i][10] = $row['estilo'];
                            $arreglo[$i][11] = $row['sku'];
                            $arreglo[$i][12] = $row['sku_desc'];
                            $arreglo[$i][13] = $row['codmar'];
                            $arreglo[$i][14] = $row['estacion'];
                            $arreglo[$i][15] = $row['tempor'];
                            $arreglo[$i][16] = $row['dessdp'];
                            $arreglo[$i][17] = $row['vendor'];
                            $arreglo[$i][18] = $row['nomprv'];
                            $arreglo[$i][19] = $row['antiguedad'];
                            $arreglo[$i][20] = $row['cosprom'];
                            $arreglo[$i][21] = $row['disponible'];
                            $arreglo[$i][22] = $row['prenor'];
                            $arreglo[$i][23] = $row['preofe'];
                            $arreglo[$i][24] = $row['fecha'];
                            $sku[$i] = $arreglo[$i][11];
                            $arreglo[$i][25] = trim($ubicacion . $sku[$i]);
                            $i++;
                        }

                        for ($j = 0; $j < $i; $j++) {
                            $query = "select fecha from antigua where sku = " . $sku[$j] . " order by fecha asc";

                            $res = $con->query($query);

                            if ($res) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $fecha = $row['fecha'];
                                }

                                $fecingret = new DateTime($arreglo[$j][24]);

                                $fecha = new DateTime($fecha);

                                $diferencia = $fecingret->diff($fecha);

                                $diferencia = $diferencia->format("%a");

                                $llave = $arreglo[$j][25];
                                $pm = $arreglo[$j][0];
                                $detalle = $arreglo[$j][2];
                                $negocio = $arreglo[$j][3];
                                $division = $arreglo[$j][4];
                                $dep = $arreglo[$j][5];
                                $desdep = $arreglo[$i][6];
                                $subdep = $arreglo[$i][7];
                                $cla = $arreglo[$i][8];
                                $descla = $arreglo[$i][9];
                                $estilo = $arreglo[$i][10];
                                $sku = $arreglo[$i][11];
                                $sku_desc = $arreglo[$i][12];
                                $codmar = $arreglo[$i][13];
                                $estacion = $arreglo[$i][14];
                                $tempor = $arreglo[$i][15];
                                $dessdp = $arreglo[$i][16];
                                $vendor = $arreglo[$i][17];
                                $nomprv = $arreglo[$i][18];
                                $antiguedad = $arreglo[$i][19];
                                $cosprom = $arreglo[$i][20];
                                $disponible = $arreglo[$i][21];
                                $prenor = $arreglo[$i][22];
                                $preofe = $arreglo[$i][23];

                                $nomprv = str_split($nomprv);
                                $nomprvtmp = "";
                                $count = count($nomprv);
                                for ($k = 0; $k < $count; $k++) {
                                    if ($nomprv[$k] == "'")
                                        $nomprvtmp = $nomprvtmp . "'" . $nomprv[$k];
                                    else
                                        $nomprvtmp = $nomprvtmp . $nomprv[$k];
                                }

                                $sku_desc = str_split($sku_desc);
                                $sku_desctmp = "";
                                $count = count($sku_desc);
                                for ($k = 0; $k < $count; $k++) {
                                    if ($sku_desc[$k] == "'")
                                        $sku_desctmp = $sku_desctmp . "'" . $sku_desc[$k];
                                    else
                                        $sku_desctmp = $sku_desctmp . $sku_desc[$k];
                                }

                                $insertar = "insert into retiquetado values($fecha,
                                $diferencia,
                               '$llave',
                                $fecingret,
                               '$pm',
                               '$ubicacion',
                               '$detalle',
                               '$negocio',
                               '$division',
                                $dep,
                               '$desdep',
                                $subdep,
                                $cla,
                               '$descla',
                                $estilo,
                                $sku,
                               '$sku_desctmp',
                               '$codmar',
                               '$estacion',
                               '$tempor',
                               '$dessdp',
                                $vendor,
                               '$nomprvtmp',
                                $diferencia,
                                $cosprom,
                                $disponible,
                                $prenor,
                                $preofe)";

                                $res = $con->query($insertar);

                                if (!$res) {
                                    echo "Error al insertar en la base Re-etiquetado.";
                                } else {
                                    if (!reEtiquetado($local, $fecha))
                                        echo "Error al actualizar Re-etiquetado.";
                                }
                            }
                        }
                    }

                } else {
                    echo "Error al actualizar base. Error número " . $con->errno;
                }
            }
        }*/

        echo "¡Actualización exitosa!";
    }else{
        echo "La ubicación no se encuentra en la base.";
    }
}else{
    echo "Debe escribir una ubicación.";
}