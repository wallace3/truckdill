<?php 
session_name("TRUCK");
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
    <link href="template/img/icont.png" rel="icon" />
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
  </head>

  <body id="page-top">
    <div id="wrapper">
        <?php  include "menuBase.php"?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <?php include "topBarBase.php" ?>

          <!--Contenido-->
          
          <!---Fin de Contenido-->
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
  </body>
</html>
