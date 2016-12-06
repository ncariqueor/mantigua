<?php
$mes = $_GET['mes'];
$dia = $_GET['dia'];
$anio = $_GET['anio'];

$pm = $_GET['pm'];

$locacion = unserialize($_GET['locacion']);

$cant = count($locacion);

$buscaract = $anio . $mes . $dia;

ini_set("max_execution_time", 0);

$con = new mysqli('localhost', 'root', '', 'mantigua');

$query = "select fecha, pm, dep, subdep, desdep, dessdp, cla, descla, estacion, antiguedad, tempor,
                 codmar, estilo, sku, sku_desc, disponible, disponible * cosprom as costo, locacion

          from antigua

          where fecha = $buscaract and pm = '$pm'";

if($cant > 0){
    if(!in_array('Total', $locacion)){
        $in = "(";

        for($i=0; $i<$cant; $i++){
            $in = $in . "'$locacion[$i]'";
            if($i<$cant-1)
                $in = $in . ", ";
        }

        $in = $in . ")";

        $query = $query . " and locacion in " . $in;
    }
}

$query = $query . " order by sku";

$res = $con->query($query);

$arreglo = array();

$i = 0;

while ($row = mysqli_fetch_assoc($res)) {
    $arreglo[$i][0] = $row['fecha'];
    $arreglo[$i][1] = $row['pm'];
    $arreglo[$i][2] = $row['dep'];
    $arreglo[$i][3] = $row['subdep'];
    $arreglo[$i][4] = $row['desdep'];
    $arreglo[$i][5] = $row['dessdp'];
    $arreglo[$i][6] = $row['cla'];
    $arreglo[$i][7] = $row['descla'];
    $arreglo[$i][8] = $row['estacion'];
    $arreglo[$i][9] = $row['antiguedad'];
    $arreglo[$i][10] = $row['tempor'];
    $arreglo[$i][11] = $row['codmar'];
    $arreglo[$i][12] = $row['estilo'];
    $arreglo[$i][13] = $row['sku'];
    $arreglo[$i][14] = $row['sku_desc'];
    $arreglo[$i][15] = $row['disponible'];
    $arreglo[$i][16] = $row['costo'];
    $arreglo[$i][17] = $row['locacion'];

    /*$excel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, $row['fecha'])
        ->setCellValue('B'.$i, $row['lpn'])
        ->setCellValue('C'.$i, $row['sku'])
        ->setCellValue('D'.$i, $row['sku_desc'])
        ->setCellValue('E'.$i, $row['locn_brcd'])
        ->setCellValue('F'.$i, $row['disponible'])
        ->setCellValue('G'.$i, $row['tipo'])
        ->setCellValue('H'.$i, $row['whse'])
        ->setCellValue('I'.$i, $row['estilo'])
        ->setCellValue('J'.$i, $row['nomprv'])
        ->setCellValue('K'.$i, $row['vendor'])
        ->setCellValue('L'.$i, $row['dep'])
        ->setCellValue('M'.$i, $row['subdep'])
        ->setCellValue('N'.$i, $row['cla'])
        ->setCellValue('O'.$i, $row['desdep'])
        ->setCellValue('P'.$i, $row['dessdp'])
        ->setCellValue('Q'.$i, $row['descla'])
        ->setCellValue('R'.$i, $row['estacion'])
        ->setCellValue('S'.$i, $row['tempor'])
        ->setCellValue('T'.$i, $row['fecing'])
        ->setCellValue('U'.$i, $row['unitra'])
        ->setCellValue('V'.$i, $row['cosprom'])
        ->setCellValue('W'.$i, $row['prenor'])
        ->setCellValue('X'.$i, $row['preofe'])
        ->setCellValue('Y'.$i, $row['rut'])
        ->setCellValue('Z'.$i, $row['division'])
        ->setCellValue('AA'.$i, $row['pm'])
        ->setCellValue('AB'.$i, $row['antiguedad'])
        ->setCellValue('AC'.$i, $row['codmar'])
        ->setCellValue('AD'.$i, $row['locacion'])
        ->setCellValue('AE'.$i, $row['negocio'])
        ->setCellValue('AF'.$i, $row['detalle']);*/

    $i++;
}

ini_set('memory_limit', '1024M');

require_once 'Classes/PHPExcel.php';

$excel = new PHPExcel();

$excel->getProperties()->setCreator("Operaciones")
    ->setLastModifiedBy("Operaciones")
    ->setTitle("Stock_PM_" . $pm . "_" . $buscaract);

$titulos = array('Fecha', 'PM', 'Depto.', 'Sub Depto.', 'Desc. Depto.', 'Desc. Sub Depto.', 'Clase', 'Desc. Clase', 'Estacion', 'Antiguedad Estilo', 'Temporada',
                 'Marca', 'Estilo', 'SKU', 'Desc. SKU', 'Stock Unidades', 'Stock Costo', 'Ubicacion');

$excel->setActiveSheetIndex(0)
    ->setCellValue('A1', $titulos[0])
    ->setCellValue('B1', $titulos[1])
    ->setCellValue('C1', $titulos[2])
    ->setCellValue('D1', $titulos[3])
    ->setCellValue('E1', $titulos[4])
    ->setCellValue('F1', $titulos[5])
    ->setCellValue('G1', $titulos[6])
    ->setCellValue('H1', $titulos[7])
    ->setCellValue('I1', $titulos[8])
    ->setCellValue('J1', $titulos[9])
    ->setCellValue('K1', $titulos[10])
    ->setCellValue('L1', $titulos[11])
    ->setCellValue('M1', $titulos[12])
    ->setCellValue('N1', $titulos[13])
    ->setCellValue('O1', $titulos[14])
    ->setCellValue('P1', $titulos[15])
    ->setCellValue('Q1', $titulos[16])
    ->setCellValue('R1', $titulos[17]);

$j = 2;

for($k=0;$k<$i;$k++){
    $excel->setActiveSheetIndex(0)
        ->setCellValue('A'.$j, $arreglo[$k][0])
        ->setCellValue('B'.$j, $arreglo[$k][1])
        ->setCellValue('C'.$j, $arreglo[$k][2])
        ->setCellValue('D'.$j, $arreglo[$k][3])
        ->setCellValue('E'.$j, $arreglo[$k][4])
        ->setCellValue('F'.$j, $arreglo[$k][5])
        ->setCellValue('G'.$j, $arreglo[$k][6])
        ->setCellValue('H'.$j, $arreglo[$k][7])
        ->setCellValue('I'.$j, $arreglo[$k][8])
        ->setCellValue('J'.$j, $arreglo[$k][9])
        ->setCellValue('K'.$j, $arreglo[$k][10])
        ->setCellValue('L'.$j, $arreglo[$k][11])
        ->setCellValue('M'.$j, $arreglo[$k][12])
        ->setCellValue('N'.$j, $arreglo[$k][13])
        ->setCellValue('O'.$j, $arreglo[$k][14])
        ->setCellValue('P'.$j, $arreglo[$k][15])
        ->setCellValue('Q'.$j, $arreglo[$k][16])
        ->setCellValue('R'.$j, $arreglo[$k][17]);

    $j++;
}

$estiloInformacion = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);

$color1 = array(
    'font' => array(
        'name'  => 'Calibri',
        'size' => '11',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'rgb' => 'eeeeee'
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
            'color' => array(
                'rgb' => 'dddddd'
            )
        )
    )
);

$excel->getActiveSheet()->getStyle('A1:R1')->applyFromArray($color1);
$excel->getActiveSheet()->getStyle('A2:R'.$j)->applyFromArray($estiloInformacion);

$excel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth('15');
$excel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth('20');
$excel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth('10');
$excel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth('10');
$excel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth('30');
$excel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth('30');
$excel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth('10');
$excel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth('30');
$excel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth('10');
$excel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth('10');
$excel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth('15');
$excel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth('15');
$excel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth('15');
$excel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth('15');
$excel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth('30');
$excel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth('10');
$excel->setActiveSheetIndex(0)->getColumnDimension('Q')->setWidth('10');
$excel->setActiveSheetIndex(0)->getColumnDimension('R')->setWidth('30');

for($i=2; $i<=($j-1); $i++)
    $excel->getActiveSheet()->getRowDimension($i)->setRowHeight(25);


// Se asigna el nombre a la hoja
$excel->getActiveSheet()->setTitle("Stock_" . $buscaract);

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$excel->setActiveSheetIndex(0);

// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$excel->getActiveSheet(0)->freezePaneByColumnAndRow(0,2);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename='Stock_PM_" . $pm . "_" . $buscaract . ".xlsx'");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
exit;

