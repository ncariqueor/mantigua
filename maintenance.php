<html>
    <head>
        <title>Mantenedor</title>
        <link type="text/css" rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap-select-1.9.4/dist/css/bootstrap-select.css"/>
    </head>

    <body>
        <script>
            function asignar() {
                var seleccion = document.getElementById('locacion').value;
                if(seleccion == 'nueva') {
                    document.getElementById('otra').value = "";
                    document.getElementById('ocultar').style.display = 'block';
                }
                else {
                    document.getElementById('otra').value = "";
                    document.getElementById('ocultar').style.display = 'none';
                }
            }

            function asignar2() {
                var seleccion = document.getElementById('locacionAct').value;
                if(seleccion == 'nueva') {
                    document.getElementById('otraAct').value = "";
                    document.getElementById('ocultarAct').style.display = 'block';
                }
                else {
                    document.getElementById('otraAct').value = "";
                    document.getElementById('ocultarAct').style.display = 'none';
                }
            }

            function permiteUbicacion() {
                var ubicacion = document.getElementById('ubicacion').value.replace(/\s/g, '');
                ubicacion = ubicacion.replace(/[\^%#$.*+¡'"&^°¬`~-¿?=!:|\\/()\[\]{}]/g, '');
                document.getElementById('ubicacion').value = ubicacion;
            }

            function permite(elemento) {
                var ubicacion = elemento.value.replace(/[\'"`]/g, '');
                elemento.value = ubicacion;
            }
        </script>

        <div class="container">
            <h1 class="text-center text-primary">Mantenedor de Ubicaciones</h1>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center text-success">Agregar nueva ubicación</h2>
                    <form class="form-control-static text-center">
                        <input type="text" name="ubicacion" id="ubicacion" class="input-sm" placeholder="Escriba la nueva ubicación" onkeypress="permiteUbicacion()" autocomplete="off"><br><br>

                        <select name="tipo" id="tipo" class="selectpicker" data-style="btn btn-sm btn-default">
                            <option value="vacio">Seleccione el tipo de ubicación</option>
                            <option value="Activo">Activo</option>
                            <option value="Case Pick">Case Pick</option>
                            <option value="Reserva">Reserva</option>
                        </select><br><br>

                        <select name="locacion" id="locacion" onchange="asignar();" class="selectpicker" data-style="btn btn-sm btn-default">
                            <option value="vacio">Seleccione locación</option>
                            <?php
                            $con = new mysqli('localhost', 'root', '', 'mantigua');

                            $query = "select distinct locacion from locaciones order by locacion asc";

                            $res = $con->query($query);

                            while($row = mysqli_fetch_assoc($res)){
                                echo "<option value='" . $row['locacion'] . "'>" . $row['locacion'] . "</option>";
                            }
                            echo "<option value='nueva'>Agregar nueva locación</option>";
                            ?>
                        </select><br><br>

                        <div style="display: none;" id="ocultar">
                            <input  type="text" id="otra" name="otra" class="input-sm" placeholder="Escriba la nueva locación" onkeypress="permite(this);"><br><br>
                        </div>

                        <input type="text" id="detalle" name="detalle" class="input-sm" placeholder="Escriba el detalle" onkeypress="permite(this);"><br><br>

                        <input type="button" class="btn btn-primary" onclick="enviar();" value="Agregar nueva ubicación" id="submit">
                    </form>
                </div>
            </div>
        </div>

        <script src="jquery-1.12.0.min.js"></script>
        <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script src="bootstrap-select-1.9.4/dist/js/bootstrap-select.min.js"></script>

        <script>
            function enviar(){
                var ubicacion = document.getElementById('ubicacion').value.replace(/\s/g, '');
                ubicacion = ubicacion.replace(/[\^%#$.*+¡'"&^°¬`~-¿?=!:|\\/()\[\]{}]/g, '');
                document.getElementById('ubicacion').value = ubicacion;
                var tipo = document.getElementById('tipo').value;
                var locacion = document.getElementById('locacion').value;
                if(locacion == 'nueva') {
                    var locacion = document.getElementById('otra').value.replace(/[\'"`]/g, '');
                    document.getElementById('otra').value = locacion;
                }
                var detalle = document.getElementById('detalle').value.replace(/[\'"`]/g, '');
                document.getElementById('detalle').value = detalle;

                $.ajax({
                    type: "post",
                    url: "recibir.php",
                    data: {
                        ubicacion: ubicacion,
                        tipo: tipo,
                        locacion: locacion,
                        detalle: detalle
                    },
                    beforeSend: function(){
                        $("#submit").attr('class', 'btn btn-warning').attr('value', "Espere... Cargando ubicación y actualizando datos.");
                    },
                    success: function(msg){
                        if(msg != '¡Locación se agregó correctamente!')
                            $("#submit").attr('class', 'btn btn-danger').attr('value', msg);
                        else
                            $("#submit").attr('class', 'btn btn-success').attr('value', msg);

                        setTimeout(function(){
                            $("#submit").attr('class', 'btn btn-primary').attr('value', "Agregar nueva ubicación");
                        }, 3500);
                    }
                })
            }


        </script>
    </body>
</html>

