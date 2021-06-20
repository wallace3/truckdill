<?php 
    session_name('TRUCK');
    session_start();
    require_once('services/db.php');
    if(!isset($_SESSION['idUsuario']) || empty($_SESSION)){
        header("Location: login.php");
    }
    $sql = "SELECT * FROM requisitions WHERE ID_Requisition = ".$_GET['id']."";
    $req = $bdd->prepare($sql);
    $req->execute();
    $requisition = $req->fetchAll();

    $sql2 = "SELECT * FROM requisition_material WHERE ID_Requisition = '".$_GET['id']."'";
    $req2 = $bdd->prepare($sql2);
    $req2->execute();
    $reqm = $req2->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="template/img/icon.png" rel="icon" />
        <title>TDM GROUP </title>
        <link
            href="template/vendor/fontawesome-free/css/all.min.css"
            rel="stylesheet"
            type="text/css"
        />
        <link
            href="template/vendor/bootstrap/css/bootstrap.min.css"
            rel="stylesheet"
            type="text/css"
        />
        <link href="template/css/ruang-admin.min.css" rel="stylesheet" />
        <link href="template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <body id="page-top">
        <div id="wrapper">
            <?php  include "menuBase.php"?>
            <div id="content-wrapper"  class="d-flex flex-column">
                <div id="content">
                    <?php include "topBarBase.php" ?>
                    <div id = "content-wrapper" class ="container-fluid">
                    <!--Contenido-->
                        <div class="row">
                        <!-- Datatables -->
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    
                                </div> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="template/img/logotdm.png" width="200px" height="100px">
                                        <div class="form-group">
                                            <label>Proyecto</label>
                                            <select class="form-control" id="proyecto" disabled>
                                                <option value="">-- SELECCIONA -- </option>
                                                <option value="San Martín" <?php if($requisition[0]["Project"]=="San Martín") echo 'selected="selected"'; ?>>San Martín</option>
                                                <option value="Bolañitos" <?php if($requisition[0]["Project"]=="Bolañitos") echo 'selected="selected"'; ?>>Bolañitos</option>
                                                <option value="El Compas" <?php if($requisition[0]["Project"]=="El Compas") echo 'selected="selected"'; ?>>El Compas</option>
                                                <option value="Guanaceví" <?php if($requisition[0]["Project"]=="Guanaceví") echo 'selected="selected"'; ?>>Guanaceví</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Equipo</label>
                                            <input type="text" id="equipo" class="form-control" value="<?php echo $requisition[0]["Equipment"];?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>No. Economico</label>
                                            <input type="text" id="economico" class="form-control" value="<?php echo $requisition[0]['Number'];?>" disabled> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Orden Compra</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" id="cot" value="<?php echo $_GET['cot']; ?>">
                                            <label>Folio No.</label>
                                            <input type="text" id="folio" class="form-control" value="<?php echo $requisition[0]['Folio'];?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Clave Depto. Emisor</label>
                                            <select class="form-control" id="depto" disabled>
                                                <option value="">-- SELECCIONA -- </option>
                                                <option value="001" <?php if($requisition[0]["Depto"]=="001") echo 'selected="selected"'; ?>>001 - San Martín</option>
                                                <option value="002" <?php if($requisition[0]["Depto"]=="002") echo 'selected="selected"'; ?>>002 - Bolañitos</option>
                                                <option value="003" <?php if($requisition[0]["Depto"]=="003") echo 'selected="selected"'; ?>>003 - El Compas</option>
                                                <option value="004" <?php if($requisition[0]["Depto"]=="004") echo 'selected="selected"'; ?>>004 - Guanaceví</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Proveedor</label>
                                       <textarea cols="5" rows="5" class="form-control" id="proveedor" disabled><?php echo $_GET['prov'];?></textarea> 
                                    </div>
                                    <div class="col-md-4">
                                        <label>DATOS DE FACTURACIÓN</label>
                                       <textarea cols="5" rows="5" class="form-control" id="nonesense" disabled>TRUCK DRILL MACHINES, S.A. DE C.V.<br>ENVIAR FACTURA ORIGINAL Y REMISIÓN FIRMADA DE ENTREGA :<br>Método de Pago:<b>PPD</b><br>Forma de Pago:<b>99</b><br>Uso de CDFI: <b>Gastos en General</b></textarea> 
                                    </div>
                                    <div class="col-md-4">
                                        <label>IMPORTANTE:</label>
                                        <span>1.- Mencionar el número de OC en la factura</span>
                                        <span>2.- Entregar 2 copia de factura y 2 de orden de compra en almacén</span>
                                        <span>3.- Enviar a los correos indicados su copia de orden de copra y factura firmados por almacén</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label> Entregar En: </label>
                                        <input type="text" class="form-control" id="lugar">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Enviar Factura Original y Remisión Firmada de Entrega A :</label>
                                        <span>paulina.hernandez@lopezrdzcia.com</span>
                                        <span>C.C: gerardo.lopez@lopezrdzcia.com</span>
                                        <span>C.C: mdiaz@truckdm.com</span>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush" id="tableMaterials">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Partida</th>
                                                    <th>Cantidad</th>
                                                    <th>Unidad</th>
                                                    <th>Descripción</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody class="materiales">
                                            <?php foreach($reqm as $val){ ?>
                                            <tr class="materiales_tr">
                                                <td><input type="text" class="form-control partida" value="<?php echo $val[1];?>" disabled></td>
                                                <td><input type="text" class="form-control cantidad" value="<?php echo $val[5];?>" disabled></td>
                                                <td><input type="text" class="form-control unidad" value="<?php echo $val[6];?>" disabled></td>
                                                <td><textarea class="form-control descripcion" rows="5"  disabled><?php echo $val[4];?></textarea></td>
                                                <td><input type="text" class="form-control preciou"></td>
                                                <td><input type="text" class="form-control total_u"></td>
                                            </tr>
                                            <?php }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Subtotal</th>
                                                    <th><input type="text" class="form-control" id="subtotal"></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>IVA</th>
                                                    <th><input type="text" class="form-control" id="iva"></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Total</th>
                                                    <th><input type="text" class="form-control" id="total"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Condiciones de Pago</label>
                                            <textarea class="form-control" rows="3" id="condiciones"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>COndiciones de Entrega</label>
                                            <textarea class="form-control" rows="3" id="entrega"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" id="guardar" class="btn btn-primary">Guardar y Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <!---Fin de Contenido-->
                </div>
                <?php include "footerBase.php"?>
            </div>
        </div>

        <!--Modals-->


        <div class="modal" id="detalleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle Cancelación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span>Fecha de Cancelación: <p id="fechaCancelacion"></p></span>
                            </div>
                            <div class="col-md-12">
                                <span>Link a Archivo:</span>
                            </div>
                            <div class="col-md-12" id="buttonUrl">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="successModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Se agregó requisicon exitosamente.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="redirect()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="errorModale" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ocurrio un error, intente de nuevo.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin Modals-->

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
        </a>

        <script src="template/vendor/jquery/jquery.min.js"></script>
        <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="template/js/ruang-admin.min.js"></script>
        <script src="template/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="js/datatable.js"></script>
        <script src="js/oc.js"></script>
        

    </body>
</html>
