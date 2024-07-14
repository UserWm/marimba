<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}

include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

echo $id=$_GET['id'];
echo $var=1;
$consulta = "UPDATE tbl_capacitaciones SET 
estado=$var
WHERE id_capacitaciones= $id ";	
$resultado = $conexion->prepare($consulta);
$resultado->execute();    
header('Location: viewcapacitaciones.php'); 

?>