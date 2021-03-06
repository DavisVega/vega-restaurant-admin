<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a 
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/index.php"
    >
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Vega</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a 
            class="nav-link"
            href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/index.php"
        >
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Sub procesos
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Mantenimientos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a 
                    class="collapse-item" 
                    href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/usuarios.php"
                >
                    Usuarios
                </a>
                <a 
                    class="collapse-item" 
                    href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/sucursales.php"
                >
                    Sucursales
                </a>
                <a 
                    class="collapse-item" 
                    href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/tipoPlatillo.php"
                >
                    Tipo de Platillo
                </a>
                <a 
                    class="collapse-item" 
                    href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/mesas.php"
                >
                    Mesas
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Principal
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Procesos</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a 
                    class="collapse-item" 
                    href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/platillos.php"
                >
                    Platillos
                </a>
                <a 
                    class="collapse-item" 
                    href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/inventarioPlatillos.php"
                >
                    Inventario de Platillos
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a
            class="nav-link" 
            href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/reservaciones.php"
        >
            <i class="fas fa-fw fa-table"></i>
            <span>Reservaciones</span>
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link" 
            href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/facturas.php"
        >
            <i class="fas fa-fw fa-table"></i>
            <span>Facturas</span>
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link" 
            href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/vega-restaurant-admin/views/pagoTarjeta.php"
        >
            <i class="fas fa-fw fa-table"></i>
            <span>Pago con Tarjeta</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <i class="fas fa-utensils mb-2"></i>
        <p class="text-center mb-2"><strong>Vega's Restaurant</strong> Visita nuestro sitio web!</p>
        <a class="btn btn-success btn-sm" href="https://davisvega.github.io/restaurant_site.github.io/">Ir al sito!</a>
    </div>

</ul>
<!-- End of Sidebar -->