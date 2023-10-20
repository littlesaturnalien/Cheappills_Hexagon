<?php
include("connect.php");
$connection = Conectar();
$data = json_decode($_POST['data']);
$numeros = $data->ID_Med;

$sql = "SELECT * FROM medicamentos WHERE ID_Med IN (" . implode(',', $numeros) . ")";
$result = mysqli_query($connection, $sql);
require('../vendor/autoload.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;


$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator("Hexagon")->setTitle("Tabla comparativa");
$spreadsheet->setActiveSheetIndex(0);
$hoja_actual = $spreadsheet->getActiveSheet();
$hoja_actual->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
$hoja_actual->setCellValue('A1', 'Nombre');
$hoja_actual->setCellValue('B1', 'Precio');
$hoja_actual->setCellValue('C1', 'Indicaciones');
$hoja_actual->setCellValue('D1', 'Componentes');
$hoja_actual->setCellValue('E1', 'Posologia');
$hoja_actual->setCellValue('F1', 'Contraindicaciones');
$hoja_actual->setCellValue('G1', 'Efectos Secundarios');
$hoja_actual->setCellValue('H1', 'Advertencias');
$hoja_actual->setCellValue('I1', 'Almacenamiento');
$hoja_actual->setCellValue('J1', 'Laboratorio');
$hoja_actual->setCellValue('K1', 'Distribuidor');

$borderStyle = [
    'borders' => [
        'left' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'ffffff'],
        ],
        'right' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'ffffff'],
        ],
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'ffffff'],
        ],
        'inside' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'ffffff'],
        ],
    ],
];


$fila_actual = 2;
for ($columna_actual = 'A'; $columna_actual != 'L'; $columna_actual++) {
    $hoja_actual->getColumnDimension($columna_actual)->setWidth(25);
    $hoja_actual->getStyle($columna_actual)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $hoja_actual->getStyle($columna_actual)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
}
$hoja_actual->getStyle('A1:K1')->getFont()->setName('Quaaykop')->setSize(14);

$hoja_actual->getColumnDimension('A')->setWidth(10);
$hoja_actual->getColumnDimension('B')->setWidth(10);
$hoja_actual->getColumnDimension('C')->setWidth(22);
$hoja_actual->getColumnDimension('D')->setWidth(22);
$hoja_actual->getColumnDimension('E')->setWidth(12);
$hoja_actual->getColumnDimension('H')->setWidth(15);
$hoja_actual->getColumnDimension('I')->setWidth(20);
$hoja_actual->getColumnDimension('J')->setWidth(15);
$hoja_actual->getColumnDimension('K')->setWidth(15);

while ($mostrar = mysqli_fetch_assoc($result)) {
    $columna_actual = 'A';
    foreach (array_slice($mostrar, 2) as $dato) {
        $hoja_actual->setCellValue($columna_actual . $fila_actual, $dato);
        $hoja_actual->getStyle($columna_actual . $fila_actual)->getAlignment()->setWrapText(true);
        ++$columna_actual;
    }
    $hoja_actual->getStyle('A' . $fila_actual . ':K' . $fila_actual)->getFont()->setName('Sanlulus')->setSize(14);
    $hoja_actual->getStyle('A' . $fila_actual . ':K' . $fila_actual)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $hoja_actual->getStyle('A' . $fila_actual . ':K' . $fila_actual)->getFill()->getStartColor()->setARGB('80BCBD');
    $hoja_actual->getStyle('A' . $fila_actual . ':K' . $fila_actual)->applyFromArray($borderStyle);
    ++$fila_actual;
}
$hoja_actual->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_TABLOID);

$writer_pdf = new Dompdf($spreadsheet);

$writer_pdf->save('../tablas_usuarios/tabla.pdf');

header('location:tabla_pagina.php');
exit;
?>