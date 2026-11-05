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

$q = $conexion->prepare("SELECT id, nombre, descripcion, precio FROM productos WHERE categoria_id = ? ORDER BY id");
$q->bind_param("i", $cat["id"]);
$q->execute();
$productos = $q->get_result()->fetch_all(MYSQLI_ASSOC);

// Foto de cada sección (Unsplash, enlace directo) y su autor
$base = "https://images.unsplash.com/";
$sufijo = "?fm=jpg&q=70&w=700&h=525&auto=format&fit=crop";
$fotos = [
  "jeans"     => ["photo-1624378440847-4a64ee1a889d", "Matthew Moloney"],
  "playeras"  => ["photo-1716951984700-64ea15a06f13", "TuanAnh Blue"],
  "camisas"   => ["photo-1546314065-565eec68f489",    "CHUTTERSNAP"],
  "chamarras" => ["photo-1575752229768-116115c80c8f", "Chermiti Mohamed"],
  "sudaderas" => ["photo-1573748674825-7732c5ea516e", "Hassan OUAJBIR"],
  "calzado"   => ["photo-1533199441292-029b982ffacc", "Arwan Sutanto"],
];
$foto = $fotos[$slug] ?? null;
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
          <?php $img = glob(__DIR__ . "/img/" . (int)$p["id"] . ".{jpg,jpeg,png,webp}", GLOB_BRACE); ?>
          <?php if ($img): ?>
            <img class="foto-img" src="img/<?= e(basename($img[0])) ?>" alt="<?= e($p["nombre"]) ?>" loading="lazy">
          <?php elseif ($foto): ?>
            <img class="foto-img" src="<?= e($base . $foto[0] . $sufijo) ?>" alt="<?= e($p["nombre"]) ?>" loading="lazy"
                 onerror="this.outerHTML='<div class=&quot;foto&quot;><?= e(mb_strtoupper(mb_substr($cat["nombre"], 0, 1))) ?></div>'">
          <?php else: ?>
            <div class="foto" aria-hidden="true"><?= e(mb_strtoupper(mb_substr($cat["nombre"], 0, 1))) ?></div>
          <?php endif; ?>
          <h3><?= e($p["nombre"]) ?></h3>
          <p class="desc"><?= e($p["descripcion"]) ?></p>
          <p class="precio">$<?= number_format($p["precio"], 2) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
    <?php if ($foto): ?>
      <p class="tenue creditos">Foto de <?= e($foto[1]) ?> en <a href="https://unsplash.com" target="_blank" rel="noopener">Unsplash</a>. Imagen ilustrativa.</p>
    <?php endif; ?>
  </main>
  <?php include "pie.php"; ?>
</body>
</html>
