<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Generador de informes</h1>

       
    <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_capacitaciones,tema, id_empresa, area, capacitador, lugar, fecha from tbl_capacitaciones order by (fecha) DESC";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablareporte" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>Tema</th>
                                <th>Capacitador</th>                              
                                <th>Lugar</th>  
                                <th>Fecha</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php     
                            $n=1;                       
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $n ; ?></td>
                                <td><?php echo $dat['tema'] ?></td>
                                <td><?php echo $dat['capacitador'] ?></td>
                                <td><?php echo $dat['lugar'] ?></td>
                                <td><?php echo $dat['fecha'] ?></td>  
                                <td>
                                    <form action="reporte.php" method="POST">
                                        <input type="text" name="id_empresa" hidden value="<?php echo $dat['id_empresa'] ?>">
                                        <input type="text" name="area" hidden value="<?php echo $dat['area'] ?>">
                                        <input type="text" name="fecha" hidden value="<?php echo $dat['fecha'] ?>">
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="consolidado">
                                        <label class="form-check-label" for="consolidado">
                                        Consolidado
                                        </label>
                            </div>
                                        <input type="submit" value="imprimir" class="btn btn-info">
                                    </form>
                                   
                                
                                </td>
                                
                            </tr>
                            <?php
                            $n++;
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>  

</div>
<!--FIN del cont principal-->

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>

<script type="text/javascript" src="main.js"></script>  
</body>



</html>