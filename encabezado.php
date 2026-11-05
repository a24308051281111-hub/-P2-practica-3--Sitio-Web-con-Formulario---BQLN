<?php
// Menú de secciones (cada una es su propio documento)
$menu = [
  "index.php"     => "Inicio",
  "jeans.php"     => "Jeans",
  "playeras.php"  => "Playeras",
  "camisas.php"   => "Camisas",
  "chamarras.php" => "Chamarras",
  "sudaderas.php" => "Sudaderas",
  "calzado.php"   => "Calzado",
];
$paginaActual = basename($_SERVER["SCRIPT_NAME"]);
?>
<header class="cabecera">
  <div class="marca">
    <span class="logo">LEVI'S</span>
    <span class="lema">Tienda en línea</span>
  </div>
  <div class="alumna">
    <strong>Lia Bretado Quiroz</strong>
    <span>Grupo 5-J</span>
  </div>
</header>
<?php if (isset($_SESSION["usuario_id"])): ?>
<nav class="barra" aria-label="Principal">
  <ul class="menu">
    <?php foreach ($menu as $archivo => $texto): ?>
      <li><a href="<?= $archivo ?>"<?= $paginaActual === $archivo ? ' class="activo" aria-current="page"' : '' ?>><?= e($texto) ?></a></li>
    <?php endforeach; ?>
  </ul>
  <div class="usuario">
    <span>Hola, <?= e($_SESSION["nombre"]) ?></span>
    <a href="pedidos.php"<?= $paginaActual === "pedidos.php" ? ' class="activo"' : '' ?>>Mis pedidos</a>
    <a href="logout.php">Cerrar sesión</a>
  </div>
</nav>
<?php endif; ?>
