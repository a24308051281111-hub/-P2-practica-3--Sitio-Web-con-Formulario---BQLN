<?php
// Plantilla compartida por jeans.php, playeras.php, camisas.php, chamarras.php, sudaderas.php y calzado.php
// Cada página define $slug antes de incluir este archivo.
require "config.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$c = $conexion->prepare("SELECT id, nombre, descripcion FROM categorias WHERE slug = ?");
$c->bind_param("s", $slug);
$c->execute();
$cat = $c->get_result()->fetch_assoc();
if (!$cat) {
    http_response_code(404);
    die("Sección no encontrada.");
}

$q = $conexion->prepare("SELECT nombre, descripcion, precio FROM productos WHERE categoria_id = ? ORDER BY id");
$q->bind_param("i", $cat["id"]);
$q->execute();
$productos = $q->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($cat["nombre"]) ?> · Levi's Tienda en línea</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <?php include "encabezado.php"; ?>
  <main>
    <section class="seccion-titulo">
      <h1><?= e($cat["nombre"]) ?></h1>
      <p><?= e($cat["descripcion"]) ?></p>
      <p class="tenue"><?= count($productos) ?> productos</p>
    </section>

    <div class="productos">
      <?php foreach ($productos as $p): ?>
        <article class="producto">
          <div class="foto" aria-hidden="true"><?= e(mb_strtoupper(mb_substr($cat["nombre"], 0, 1))) ?></div>
          <h3><?= e($p["nombre"]) ?></h3>
          <p class="desc"><?= e($p["descripcion"]) ?></p>
          <p class="precio">$<?= number_format($p["precio"], 2) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </main>
  <?php include "pie.php"; ?>
</body>
</html>
