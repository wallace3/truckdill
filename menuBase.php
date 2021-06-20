 
  <!-- Sidebar -->
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="">
        </div>
        <div class="sidebar-brand-text mx-3"><img src = "template/img/logotdm.png" style="width:100%"></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menú
      </div>
     
     
      <!-- MENU PROVEEDORES -->
      
      <?php 
        if($_SESSION['idType']==1){ 
        
          echo '    <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#proveedoresTab" aria-expanded="true"
            aria-controls="collapseTable">
            <i class="fas fa-user-friends"></i>
            <span>Proveedores</span>
          </a>
          <div id = "proveedoresTab" class = "collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class = "bg-white py-2 collapse-inner rounded">
              <h6 class = "collapse-header">Proveedores</h6>
              <a class = "collapse-item" href="proveedores">Proveedores</a>
              <a class = "collapse-item" href = "alta_proveedor">Alta Proveedor</a>
              <a class = "collapse-item" href = "facturas">Facturas</a>
              <a class = "collapse-item" href = "docs">Cartas Cumplimiento Fiscal</a>
            </div>
          </div>
        </li>';

        } 
      ?>
      
    


      <!-- MENU USUARIOS -->

      <?php 
        if($_SESSION['idType']==1){ 

          echo '  <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usuariosTab" aria-expanded="true"
            aria-controls="collapseTable">
            <i class="fas fa-users-cog"></i>
            <span>Usuarios</span>
          </a>
          <div id = "usuariosTab" class = "collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class = "bg-white py-2 collapse-inner rounded">
              <h6 class = "collapse-header">Usuarios</h6>
              <a class = "collapse-item" href="usuario">Usuarios</a>
              <a class = "collapse-item" href = "alta_usuarios">Crear Usuario</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="programacion">
            <i class="far fa-calendar-alt"></i>
            <span>Programación de Pagos</span>
          </a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="servicios">
            <i class="fas fa-list"></i>
            <span>Servicios de Proveedores</span>
          </a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="complementos-pago">
            <i class="fas fa-money-check"></i>
            <span>Complementos de Pago</span>
          </a>
        </li> 
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#evaluacionesTab" aria-expanded="true"
            aria-controls="collapseTable">
            <i class="fas fa-pencil-ruler"></i>
            <span>Evaluaciones</span>
          </a>
          <div id = "evaluacionesTab" class = "collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class = "bg-white py-2 collapse-inner rounded">
              <h6 class = "collapse-header">Evaluaciones</h6>
              <a class = "collapse-item" href="evaluaciones">Empleados</a>
              <a class = "collapse-item" href = "evaluaciones_candidatos">Candidatos</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="unidad-minera">
            <i class="fas fa-network-wired"></i>
            <span>Unidades Mineras</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#requisicionesTab" aria-expanded="true"
            aria-controls="collapseTable">
            <i class="fas fa-users"></i>
            <span>Residentes</span>
          </a>
          <div id = "requisicionesTab" class = "collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class = "bg-white py-2 collapse-inner rounded">
              <a class = "collapse-item" href="residentes">Lista Residentes</a>
              <a class = "collapse-item" href="requisiciones">Requisiciones</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ordenes">
            <i class="fas fa-file-csv"></i>
            <span>Ordenes de Compra</span>
          </a>
        </li>
        ';

        }
      ?>
    
      <?php 
        if($_SESSION['idType']==4){
          echo '
          <li class="nav-item">
            <a class="nav-link" href="carta">
              <i class="far fa-file-alt"></i>
              <span>Carta Cumplimiento Fiscal</span>
            </a>
          </li><li class="nav-item">
          <a class="nav-link" href="facturas_proveedor">
            <i class="far fa-file"></i>
            <span>Mis Facturas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="schedules">
            <i class="far fa-calendar-alt"></i>
            <span>Pagos Programados</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="complemento-proveedor">
            <i class="fas fa-money-check"></i>
            <span>Complemento de Pago</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="requisicion">
          <i class="far fa-file-word"></i>
          <span>Requisiciones</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mis_oc">
          <i class="fas fa-file-csv"></i>
          <span>Mis Ordenes de Compra</span>
        </a>
      </li>'
          ;
        }
      ?>

        
      <?php  
      
        if($_SESSION['idType']==3){

          echo '<li class="nav-item">
          <a class="nav-link" href="mis_requisiciones">
            <i class="far fa-file"></i>
            <span>Mis Requisiciones</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="nueva_requisicion">
            <i class="far fa-file-word"></i>
            <span>Nueva Requisición</span>
          </a>
        </li>
        ';

        }
      
      ?>
      


      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->