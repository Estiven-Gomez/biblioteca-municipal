<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Panel Administrativo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="<?php echo base_url; ?>Assets/css/main.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@600;800&family=Montserrat:wght@400;600;700;800&family=Pacifico&display=swap');

        body.app.sidebar-mini {
            font-family: 'Montserrat', sans-serif;
            background-color: #e2e8f0 !important;
        }

        body.app.sidebar-mini::before {
            content: "";
            position: fixed;
            top: -10px; left: -10px; right: -10px; bottom: -10px; /* Slight overflow to hide blur edges */
            background-image: url('<?php echo base_url; ?>Assets/img/login-bg.png');
            background-size: cover;
            background-position: center;
            opacity: 0.35;
            filter: blur(8px);
            z-index: -1;
            pointer-events: none;
        }

        /* Glassmorphism Header */
        .app-header {
            background-color: rgba(69, 149, 235, 0.8) !important;
            backdrop-filter: blur(8px) !important;
            border-bottom: 1px solid rgba(255,255,255,0.2) !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
        }

        .app-header__logo {
            background-color: transparent !important;
            font-family: 'Pacifico', cursive !important;
            font-size: 30px !important;
            color: #fff !important;
            letter-spacing: 1px;
            font-weight: 400 !important;
        }

        /* Glassmorphism Sidebar */
        .app-sidebar {
            background-color: rgba(30, 80, 140, 0.85) !important;
            backdrop-filter: blur(12px) !important;
            border-right: 1px solid rgba(255,255,255,0.1) !important;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1) !important;
        }

        .app-sidebar__user {
            background-color: rgba(0,0,0,0.15) !important;
        }

        .app-sidebar__user-name, .app-sidebar__user-designation, .app-menu__label, .app-menu__icon {
            color: #ffffff !important;
        }

        .app-menu__item:hover, .app-menu__item.active {
            background-color: rgba(255,255,255,0.25) !important;
            border-left-color: #fff !important;
        }

        .treeview-menu {
            background-color: rgba(0,0,0,0.2) !important;
        }

        .treeview-item {
            color: #ececec !important;
        }
        
        .treeview-item:hover {
            color: #ffffff !important;
            background-color: transparent !important;
        }

        /* Content Area */
        .app-content {
            background-color: transparent !important;
        }

        /* Tiles / Panels */
        .tile {
            background-color: rgba(255, 255, 255, 0.95) !important;
            border-radius: 15px !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
            border: none !important;
        }
        .app-title {
            background-color: rgba(255, 255, 255, 0.92) !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
            backdrop-filter: blur(5px);
        }

        /* Auto-enumerador de Tablas (DataTables Sequence Sync) */
        table.dataTable tbody {
            counter-reset: dtSequence;
        }
        table.dataTable tbody tr {
            counter-increment: dtSequence;
        }
        table.dataTable tbody tr td:first-child {
            color: transparent !important;
            position: relative;
        }
        table.dataTable tbody tr td:first-child::before {
            content: counter(dtSequence);
            color: #555 !important;
            font-weight: 600;
            position: absolute;
            left: 15px; /* Alineación del número */
        }
    </style>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?php echo base_url; ?>Configuracion/admin">elector</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!--Notification Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">Libros no entregados.</li>
                    <div class="app-notification__content">
                        <li id="nombre_estudiante">
                            
                        </li>
                    </div>
                    <li class="app-notification__footer"><a href="<?php echo base_url; ?>Configuracion/libros" target="_blank">Generar Reporte.</a></li>
                </ul>
            </li>
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="#" id="modalPass"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir"><i class="fa fa-sign-out fa-lg"></i> Salir</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <a href="<?php echo base_url; ?>Configuracion/admin" style="text-decoration: none;">
            <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo base_url; ?>Assets/img/logo.png" alt="User Image" width="50">
                <div>
                    <p class="app-sidebar__user-name"><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario'; ?></p>
                    <p class="app-sidebar__user-designation"><?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario'; ?></p>
                </div>
            </div>
        </a>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Configuracion/admin"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Panel de Inicio</span></a></li>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Prestamos"><i class="app-menu__icon fa fa-hourglass-start"></i><span class="app-menu__label">Prestamos</span></a></li>
            <?php if($_SESSION['id_usuario'] == 1) { ?>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Estudiantes"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">Estudiantes</span></a></li>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Profesores"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">Profesores</span></a></li>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Personas"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Lectores Externos</span></a></li>
            <?php } ?>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Materia"><i class="app-menu__icon fa fa-list-alt"></i><span class="app-menu__label">Materias</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Libros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <?php if($_SESSION['id_usuario'] == 1) { ?>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Autor"><i class="icon fa fa-address-book-o"></i> Autor</a></li>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Editorial"><i class="icon fa fa-tags"></i> Editorial</a></li>
                    <?php } ?>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Libros"><i class="icon fa fa-book"></i> Libros</a></li>
                </ul>
            </li>
            <?php if($_SESSION['id_usuario'] == 1) { ?>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-wrench"></i><span class="app-menu__label">Administración</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Usuarios"><i class="icon fa fa-user-o"></i> Usuarios</a></li>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Configuracion"><i class="icon fa fa-cogs"></i> Configuración</a></li>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Noticias"><i class="icon fa fa-newspaper-o"></i> Noticias</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Reportes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" target="_blank" href="<?php echo base_url; ?>Prestamos/pdf"><i class="icon fa fa-file-pdf-o"></i> Libros Prestados</a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </aside>
    <main class="app-content">