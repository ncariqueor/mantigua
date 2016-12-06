<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Mercadería Antigua</title>
        <link type="text/css" rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap-select-1.9.4/dist/css/bootstrap-select.css"/>
        <link rel="stylesheet" type="text/css" href="estilo.css" />
    </head>

    <body onload="asignar();">

        <script>
            function asignar(){
                var month = document.getElementById("mes").value;
                var year = document.getElementById("anio").value;
                var day = document.getElementById("dia").value;
                document.getElementById("exportar").href = "exportar2.php?mes="+month+"&anio="+year+"&dia="+day+"&tipo=base";
                document.getElementById("exportar2").href = "exportar2.php?mes="+month+"&anio="+year+"&dia="+day+"&tipo=ret";
                document.getElementById("exportar3").href = "exportar2.php?mes="+month+"&anio="+year+"&dia="+day+"&tipo=comercial";
            }
        </script>

        <header class="container">
            <nav class="navbar navbar-default">
                <div class="btn-group-sm">
                    <div class="row">
                        <div class="col-md-12"><h3 class="text-center"><a href="http://10.95.17.114/paneles"><img src="paris.png" width="140px" height="100px" title="Reportes Paris"></a> Informe General Mercadería Antigua</h3></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-default btn-sm" href="query.php" style="margin-left: 45%;">Query <img id="txt" src="images.png"></a>
                            <div class="col-lg-1">
                                <a id="exportar3" class="btn btn-success btn-sm" href="#">Exportar Base Comerciales</a>
                            </div>
                        </div>
                    </div><br>

                    <form action="informe.php" method="post" class="row">
                        <div class="col-lg-4" style="width: 25%;">
                            <label class="label label-primary">Actual</label>
                            <select name="dia" id="dia" class="selectpicker" title="Día" data-style="btn btn-default btn-sm" data-width="50px" onchange="asignar();">
                            <?php
                            date_default_timezone_set("America/Asuncion");
                            if(isset($_POST['dia'])){
                                $select = $_POST['dia'];
                                $actual = date("d");

                                $d = date("Ymd");

                                $d = new DateTime($d);

                                $d = $d->modify('last day of this month');

                                for($day = 1; $day <= 31; $day++){
                                    $dia = $day;
                                    if(strlen($dia) < 2)
                                        $dia = '0'.$dia;
                                    if($select == $dia)
                                        echo "<option selected='selected' value='" . $dia . "'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }else{
                                $actual = date("d");

                                $d = date("Ymd");

                                $d = new DateTime($d);

                                $d = $d->modify('last day of this month');

                                for($day = '01'; $day <= 31; $day++) {
                                    $dia = $day;
                                    if(strlen($dia) < 2)
                                        $dia = '0'.$dia;
                                    if ($actual == $dia)
                                        echo "<option value='" . $dia . "' selected='selected'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }
                            ?>
                        </select>
                            <select name="mes" id="mes" class="selectpicker" title="Mes" data-style="btn btn-default btn-sm" data-width="100px" onchange="asignar();">
                            <?php
                            if(isset($_POST['mes'])){
                                $mes = $_POST['mes'];
                                if($mes == '01') {
                                    echo "<option value='01' selected='selected'>Enero</option>";
                                    echo "<option value='02'>Febrero</option>";
                                    echo "<option value='03'>Marzo</option>";
                                    echo "<option value='04'>Abril</option>";
                                    echo "<option value='05'>Mayo</option>";
                                    echo "<option value='06'>Junio</option>";
                                    echo "<option value='07'>Julio</option>";
                                    echo "<option value='08'>Agosto</option>";
                                    echo "<option value='09'>Septiembre</option>";
                                    echo "<option value='10'>Octubre</option>";
                                    echo "<option value='11'>Noviembre</option>";
                                    echo "<option value='12'>Diciembre</option>";
                                }else{
                                    if($mes == '02'){
                                        echo "<option value='01'>Enero</option>";
                                        echo "<option value='02' selected='selected'>Febrero</option>";
                                        echo "<option value='03'>Marzo</option>";
                                        echo "<option value='04'>Abril</option>";
                                        echo "<option value='05'>Mayo</option>";
                                        echo "<option value='06'>Junio</option>";
                                        echo "<option value='07'>Julio</option>";
                                        echo "<option value='08'>Agosto</option>";
                                        echo "<option value='09'>Septiembre</option>";
                                        echo "<option value='10'>Octubre</option>";
                                        echo "<option value='11'>Noviembre</option>";
                                        echo "<option value='12'>Diciembre</option>";
                                    } else{
                                        if($mes == '03'){
                                            echo "<option value='01'>Enero</option>";
                                            echo "<option value='02'>Febrero</option>";
                                            echo "<option value='03' selected='selected'>Marzo</option>";
                                            echo "<option value='04'>Abril</option>";
                                            echo "<option value='05'>Mayo</option>";
                                            echo "<option value='06'>Junio</option>";
                                            echo "<option value='07'>Julio</option>";
                                            echo "<option value='08'>Agosto</option>";
                                            echo "<option value='09'>Septiembre</option>";
                                            echo "<option value='10'>Octubre</option>";
                                            echo "<option value='11'>Noviembre</option>";
                                            echo "<option value='12'>Diciembre</option>";
                                        }else{
                                            if($mes == '04'){
                                                echo "<option value='01'>Enero</option>";
                                                echo "<option value='02'>Febrero</option>";
                                                echo "<option value='03'>Marzo</option>";
                                                echo "<option value='04' selected='selected'>Abril</option>";
                                                echo "<option value='05'>Mayo</option>";
                                                echo "<option value='06'>Junio</option>";
                                                echo "<option value='07'>Julio</option>";
                                                echo "<option value='08'>Agosto</option>";
                                                echo "<option value='09'>Septiembre</option>";
                                                echo "<option value='10'>Octubre</option>";
                                                echo "<option value='11'>Noviembre</option>";
                                                echo "<option value='12'>Diciembre</option>";
                                            }else{
                                                if($mes == '05'){
                                                    echo "<option value='01'>Enero</option>";
                                                    echo "<option value='02'>Febrero</option>";
                                                    echo "<option value='03'>Marzo</option>";
                                                    echo "<option value='04'>Abril</option>";
                                                    echo "<option value='05' selected='selected'>Mayo</option>";
                                                    echo "<option value='06'>Junio</option>";
                                                    echo "<option value='07'>Julio</option>";
                                                    echo "<option value='08'>Agosto</option>";
                                                    echo "<option value='09'>Septiembre</option>";
                                                    echo "<option value='10'>Octubre</option>";
                                                    echo "<option value='11'>Noviembre</option>";
                                                    echo "<option value='12'>Diciembre</option>";
                                                }else{
                                                    if($mes == '06'){
                                                        echo "<option value='01'>Enero</option>";
                                                        echo "<option value='02'>Febrero</option>";
                                                        echo "<option value='03'>Marzo</option>";
                                                        echo "<option value='04'>Abril</option>";
                                                        echo "<option value='05'>Mayo</option>";
                                                        echo "<option value='06' selected='selected'>Junio</option>";
                                                        echo "<option value='07'>Julio</option>";
                                                        echo "<option value='08'>Agosto</option>";
                                                        echo "<option value='09'>Septiembre</option>";
                                                        echo "<option value='10'>Octubre</option>";
                                                        echo "<option value='11'>Noviembre</option>";
                                                        echo "<option value='12'>Diciembre</option>";
                                                    }else{
                                                        if($mes == '07'){
                                                            echo "<option value='01'>Enero</option>";
                                                            echo "<option value='02'>Febrero</option>";
                                                            echo "<option value='03'>Marzo</option>";
                                                            echo "<option value='04'>Abril</option>";
                                                            echo "<option value='05'>Mayo</option>";
                                                            echo "<option value='06'>Junio</option>";
                                                            echo "<option value='07' selected='selected'>Julio</option>";
                                                            echo "<option value='08'>Agosto</option>";
                                                            echo "<option value='09'>Septiembre</option>";
                                                            echo "<option value='10'>Octubre</option>";
                                                            echo "<option value='11'>Noviembre</option>";
                                                            echo "<option value='12'>Diciembre</option>";
                                                        }else{
                                                            if($mes == '08'){
                                                                echo "<option value='01'>Enero</option>";
                                                                echo "<option value='02'>Febrero</option>";
                                                                echo "<option value='03'>Marzo</option>";
                                                                echo "<option value='04'>Abril</option>";
                                                                echo "<option value='05'>Mayo</option>";
                                                                echo "<option value='06'>Junio</option>";
                                                                echo "<option value='07'>Julio</option>";
                                                                echo "<option value='08' selected='selected'>Agosto</option>";
                                                                echo "<option value='09'>Septiembre</option>";
                                                                echo "<option value='10'>Octubre</option>";
                                                                echo "<option value='11'>Noviembre</option>";
                                                                echo "<option value='12'>Diciembre</option>";
                                                            }else{
                                                                if($mes == '09'){
                                                                    echo "<option value='01'>Enero</option>";
                                                                    echo "<option value='02'>Febrero</option>";
                                                                    echo "<option value='03'>Marzo</option>";
                                                                    echo "<option value='04'>Abril</option>";
                                                                    echo "<option value='05'>Mayo</option>";
                                                                    echo "<option value='06'>Junio</option>";
                                                                    echo "<option value='07'>Julio</option>";
                                                                    echo "<option value='08'>Agosto</option>";
                                                                    echo "<option value='09' selected='selected'>Septiembre</option>";
                                                                    echo "<option value='10'>Octubre</option>";
                                                                    echo "<option value='11'>Noviembre</option>";
                                                                    echo "<option value='12'>Diciembre</option>";
                                                                }else{
                                                                    if($mes == '10'){
                                                                        echo "<option value='01'>Enero</option>";
                                                                        echo "<option value='02'>Febrero</option>";
                                                                        echo "<option value='03'>Marzo</option>";
                                                                        echo "<option value='04'>Abril</option>";
                                                                        echo "<option value='05'>Mayo</option>";
                                                                        echo "<option value='06'>Junio</option>";
                                                                        echo "<option value='07'>Julio</option>";
                                                                        echo "<option value='08'>Agosto</option>";
                                                                        echo "<option value='09'>Septiembre</option>";
                                                                        echo "<option value='10' selected='selected'>Octubre</option>";
                                                                        echo "<option value='11'>Noviembre</option>";
                                                                        echo "<option value='12'>Diciembre</option>";
                                                                    }else{
                                                                        if($mes == '11'){
                                                                            echo "<option value='01'>Enero</option>";
                                                                            echo "<option value='02'>Febrero</option>";
                                                                            echo "<option value='03'>Marzo</option>";
                                                                            echo "<option value='04'>Abril</option>";
                                                                            echo "<option value='05'>Mayo</option>";
                                                                            echo "<option value='06'>Junio</option>";
                                                                            echo "<option value='07'>Julio</option>";
                                                                            echo "<option value='08'>Agosto</option>";
                                                                            echo "<option value='09'>Septiembre</option>";
                                                                            echo "<option value='10'>Octubre</option>";
                                                                            echo "<option value='11' selected='selected'>Noviembre</option>";
                                                                            echo "<option value='12'>Diciembre</option>";
                                                                        }else{
                                                                            if($mes == '12'){
                                                                                echo "<option value='01'>Enero</option>";
                                                                                echo "<option value='02'>Febrero</option>";
                                                                                echo "<option value='03'>Marzo</option>";
                                                                                echo "<option value='04'>Abril</option>";
                                                                                echo "<option value='05'>Mayo</option>";
                                                                                echo "<option value='06'>Junio</option>";
                                                                                echo "<option value='07'>Julio</option>";
                                                                                echo "<option value='08'>Agosto</option>";
                                                                                echo "<option value='09'>Septiembre</option>";
                                                                                echo "<option value='10'>Octubre</option>";
                                                                                echo "<option value='11'>Noviembre</option>";
                                                                                echo "<option value='12' selected='selected'>Diciembre</option>";
                                                                            }else{
                                                                                echo "<option value='01'>Enero</option>";
                                                                                echo "<option value='02'>Febrero</option>";
                                                                                echo "<option value='03'>Marzo</option>";
                                                                                echo "<option value='04'>Abril</option>";
                                                                                echo "<option value='05'>Mayo</option>";
                                                                                echo "<option value='06'>Junio</option>";
                                                                                echo "<option value='07'>Julio</option>";
                                                                                echo "<option value='08'>Agosto</option>";
                                                                                echo "<option value='09'>Septiembre</option>";
                                                                                echo "<option value='10'>Octubre</option>";
                                                                                echo "<option value='11'>Noviembre</option>";
                                                                                echo "<option value='12'>Diciembre</option>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }else{
                                if(date("m") == '01')
                                    echo "<option value='01' selected='selected'>Enero</option>";
                                else
                                    echo "<option value='01'>Enero</option>";

                                if(date("m") === '02')
                                    echo "<option value='02' selected='selected'>Febrero</option>";
                                else
                                    echo "<option value='02'>Febrero</option>";

                                if(date("m") == '03')
                                    echo "<option value='03' selected='selected'>Marzo</option>";
                                else
                                    echo "<option value='03'>Marzo</option>";

                                if(date("m") == '04')
                                    echo "<option value='04' selected='selected'>Abril</option>";
                                else
                                    echo "<option value='04'>Abril</option>";

                                if(date("m") == '05')
                                    echo "<option value='05' selected='selected'>Mayo</option>";
                                else
                                    echo "<option value='05'>Mayo</option>";

                                if(date("m") == '06')
                                    echo "<option value='06' selected='selected'>Junio</option>";
                                else
                                    echo "<option value='06'>Junio</option>";

                                if(date("m") == '07')
                                    echo "<option value='07' selected='selected'>Julio</option>";
                                else
                                    echo "<option value='07'>Julio</option>";

                                if(date("m") == '08')
                                    echo "<option value='08' selected='selected'>Agosto</option>";
                                else
                                    echo "<option value='08'>Agosto</option>";

                                if(date("m") == '09')
                                    echo "<option value='09' selected='selected'>Septiembre</option>";
                                else
                                    echo "<option value='09'>Septiembre</option>";

                                if(date("m") == '10')
                                    echo "<option value='10' selected='selected'>Octubre</option>";
                                else
                                    echo "<option value='10'>Octubre</option>";

                                if(date("m") == '11')
                                    echo "<option value='11' selected='selected'>Noviembre</option>";
                                else
                                    echo "<option value='11'>Noviembre</option>";

                                if(date("m") == '12')
                                    echo "<option value='12' selected='selected'>Diciembre</option>";
                                else
                                    echo "<option value='12'>Diciembre</option>";
                            }
                            ?>
                        </select>
                            <select name="anio" id="anio" class="selectpicker" title="Año" data-style="btn btn-default btn-sm" data-width="70px" onchange="asignar();">
                            <?php
                            if(isset($_POST['anio'])){
                                $anio = $_POST['anio'];
                                $actual = date("Y");
                                for($dia = 2015; $dia <= $actual; $dia++){
                                    if($anio == $dia)
                                        echo "<option selected='selected' value='" . $dia . "'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }else{
                                $actual = date("Y");
                                for($dia = 2015; $dia <= $actual; $dia++) {
                                    if (date("Y") == $dia)
                                        echo "<option value='" . $dia . "' selected='selected'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }
                            ?>
                        </select>
                        </div>

                        <div class="col-lg-4" style="width: 25%;">
                            <label class="label label-primary">Anterior</label>
                            <select name="diaant" id="dia" class="selectpicker" title="Día" data-style="btn btn-default btn-sm" data-width="50px" onchange="asignar();">
                            <?php
                            date_default_timezone_set("America/Asuncion");
                            if(isset($_POST['diaant'])){
                                $select = $_POST['diaant'];

                                $d = date("Ymd");

                                $d = new DateTime($d);

                                $d = $d->modify('last day of this month');

                                for($day = 1; $day <= 31; $day++){
                                    $dia = $day;
                                    if(strlen($dia) < 2)
                                        $dia = '0'.$dia;
                                    if($select == $dia)
                                        echo "<option selected='selected' value='" . $dia . "'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }else{
                                $actual = date("Ym") . '01';

                                $actual = date("d", strtotime("{$actual}-1 day"));

                                for($day = '01'; $day <= 31; $day++) {
                                    $dia = $day;
                                    if(strlen($dia) < 2)
                                        $dia = '0'.$dia;
                                    if ($actual == $dia)
                                        echo "<option value='" . $dia . "' selected='selected'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }
                            ?>
                        </select>
                            <select name="mesant" id="mes" class="selectpicker" title="Mes" data-style="btn btn-default btn-sm" data-width="100px" onchange="asignar();">
                            <?php
                            if(isset($_POST['mesant'])){
                                $mes = $_POST['mesant'];
                                if($mes == '01') {
                                    echo "<option value='01' selected='selected'>Enero</option>";
                                    echo "<option value='02'>Febrero</option>";
                                    echo "<option value='03'>Marzo</option>";
                                    echo "<option value='04'>Abril</option>";
                                    echo "<option value='05'>Mayo</option>";
                                    echo "<option value='06'>Junio</option>";
                                    echo "<option value='07'>Julio</option>";
                                    echo "<option value='08'>Agosto</option>";
                                    echo "<option value='09'>Septiembre</option>";
                                    echo "<option value='10'>Octubre</option>";
                                    echo "<option value='11'>Noviembre</option>";
                                    echo "<option value='12'>Diciembre</option>";
                                }else{
                                    if($mes == '02'){
                                        echo "<option value='01'>Enero</option>";
                                        echo "<option value='02' selected='selected'>Febrero</option>";
                                        echo "<option value='03'>Marzo</option>";
                                        echo "<option value='04'>Abril</option>";
                                        echo "<option value='05'>Mayo</option>";
                                        echo "<option value='06'>Junio</option>";
                                        echo "<option value='07'>Julio</option>";
                                        echo "<option value='08'>Agosto</option>";
                                        echo "<option value='09'>Septiembre</option>";
                                        echo "<option value='10'>Octubre</option>";
                                        echo "<option value='11'>Noviembre</option>";
                                        echo "<option value='12'>Diciembre</option>";
                                    } else{
                                        if($mes == '03'){
                                            echo "<option value='01'>Enero</option>";
                                            echo "<option value='02'>Febrero</option>";
                                            echo "<option value='03' selected='selected'>Marzo</option>";
                                            echo "<option value='04'>Abril</option>";
                                            echo "<option value='05'>Mayo</option>";
                                            echo "<option value='06'>Junio</option>";
                                            echo "<option value='07'>Julio</option>";
                                            echo "<option value='08'>Agosto</option>";
                                            echo "<option value='09'>Septiembre</option>";
                                            echo "<option value='10'>Octubre</option>";
                                            echo "<option value='11'>Noviembre</option>";
                                            echo "<option value='12'>Diciembre</option>";
                                        }else{
                                            if($mes == '04'){
                                                echo "<option value='01'>Enero</option>";
                                                echo "<option value='02'>Febrero</option>";
                                                echo "<option value='03'>Marzo</option>";
                                                echo "<option value='04' selected='selected'>Abril</option>";
                                                echo "<option value='05'>Mayo</option>";
                                                echo "<option value='06'>Junio</option>";
                                                echo "<option value='07'>Julio</option>";
                                                echo "<option value='08'>Agosto</option>";
                                                echo "<option value='09'>Septiembre</option>";
                                                echo "<option value='10'>Octubre</option>";
                                                echo "<option value='11'>Noviembre</option>";
                                                echo "<option value='12'>Diciembre</option>";
                                            }else{
                                                if($mes == '05'){
                                                    echo "<option value='01'>Enero</option>";
                                                    echo "<option value='02'>Febrero</option>";
                                                    echo "<option value='03'>Marzo</option>";
                                                    echo "<option value='04'>Abril</option>";
                                                    echo "<option value='05' selected='selected'>Mayo</option>";
                                                    echo "<option value='06'>Junio</option>";
                                                    echo "<option value='07'>Julio</option>";
                                                    echo "<option value='08'>Agosto</option>";
                                                    echo "<option value='09'>Septiembre</option>";
                                                    echo "<option value='10'>Octubre</option>";
                                                    echo "<option value='11'>Noviembre</option>";
                                                    echo "<option value='12'>Diciembre</option>";
                                                }else{
                                                    if($mes == '06'){
                                                        echo "<option value='01'>Enero</option>";
                                                        echo "<option value='02'>Febrero</option>";
                                                        echo "<option value='03'>Marzo</option>";
                                                        echo "<option value='04'>Abril</option>";
                                                        echo "<option value='05'>Mayo</option>";
                                                        echo "<option value='06' selected='selected'>Junio</option>";
                                                        echo "<option value='07'>Julio</option>";
                                                        echo "<option value='08'>Agosto</option>";
                                                        echo "<option value='09'>Septiembre</option>";
                                                        echo "<option value='10'>Octubre</option>";
                                                        echo "<option value='11'>Noviembre</option>";
                                                        echo "<option value='12'>Diciembre</option>";
                                                    }else{
                                                        if($mes == '07'){
                                                            echo "<option value='01'>Enero</option>";
                                                            echo "<option value='02'>Febrero</option>";
                                                            echo "<option value='03'>Marzo</option>";
                                                            echo "<option value='04'>Abril</option>";
                                                            echo "<option value='05'>Mayo</option>";
                                                            echo "<option value='06'>Junio</option>";
                                                            echo "<option value='07' selected='selected'>Julio</option>";
                                                            echo "<option value='08'>Agosto</option>";
                                                            echo "<option value='09'>Septiembre</option>";
                                                            echo "<option value='10'>Octubre</option>";
                                                            echo "<option value='11'>Noviembre</option>";
                                                            echo "<option value='12'>Diciembre</option>";
                                                        }else{
                                                            if($mes == '08'){
                                                                echo "<option value='01'>Enero</option>";
                                                                echo "<option value='02'>Febrero</option>";
                                                                echo "<option value='03'>Marzo</option>";
                                                                echo "<option value='04'>Abril</option>";
                                                                echo "<option value='05'>Mayo</option>";
                                                                echo "<option value='06'>Junio</option>";
                                                                echo "<option value='07'>Julio</option>";
                                                                echo "<option value='08' selected='selected'>Agosto</option>";
                                                                echo "<option value='09'>Septiembre</option>";
                                                                echo "<option value='10'>Octubre</option>";
                                                                echo "<option value='11'>Noviembre</option>";
                                                                echo "<option value='12'>Diciembre</option>";
                                                            }else{
                                                                if($mes == '09'){
                                                                    echo "<option value='01'>Enero</option>";
                                                                    echo "<option value='02'>Febrero</option>";
                                                                    echo "<option value='03'>Marzo</option>";
                                                                    echo "<option value='04'>Abril</option>";
                                                                    echo "<option value='05'>Mayo</option>";
                                                                    echo "<option value='06'>Junio</option>";
                                                                    echo "<option value='07'>Julio</option>";
                                                                    echo "<option value='08'>Agosto</option>";
                                                                    echo "<option value='09' selected='selected'>Septiembre</option>";
                                                                    echo "<option value='10'>Octubre</option>";
                                                                    echo "<option value='11'>Noviembre</option>";
                                                                    echo "<option value='12'>Diciembre</option>";
                                                                }else{
                                                                    if($mes == '10'){
                                                                        echo "<option value='01'>Enero</option>";
                                                                        echo "<option value='02'>Febrero</option>";
                                                                        echo "<option value='03'>Marzo</option>";
                                                                        echo "<option value='04'>Abril</option>";
                                                                        echo "<option value='05'>Mayo</option>";
                                                                        echo "<option value='06'>Junio</option>";
                                                                        echo "<option value='07'>Julio</option>";
                                                                        echo "<option value='08'>Agosto</option>";
                                                                        echo "<option value='09'>Septiembre</option>";
                                                                        echo "<option value='10' selected='selected'>Octubre</option>";
                                                                        echo "<option value='11'>Noviembre</option>";
                                                                        echo "<option value='12'>Diciembre</option>";
                                                                    }else{
                                                                        if($mes == '11'){
                                                                            echo "<option value='01'>Enero</option>";
                                                                            echo "<option value='02'>Febrero</option>";
                                                                            echo "<option value='03'>Marzo</option>";
                                                                            echo "<option value='04'>Abril</option>";
                                                                            echo "<option value='05'>Mayo</option>";
                                                                            echo "<option value='06'>Junio</option>";
                                                                            echo "<option value='07'>Julio</option>";
                                                                            echo "<option value='08'>Agosto</option>";
                                                                            echo "<option value='09'>Septiembre</option>";
                                                                            echo "<option value='10'>Octubre</option>";
                                                                            echo "<option value='11' selected='selected'>Noviembre</option>";
                                                                            echo "<option value='12'>Diciembre</option>";
                                                                        }else{
                                                                            if($mes == '12'){
                                                                                echo "<option value='01'>Enero</option>";
                                                                                echo "<option value='02'>Febrero</option>";
                                                                                echo "<option value='03'>Marzo</option>";
                                                                                echo "<option value='04'>Abril</option>";
                                                                                echo "<option value='05'>Mayo</option>";
                                                                                echo "<option value='06'>Junio</option>";
                                                                                echo "<option value='07'>Julio</option>";
                                                                                echo "<option value='08'>Agosto</option>";
                                                                                echo "<option value='09'>Septiembre</option>";
                                                                                echo "<option value='10'>Octubre</option>";
                                                                                echo "<option value='11'>Noviembre</option>";
                                                                                echo "<option value='12' selected='selected'>Diciembre</option>";
                                                                            }else{
                                                                                echo "<option value='01'>Enero</option>";
                                                                                echo "<option value='02'>Febrero</option>";
                                                                                echo "<option value='03'>Marzo</option>";
                                                                                echo "<option value='04'>Abril</option>";
                                                                                echo "<option value='05'>Mayo</option>";
                                                                                echo "<option value='06'>Junio</option>";
                                                                                echo "<option value='07'>Julio</option>";
                                                                                echo "<option value='08'>Agosto</option>";
                                                                                echo "<option value='09'>Septiembre</option>";
                                                                                echo "<option value='10'>Octubre</option>";
                                                                                echo "<option value='11'>Noviembre</option>";
                                                                                echo "<option value='12'>Diciembre</option>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }else{
                                $actual = date("m", strtotime("-1 month"));

                                if($actual == '01')
                                    echo "<option value='01' selected='selected'>Enero</option>";
                                else
                                    echo "<option value='01'>Enero</option>";

                                if($actual === '02')
                                    echo "<option value='02' selected='selected'>Febrero</option>";
                                else
                                    echo "<option value='02'>Febrero</option>";

                                if($actual == '03')
                                    echo "<option value='03' selected='selected'>Marzo</option>";
                                else
                                    echo "<option value='03'>Marzo</option>";

                                if($actual == '04')
                                    echo "<option value='04' selected='selected'>Abril</option>";
                                else
                                    echo "<option value='04'>Abril</option>";

                                if($actual == '05')
                                    echo "<option value='05' selected='selected'>Mayo</option>";
                                else
                                    echo "<option value='05'>Mayo</option>";

                                if($actual == '06')
                                    echo "<option value='06' selected='selected'>Junio</option>";
                                else
                                    echo "<option value='06'>Junio</option>";

                                if($actual == '07')
                                    echo "<option value='07' selected='selected'>Julio</option>";
                                else
                                    echo "<option value='07'>Julio</option>";

                                if($actual == '08')
                                    echo "<option value='08' selected='selected'>Agosto</option>";
                                else
                                    echo "<option value='08'>Agosto</option>";

                                if($actual == '09')
                                    echo "<option value='09' selected='selected'>Septiembre</option>";
                                else
                                    echo "<option value='09'>Septiembre</option>";

                                if($actual == '10')
                                    echo "<option value='10' selected='selected'>Octubre</option>";
                                else
                                    echo "<option value='10'>Octubre</option>";

                                if($actual == '11')
                                    echo "<option value='11' selected='selected'>Noviembre</option>";
                                else
                                    echo "<option value='11'>Noviembre</option>";

                                if($actual == '12')
                                    echo "<option value='12' selected='selected'>Diciembre</option>";
                                else
                                    echo "<option value='12'>Diciembre</option>";
                            }
                            ?>
                        </select>
                            <select name="anioant" id="anio" class="selectpicker" title="Año" data-style="btn btn-default btn-sm" data-width="70px" onchange="asignar();">
                            <?php
                            if(isset($_POST['anioant'])){
                                $anio = $_POST['anioant'];
                                $actual = date("Y");
                                for($dia = 2015; $dia <= $actual; $dia++){
                                    if($anio == $dia)
                                        echo "<option selected='selected' value='" . $dia . "'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }else{
                                $actual = new DateTime(date("Ymd", strtotime("-1 day")));

                                $actual = $actual->format("Y");

                                for($dia = 2015; $dia <= $actual; $dia++) {
                                    if (date("Y") == $dia)
                                        echo "<option value='" . $dia . "' selected='selected'>" . $dia . "</option>";
                                    else
                                        echo "<option value='" . $dia . "'>" . $dia . "</option>";
                                }
                            }
                            ?>
                        </select>
                        </div>

                        <div class="col-lg-2" style="width: 15%;">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Seleccione Informe
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="informe.php">Informe General</a></li>
                                    <li><a href="informe_pm.php">Mercadería Antigua por PM</a></li>
                                    <li><a href="informe_comp.php">Informe Comparativo MHT vs EOM</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-1 col-sm-4">
                            <button class="btn btn-primary btn-sm" style="width: 100px;">Actualizar</button>
                        </div>

                        <div class="col-lg-1" style="width: 11%;">
                            <a id="exportar" class="btn btn-success btn-sm" href="#">Exportar Base MHT</a>
                        </div>

                        <div class="col-lg-1">
                            <a id="exportar2" class="btn btn-success btn-sm" href="#">Exportar Re-etiquetado</a>
                        </div>

                    </form>
                </div>
            </nav>
        </header>

        <?php
        require_once 'general.php';
        if(isset($_POST['dia']) && isset($_POST['mes']) && isset($_POST['anio']) && isset($_POST['diaant']) && isset($_POST['mesant']) && isset($_POST['anioant'])) {
            $dia = $_POST['dia'];
            $mes = $_POST['mes'];
            $anio = $_POST['anio'];

            $diaant = $_POST['diaant'];
            $mesant = $_POST['mesant'];
            $anioant = $_POST['anioant'];

            General($dia, $mes, $anio, $diaant, $mesant, $anioant);
        }else{
            $dia = date("d");
            $mes = date("m");
            $anio = date("Y");

            $ayer = new DateTime(date("Ymd", strtotime("-1 month")));

            $diaant = date("Ym") . '01';

            $diaant = date("d", strtotime("{$diaant} -1 day"));

            $mesant = $ayer->format("m");
            $anioant = $ayer->format("Y");

            General($dia, $mes, $anio, $diaant, $mesant, $anioant);
        }
        ?>

        <script src="jquery-1.12.0.min.js"></script>
        <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script src="bootstrap-select-1.9.4/dist/js/bootstrap-select.min.js"></script>
    </body>
</html>
