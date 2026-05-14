# Elector - Sistema de Gestion de Biblioteca

Sistema web de gestion de biblioteca escolar (**Elector**) que permite administrar libros, autores, editoriales, estudiantes y prestamos, con control de usuarios y permisos por rol. 

Incluye a **Lexi**, un Chatbot Multilingue integrado (Espanol - English - Francais) con filosofia institucional.

---

## Que hace la aplicacion?

Permite a los administradores de una biblioteca:
- Registrar y controlar el inventario de libros fisicos.
- Gestionar prestamos a estudiantes, profesores y lectores externos.
- Generar reportes en PDF.
- Administrar usuarios con distintos niveles de acceso (Super Admin / Bibliotecario).
- Publicar noticias y eventos de la biblioteca.
- Atender consultas en tiempo real mediante el chatbot Lexi.

---

## Tecnologias usadas

### Backend
| Tecnologia     | Uso                                   |
|----------------|---------------------------------------|
| PHP 8          | Logica del servidor, arquitectura MVC |
| MySQL/MariaDB  | Base de datos relacional              |
| Apache (XAMPP) | Servidor web local                    |

### Frontend
| Tecnologia    | Uso                                        |
|---------------|--------------------------------------------|
| HTML5 / CSS3  | Estructura y estilos base                  |
| Bootstrap 4   | Framework CSS responsive                   |
| jQuery 3.6    | Manipulacion del DOM y AJAX                |
| DataTables    | Tablas interactivas con busqueda/paginacion|
| SweetAlert2   | Alertas y confirmaciones estilizadas       |
| Select2       | Selectores enriquecidos                    |
| Chart.js      | Graficas en el dashboard                   |
| Font Awesome  | Iconografia                                |
| pdfMake       | Generacion de PDFs en el cliente           |

### Librerias Adicionales
- **FPDF** (Generacion de PDFs en backend)

---

## Chatbot Multilingue - Lexi

El sistema incluye un chatbot integrado que funciona sin necesidad de APIs externas de pago, corriendo 100% en el navegador del cliente.

### Caracteristicas del Chatbot
| Caracteristica   | Detalle                                         |
|------------------|-------------------------------------------------|
| Tecnologias      | JavaScript Vanilla (ES6+), CSS3 (Glassmorphism) |
| Inteligencia     | Knowledge Base local, Regex Rule Engine         |
| Idiomas          | Espanol (es), English (en), Francais (fr)       |
| Interfaz         | Boton flotante, typing indicator, responsive    |
| Variables Entorno| NO requiere API Key externa                     |

### Filosofia Institucional integrada
El chatbot incluye de manera visible y reflexiva la declaracion institucional:
> "Soy LIBRE, AUTONOMO Y RESPONSABLE a traves del dialogo y la construccion, como ideal regulativo; me dirijo, controlo y dicto mis propias leyes."

Esta declaracion, junto con reflexiones diarias sobre *Etica, Desarrollo Humano, Bienestar, Autonomia y Transformacion Positiva*, aparecen de forma interactiva en la conversacion, fomentando la responsabilidad social y la evolucion personal.

---

## Requisitos previos

- PHP 8.0 o superior
- MySQL 5.7+ / MariaDB 10.4+
- Servidor web: Apache (XAMPP, WAMP o similar)
- Extension PDO habilitada en PHP

---

## Instalacion y ejecucion

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/biblioteca.git
```

### 2. Copiar la carpeta al servidor
Mueve la carpeta `biblioteca/` dentro de tu directorio web:
```text
Windows (XAMPP): C:/xampp/htdocs/biblioteca/
Linux (Apache):  /var/www/html/biblioteca/
```

### 3. Importar la base de datos
1. Abre phpMyAdmin en tu navegador: `http://localhost/phpmyadmin`
2. Crea una base de datos llamada `biblioteca`
3. Importa el archivo `biblioteca.sql` que se encuentra en la raiz del proyecto

### 4. Configurar la conexion
1. Renombra `Config/Config.example.php` a `Config/Config.php` (Nota: este archivo esta excluido de Git por seguridad).
2. Edita el archivo `Config/Config.php` con tus credenciales:
```php
const base_url = "http://localhost/biblioteca/";
const host     = "localhost";
const user     = "root";       // tu usuario de MySQL
const pass     = "";           // tu contrasena de MySQL
const db       = "biblioteca";
const charset  = "charset=utf8";
```

### 5. Ejecutar la aplicacion
Abre tu navegador y visita:
```text
http://localhost/biblioteca/
```

### 6. Credenciales de acceso por defecto
| Usuario | Contrasena | Rol                 |
|---------|------------|---------------------|
| admin   | admin      | Super Administrador |

---

## Estructura del proyecto

```text
biblioteca/
+-- Assets/             # CSS, JS, imagenes, fuentes (incluye chatbot.css y chatbot.js)
+-- Config/             # Configuracion, conexion, autoload
+-- Controllers/        # Logica de cada modulo (MVC)
+-- Models/             # Acceso a base de datos
+-- Views/              # Plantillas HTML/PHP (footer.php integra el chatbot)
+-- Libraries/          # FPDF para generacion de PDFs
+-- biblioteca.sql      # Dump de la base de datos
+-- index.php           # Punto de entrada (front controller)
```

---

## Capturas de pantalla
> Agrega aqui capturas de la pantalla de login, el dashboard y el modulo de prestamos.

---

## Licencia
Este proyecto es de uso educativo. Puedes adaptarlo y mejorarlo libremente.