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
        <title>TDM GROUP</title>
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
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Ordenes de Compra</h6>
                                    </div>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Proveedor</th>
                                                    <th>Proyecto</th>
                                                    <th>Equipo</th>
                                                    <th>Folio</th>
                                                    <th>Depto</th>
                                                    <th>Total</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Proveedor</th>
                                                    <th>Proyecto</th>
                                                    <th>Equipo</th>
                                                    <th>Folio</th>
                                                    <th>Depto</th>
                                                    <th>Total</th>
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

        <div class="modal" id="newModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Residente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Usuario para Inicio de Sesión:</label>
                            <input type="text" class="form-control" id="user">
                        </div>
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="password" class="form-control" id="pass">
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico:</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label>Teléfono:</label>
                            <input type="text" class="form-control" id="tel">
                        </div>
                        <div class="form-group">
                            <label>Nombre de Residente:</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label>Unidad Minera:</label>
                            <select class="form-control ums" id="um">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="create()">Crear</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="blockModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Se ha bloqueado a residente exitosamente</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Se ha eliminado a proveedor exitosamente</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="errorModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ha ocurrido un error en la operación</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="exitoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Exito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Se ha actualizo información con éxito</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
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
                        <p>Se ha activado residente exitosamente</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
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
        <script src="js/datatable.js"></script>
        <script src="js/ordenes.js"></script>
        

    </body>
</html>
