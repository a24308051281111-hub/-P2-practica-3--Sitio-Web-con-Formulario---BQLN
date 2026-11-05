<?php
require "config.php";

// Solo usuarios con sesión iniciada
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$cats = $conexion->query(
    "SELECT c.slug, c.nombre, c.descripcion, COUNT(p.id) AS n
     FROM categorias c LEFT JOIN productos p ON p.categoria_id = c.id
     GROUP BY c.id ORDER BY c.id"
)->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio · Levi's Tienda en línea</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <?php include "encabezado.php"; ?>
  <main>
    <section class="hero">
      <p class="sobretitulo">Desde 1853</p>
      <h1>Mezclilla con historia, estilo para hoy</h1>
      <p>Bienvenido a la tienda en línea de Levi's. Aquí encontrarás jeans, playeras, camisas, chamarras, sudaderas y calzado de la marca que inventó el jean moderno.</p>
    </section>

    <section class="tarjeta">
      <h2>Sobre este sitio</h2>
      <p>Este sitio presenta el catálogo de prendas de vestir y calzado Levi's, organizado en seis secciones. Usa la barra de navegación para entrar a cada una y conocer sus productos, descripciones y precios.</p>
      <p>Levi Strauss &amp; Co. nació en San Francisco, California, en 1853. En 1873 se patentó el remache en los bolsillos de los pantalones de trabajo, y de ahí surgió el jean 501, el modelo más emblemático de la marca. Hoy Levi's sigue combinando ese legado con diseños modernos para todos los días.</p>
    </section>

    <section class="tarjeta">
      <h2>Nuestras secciones</h2>
      <div class="cats">
        <?php foreach ($cats as $c): ?>
          <a class="cat" href="<?= e($c["slug"]) ?>.php">
            <span class="cat-nombre"><?= e($c["nombre"]) ?></span>
            <span class="cat-desc"><?= e($c["descripcion"]) ?></span>
            <span class="cat-n"><?= (int)$c["n"] ?> productos →</span>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="tarjeta">
      <h2>Por qué Levi's</h2>
      <ul class="ventajas">
        <li><strong>Calidad duradera.</strong> Mezclilla resistente pensada para años de uso.</li>
        <li><strong>Cortes para cada persona.</strong> Slim, recto, regular y atlético, para hombre y mujer.</li>
        <li><strong>Estilo clásico.</strong> La etiqueta roja y el logotipo batwing son reconocidos en todo el mundo.</li>
      </ul>
    </section>
  </main>
  <?php include "pie.php"; ?>
</body>
</html>
