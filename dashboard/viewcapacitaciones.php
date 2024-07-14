<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Programación de capacitaciones</h1>

       
    <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_capacitaciones,tema, tbl_empresas.nombreComercial as empresa, tbl_area.nombre as area,capacitador,lugar,fecha,estado from tbl_capacitaciones
inner join tbl_empresas on tbl_capacitaciones.id_empresa=tbl_empresas.id_empresa
inner join tbl_area on tbl_capacitaciones.area=tbl_area.id_area order by (fecha) DESC";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoCapacitacion2" type="button" class="btn btn-success" data-toggle="modal">Agregar Capacitación</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaCapacitacion" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Tema</th>
                                <th>Empresa</th>                              
                                <th>Area</th>  
                                <th>Capacitador</th>  
                                <th>Lugar</th>  
                                <th>Fecha</th>  
                                <th>Estado</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id_capacitaciones'] ?></td>
                                <td><?php echo $dat['tema'] ?></td>
                                <td><?php echo $dat['empresa'] ?></td>
                                <td><?php echo $dat['area'] ?></td>  
                                <td><?php echo $dat['capacitador'] ?></td>
                                <td><?php echo $dat['lugar'] ?></td>
                                <td><?php echo $dat['fecha'] ?></td> 
                                <?php
                                    if($dat['estado']==0){
                                echo "<td><a href='cambioestado.php?id=".$dat['id_capacitaciones']."' class='btn btn-danger' >Pendiente</a></td>";
                                    }else{
                                echo "<td><a href='' class='btn btn-success' >Realizado</a></td>";
                                    }
                                ?>
                               
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
<div class="modal fade" id="modalCRUDCapacitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formCapacitacion">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Tema de capacitación:</label>
                <input type="text" class="form-control" id="tema" required>
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
                    <option >Seleccione una área</option>
                   
                </select>
                </div> 
                
                <div class="form-group">
                <label for="nombre" class="col-form-label">Capacitador:</label>
                <input type="text" class="form-control" id="capacitador" required>
                </div>

                <div class="form-group">
                <label for="nombre" class="col-form-label">Lugar de capacitación:</label>
                <input type="text" class="form-control" id="lugar" required>
                </div>

                <div class="form-group">
                <label for="nombre" class="col-form-label">Fecha de capacitación:</label>
                <input type="date" class="form-control" id="fecha" required>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardarCapacitacion" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
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