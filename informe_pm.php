<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mercadería Antigua</title>
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap-select-1.9.4/dist/css/bootstrap-select.css"/>
</head>

<body>
<header class="container">
    <script>
        function cambiar() {
            var x = document.getElementById("locacion").options.length;
            var y = document.getElementById("locacion");
            var esta = -1;
            for(var i=0; i<x; i++){
                if(y.options[i].selected){
                    if(y.options[i].value == 'Total'){
                        esta = i;
                        break;
                    }
                }
            }

            if(esta != -1){
                for(var i=0; i<x; i++){
                    if(i != esta) {
                        y.options[i].selected = false;
                        alert(y.options[i].className = '';
                        //alert(i + ", " + y.options[i].selected + ", " + y.options[i].value);
                    }
                }
            }
        }

    </script>

    <nav class="navbar navbar-default">
        <div class="btn-group-sm">
            <div class="row">
                <div class="col-md-12"><h3 class="text-center"><a href="http://10.95.17.114/paneles"><img src="paris.png" width="140px" height="100px" title="Reportes Paris"></a> Informe Mercadería Antigua por PM</h3></div>
            </div><br>

            <form action="informe_pm.php" method="post" class="row" id="form">
                <div class="col-lg-3">
                    <label class="label label-primary">Día Actual</label>
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
                    <select name="anio" id="anio" class="selectpicker" title="Año" data-style="btn btn-default btn-sm" data-width="65px" onchange="asignar();">
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

                <div class="col-lg-2">
                    <select name="pm" id="pm" class="selectpicker" title="Seleccione PM" data-style="btn btn-default btn-sm" data-width="185px">
                        <?php
                        if(isset($_POST['pm'])){
                            $pm = $_POST['pm'];
                            if($pm == 'Todos'){
                                echo "<option value='Todos' selected='selected'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Andres Ruiz'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz' selected='selected'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Denisse Trajtmann'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann' selected='selected'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Eugenia Neira Herbage'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage' selected='selected'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Francisca Zarges'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges' selected='selected'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Maria Constanza Troncoso'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso' selected='selected'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Maria Jose Neira'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira' selected='selected'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Valentina Houdely'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely' selected='selected'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Maria Laura Gutierrez'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez' selected='selected'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                            }
                            if($pm == 'Magdalena Rosende'){
                                echo "<option value='Todos'>Tod@s l@s PM</option>";
                                echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                                echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                                echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                                echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                                echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                                echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                                echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                                echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                                echo "<option value='Magdalena Rosende' selected='selected'>Magdalena Rosende</option>";
                            }
                        }else{
                            echo "<option value='Todos' selected='selected'>Tod@s l@s PM</option>";
                            echo "<option value='Andres Ruiz'>Andres Ruiz</option>";
                            echo "<option value='Denisse Trajtmann'>Denisse Trajtmann</option>";
                            echo "<option value='Eugenia Neira Herbage'>Eugenia Neira Herbage</option>";
                            echo "<option value='Francisca Zarges'>Francisca Zarges</option>";
                            echo "<option value='Maria Constanza Troncoso'>Maria Constanza Troncoso</option>";
                            echo "<option value='Maria Jose Neira'>Maria jose Neira</option>";
                            echo "<option value='Valentina Houdely'>Valentina Houdely</option>";
                            echo "<option value='Maria Laura Gutierrez'>Maria Laura Gutierrez</option>";
                            echo "<option value='Magdalena Rosende'>Magdalena Rosende</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-2">
                    <select name="locacion[]" id="locacion" class="selectpicker" title="Seleccione Locacion" data-style="btn btn-default btn-sm" data-width="190px" multiple onchange='cambiar();'>
                        <?php
                        if(isset($_POST['locacion'])){
                            $arreglo = $_POST['locacion'];

                            $opcion = "";

                            if(in_array('Total', $arreglo))
                                $opcion = $opcion . "<option value='Total' selected='selected'>Total Stock</option>";
                            else
                                $opcion = $opcion . "<option value='Total'>Total Stock</option>";

                            if(in_array('Disponible para la venta', $arreglo))
                                $opcion = $opcion . "<option value='Disponible para la venta' selected='selected'>Disponible para la venta</option>";
                            else
                                $opcion = $opcion . "<option value='Disponible para la venta'>Disponible para la venta</option>";

                            $opcion = $opcion . "<optgroup label='No Disponible para la venta'>";

                            if(in_array('Logistica Inversa', $arreglo))
                                $opcion = $opcion . "<option value='Logistica Inversa' selected='selected'>Logística Inversa</option>";
                            else
                                $opcion = $opcion . "<option value='Logistica Inversa'>Logística Inversa</option>";

                            if(in_array('Logistica Inversa/ cobros', $arreglo))
                                $opcion = $opcion . "<option value='Logistica Inversa/ cobros' selected='selected'>Logística Inversa/ cobros</option>";
                            else
                                $opcion = $opcion . "<option value='Logistica Inversa/ cobros'>Logística Inversa/ cobros</option>";

                            if(in_array('Venta Empresa', $arreglo))
                                $opcion = $opcion . "<option value='Venta Empresa' selected='selected'>Venta Empresa</option>";
                            else
                                $opcion = $opcion . "<option value='Venta Empresa'>Venta Empresa</option>";

                            if(in_array('Re-etiquetado', $arreglo))
                                $opcion = $opcion . "<option value='Re-etiquetado' selected='selected'>Re-etiquetado</option>";
                            else
                                $opcion = $opcion . "<option value='Re-etiquetado'>Re-etiquetado</option>";

                            if(in_array('De baja', $arreglo))
                                $opcion = $opcion . "<option value='De baja' selected='selected'>De baja</option>";
                            else
                                $opcion = $opcion . "<option value='De baja'>De baja</option>";

                            if(in_array('Extraviado', $arreglo))
                                $opcion = $opcion . "<option value='Extraviado' selected='selected'>Extraviado</option>";
                            else
                                $opcion = $opcion . "<option value='Extraviado'>Extraviado</option>";

                            if(in_array('Fotografia', $arreglo))
                                $opcion = $opcion . "<option value='Fotografia' selected='selected'>Fotografía</option>";
                            else
                                $opcion = $opcion . "<option value='Fotografia'>Fotografía</option>";

                            if(in_array('Productos Danados', $arreglo))
                                $opcion = $opcion . "<option value='Productos Danados' selected='selected'>Productos Dañados</option>";
                            else
                                $opcion = $opcion . "<option value='Productos Danados'>Productos Dañados</option>";

                            if(in_array('Zona de transito', $arreglo))
                                $opcion = $opcion . "<option value='Zona de transito' selected='selected'>Zona de tránsito</option>";
                            else
                                $opcion = $opcion . "<option value='Zona de transito'>Zona de tránsito</option>";

                            if(in_array('Otros', $arreglo))
                                $opcion = $opcion . "<option value='Otros' selected='selected'>Otros</option>";
                            else
                                $opcion = $opcion . "<option value='Otros'>Otros</option>";

                            $opcion = $opcion . "</optgroup>";

                            echo $opcion;
                        }else{
                            echo "<option value='Total' selected='selected'>Total Stock</option>";
                            echo "<option value='Disponible para la venta'>Disponible para la venta</option>";
                            echo "<optgroup label='No Disponible para la venta'>";
                            echo "<option value='Logistica Inversa'>Logística Inversa</option>";
                            echo "<option value='Logistica Inversa/ cobros'>Logística Inversa/ cobros</option>";
                            echo "<option value='Venta Empresa'>Venta Empresa</option>";
                            echo "<option value='Re-etiquetado'>Re-etiquetado</option>";
                            echo "<option value='De baja'>De baja</option>";
                            echo "<option value='Extraviado'>Extraviado</option>";
                            echo "<option value='Fotografia'>Fotografía</option>";
                            echo "<option value='Productos Danados'>Productos Dañados</option>";
                            echo "<option value='Zona de transito'>Zona de tránsito</option>";
                            echo "<option value='Otros'>Otros</option>";
                            echo "</optgroup>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-2">
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

                <div class="col-lg-1">
                    <button class="btn btn-primary btn-sm" style="width: 100px;">Actualizar</button>
                </div>

            </form>
        </div>
    </nav>

</header>

<?php
require_once 'general.php';
if(isset($_POST['dia']) && isset($_POST['mes']) && isset($_POST['anio']) && isset($_POST['pm']) && isset($_POST['locacion'])){
    if($_POST['pm'] == 'Todos') {
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $anio = $_POST['anio'];

        $pm = $_POST['pm'];

        $locacion = $_POST['locacion'];

        informePM($dia, $mes, $anio, $pm, $locacion);
    }else{
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $anio = $_POST['anio'];

        $pm = $_POST['pm'];

        $locacion = $_POST['locacion'];

        informeDepto($dia, $mes, $anio, $pm, $locacion);
    }
}else{
    $dia = date("d");
    $mes = date("m");
    $anio = date("Y");

    $pm = "Todos";

    $locacion = array('Total');

    informePM($dia, $mes, $anio, $pm, $locacion);
}
?>

<script src="jquery-1.12.0.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="bootstrap-select-1.9.4/dist/js/bootstrap-select.min.js"></script>
</body>
</html>