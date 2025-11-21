<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="./">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Secciones</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Tickets
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link" href="TicketsPendientes.php">
                        Tickets Pendientes
                    </a>
                </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Mantenimientos del Sistema</div>
            <a class="nav-link" href="Mantenimiento.php">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Mantenimiento de Usuarios
            </a>
            <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <?=$_SESSION['id_usuario']?>
    </div>
</nav>