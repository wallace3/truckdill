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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <style>
        
            .select2 select2-container select2-container--default select2-container--focus{
                width:100%!important;
            }

        
        </style>
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
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Requisiciones</h6>
                                    </div>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush" id="dataTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Proyecto</th>
                                                    <th>Residente</th>
                                                    <th>U. Minera</th>
                                                    <th>Fecha de Emisión</th>
                                                    <th>Fecha Requerida</th>
                                                    <th>Solicitante</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Proyecto</th>
                                                    <th>Residente</th>
                                                    <th>U. Minera</th>
                                                    <th>Fecha de Emisión</th>
                                                    <th>Fecha Requerida</th>
                                                    <th>Solicitante</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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

        <div class="modal" id="suppliersModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Asignación de Requisición</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class = "form-group row">
                            <label>Proveedores</label>
                            <select class="js-example-basic-multiple form-control suppliers" id="supplierEmail" name = "supplier" multiple="multiple">
                            </select>
                            <input type="hidden" id="idRequisicion">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="sendEmail()">Enviar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="exitoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Se envio requisicion correctamente.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="noData" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sin Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>No se han adjuntado cotizaciones para esa requisición</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="qModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">Cotizaciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table id="qTable" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Cotización</th>
                                        <th>Proveedor</th>
                                        <th>Estatus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="dataQ">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Cotización</th>
                                        <th>Proveedor</th>
                                        <th>Estatus</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>


        
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="js/datatable.js"></script>
        <script src="js/requisicionesAdmin.js"></script>
        

    </body>
</html>
