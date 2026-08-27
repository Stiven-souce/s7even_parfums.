<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

// Filtros desde GET
$categoria = $_GET['categoria'] ?? 'Todos';
$genero    = $_GET['genero'] ?? '';
$marca     = $_GET['marca'] ?? '';
$busqueda  = $_GET['q'] ?? '';
$orden     = $_GET['orden'] ?? 'recientes';

// Construcción de consulta a Supabase
$query = 'productos?select=*';
if ($categoria !== 'Todos') {
    $query .= '&categoria=eq.' . urlencode($categoria);
}
if (!empty($genero)) {
    $query .= '&genero=eq.' . urlencode($genero);
}
if (!empty($marca)) {
    $query .= '&marca=eq.' . urlencode($marca);
}
if (!empty($busqueda)) {
    $query .= '&nombre=ilike.*' . urlencode($busqueda) . '*';
}

// Orden
if ($orden === 'precio_asc') {
    $query .= '&order=precio.asc';
} elseif ($orden === 'precio_desc') {
    $query .= '&order=precio.desc';
} else {
    $query .= '&order=id.desc';
}

$productos = supabase_request($query, 'GET') ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo — S7even Parfums</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .catalogo-container { display: flex; gap: 30px; max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .sidebar-filtros { width: 260px; background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #eee; height: fit-content; }
        .sidebar-filtros h3 { font-family: 'Cinzel', serif; margin-bottom: 5px; }
        .filtro-group { margin-bottom: 15px; }
        .filtro-group label { font-size: 0.85rem; font-weight: 600; display: block; margin-bottom: 5px; }
        .filtro-group select, .filtro-group input { width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; }
        
        .main-catalogo { flex: 1; }
        .pills-categoria { display: flex; gap: 10px; margin-bottom: 25px; }
        .pill-btn { padding: 8px 18px; border-radius: 20px; border: 1px solid #e0e0e0; background: #fff; text-decoration: none; color: #333; font-size: 0.85rem; }
        .pill-btn.active { background: #000; color: #fff; border-color: #000; }

        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .grid-productos { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }
        .card-producto { background: #fff; border-radius: 12px; padding: 15px; text-decoration: none; color: #000; border: 1px solid #f0f0f0; transition: transform 0.2s; position: relative; }
        .card-producto:hover { transform: translateY(-3px); }
        .card-tag { position: absolute; top: 10px; left: 10px; background: #fff3e0; color: #e65100; font-size: 0.75rem; padding: 2px 8px; border-radius: 10px; font-weight: 600; }
        .card-img { width: 100%; height: 200px; object-fit: contain; margin-bottom: 15px; }
        .card-precio { font-weight: bold; font-size: 1.1rem; text-align: center; margin-top: 10px; }
        .card-marca { text-align: center; font-size: 0.8rem; color: #777; text-transform: uppercase; margin-top: 5px; }
    </style>
</head>
<body style="background:#f8f9fa;">

<div class="catalogo-container">
    <!-- BARRA LATERAL FILTROS -->
    <aside class="sidebar-filtros">
        <h3>Filtrar</h3>
        <p style="font-size: 0.8rem; color:#666; margin-bottom:20px;">Encuentra tu fragancia ideal</p>

        <form method="GET" action="catalogo.php">
            <div class="filtro-group">
                <label>Categoría</label>
                <select name="categoria">
                    <option value="Todos">Todas</option>
                    <option value="Diseñador" <?= $categoria === 'Diseñador' ? 'selected' : '' ?>>Diseñador</option>
                    <option value="Árabes" <?= $categoria === 'Árabes' ? 'selected' : '' ?>>Árabes</option>
                    <option value="Nichos" <?= $categoria === 'Nichos' ? 'selected' : '' ?>>Nichos</option>
                </select>
            </div>

            <div class="filtro-group">
                <label>Género</label>
                <select name="genero">
                    <option value="">Todos</option>
                    <option value="Hombre" <?= $genero === 'Hombre' ? 'selected' : '' ?>>Hombre</option>
                    <option value="Mujer" <?= $genero === 'Mujer' ? 'selected' : '' ?>>Mujer</option>
                    <option value="Unisex" <?= $genero === 'Unisex' ? 'selected' : '' ?>>Unisex</option>
                </select>
            </div>

            <div class="filtro-group">
                <label>Buscar</label>
                <input type="text" name="q" placeholder="Buscar perfume, marca..." value="<?= htmlspecialchars($busqueda) ?>">
            </div>

            <button type="submit" style="width:100%; background:#000; color:#fff; padding:10px; border:none; border-radius:6px; font-weight:bold; cursor:pointer;">Aplicar filtros</button>
            <a href="catalogo.php" style="display:block; text-align:center; font-size:0.8rem; color:#666; margin-top:10px; text-decoration:none;">Limpiar filtros</a>
        </form>
    </aside>

    <!-- LISTA DE PRODUCTOS -->
    <main class="main-catalogo">
        <span style="font-size:0.8rem; letter-spacing:1px; color:#888;">NUESTRA COLECCIÓN</span>
        <h1 style="font-family:'Cinzel',serif; margin:0 0 15px 0;">Todos los productos</h1>

        <div class="pills-categoria">
            <a href="catalogo.php?categoria=Todos" class="pill-btn <?= $categoria === 'Todos' ? 'active' : '' ?>">Todos</a>
            <a href="catalogo.php?categoria=Diseñador" class="pill-btn <?= $categoria === 'Diseñador' ? 'active' : '' ?>">DISEÑADOR</a>
            <a href="catalogo.php?categoria=Árabes" class="pill-btn <?= $categoria === 'Árabes' ? 'active' : '' ?>">ÁRABES</a>
            <a href="catalogo.php?categoria=Nichos" class="pill-btn <?= $categoria === 'Nichos' ? 'active' : '' ?>">NICHOS</a>
        </div>

        <div class="top-bar">
            <span style="font-size:0.85rem; color:#666;"><?= count($productos) ?> resultado(s) encontrados</span>
            <select onchange="location = this.value;" style="padding:6px 12px; border-radius:6px; border:1px solid #ccc;">
                <option value="catalogo.php?orden=recientes">Más recientes</option>
                <option value="catalogo.php?orden=precio_asc">Precio menor</option>
                <option value="catalogo.php?orden=precio_desc">Precio mayor</option>
            </select>
        </div>

        <div class="grid-productos">
            <?php foreach ($productos as $prod): ?>
                <a href="producto.php?id=<?= $prod['id'] ?>" class="card-producto">
                    <span class="card-tag">Importado</span>
                    <img src="<?= htmlspecialchars($prod['imagen'] ?? 'img/placeholder.jpg') ?>" class="card-img" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                    <div style="font-weight:600; text-align:center; font-size:0.95rem;"><?= htmlspecialchars($prod['nombre']) ?></div>
                    <div class="card-precio">S/ <?= number_format($prod['precio'], 2) ?></div>
                    <div class="card-marca"><?= htmlspecialchars($prod['marca'] ?? 'S7even') ?></div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>
</div>

</body>
</html>
