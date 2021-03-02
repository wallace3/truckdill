<?php 
    session_name('TRUCK');
    session_start();
    if(!isset($_SESSION['idUsuario']) || empty($_SESSION)){
        header("Location: login.php");
    }
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
        <title>TruckDill </title>
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
                                            <input type="text" id="proyecto" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Equipo</label>
                                            <input type="text" id="equipo" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>No. Economico</label>
                                            <input type="text" id="economico" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Requisición de Compra</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Folio No.</label>
                                            <input type="text" id="folio" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Fecha de Emisión.</label>
                                            <input type="date" id="fecha_emision" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Fecha Requerida</label>
                                            <input type="date" id="fecha_requerida" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Clave Depto. Emisor</label>
                                            <input type="text" id="depto" class="form-control">
                                        </div>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush" id="tableMaterials">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Partida</th>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad</th>
                                                    <th>Unidad</th>
                                                    <th>Area en la que se va utilizar</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="materiales">
                                            <tr class="materiales_tr">
                                                <td><input type="text" class="form-control partida"></td>
                                                <td><input type="text" class="form-control marca"></td>
                                                <td><input type="text" class="form-control modelo"></td>
                                                <td><textarea class="form-control descripcion" rows="5" ></textarea></td>
                                                <td><input type="text" class="form-control cantidad"></td>
                                                <td><input type="text" class="form-control unidad"></td>
                                                <td><input type="text" class="form-control area"></td>
                                                <td><button class="btn btn-primary" id="more"><i class="fas fa-plus"></i></button></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Justificación</label>
                                            <textarea class="form-control" rows="3" id="justificacion"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <textarea class="form-control" rows="3" id="observaciones"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Solicitante</label>
                                            <input type="text" id="solicitante" class="form-control">
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

        <div class="modal" id="cancelModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cancelación de Factura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Ingresa Acuse de Cancelación</label>
                        <div class  = "form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" multiple="multiple" id="filePdf" >
                                    <label class="custom-file-label" for="customFileLangHTML" id="fileName" data-browse="Seleccionar Archivo">Seleccionar Archivo</label>
                                </div>
                            </div>
                            <p>* Ingresa solo archivo PDF</p>
                        </div>
                        <input type="hidden" id="idInvoice">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="cancelInvoice();">Confirmar Cancelación</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        <script src="js/requisiciones.js"></script>
        

    </body>
</html>
