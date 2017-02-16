<!DOCTYPE html>
<html lang="es">

<head>
    <title>Re-etiquetado</title>
    <link type="text/css" rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../bootstrap-select-1.9.4/dist/css/bootstrap-select.css" />
    <link rel="stylesheet" type="text/css" href="../bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css" />
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                            ga('create', 'UA-88784345-1', 'auto');
                            ga('send', 'pageview');
    </script>
</head>

<body onload="change_download_link();">

    <script>
        function change_download_link() {
            var date = document.getElementById("fecha").value;
            
            var day   = date[5] + "" + date[6];
            
            var month = date[8] + "" + date[9];
            
            var year  = date[11] + "" + date[12] + "" + date[13] + "" + date[14];
            
            document.getElementById("exportar2").href = "../exportar2.php?mes=" + month + "&anio=" + year + "&dia=" + day + "&tipo=ret";
        }
    </script>

    <header class="container">
        <nav class="navbar navbar-default">
            <div class="btn-group-sm">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center"><a href="http://10.95.17.114/paneles"><img src="../paris.png" width="140px" height="100px" title="Reportes Paris"></a> Informe de Re-etiquetado</h3></div>
                </div>

                <form action="index.php" method="get" class="row">
                    <div class="col-lg-2" style="margin-left: 24%;">
                        <div class="text-center"><span class="label label-primary" style="font-size: 13px;">Seleccione día actual</span></div>
                        <div class="input-group date" data-provide="datepicker">
                            <input name='fecha' id="fecha" class="form-control" onchange="change_download_link();" type="text" value="<?php
                            date_default_timezone_set("America/Santiago");

                            require_once '../fecha_es.php';

                            if(isset($_GET['fecha'])){
                                echo $_GET['fecha'];
                            }else {
                                echo obtenerDia(date("D")) . ", " . date("d/m/Y ");
                            }
                            ?>" />
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="text-center"><span class="label label-primary" style="font-size: 13px;">Seleccione día a comparar</span></div>
                        <div class="input-group date" data-provide="datepicker">
                            <input name='fecha2' id="fecha2" class="form-control" type="text" value="<?php
                            if(isset($_GET['fecha'])){
                                echo $_GET['fecha2'];
                            }else {
                                $last_day_of_month = date("Ym") . '01';
                                
                                $last_day_of_month = date("Ymd", strtotime("{$last_day_of_month} -1 day"));
                                
                                echo obtenerDia(date("D", strtotime("{$last_day_of_month}"))) . ", " . date("d/m/Y", strtotime("{$last_day_of_month}"));
                            }
                            ?>" />
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1"><br>
                        <button class="btn btn-primary">Actualizar</button>
                    </div>

                    <div class="col-lg-3"><br>
                        <a id="exportar2" class="btn btn-success" href="#">Exportar Re-etiquetado</a>
                    </div>

                </form>
            </div>
        </nav>
    </header>

    <?php
        require_once 'general.php';
        if(isset($_GET['fecha']) && isset($_GET['fecha2'])) {
            $current_day = utf8_decode($_GET['fecha']);

            $current_day = str_split($current_day);
            
            $dia = $current_day[5] . $current_day[6];
            
            $mes = $current_day[8] . $current_day[9];
            
            $anio = $current_day[11] . $current_day[12] . $current_day[13] . $current_day[14];
            
            $last_day    = utf8_decode($_GET['fecha2']);
            
            $diaant = $last_day[5] . $last_day[6];
            
            $mesant = $last_day[8] . $last_day[9];
            
            $anioant = $last_day[11] . $last_day[12] . $last_day[13] . $last_day[14];

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

        <script src="../jquery-1.12.0.min.js"></script>
        <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="../bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.es.min.js"></script>
        <script>
            $('.date').datepicker({
                format: 'D, dd/mm/yyyy',
                language: 'es-ES'
            });
            
            $('.date2').datepicker({
                format: 'D, dd/mm/yyyy',
                language: 'es-ES'
            });
        </script>
</body>

</html>