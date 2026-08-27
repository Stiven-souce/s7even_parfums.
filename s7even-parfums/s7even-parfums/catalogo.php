<?php
/**
 * Catálogo Elegante — S7even Parfums
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = "Catálogo Exclusivo — S7even Parfums";

// Filtros GET
$categoria = $_GET['categoria'] ?? 'Todos';
$genero    = $_GET['genero'] ?? '';
$marca     = $_GET['marca'] ?? '';
$busqueda  = $_GET['q'] ?? '';
$orden     = $_GET['orden'] ?? 'recientes';

// Construcción de la Consulta para Supabase
$query = 'productos?select=*';

if (!empty($categoria) && strtolower($categoria) !== 'todos') {
    // Si la categoría es Árabes, usamos comodín para evitar fallos por la tilde en Supabase
    if (in_array(strtolower($categoria), ['árabes', 'arabes'])) {
        $query .= '&categoria=ilike.*rabes*';
    } else {
        $query .= '&categoria=ilike.' . urlencode($categoria);
    }
}

if (!empty($genero)) {
    $query .= '&genero=ilike.' . urlencode($genero);
}

if (!empty($marca)) {
    $query .= '&marca=eq.' . urlencode($marca);
}

if (!empty($busqueda)) {
    $query .= '&nombre=ilike.*' . urlencode($busqueda) . '*';
}

if ($orden === 'precio_asc') {
    $query .= '&order=precio.asc';
} elseif ($orden === 'precio_desc') {
    $query .= '&order=precio.desc';
} else {
    $query .= '&order=id.desc';
}

$productos = supabase_request($query, 'GET') ?? [];

// Cargar Header elegante
require_once __DIR__ . '/includes/header.php';

// Helper para mantener los parámetros en las URLs
function build_url($param, $valor) {
    $params = $_GET;
    if ($valor === '' || $valor === 'Todos') {
        unset($params[$param]);
    } else {
        $params[$param] = $valor;
    }
    return 'catalogo.php?' . http_build_query($params);
}
?>

<style>
/* Estilos Exclusivos Catálogo Dark Luxury */
body {
    background-color: #0b0b0b;
    color: #e5e5e5;
    font-family: 'Poppins', sans-serif;
}

.cat-wrapper {
    max-width: 1300px;
    margin: 40px auto 80px auto;
    padding: 0 20px;
    display: flex;
    gap: 40px;
}

/* Sidebar Filtros */
.cat-sidebar {
    width: 280px;
    background: rgba(18, 18, 18, 0.85);
    border: 1px solid rgba(197, 160, 89, 0.25);
    border-radius: 8px;
    padding: 25px;
    height: fit-content;
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
}

.cat-sidebar h3 {
    font-family: 'Cinzel', serif;
    color: #c5a059;
    font-size: 1.3rem;
    margin-bottom: 5px;
    letter-spacing: 1px;
}

.cat-sidebar p {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 25px;
}

.filter-group {
    margin-bottom: 20px;
}

.filter-group label {
    display: block;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #c5a059;
    margin-bottom: 8px;
}

.filter-group select, 
.filter-group input {
    width: 100%;
    background: #050505;
    border: 1px solid rgba(197, 160, 89, 0.3);
    color: #fff;
    padding: 10px 12px;
    border-radius: 4px;
    font-size: 0.85rem;
    outline: none;
    transition: border 0.3s ease;
}

.filter-group select:focus, 
.filter-group input:focus {
    border-color: #c5a059;
}

.btn-filter {
    width: 100%;
    background: linear-gradient(135deg, #c5a059 0%, #9e7d3b 100%);
    color: #000;
    font-weight: 600;
    padding: 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    box-shadow: 0 0 15px rgba(197, 160, 89, 0.4);
    transform: translateY(-1px);
}

.btn-reset {
    display: block;
    text-align: center;
    color: #888;
    font-size: 0.75rem;
    margin-top: 15px;
    text-decoration: none;
    transition: color 0.3s;
}

.btn-reset:hover {
    color: #c5a059;
}

/* Main Content */
.cat-main {
    flex: 1;
}

.cat-subtitle {
    font-size: 0.75rem;
    letter-spacing: 3px;
    color: #c5a059;
    text-transform: uppercase;
    display: block;
}

.cat-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.8rem;
    font-weight: 300;
    color: #fff;
    margin: 5px 0 25px 0;
}

/* Pills Categorías */
.cat-pills {
    display: flex;
    gap: 12px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.pill-item {
    padding: 8px 24px;
    border-radius: 30px;
    border: 1px solid rgba(197, 160, 89, 0.3);
    background: transparent;
    color: #ccc;
    text-decoration: none;
    font-size: 0.8rem;
    letter-spacing: 1px;
    transition: all 0.3s;
}

.pill-item:hover,
.pill-item.active {
    background: #c5a059;
    color: #000;
    border-color: #c5a059;
    font-weight: 600;
    box-shadow: 0 0 12px rgba(197, 160, 89, 0.3);
}

/* Bar de Orden y Contador */
.cat-topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    padding-bottom: 15px;
    margin-bottom: 30px;
}

.cat-count {
    font-size: 0.85rem;
    color: #888;
}

.cat-sort select {
    background: #050505;
    color: #ccc;
    border: 1px solid rgba(197, 160, 89, 0.3);
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 0.8rem;
}

/* Grid de Productos */
.cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 25px;
}

.prod-card {
    background: rgba(18, 18, 18, 0.6);
    border: 1px solid rgba(197, 160, 89, 0.15);
    border-radius: 8px;
    padding: 20px;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.prod-card:hover {
    border-color: #c5a059;
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.7);
}

.prod-tag {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(197, 160, 89, 0.15);
    color: #c5a059;
    border: 1px solid rgba(197, 160, 89, 0.3);
    font-size: 0.65rem;
    padding: 2px 8px;
    border-radius: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.prod-img-box {
    height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.prod-img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
    filter: drop-shadow(0 5px 15px rgba(0,0,0,0.6));
    transition: transform 0.3s ease;
}

.prod-card:hover .prod-img {
    transform: scale(1.05);
}

.prod-brand {
    font-size: 0.7rem;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    text-align: center;
}

.prod-title {
    font-family: 'Cinzel', serif;
    font-size: 1rem;
    color: #fff;
    text-align: center;
    margin: 5px 0 10px 0;
}

.prod-price {
    font-size: 1.1rem;
    color: #c5a059;
    font-weight: 500;
    text-align: center;
}

.empty-msg {
    text-align: center;
    padding: 60px 0;
    color: #666;
    grid-column: 1 / -1;
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.5rem;
}
</style>

<div class="cat-wrapper">
    <!-- FILTROS LATERALES -->
    <aside class="cat-sidebar">
        <h3>FILTRAR</h3>
        <p>Encuentra tu fragancia ideal</p>

        <form method="GET" action="catalogo.php">
            <div class="filter-group">
                <label>Categoría</label>
                <select name="categoria">
                    <option value="Todos">Todas</option>
                    <option value="Diseñador" <?= strtolower($categoria) === 'diseñador' ? 'selected' : '' ?>>Diseñador</option>
                    <option value="Arabes" <?= in_array(strtolower($categoria), ['árabes', 'arabes']) ? 'selected' : '' ?>>Árabes</option>
                    <option value="Nichos" <?= strtolower($categoria) === 'nichos' ? 'selected' : '' ?>>Nichos</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Género</label>
                <select name="genero">
                    <option value="">Todos</option>
                    <option value="Hombre" <?= strtolower($genero) === 'hombre' ? 'selected' : '' ?>>Hombre</option>
                    <option value="Mujer" <?= strtolower($genero) === 'mujer' ? 'selected' : '' ?>>Mujer</option>
                    <option value="Unisex" <?= strtolower($genero) === 'unisex' ? 'selected' : '' ?>>Unisex</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Buscar</label>
                <input type="text" name="q" placeholder="Perfume, notas..." value="<?= htmlspecialchars($busqueda) ?>">
            </div>

            <button type="submit" class="btn-filter">Aplicar filtros</button>
            <a href="catalogo.php" class="btn-reset">Limpiar filtros</a>
        </form>
    </aside>

    <!-- LISTADO PRODUCTOS -->
    <main class="cat-main">
        <span class="cat-subtitle">NUESTRA COLECCIÓN</span>
        <h1 class="cat-title">Todos los productos</h1>

        <div class="cat-pills">
            <a href="<?= build_url('categoria', 'Todos') ?>" class="pill-item <?= strtolower($categoria) === 'todos' ? 'active' : '' ?>">TODOS</a>
            <a href="<?= build_url('categoria', 'Diseñador') ?>" class="pill-item <?= strtolower($categoria) === 'diseñador' ? 'active' : '' ?>">DISEÑADOR</a>
            <a href="<?= build_url('categoria', 'Arabes') ?>" class="pill-item <?= in_array(strtolower($categoria), ['árabes', 'arabes']) ? 'active' : '' ?>">ÁRABES</a>
            <a href="<?= build_url('categoria', 'Nichos') ?>" class="pill-item <?= strtolower($categoria) === 'nichos' ? 'active' : '' ?>">NICHOS</a>
        </div>

        <div class="cat-topbar">
            <span class="cat-count"><?= count($productos) ?> resultado(s) encontrados</span>
            <div class="cat-sort">
                <select onchange="location = this.value;">
                    <option value="<?= build_url('orden', 'recientes') ?>">Más recientes</option>
                    <option value="<?= build_url('orden', 'precio_asc') ?>" <?= $orden === 'precio_asc' ? 'selected' : '' ?>>Precio menor</option>
                    <option value="<?= build_url('orden', 'precio_desc') ?>" <?= $orden === 'precio_desc' ? 'selected' : '' ?>>Precio mayor</option>
                </select>
            </div>
        </div>

        <div class="cat-grid">
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $prod): ?>
                    <a href="producto.php?id=<?= $prod['id'] ?>" class="prod-card">
                        <span class="prod-tag"><?= htmlspecialchars($prod['categoria'] ?? 'Exclusivo') ?></span>
                        <div class="prod-img-box">
                            <img src="<?= htmlspecialchars($prod['imagen'] ?? 'assets/logo.png') ?>" class="prod-img" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                        </div>
                        <div>
                            <div class="prod-brand"><?= htmlspecialchars($prod['marca'] ?? 'S7even Parfums') ?></div>
                            <h2 class="prod-title"><?= htmlspecialchars($prod['nombre']) ?></h2>
                            <div class="prod-price">S/ <?= number_format($prod['precio'], 2) ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-msg">No se encontraron fragancias con los criterios seleccionados.</div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php 
if (file_exists(__DIR__ . '/includes/footer.php')) {
    require_once __DIR__ . '/includes/footer.php';
} else {
    echo '</body></html>';
}
?>
