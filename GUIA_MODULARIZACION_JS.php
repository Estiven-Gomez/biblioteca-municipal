<?php
/**
 * Cómo incluir los archivos JavaScript modularizados en las vistas
 * 
 * ORDEN IMPORTANTE DE CARGA:
 * 1. jQuery (dependencia fundamental)
 * 2. Bootstrap JS (dependencia fundamental)
 * 3. SweetAlert2, DataTables, Select2 (librerías externas)
 * 4. comun.js (funciones compartidas)
 * 5. modulos/*.js (módulos específicos)
 * 6. main.js (scripts globales del sitio)
 * 
 * NUNCA cargar comun.js antes que jQuery y SweetAlert2
 * NUNCA cargar modulos/*.js antes que comun.js
 */
?>

<!-- ========== EJEMPLO DE CARGA CORRECTA EN Templates/footer.php ========== -->

<!-- jQuery (si no está ya cargado) -->
<script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap y librerías esenciales -->
<script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/pace.min.js"></script>

<!-- Librerías de terceros: DataTables, SweetAlert2, Select2, Chart.js -->
<script src="<?php echo base_url; ?>Assets/js/datatables.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/chart.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/pdfmake.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/vfs_fonts.js"></script>

<!-- PASO 1: Cargar funciones comunes (SweetAlert2, Select2, alertas, etc.) -->
<script src="<?php echo base_url; ?>Assets/js/comun.js"></script>

<!-- PASO 2: Cargar módulos específicos según la página actual -->
<?php
    // Detectar la página actual y cargar solo los módulos necesarios
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    $controlador = explode('/', $url)[0] ?? '';
    
    // Mapeo: controlador => archivo módulo
    $modulos = [
        'Usuarios' => 'usuarios.js',
        'Estudiantes' => 'estudiantes.js', // crear este archivo
        'Libros' => 'libros.js', // crear este archivo
        'Prestamos' => 'prestamos.js',
        'Configuracion' => 'reportes.js', // crear este archivo
        'Autor' => 'autores.js', // crear este archivo
        'Editorial' => 'editoriales.js', // crear este archivo
        'Materia' => 'materias.js' // crear este archivo
    ];
    
    // Cargar el módulo correcto si existe
    if (isset($modulos[$controlador])) {
        echo '<script src="' . base_url . 'Assets/js/modulos/' . $modulos[$controlador] . '"></script>' . PHP_EOL;
    }
?>

<!-- PASO 3: Cargar main.js (scripts globales que aplican a todas las páginas) -->
<script src="<?php echo base_url; ?>Assets/js/main.js"></script>

<!-- Variable global base_url para AJAX -->
<script>
    const base_url = '<?php echo base_url; ?>';
</script>


<!-- ========== ALTERNATIVA: CARGA MANUAL EN VISTAS ESPECÍFICAS ========== -->

<?php
/**
 * Si prefieres cargar módulos manualmente en cada vista, haz esto
 * en el footer.php de cada módulo. Ejemplo en Views/Usuarios/index.php:
 */
?>

<!-- En Views/Usuarios/index.php (DESPUÉS de cargar comun.js) -->
<script src="<?php echo base_url; ?>Assets/js/comun.js"></script>
<script src="<?php echo base_url; ?>Assets/js/modulos/usuarios.js"></script>

<!-- O en Views/Prestamos/index.php -->
<script src="<?php echo base_url; ?>Assets/js/comun.js"></script>
<script src="<?php echo base_url; ?>Assets/js/modulos/prestamos.js"></script>


<!-- ========== ESTRUCTURA RESULTANTE ========== -->
<?php
/**
 * Assets/
 * └── js/
 *     ├── jquery-3.6.0.min.js (ya existe)
 *     ├── bootstrap.bundle.min.js (ya existe)
 *     ├── datatables.min.js (ya existe)
 *     ├── sweetalert2.all.min.js (ya existe)
 *     ├── select2.min.js (ya existe)
 *     ├── chart.min.js (ya existe)
 *     ├── comun.js ← NUEVO: funciones compartidas
 *     ├── main.js (ya existe)
 *     ├── login.js (ya existe)
 *     ├── pace.min.js (ya existe)
 *     └── modulos/ ← NUEVA CARPETA
 *         ├── usuarios.js ← NUEVO
 *         ├── libros.js ← NUEVO
 *         ├── prestamos.js ← NUEVO
 *         ├── estudiantes.js ← TODO
 *         ├── autores.js ← TODO
 *         ├── editoriales.js ← TODO
 *         ├── materias.js ← TODO
 *         └── reportes.js ← TODO
 */
?>


<!-- ========== CÓMO IDENTIFICAR A QUÉ MÓDULO PERTENECE CADA FUNCIÓN ========== -->

<?php
/**
 * POR PREFIJO DE FUNCIÓN:
 * 
 * Usuarios:
 * - frmUsuario() 
 * - registrarUser() 
 * - btnEditarUser() 
 * - btnEliminarUser() 
 * - btnReingresarUser() 
 * - btnRolesUser() 
 * - registrarPermisos()
 * 
 * Libros:
 * - frmLibros() 
 * - registrarLibro() 
 * - btnEditarLibro() 
 * - btnEliminarLibro() 
 * - btnReingresarLibro()
 * 
 * Préstamos:
 * - frmPrestar() 
 * - registrarPrestamo() 
 * - btnEntregar() 
 * - reportePDF()
 * 
 * Estudiantes:
 * - frmEstudiante() 
 * - registrarEstudiante() 
 * - btnEditarEst() 
 * - btnEliminarEst() 
 * - btnReingresarEst()
 * 
 * Materias:
 * - frmMateria() 
 * - registrarMateria() 
 * - btnEditarMat() 
 * - btnEliminarMat() 
 * - btnReingresarMat()
 * 
 * Autores:
 * - frmAutor() 
 * - registrarAutor() 
 * - btnEditarAutor() 
 * - btnEliminarAutor() 
 * - btnReingresarAutor()
 * 
 * Editoriales:
 * - frmEditorial() 
 * - registrarEditorial() 
 * - btnEditarEdi() 
 * - btnEliminarEdi() 
 * - btnReingresarEdi()
 * 
 * COMPARTIDO (comun.js):
 * - alertas()
 * - preview()
 * - deleteImg()
 * - obtenerTokenCSRF()
 * - Select2 configurations
 * - initTabla* (inicializadores genéricos)
 * 
 * 
 * POR ELEMENT ID (HTML):
 * 
 * Usuarios:
 * - #tblUsuarios (DataTable)
 * - #frmUsuario (formulario)
 * - #nuevo_usuario (modal)
 * 
 * Libros:
 * - #tblLibros (DataTable)
 * - #frmLibro (formulario)
 * - #nuevoLibro (modal)
 * 
 * Préstamos:
 * - #tblPrestar (DataTable)
 * - #frmPrestamo (formulario)
 * - #nuevoPrestamo (modal)
 * 
 * Estudiantes:
 * - #tblEst (DataTable)
 * - #frmEstudiante (formulario)
 * - #nuevoEstudiante (modal)
 * 
 * Materias:
 * - #tblMateria (DataTable)
 * - #frmMateria (formulario)
 * - #nuevoMateria (modal)
 * 
 * Autores:
 * - #tblAutor (DataTable)
 * - #frmAutor (formulario)
 * - #nuevoAutor (modal)
 * 
 * Editoriales:
 * - #tblEditorial (DataTable)
 * - #frmEditorial (formulario)
 * - #nuevoEditorial (modal)
 */
?>
