<?php
/*
 * Archivo de configuración de ejemplo para el proyecto Biblioteca
 *
 * PASOS PARA CONFIGURAR:
 * 1. Renombra este archivo de "Config.example.php" a "Config.php"
 * 2. Llena las constantes con tus valores reales de base de datos
 * 3. Asegúrate de que este archivo NO esté versionado en Git (debe estar en .gitignore)
 *
 * NOTA: Nunca subas credenciales reales a un repositorio público.
 */

// URL base de la aplicación (cambiar según el dominio)
const base_url = "http://localhost/biblioteca/";  // Ejemplo: "https://midominio.com/"

// Configuración de base de datos MySQL
const host = "localhost";          // Servidor de BD (ej: "127.0.0.1" o "mysql.midominio.com")
const user = "root";               // Usuario de BD (ej: "miusuario")
const pass = "";                   // Contraseña de BD (ej: "mipassword123")
const db = "biblioteca";           // Nombre de la base de datos
const charset = "charset=utf8";    // Charset (generalmente utf8 o utf8mb4)
?>