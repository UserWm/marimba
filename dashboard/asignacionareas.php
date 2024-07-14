<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Asignacion de áreas a empresas.</h1>

    
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "select id_gestion, tbl_empresas.nombreComercial as empresa, tbl_area.nombre as area FROM tbl_gestio_areas
inner join tbl_empresas on tbl_gestio_areas.id_empresa=tbl_empresas.id_empresa
inner join tbl_area on tbl_gestio_areas.id_area = tbl_area.id_area";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
$n=1;
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoAsignacion" type="button" class="btn btn-success" data-toggle="modal">Nueva asignación</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaAsignacion" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Empresa</th>
                                <th>Area</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {  
                                                                                      
                            ?>
                            <tr>
                                <td><?php echo $dat['id_gestion']; ?></td>
                                <td><?php echo $dat['empresa']; ?></td>
                                <td><?php echo $dat['area']; ?></td>
                                <td></td>
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
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUDAsignacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formAsignacion">   
        <div class="modal-body"> 
        <div class="form-group">
             
                <label for="empresa" class="col-form-label">Empresa</label>
                <select class="form-control" id="empresa">
                    <option value="0">Seleccione una Empresa</option>
                <?php          
                $consulta2 = "SELECT * from tbl_empresas";
                $resultado2 = $conexion->prepare($consulta2);
                $resultado2->execute();
                $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);                  
                foreach($data2 as $dat2)
                { 
                 echo "<option value='".$dat2['id_empresa']."'>".$dat2['nombreComercial']."</option>";
                }                                                       
                ?>
                </select>
                </div> 

                <div class="form-group">
                <label for="area" class="col-form-label">Area</label>
                <select class="form-control" id="area1">
                    <option value="0">Seleccione una Area</option>
                <?php          
                $consulta3 = "SELECT * from tbl_area";
                $resultado3 = $conexion->prepare($consulta3);
                $resultado3->execute();
                $data3=$resultado3->fetchAll(PDO::FETCH_ASSOC);                  
                foreach($data3 as $dat3)
                { 
                 echo "<option value='".$dat3['id_area']."'>".$dat3['nombre']."</option>";
                }                                                       
                ?>
                </select>
                </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardarAsignacion" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>    
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>

<script type="text/javascript" src="main.js"></script>  
</body>



</html>  