<?php

    require_once('services/db.php');

    $sql = "SELECT pr.Pregunta, re.respuesta, pr.Url, re.Calificacion, re.idRespuesta FROM respuestas_candidato as re JOIN preguntas pr ON re.idPregunta = pr.idPregunta WHERE re.idEmpleado = ".$_GET['id'];
    $req = $bdd->prepare($sql);
    $req->execute();
    $events = $req->fetchAll();

    $sql_em = "SELECT * FROM candidatos  WHERE idCandidato = ".$_GET['id'];
    $req_emp = $bdd->prepare($sql_em);
    $req_emp->execute();
    $empleado = $req_emp->fetchAll();

   ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Evaluación TDM GROUP</title>
        <meta name="description" content="">
        <!-- 
    	Volton Template
    	http://www.templatemo.com/tm-441-volton
        -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="template/css/normalize.css">
        <link rel="stylesheet" href="template/css/font-awesome.css">
        <link rel="stylesheet" href="template/css/bootstrap.min.css">
        <link rel="stylesheet" href="template/css/templatemo-style.css">
        <link rel="stylesheet" href="template/css/font-awesome.css">
        <link
            href="template/vendor/fontawesome-free/css/all.min.css"
            rel="stylesheet"
            type="text/css"
        />

        <script src="template/js/modernizr-2.6.2.min.js"></script>
        <style>
        .p .timer{
            text-align: center;
            font-size: 60px;
            margin-top: 0px;
          }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
        <div class="responsive-header visible-xs visible-sm">
           
        </div>

        <!-- SIDEBAR -->
        <div class="sidebar-menu hidden-xs hidden-sm">
            
        </div> <!-- .sidebar-menu -->
        

        <div class="banner-bg" id="top">
            <div class="banner-overlay"></div>
        </div>

        <hr style="width:77%;float:right;color:black;">
        
        <!-- MAIN CONTENT -->
        <div class="main-content">
            
            <div class="fluid-container">
                
                <div class="content-wrapper">
                    <div class = "row" style="margin-top:20px;">
                        <p id = "timer" class = "timer" style=" text-align: center;
                        font-size: 60px;
                        margin-top: 0px;
                        position:fixed;
                        z-index:1;"></p>
                    </div>
                    
                    <!-- ABOUT -->
                    <div class="page-section" id="about">
                        <div class="row" style="margin-bottom:25px;">
                            <div class ="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2" >Nombre Completo:</label>
                                <div class = "col-sm-10">
                                    <input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" value="<?php echo $empleado[0]['Nombre']; ?>" placeholder="Nombre Completo" disabled>
                                </div>
                            </div>
                            <div class ="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2" >Télefono:</label>
                                <div class = "col-sm-10">
                                    <input type="text" class="form-control" id="puesto" aria-describedby="emailHelp" value="<?php echo $empleado[0]['Tel']; ?>" placeholder="Puesto" disabled>
                                </div>
                            </div>
                            <div class ="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2" >Celular:</label>
                                <div class = "col-sm-10">
                                    <input type="text" class="form-control" id="nivel" aria-describedby="emailHelp" placeholder="Nivel de estudios" value="<?php echo $empleado[0]['Cel']; ?>" disabled>
                                </div>
                            </div>
                            <div class ="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2" >Ciudad de Origen:</label>
                                <div class = "col-sm-10">
                                    <input type="text" class="form-control" id="nivel" aria-describedby="emailHelp" placeholder="Nivel de estudios" value="<?php echo $empleado[0]['Ciudad']; ?>" disabled>
                                </div>
                            </div>
                            <div class ="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2" >Años Experiencia:</label>
                                <div class = "col-sm-10">
                                    <input type="text" class="form-control" id="nivel" aria-describedby="emailHelp" placeholder="Nivel de estudios" value="<?php echo $empleado[0]['Tiempo']; ?>" disabled>
                                </div>
                            </div>
                            <div class ="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2" >Proyecto donde esta laborando:</label>
                                <div class = "col-sm-10">
                                    <select class = "form-control" name="select" value="<?php echo $empleado[0]['Proyecto']; ?>" id="proyecto" disabled>
                                        <option value ="Bolaños">Bolaños</option>
                                        <option value ="San Martin">San Martin</option>
                                        <option value ="Guanacevi">Guanacevi</option>
                                        <option value ="Compas">Compas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="text-align:center;margin-bottom:10px;">
                            <label style="font-size:24px;color:#00722e;">Respuestas evaluación</label>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cuestionario">
                                    <div class="form-group preguntas">
                                        <label>¿Qué unidad de medida se utiliza para medir la presión?</label>
                                        <textarea class="form-control respuesta" rows="5" value="" disabled><?php echo $events[0]['respuesta']; ?></textarea>
                                        <?php if($events[0]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[0]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[0]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[0]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[0]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[0]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Qué es un bar?</label>
                                        <input type="hidden" class="idPregunta" value="2">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[1]['respuesta']; ?></textarea>
                                        <?php if($events[1]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[1]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[1]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[1]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[1]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[1]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cómo se genera la presión hidráulica?</label>
                                        <input type="hidden" class="idPregunta" value="3">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[2]['respuesta']; ?></textarea>
                                        <?php if($events[2]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[2]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[2]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[2]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[2]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[2]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es el principio de la presión?</label>
                                        <input type="hidden" class="idPregunta" value="4">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[3]['respuesta']; ?></textarea>
                                        <?php if($events[3]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[3]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[3]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[3]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[3]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[3]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Qué tipo de aceite utilizan los motores diésel?</label>
                                        <input type="hidden" class="idPregunta" value="5">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[4]['respuesta']; ?></textarea>
                                        <?php if($events[4]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[4]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[4]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[4]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[4]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[4]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Qué tipo de aceite utiliza el sistema hidráulico del jumbo?</label>
                                        <input type="hidden" class="idPregunta" value="6">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[5]['respuesta']; ?></textarea>
                                        <?php if($events[5]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[5]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[5]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[5]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[5]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[5]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Qué tipo de aceite lleva una transmisión de un scoop?</label>
                                        <input type="hidden" class="idPregunta" value="7">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[6]['respuesta']; ?></textarea>
                                        <?php if($events[6]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[6]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[6]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[6]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[6]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[6]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Qué tipo de aceite llevan los planetarios?</label>
                                        <input type="hidden" class="idPregunta" value="8">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[7]['respuesta']; ?></textarea>
                                        <?php if($events[7]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[7]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[7]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[7]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[7]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[7]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Qué tipo de aceite debe llevar los diferenciales?</label>
                                        <input type="hidden" class="idPregunta" value="9">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[8]['respuesta']; ?></textarea>
                                        <?php if($events[8]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[8]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[8]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[8]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[8]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[8]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Qué tipo de grasa se utiliza en la lubricación de los equipos?</label>
                                        <input type="hidden" class="idPregunta" value="10">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[9]['respuesta']; ?></textarea>
                                        <?php if($events[9]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[9]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[9]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[9]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[9]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[9]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿A qué presiones de calibración dejaría Ud. las válvulas de control de los siguientes sistemas de un Jumbo Electrohidráulico de 1 brazo marca Sandvik modelo DD-130, Axera 6? Rotación, Avance, Percusión</label>
                                        <input type="hidden" class="idPregunta" value="11">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[10]['respuesta']; ?></textarea>
                                        <?php if($events[10]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[10]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[10]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[10]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[10]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[10]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>Mencione los diferentes tipos de mantenimiento preventivo que se aplican en un jumbo</label>
                                        <input type="hidden" class="idPregunta" value="12">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[11]['respuesta']; ?></textarea>
                                        <?php if($events[11]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[11]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[11]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[11]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[11]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[11]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas"> 
                                        <label>Mencione el modelo de perforadora tienen los jumbos: AXERA 5, DD310</label>
                                        <input type="hidden" class="idPregunta" value="13">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[12]['respuesta']; ?></textarea>
                                        <?php if($events[12]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[12]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[12]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[12]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[12]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[12]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función del acumulador de alta presión y cuál es el diagnostico de falla cuando un acumulador esta descargado?</label>
                                        <input type="hidden" class="idPregunta" value="14">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[13]['respuesta']; ?></textarea>
                                        <?php if($events[13]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[13]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[13]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[13]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[13]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[13]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es el efecto en una perforadora cuando se percute en vacío o cuando el operador no calibra bien las presiones y hay percusiones en vacío?</label>
                                        <input type="hidden" class="idPregunta" value="15">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[14]['respuesta']; ?></textarea>
                                        <?php if($events[14]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[14]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[14]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[14]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[14]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[14]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de una válvula de alivio?</label>
                                        <input type="hidden" class="idPregunta" value="16">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[15]['respuesta']; ?></textarea>
                                        <?php if($events[15]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[15]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[15]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[15]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[15]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[15]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de una válvula de secuencia?</label>
                                        <input type="hidden" class="idPregunta" value="17">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[16]['respuesta']; ?></textarea>
                                        <?php if($events[16]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[16]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[16]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[16]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[16]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[16]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de una válvula reductora de presión?</label>
                                        <input type="hidden" class="idPregunta" value="18">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[17]['respuesta']; ?></textarea>
                                        <?php if($events[17]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[17]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[17]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[17]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[17]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[17]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de una válvula de choque o sobrecarga?</label>
                                        <input type="hidden" class="idPregunta" value="19">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[18]['respuesta']; ?></textarea>
                                        <?php if($events[18]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[18]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[18]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[18]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[18]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[18]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de una válvula direccional?</label>
                                        <input type="hidden" class="idPregunta" value="20">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[19]['respuesta']; ?></textarea>
                                        <?php if($events[19]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[19]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[19]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[19]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[19]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[19]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>Mencione 5 tipos de accionamiento de una válvula direccional</label>
                                        <input type="hidden" class="idPregunta" value="21">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[20]['respuesta']; ?></textarea>
                                        <?php if($events[20]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[20]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[20]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[20]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[20]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[20]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la presión máxima en el sistema de rotación?</label>
                                        <input type="hidden" class="idPregunta" value="22">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[21]['respuesta']; ?></textarea>
                                        <?php if($events[21]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[21]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[21]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[21]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[21]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[21]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de las válvulas 6 y 7?</label>
                                        <input type="hidden" class="idPregunta" value="23">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[22]['respuesta']; ?></textarea>
                                        <?php if($events[22]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[22]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[22]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[22]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[22]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[22]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de la válvula 43?</label>
                                        <input type="hidden" class="idPregunta" value="24">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[23]['respuesta']; ?></textarea>
                                        <?php if($events[23]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[23]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[23]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[23]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[23]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[23]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de las válvulas 4 y 5?</label>
                                        <input type="hidden" class="idPregunta" value="25">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[24]['respuesta']; ?></textarea>
                                        <?php if($events[24]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[24]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[24]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[24]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[24]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[24]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de las válvulas 20 y 59?</label>
                                        <input type="hidden" class="idPregunta" value="26">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[25]['respuesta']; ?></textarea>
                                        <?php if($events[25]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[25]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[25]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[25]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[25]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[25]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de la válvula 34 y a qué presión se calibra?</label>
                                        <input type="hidden" class="idPregunta" value="27">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[26]['respuesta']; ?></textarea>
                                        <?php if($events[26]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[26]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[26]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[26]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[26]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[26]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>¿Cuál es la función de la válvula 3 y el compensador 2?</label>
                                        <input type="hidden" class="idPregunta" value="28">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[27]['respuesta']; ?></textarea>
                                        <?php if($events[27]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[27]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[27]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[27]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[27]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[27]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                        <div class="form-group preguntas">
                                        <label>¿Cuál es la diferencia de presión entre avance y percusión de barrenacion normalmente?</label>
                                        <input type="hidden" class="idPregunta" value="29">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[28]['respuesta']; ?></textarea>
                                        <?php if($events[28]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[28]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[28]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[28]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[28]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[28]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>De la siguiente imagen identifique cada una de las partes que se indican</label><br>
                                        <img src="http://evaluacion.truckdm.com.mx/img/1.png">
                                        <input type="hidden" class="idPregunta" value="30">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[29]['respuesta']; ?></textarea>
                                        <?php if($events[29]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[29]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[29]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[29]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[29]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[29]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>De la siguiente imagen identifique cada uno de los simbolos y escribalos en el campo de texto.</label><br>
                                        <img src="http://evaluacion.truckdm.com.mx/img/imagen2.png">
                                        <input type="hidden" class="idPregunta" value="31">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[30]['respuesta']; ?></textarea>
                                        <?php if($events[30]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[30]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[30]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[30]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[30]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[30]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>De las siguiente imagen identifique cada uno de los componentes marcados y escribalos con su numero en el cuadro de texto</label><br>
                                        <img src="http://evaluacion.truckdm.com.mx/img/imagen3.png">
                                        <input type="hidden" class="idPregunta" value="32">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[31]['respuesta']; ?></textarea>
                                        <?php if($events[31]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[31]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[31]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[31]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[31]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[31]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>De las siguiente imagen identifique cada uno de los componentes marcados y escribalos con su numero en el cuadro de texto</label><br>
                                        <img src="http://evaluacion.truckdm.com.mx/img/imagen4.png">
                                        <input type="hidden" class="idPregunta" value="33">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[32]['respuesta']; ?></textarea>
                                        <?php if($events[32]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[32]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[32]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[32]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[32]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[32]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>Lea el siguiente diagrama</label><br>
                                        <img src="http://evaluacion.truckdm.com.mx/img/imagen5.png">
                                        <input type="hidden" class="idPregunta" value="34">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[33]['respuesta']; ?></textarea>
                                        <?php if($events[33]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[33]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[33]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[33]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[33]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[33]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group preguntas">
                                        <label>Lea el siguiente diagrama</label><br>
                                        <img src="http://evaluacion.truckdm.com.mx/img/imagen6.png">
                                        <input type="hidden" class="idPregunta" value="35">
                                        <textarea class="form-control respuesta" rows="5" disabled><?php echo $events[34]['respuesta']; ?></textarea>
                                        <?php if($events[34]['Calificacion'] == 0){?>
                                            <span>Calificar:</span>
                                            <span onclick="qua(<?php echo $events[34]['idRespuesta']; ?>,1);"><i class="fas fa-check" style="color:green;cursor:pointer;"></i></span>
                                            <span onclick="qua(<?php echo $events[34]['idRespuesta']; ?>,2);" style ="cursor:pointer;"><b>1/2</b></span>
                                            <span onclick="qua(<?php echo $events[34]['idRespuesta']; ?>,3);"><i class="fas fa-times" style="color:red;cursor:pointer"></i></span>
                                        <?php }elseif($events[34]['Calificacion'] == 1){?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-check" style="color:green;cursor:pointer;"></i>
                                        <?php }elseif($events[34]['Calificacion'] == 2){ ?>
                                            <span>Calificación:</span>
                                            <span style ="cursor:pointer;"><b>1/2</b></span>
                                        <?php }else{  ?>
                                            <span>Calificación:</span>
                                            <i class="fas fa-times" style="color:red;cursor:pointer"></i>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    
          
                    <!-- CONTACT -->
                  

                    <div class="row" id="footer">
                        <div class="col-md-12 text-center">
                            <p class="copyright-text">Copyright &copy; 2020 Cielo y Tierra</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="modal" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Completa la Información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Verifica que la información general este completa</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="success" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Se ha calificado con éxito.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="reload()">Cerrar</button>
                    </div>
                </div>
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
                        <p>Ocurrio un error a la hora de calificar</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="template/js/jquery-1.10.2.min.js"></script>
        <script src="template/js/plugins.min.js"></script>
        <script src="template/js/main.min.js"></script>
        <script src="template/js/bootstrap.bundle.min.js"></script>
        <script>
                function qua(id,cal){
                   console.log(id);
                   console.log(cal);
                   $.ajax({
                        method:"POST",
                        url:"services/setCal",
                        dataType:"json",
                        data:{
                            id:id,
                            cal:cal
                            },
                        success:function(response){
                            if(response.status == 200){
                                $('#success').modal('show');
                            }else{
                                $('#error').modal('show');
                            }
                        }
                   })
                }

                function reload(){
                    location.reload();
                }

        </script>
    </body>
</html>