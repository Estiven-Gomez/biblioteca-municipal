<?php
class Prestamos extends Controller
{
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $id_user = $_SESSION['id_usuario'];
        if ($id_user == 1) {
            $data = $this->model->getPrestamos();
        } else {
            $data = $this->model->getPrestamosUser($id_user);
        }
        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i]['id'];
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-secondary">Prestado</span>';
                $data[$i]['acciones'] = '<button class="btn btn-primary btn-sm" onclick="btnEntregar(' . $id . ')"><i class="fa fa-hourglass-start"></i></button> <a class="btn btn-danger btn-sm" target="_blank" href="' . base_url . 'Prestamos/ticked/' . $id . '"><i class="fa fa-file-pdf-o"></i></a>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-primary">Devuelto</span>';
                $data[$i]['acciones'] = '<a class="btn btn-danger btn-sm" target="_blank" href="' . base_url . 'Prestamos/ticked/' . $id . '"><i class="fa fa-file-pdf-o"></i></a>';
            }
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT);
        die();
    }
    public function registrar()
    {
        $libro = strClean($_POST['libro']);
        $cantidad = strClean($_POST['cantidad']);
        $fecha_prestamo = strClean($_POST['fecha_prestamo']);
        $fecha_devolucion = strClean($_POST['fecha_devolucion']);
        $observacion = strClean($_POST['observacion']);

        $id_user = $_SESSION['id_usuario'];
        if ($id_user == 1) {
            $estudiante = strClean($_POST['estudiante']);
        } else {
            $estudiante = $this->model->getEstudianteIdByUsuario($id_user);
            if (!$estudiante) {
                echo json_encode(['success' => false, 'message' => 'Error: Perfil de estudiante no enlazado con la sesión'], JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        if (empty($libro) || empty($estudiante) || empty($cantidad) || empty($fecha_prestamo) || empty($fecha_devolucion)) {
            $response = ['success' => false, 'message' => 'Todos los campos son requeridos'];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        if (!filter_var($cantidad, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
            $response = ['success' => false, 'message' => 'La cantidad debe ser un entero mayor a 0'];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        $verificar_cant = $this->model->getCantLibro($libro);
        if (empty($verificar_cant) || !isset($verificar_cant['cantidad'])) {
            $response = ['success' => false, 'message' => 'No se encontró el libro seleccionado'];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        if ($verificar_cant['cantidad'] < (int)$cantidad) {
            $response = ['success' => false, 'message' => 'Stock no disponible'];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        $fechaActual = new DateTime('today');
        $fechaDevolucion = DateTime::createFromFormat('Y-m-d', $fecha_devolucion);
        if (!$fechaDevolucion) {
            $response = ['success' => false, 'message' => 'La fecha de devolución no tiene un formato válido'];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        if ($fechaDevolucion <= $fechaActual) {
            $response = ['success' => false, 'message' => 'La fecha de devolución debe ser posterior a la fecha actual'];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        $data = $this->model->insertarPrestamo($estudiante, $libro, $cantidad, $fecha_prestamo, $fecha_devolucion, $observacion);
        if ($data > 0) {
            $response = ['success' => true, 'message' => 'Préstamo registrado correctamente'];
        } else if ($data == 'existe') {
            $response = ['success' => false, 'message' => 'El libro ya está prestado'];
        } else {
            $response = ['success' => false, 'message' => 'Error al registrar el préstamo'];
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function entregar($id)
    {
        $datos = $this->model->actualizarPrestamo(0, $id);
        if ($datos == "ok") {
            $msg = array('msg' => 'Libro recibido', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al recibir el libro', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function verificar()
    {
        $data = $this->model->selectPrestamoDebe();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function pdf()
    {
        $datos = $this->model->selectDatos();
        $prestamo = $this->model->selectPrestamoDebe();
        if (empty($prestamo)) {
            header('Location: ' . base_url . 'Configuracion/vacio');
            exit;
        }
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Prestamos");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 5, mb_convert_encoding($datos['nombre'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        $logoPath = $_SERVER['DOCUMENT_ROOT'] . "/biblioteca/Assets/img/logo.png";
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 180, 10, 30, 30, 'PNG');
        }
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, mb_convert_encoding("Teléfono: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, $datos['telefono'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, mb_convert_encoding("Dirección: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, mb_convert_encoding($datos['direccion'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, "Correo: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, mb_convert_encoding($datos['correo'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, "Detalle de Prestamos", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, mb_convert_encoding('N°', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
        $pdf->Cell(50, 5, mb_convert_encoding('Estudiantes', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
        $pdf->Cell(87, 5, 'Libros', 1, 0, 'L');
        $pdf->Cell(30, 5, 'Fecha Prestamo', 1, 0, 'L');
        $pdf->Cell(15, 5, 'Cant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($prestamo as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(50, 5, $row['nombre'], 1, 0, 'L');
            $pdf->Cell(87, 5, mb_convert_encoding($row['titulo'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
            $pdf->Cell(30, 5, $row['fecha_prestamo'], 1, 0, 'L');
            $pdf->Cell(15, 5, $row['cantidad'], 1, 1, 'L');
            $contador++;
        }
        $pdf->Output("prestamos.pdf", "I");
    }
    public function ticked($id_prestamo)
    {
        $datos = $this->model->selectDatos();
        $prestamo = $this->model->getPrestamoLibro($id_prestamo);
        if (empty($prestamo)) {
            header('Location: '.base_url. 'Configuracion/vacio');
            exit;
        }
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("Prestamos");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40,5,$prestamo['titulo'],0,1,'L');

        $logoPath = $_SERVER['DOCUMENT_ROOT'] . "/biblioteca/Assets/img/logo.png";
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 55, 15, 20, 20, 'PNG');
        }
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 5, "Teléfono: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 5, $datos['telefono'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 5, "Dirección: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 5, $datos['direccion'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 5, "Correo: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 5, $datos['correo'], 0, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(72, 5, "Detalle de Prestamos", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(60, 5, 'Libros', 1, 0, 'L');
        $pdf->Cell(12, 5, 'Cant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(60, 5, $prestamo['titulo'], 1, 0, 'L');
        $pdf->Cell(12, 5, $prestamo['cantidad'], 1, 1, 'L');
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(72, 5, "Estudiante", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(35, 5, 'Nombre.', 1, 0, 'L');
        $pdf->Cell(37, 5, 'Carrera.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(35, 5, $prestamo['nombre'], 1, 0, 'L');
        $pdf->Cell(37, 5, $prestamo['carrera'], 1, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(72, 5, 'Fecha Prestamo', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(72, 5, $prestamo['fecha_prestamo'], 0, 1, 'C');
        $pdf->Output("prestamos.pdf", "I");
    }
    
}
