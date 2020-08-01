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
        <link href="template/img/logo/logo.png" rel="icon" />
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
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Subir Factura</h6>
                            </div>
                            <div class="card-body">
                                <div class  = "form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" multiple="multiple" id="filePdf" >
                                            <label class="custom-file-label" for="customFileLangHTML" id="fileName" data-browse="Seleccionar Archivo">Seleccionar Archivo</label>
                                        </div>
                                    </div>
                                    <p>* Ingresa archivo XML y PDF</p>
                                </div>
                                <div class = "form-group">
                                    <label for = "orden">No. Orden</label>
                                    <input type = "text" class = "form-control" id = "orden">
                                </div>
                                <div class = "form-group">
                                    <label for = "empresa">Empresa Factura</label>
                                    <select name  = "empresa" class = "form-control" id = "empresa">
                                        <option value = "empresa1" selected>Empresa 1</option>
                                        <option value = "empresa2">Empresa 2</option>
                                    </select>
                                </div>
                                <div class  = "form-group">
                                    <button class="btn" id = "upload" style = "background-color: #3f51b5;border-color: #3f51b5;color: #fff;">
                                        Subir
                                    </button>
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

        <div class="modal" id="modalSuccess" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Éxito</h5>
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Se han subido archivos correctamente</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="relocate();">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="allModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Obligatorios</h5>
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Todos los campos son obligatorios.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondar" data-dismiss = "modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modalIngreso" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error en Archivos</h5>
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ingresa Formato PDF y XML (no acepta otro formato)</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="reload();">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modalXml" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error en Archivos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Por favor incluye archivo en formato XML</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="reload();">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modalMax" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error en Archivos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Por favor ingresa solo dos archivos, PDF Y XML</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="reload();">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modalError" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ha ocurrido un error contactar a servicio</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="reload();">Cerrar</button>
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
        <script src="js/altaFacturas.js"></script>

     
    </body>
</html>
