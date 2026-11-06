<?php
// Conexión a MySQL de XAMPP 
$host = "localhost";
$usuario = "root";
$clave = "";
$base = "levis_tienda";

$conexion = new mysqli($host, $usuario, $clave, $base);
if ($conexion->connect_error) {
    die("No se pudo conectar a la base de datos: " . $conexion->connect_error);
}
$conexion->set_charset("utf8mb4");

session_start();

function e($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
