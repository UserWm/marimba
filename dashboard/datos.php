<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT pf,count(*) as 'value' FROM tbl_empresas 
INNER JOIN tbl_departamentos ON tbl_empresas.idDepartamento=tbl_departamentos.idDepartamento
GROUP BY (tbl_empresas.idDepartamento);";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
[
<?php 
$c=1;
foreach($data as $dat){
    
    if($c==1){
   ?>

   {
    "value": <?php echo $dat['value'] ;?>,
    "code":"<?php echo $dat['pf'] ;?>"
    }

   <?php
    }
    else{
        echo ",{";
        ?>
        
            "value": <?php echo $dat['value'] ;?>,
            "code":"<?php echo $dat['pf'] ;?>"
            
            <?php
            echo "}";
    }
    $c=$c+1;
}

?>
]