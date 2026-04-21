#  Sistema de Biblioteca — PHP + MySQL

Sistema web de gestión de biblioteca escolar que permite administrar libros, autores, editoriales, estudiantes y préstamos, con control de usuarios y permisos por rol.

---

##  ¿Qué hace la app?

Permite a los administradores de una biblioteca registrar y controlar el inventario de libros, gestionar préstamos a estudiantes, generar reportes en PDF y administrar usuarios con distintos niveles de acceso.

---

##  Tecnologías usadas

- **Backend:** PHP 8 (arquitectura MVC personalizada)
- **Base de datos:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, Bootstrap 4, jQuery 3.6
- **Librerías:** DataTables, SweetAlert2, Select2, Chart.js, FPDF (generación de PDFs), Font Awesome 4.7

---

##  Requisitos previos

- PHP 8.0 o superior
- MySQL 5.7+ / MariaDB 10.4+
- Servidor web: Apache (XAMPP, WAMP o similar)
- Extensión PDO habilitada en PHP

---

##  Instalación y ejecución

### 1. Clona el repositorio

```bash
git clone https://github.com/tu-usuario/biblioteca.git
```

### 2. Copia la carpeta al servidor

Mueve la carpeta `biblioteca/` dentro de tu directorio web:

```
C:/xampp/htdocs/biblioteca/     ← en Windows con XAMPP
/var/www/html/biblioteca/       ← en Linux con Apache
```

### 3. Importa la base de datos

1. Abre **phpMyAdmin** en tu navegador: `http://localhost/phpmyadmin`
2. Crea una base de datos llamada `biblioteca`
3. Importa el archivo `biblioteca.sql` que se encuentra en la raíz del proyecto

### 4. Configura la conexión

Edita el archivo `Config/Config.php` con tus credenciales:

```php
const base_url = "http://localhost/biblioteca/";
const host     = "localhost";
const user     = "root";       // tu usuario de MySQL
const pass     = "";           // tu contraseña de MySQL
const db       = "biblioteca";
const charset  = "charset=utf8";
```

### 5. Ejecuta la aplicación

Abre tu navegador y visita:

```
http://localhost/biblioteca/
```

### 6. Credenciales de acceso por defecto

| Usuario | Contraseña | Rol |
|---------|------------|-----|
| `admin` | `admin`    | Super Administrador |

---

##  Estructura del proyecto

```
biblioteca/
├── Assets/             # CSS, JS, imágenes, fuentes
├── Config/             # Configuración, conexión, autoload
├── Controllers/        # Lógica de cada módulo (MVC)
├── Models/             # Acceso a base de datos
├── Views/              # Plantillas HTML/PHP
├── Libraries/          # FPDF para generación de PDFs
├── biblioteca.sql      # Dump de la base de datos
└── index.php           # Punto de entrada (front controller)
```

---

##  Capturas de pantalla

![Pantalla de Login](login.png)

##  Licencia

Este proyecto es de uso educativo. Puedes adaptarlo y mejorarlo libremente.

