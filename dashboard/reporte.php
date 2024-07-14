<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}
header('Content-Type: text/html; charset=UTF-8');

require('fpdf/fpdf.php');

include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id_empresa= $_POST['id_empresa'];
$area= $_POST['area'];
$fecha= $_POST['fecha'];
$consolidado= isset($_POST['consolidado']);

if($consolidado==1){
    $consulta1 = "SELECT id_capacitaciones,tema, tbl_empresas.nombreComercial as empresa, tbl_area.nombre as area,capacitador,lugar,fecha,estado from tbl_capacitaciones 
    inner join tbl_empresas on tbl_capacitaciones.id_empresa=tbl_empresas.id_empresa 
    inner join tbl_area on tbl_capacitaciones.area=tbl_area.id_area 
    WHERE tbl_capacitaciones.id_empresa ='".$id_empresa."' 
    and tbl_capacitaciones.area ='".$area."' 
    and fecha ='".$fecha."'";
    
    $resultado1 = $conexion->prepare($consulta1);
    $resultado1->execute();
    $data1=$resultado1->fetch(PDO::FETCH_ASSOC);
    
    
    class PDF extends FPDF {
        // Define el método de encabezado
        function Header() {
          // Encabezado personalizado
        }
      
        // Define el método de pie de página
        function Footer() {
          // Pie de página personalizado
          $this->SetY(-15);
          $this->SetFont('Arial', 'I', 8);
          $this->Cell(0, 10, 'creado por '.$_SESSION["s_usuario"]. utf8_decode(' Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
        }
      }
      $pdf = new PDF();
      $pdf->AddPage();
      $pdf->SetFont('Arial', 'b', 8,'', true, 'UTF-8');
      $pdf->Cell(0, 10, "REPORTE CONSOLIDADO DE EMPLEADOS A CAPACITACION " . strtoupper($data1['tema']), 0,0,'C');
      $pdf->Ln();
      $pdf->Cell(0, 10, "DE LA EMPRESA " . strtoupper($data1['empresa'])." AREA ".strtoupper($data1['area']), 0,0,'C');
      $pdf->Ln(-5);
      $pdf->Cell(0, 10, "UBICACION DE LA CAPACITACION " . strtoupper($data1['lugar']), 0,0,'C');
      $pdf->Ln();
      $pdf->Cell(0, 10, "FECHA DE CAPACITACION " . strtoupper($data1['fecha']), 0,0,'C');
      $pdf->Ln();
      
       
       
      
    
    
      $pdf->SetFont('Arial', 'b', 12,'', true, 'UTF-8');
      $pdf->Cell(10, 10, utf8_decode('N°'), 1);
      $pdf->Cell(80, 10, 'Nombre', 1);
      $pdf->Cell(50, 10, 'Nacimiento', 1);
      $pdf->Cell(50, 10, utf8_decode('Teléfono'), 1);
      $pdf->Ln();
      $pdf->SetFont('Arial', '', 10);
      
    $consulta = "SELECT nombre, fechaNacimiento, genero, telefono FROM tbl_empleados where id_empresa='".$id_empresa."' and area ='".$area."'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $n=1;
    foreach($data as $dat){
        $pdf->Cell(10, 8, $n, 1);
        $pdf->Cell(80, 8, $dat['nombre'], 1);
        $pdf->Cell(50, 8, $dat['fechaNacimiento'], 1);
        $pdf->Cell(50, 8, $dat['telefono'], 1);
        $pdf->Ln();
        $pdf->Ln(10);
        $n++;
    }
      
    
     
      $pdf->Output();
        
}else{
$consulta1 = "SELECT id_capacitaciones,tema, tbl_empresas.nombreComercial as empresa, tbl_area.nombre as area,capacitador,lugar,fecha,estado from tbl_capacitaciones 
inner join tbl_empresas on tbl_capacitaciones.id_empresa=tbl_empresas.id_empresa 
inner join tbl_area on tbl_capacitaciones.area=tbl_area.id_area 
WHERE tbl_capacitaciones.id_empresa ='".$id_empresa."' 
and tbl_capacitaciones.area ='".$area."' 
and fecha ='".$fecha."'";

$resultado1 = $conexion->prepare($consulta1);
$resultado1->execute();
$data1=$resultado1->fetch(PDO::FETCH_ASSOC);


class PDF extends FPDF {
    // Define el método de encabezado
    function Header() {
      // Encabezado personalizado
    }
  
    // Define el método de pie de página
    function Footer() {
      // Pie de página personalizado
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10,'creado por '.$_SESSION["s_usuario"]. utf8_decode(' Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }
  }
  $pdf = new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'b', 10,'', true, 'UTF-8');
  $pdf->Cell(0, 10, "REPORTE DE EMPLEADOS A CAPACITACION " . strtoupper($data1['tema']), 0,0,'C');
  $pdf->Ln();
  $pdf->Cell(0, 10, "DE LA EMPRESA " . strtoupper($data1['empresa'])." AREA ".strtoupper($data1['area']), 0,0,'C');
  $pdf->Ln(-5);
  $pdf->Cell(0, 10, "UBICACION DE LA CAPACITACION " . strtoupper($data1['lugar']), 0,0,'C');
  $pdf->Ln();
  $pdf->Cell(0, 10, "FECHA DE CAPACITACION " . strtoupper($data1['fecha']), 0,0,'C');
  $pdf->Ln();
   
   
  


  $pdf->SetFont('Arial', 'b', 13,'', true, 'UTF-8');
  $pdf->Cell(10, 10, utf8_decode('N°'), 1);
  $pdf->Cell(60, 10, 'Nombre', 1);
  $pdf->Cell(40, 10, 'Nacimiento', 1);
  $pdf->Cell(40, 10, utf8_decode('Género'), 1);
  $pdf->Cell(40, 10, utf8_decode('Teléfono'), 1);
  $pdf->Ln();
  $pdf->SetFont('Arial', '', 12);
  
$consulta = "SELECT nombre, fechaNacimiento, genero, telefono FROM tbl_empleados where id_empresa='".$id_empresa."' and area ='".$area."'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
$n=1;
foreach($data as $dat){
    $pdf->Cell(10, 8, $n, 1);
    $pdf->Cell(60, 8, $dat['nombre'], 1);
    $pdf->Cell(40, 8, $dat['fechaNacimiento'], 1);
    $pdf->Cell(40, 8, $dat['genero'], 1);
    $pdf->Cell(40, 8, $dat['telefono'], 1);
    $pdf->Ln();
    $pdf->Ln(10);
    $n++;
}
  

 
  $pdf->Output();
}

?>