<?php
require_once __DIR__ . '/config.php';

/**
 * Catálogo de productos.
 * Para agregar/editar un perfume, solo edita este arreglo — todo el sitio
 * (tienda, carrito, checkout, panel admin) lee de aquí.
 *
 * 'clase' controla el color CSS del frasco (ver .frasco--* en style.css).
 * 'imagen' especifica la ruta de tu foto en assets. Si está vacío, usa el frasco CSS.
 * 'categoria' asigna si es 'disenador', 'arabes' o 'nichos'.
 */
function s7_catalogo(): array {
    return [
        [
            'id'        => 'Hawas-lavagold',
            'numero'    => 'No. I',
            'nombre'    => 'HAWAS LAVA GOLD',
            'notas'     => 'Oud · Cuero · Pimienta negra',
            'precio'    => 175.00,
            'clase'     => 'frasco--onix',
            'stock'     => 25,
            'categoria' => 'arabes',
            'marca'     => 'HAWAS',
            'imagen'    => 'assets/hawas_lavagold.png',
        ],
        [
            'id'        => 'oro-salvaje',
            'numero'    => 'No. II',
            'nombre'    => 'ORO SALVAJE',
            'notas'     => 'Ámbar · Vainilla de Madagascar · Almizcle',
            'precio'    => 379.00,
            'clase'     => 'frasco--dorado',
            'stock'     => 25,
            'categoria' => 'disenador',
            'marca'     => 'S7EVEN',
            'imagen'    => '',
        ],
        [
            'id'        => 'selva-esmeralda',
            'numero'    => 'No. III',
            'nombre'    => 'SELVA ESMERALDA',
            'notas'     => 'Vetiver · Hoja de higuera · Almizcle blanco',
            'precio'    => 329.00,
            'clase'     => 'frasco--esmeralda',
            'stock'     => 25,
            'categoria' => 'nichos',
            'marca'     => 'S7EVEN',
            'imagen'    => '',
        ],
        [
            'id'        => 'pulso-carmin',
            'numero'    => 'No. IV',
            'nombre'    => 'PULSO CARMÍN',
            'notas'     => 'Rosa turca · Canela · Sándalo',
            'precio'    => 359.00,
            'clase'     => 'frasco--carmin',
            'stock'     => 25,
            'categoria' => 'disenador',
            'marca'     => 'S7EVEN',
            'imagen'    => '',
        ],
    ];
}

/** Busca un producto por id. Devuelve null si no existe. */
function s7_producto(string $id): ?array {
    foreach (s7_catalogo() as $p) {
        if (strcasecmp($p['id'], $id) === 0) return $p;
    }
    return null;
}

function s7_formato_precio(float $precio): string {
    return 'S/ ' . number_format($precio, 2);
}
