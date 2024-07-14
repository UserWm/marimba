<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Administración de empresas</h1>

    
    
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_empresa,nombreComercial,razonSocial,direccionGeneral,Departamento,telefonoempresarial,correoEmpresarial FROM tbl_empresas inner join tbl_departamentos on tbl_empresas.idDepartamento = tbl_departamentos.idDepartamento";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nueva Empresa</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaEmpresa" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Giro</th>                              
                                <th>Ubicación</th>  
                                <th>Departamento</th>  
                                <th>Contacto</th>  
                                <th>Correo</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id_empresa'] ?></td>
                                <td><?php echo $dat['nombreComercial'] ?></td>
                                <td><?php echo $dat['razonSocial'] ?></td>
                                <td><?php echo $dat['direccionGeneral'] ?></td>
                                <td><?php echo $dat['Departamento'] ?></td>   
                                <td><?php echo $dat['telefonoempresarial'] ?></td>    
                                <td><?php echo $dat['correoEmpresarial'] ?></td>   
                               
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
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formEmpresas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre Empresa:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="razonSocial" class="col-form-label">Razón Social:</label>
                <input type="text" class="form-control" id="razonSocial">
                </div>                
                <div class="form-group">
                <label for="edad" class="col-form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion">
                </div>  
                <div class="form-group">
                <label for="edad" class="col-form-label">Departamento</label>
                <select class="form-control" id="departamento">
                    <option value="0">Seleccione un Departamento</option>
                <?php          
                $consulta2 = "SELECT * from tbl_departamentos";
                $resultado2 = $conexion->prepare($consulta2);
                $resultado2->execute();
                $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);                  
                foreach($data2 as $dat2)
                { 
                 echo "<option value='".$dat2['idDepartamento']."'>".$dat2['Departamento']."</option>";
                }                                                       
                ?>
                </select>
                </div>  
                <div class="form-group">
                <label for="telefono" class="col-form-label">Teléfono:</label>
                <input type="text" class="form-control" id="telefono">
                </div>        
                <div class="form-group">
                <label for="correo" class="col-form-label">Correo:</label>
                <input type="email" class="form-control" id="correo">
                </div>      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>

<script type="text/javascript" src="mainEmpresas.js"></script>  

</body>

</html>