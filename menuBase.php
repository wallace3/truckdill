  <!-- Sidebar -->
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="">
        </div>
        <div class="sidebar-brand-text mx-3">TruckDill</div>
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
     
      <li class="nav-item">
        <a class="nav-link" href="">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Página 1</span>
        </a>
      </li>
      <!-- MENU PROVEEDORES -->
      <li class="nav-item">
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
          </div>
        </div>
      </li>
      <!-- MENU USUARIOS -->
      <li class="nav-item">
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
        <a class="nav-link" href="carta">
          <i class="far fa-file-alt"></i>
          <span>Carta Cumplimiento Fiscal</span>
        </a>
      </li>


      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->