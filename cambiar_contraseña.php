<?php require ('services/session_check.php');?>
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
  </head>

  <body id="page-top">
    <div id="wrapper">
    <?php  include "menuBase.php"?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        <?php include "topBarBase.php" ?>

          <!--Contenido-->
          <div id = "content-wrapper" class ="container-fluid">
          
            <div class="row justify-content-center">
              <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                  <div class="card-body p-0">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="login-form">
                          <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Cambio de Contraseña</h1>
                            </div>
                            <div class="form-group">
                                <label>Contraseña Nueva</label>
                              <input type="password" class="form-control" id="password" placeholder="Contraseña">
                            </div>
                            <div class="form-group">
                                <label>Confirmar Contraseña</label>
                              <input type="password" class="form-control" id="passwordConfirm" placeholder="Confirmar Contraseña">
                            </div>
                            <div class="form-group">
                              <button type="button" id="change" class="btn btn-primary btn-block">Cambiar</button>
                            </div>
                            <hr>
                        </div>
                      </div>
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

    <div class="modal" id="error" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Ha ocurrido un error, intente mas tarde</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
      </div>
    </div>

    <div class="modal" id="exito" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Exito</h5>
            </div>
            <div class="modal-body">
                <p>Se ha actualizado contraseña correctamente</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="logout()">Cerrar</button>
            </div>
        </div>
      </div>
    </div>

    <div class="modal" id="pass" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Las contraseñas no coinciden</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
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
    <script src = "js/changePassword.js"></script>
  </body>
</html>
