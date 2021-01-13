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
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <?php include "topBarBase.php" ?>
            <div id = "content-wrapper" class ="container-fluid">
                <div class="table-responsive">
                    <table id="table-empleados" class="table table-striped">
                        <thead id="thead-compras">
                            <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Celular</th>
                            <th>Télefono</th>
                            <th>Ciudad de Origen</th>
                            <th>Proyecto</th>
                            <th>Fecha</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody id="emp-body">

                        </tbody>
                    </table><!-- end table de compras-->
                </div>
            </div>
        </div>
        <?php include "footerBase.php"?>
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
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="js/datatable.js"></script>
        <script src="js/evaluacionesCandidatos.js"></script>
  </body>
</html>
