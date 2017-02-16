<?php
function obtenerDia($dia){
    if($dia == 'Mon')
        return 'Lun';

    if($dia == 'Tue')
        return 'Mar';

    if($dia == 'Wed')
        return 'Mié';

    if($dia == 'Thu')
        return 'Jue';

    if($dia == 'Fri')
        return 'Vie';

    if($dia == 'Sat')
        return 'Sáb';

    if($dia == 'Sun')
        return 'Dom';
}

function obtenerMes($mes){
    $meses = array('01' => 'enero', 
                   '02' => 'febrero', 
                   '03' => 'marzo', 
                   '04' => 'abril', 
                   '05' => 'mayo', 
                   '06' => 'junio', 
                   '07' => 'julio', 
                   '08' => 'agosto', 
                   '09' => 'septiembre', 
                   '10' => 'octubre', 
                   '11' => 'noviembre', 
                   '12' => 'diciembre');
    
    return $meses[$mes];
}
