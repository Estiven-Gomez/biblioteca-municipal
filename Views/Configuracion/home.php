<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Panel de Inicio</h1>
    </div>
</div>

<?php if(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 1) { ?>
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Usuarios">
                <h4>Usuarios</h4>
                <p><b><?php echo $data['usuarios']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-book fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Libros">
                <h4>Libros</h4>
                <p><b><?php echo $data['libros']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-address-book-o fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Autor">
                <h4>Autor</h4>
                <p><b><?php echo $data['autor']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-tags fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Editorial">
                <h4>Editorial</h4>
                <p><b><?php echo $data['editorial']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-graduation-cap fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Estudiantes">
                <h4>Estudiantes</h4>
                <p><b><?php echo $data['estudiantes']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-user-circle fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Profesores">
                <h4>Profesores</h4>
                <p><b><?php echo $data['profesores']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Personas">
                <h4>Lectores Externos</h4>
                <p><b><?php echo $data['personas']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-hourglass-start fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Prestamos">
                <h4>Prestamos</h4>
                <p><b><?php echo $data['prestamos']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-list-alt fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Materia">
                <h4>Materias</h4>
                <p><b><?php echo $data['materias']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-cogs fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Configuracion">
                <h6>Configuracion</h6>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Noticias y Novedades</h3>
            <div class="messanger">
                <div class="messages" style="height: auto; max-height: 400px; overflow-y: auto;">
                    <?php if(!empty($data['noticias'])) { 
                        foreach($data['noticias'] as $noticia) { ?>
                        <div class="card mb-3" style="border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.08); border-radius: 12px; overflow: hidden; background-color: rgba(255, 255, 255, 0.95);">
                            <?php if (!empty($noticia['imagen'])) { ?>
                                <img src="<?php echo base_url; ?>Assets/img/noticias/<?php echo htmlspecialchars($noticia['imagen']); ?>" class="card-img-top" alt="Imagen Noticia" style="max-height: 220px; object-fit: cover;">
                            <?php } ?>
                            <div class="card-body">
                                <h4 class="card-title text-primary" style="font-weight: 700;"><?php echo htmlspecialchars($noticia['titulo']); ?></h4>
                                <p class="card-text text-dark" style="font-size: 15px; line-height: 1.5;"><?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?></p>
                                <p class="card-text"><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date("d/m/Y h:i A", strtotime($noticia['fecha'])); ?></small></p>
                            </div>
                        </div>
                    <?php } } else { ?>
                        <p>No hay noticias recientes.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Libros Disponibles</h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="reportePrestamo"></canvas>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>