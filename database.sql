CREATE DATABASE IF NOT EXISTS levis_tienda CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE levis_tienda;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  correo VARCHAR(120) NOT NULL UNIQUE,
  clave VARCHAR(255) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Se recrean pedidos, productos y categorías (las cuentas de usuarios se conservan)
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS categorias;

CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(30) NOT NULL UNIQUE,
  nombre VARCHAR(50) NOT NULL,
  descripcion VARCHAR(200) NOT NULL
);

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  categoria_id INT NOT NULL,
  nombre VARCHAR(80) NOT NULL,
  descripcion VARCHAR(160) NOT NULL,
  precio DECIMAL(8,2) NOT NULL,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  producto_id INT NOT NULL,
  talla VARCHAR(4) NOT NULL,
  cantidad INT NOT NULL,
  precio_unitario DECIMAL(8,2) NOT NULL,
  direccion VARCHAR(250) NOT NULL,
  notas VARCHAR(500),
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
  FOREIGN KEY (producto_id) REFERENCES productos(id)
);

INSERT INTO categorias (id, slug, nombre, descripcion) VALUES
(1, 'jeans',     'Jeans',     'Los cortes que hicieron historia: 501, 511, 512 y más, en mezclilla de calidad.'),
(2, 'playeras',  'Playeras',  'Algodón suave con el logotipo y los gráficos clásicos de Levi''s.'),
(3, 'camisas',   'Camisas',   'Mezclilla, western, oxford y franela para cualquier ocasión.'),
(4, 'chamarras', 'Chamarras', 'Desde la icónica Trucker hasta parkas y chalecos para el frío.'),
(5, 'sudaderas', 'Sudaderas', 'Comodidad diaria en felpa, polar y algodón francés.'),
(6, 'calzado',   'Calzado',   'Tenis, botas y sandalias con el estilo Levi''s.');

INSERT INTO productos (categoria_id, nombre, descripcion, precio) VALUES
-- Jeans
(1, 'Jeans 501 Original', 'Corte recto clásico en mezclilla azul', 1299.00),
(1, 'Jeans 511 Slim', 'Corte ajustado con tela elástica', 1199.00),
(1, 'Jeans 512 Slim Taper', 'Entallado en el muslo y ceñido al tobillo', 1249.00),
(1, 'Jeans 505 Regular', 'Corte regular recto con cierre de cremallera', 1199.00),
(1, 'Jeans 514 Straight', 'Ajuste recto, ligeramente más entallado que el 501', 1149.00),
(1, 'Jeans 502 Taper', 'Holgado en el muslo, se estrecha hacia abajo', 1249.00),
(1, 'Jeans 541 Athletic Taper', 'Más espacio en cadera y muslo, con elasticidad', 1299.00),
(1, 'Jeans 721 High Rise Skinny', 'Tiro alto y ajuste muy ceñido para mujer', 1199.00),
(1, 'Jeans 724 High Rise Straight', 'Tiro alto y pierna recta para mujer', 1299.00),
(1, 'Jeans Ribcage Straight Tobillero', 'Tiro súper alto, pierna recta a la altura del tobillo', 1399.00),
-- Playeras
(2, 'Playera Logo', 'Algodón suave con logotipo al frente', 499.00),
(2, 'Playera Batwing', 'Estampado clásico del logotipo batwing', 549.00),
(2, 'Playera Housemark', 'Corte clásico con logotipo housemark', 529.00),
(2, 'Playera Gráfica Retro', 'Gráfico inspirado en los archivos de la marca', 579.00),
(2, 'Playera Cuello V', 'Algodón ligero con cuello en V', 449.00),
(2, 'Playera con Bolsillo', 'Bolsillo frontal y etiqueta roja clásica', 479.00),
(2, 'Playera Vintage Lavada', 'Lavado vintage con tacto suave', 599.00),
(2, 'Playera Ringer', 'Cuello y mangas en contraste', 549.00),
(2, 'Playera Manga Larga', 'Algodón de peso medio con logotipo pequeño', 629.00),
(2, 'Playera Oversize Gráfica', 'Corte amplio con gráfico en el pecho', 649.00),
-- Camisas
(3, 'Camisa de Mezclilla', 'Manga larga con bolsillos frontales', 999.00),
(3, 'Camisa Western Clásica', 'Pechera con botones de presión y canesú', 1099.00),
(3, 'Camisa Sunset de Bolsillo', 'Ligera, con un bolsillo y corte relajado', 949.00),
(3, 'Camisa Battery Housemark', 'Manga larga con logotipo bordado', 899.00),
(3, 'Camisa Oxford', 'Tela oxford de algodón, cuello abotonado', 849.00),
(3, 'Camisa a Cuadros Franela', 'Franela suave a cuadros para clima fresco', 899.00),
(3, 'Camisa de Lino', 'Mezcla de lino fresca para días calurosos', 1049.00),
(3, 'Camisa Barstow Western', 'Estilo western con costuras en contraste', 1199.00),
(3, 'Camisa Worker Clásica', 'Estilo de trabajo con doble bolsillo', 999.00),
(3, 'Camisa Manga Corta', 'Mezclilla ligera de manga corta', 749.00),
-- Chamarras
(4, 'Chamarra Trucker', 'Chamarra de mezclilla con botones metálicos', 1899.00),
(4, 'Chamarra Trucker Sherpa', 'Mezclilla con forro sherpa interior', 2499.00),
(4, 'Chamarra Bomber Acolchada', 'Bomber con relleno ligero y puños elásticos', 2299.00),
(4, 'Chamarra Acolchada Ligera', 'Acolchado compacto que se guarda fácil', 2199.00),
(4, 'Chamarra Rompevientos', 'Ligera, con capucha y resistente al viento', 1699.00),
(4, 'Chaleco Acolchado', 'Sin mangas, con relleno térmico', 1599.00),
(4, 'Chamarra Coach', 'Estilo coach con cierre de botones', 1799.00),
(4, 'Parka Impermeable', 'Parka larga con capucha y forro interior', 2899.00),
(4, 'Chamarra Denim Oversize', 'Corte amplio en mezclilla gruesa', 2099.00),
(4, 'Chamarra Harrington', 'Ligera con cuello alto y cierre frontal', 1999.00),
-- Sudaderas
(5, 'Sudadera con Capucha', 'Felpa interior y bolsillo canguro', 1099.00),
(5, 'Sudadera Crewneck Logo', 'Cuello redondo con logotipo bordado', 949.00),
(5, 'Sudadera con Cierre', 'Cierre completo y bolsillos laterales', 1199.00),
(5, 'Sudadera Gráfica Retro', 'Felpa suave con gráfico de la marca', 1049.00),
(5, 'Sudadera Medio Cierre', 'Cuello alto con medio cierre', 1149.00),
(5, 'Sudadera Vintage Lavada', 'Lavado vintage y tacto desgastado', 1249.00),
(5, 'Sudadera Oversize', 'Corte amplio para un look relajado', 1199.00),
(5, 'Sudadera Polar', 'Tela polar cálida y ligera', 1099.00),
(5, 'Sudadera Bordada Housemark', 'Logotipo housemark bordado al pecho', 1149.00),
(5, 'Sudadera Capucha Colorblock', 'Bloques de color y bolsillo canguro', 1249.00),
-- Calzado
(6, 'Tenis Levi''s Drive', 'Tenis urbanos con suela ligera', 1199.00),
(6, 'Tenis Woodward Rugged', 'Estilo clásico con suela de goma resistente', 1299.00),
(6, 'Tenis Stan Buck', 'Piel sintética con detalle de etiqueta roja', 1099.00),
(6, 'Bota Workwear', 'Bota de trabajo con agujetas y suela gruesa', 1899.00),
(6, 'Tenis Lifestyle Blancos', 'Diseño limpio en blanco para todos los días', 1249.00),
(6, 'Sandalias Sport', 'Correas ajustables y suela acolchada', 699.00),
(6, 'Tenis Slip-On', 'Sin agujetas, fáciles de poner', 999.00),
(6, 'Botines de Piel', 'Botines de piel con elástico lateral', 1999.00),
(6, 'Tenis High Top', 'Caña alta con suela vulcanizada', 1399.00),
(6, 'Sandalias Slide Logo', 'Slides acolchadas con logotipo en relieve', 599.00);
