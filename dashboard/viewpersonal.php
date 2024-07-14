<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Gestión de Personal</h1>
        
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT  id_empleados, tbl_empleados.nombre as nombreempleado, fechaNacimiento,genero,telefono,tbl_empresas.nombreComercial as nombrec,tbl_area.nombre as nombrearea FROM tbl_empleados
inner join tbl_empresas on tbl_empleados.id_empresa = tbl_empresas.id_empresa
inner join tbl_area on tbl_empleados.area=tbl_area.id_area";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoPersonal2" type="button" class="btn btn-success" data-toggle="modal">Agregar Personal</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Nacimiento</th>                              
                                <th>Genero</th>  
                                <th>Teléfono</th>  
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
                                <td><?php echo $dat['id_empleados'] ?></td>
                                <td><?php echo $dat['nombreempleado'] ?></td>
                                <td><?php echo $dat['fechaNacimiento'] ?></td>
                                <td><?php echo $dat['genero'] ?></td>  
                                <td><?php echo $dat['telefono'] ?></td>
                                <td><?php echo $dat['nombrec'] ?></td>
                                <td><?php echo $dat['nombrearea'] ?></td>  
                               
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUDPersonal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonal">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre Empleado:</label>
                <input type="text" class="form-control" id="nombre" required>
                </div>
                <div class="form-group">
                <label for="fecha" class="col-form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha" required>
                </div>                
                <div class="form-group">
                <label for="genero" class="col-form-label">Genero</label>
                <select class="form-control" id="genero">
                <option value="I">Seleccione un genero</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                </div>  
                <div class="form-group">
                <label for="telefono" class="col-form-label">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" required>
                </div>
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
                <select class="form-control" id="area">
                    <option value="0">Seleccione una Area</option>
                </select>
                </div>  
                
       
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardarPersonal" class="btn btn-dark">Guardar</button>
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