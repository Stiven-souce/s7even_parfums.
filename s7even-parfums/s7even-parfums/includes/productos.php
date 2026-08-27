<?php
/**
 * Catálogo de productos.
 * Para agregar/editar un perfume, solo edita este arreglo — todo el sitio
 * (tienda, carrito, checkout, panel admin) lee de aquí.
 *
 * 'clase' controla el color CSS del frasco (ver .frasco--* en style.css).
 */
function s7_catalogo(): array {
    return [
        [
            'id'     => 'onix-nocturno',
            'numero' => 'No. I',
            'nombre' => 'ÓNIX NOCTURNO',
            'notas'  => 'Oud · Cuero · Pimienta negra',
            'precio' => 349.00,
            'clase'  => 'frasco--onix',
            'stock'  => 25,
        ],
        [
            'id'     => 'oro-salvaje',
            'numero' => 'No. II',
            'nombre' => 'ORO SALVAJE',
            'notas'  => 'Ámbar · Vainilla de Madagascar · Almizcle',
            'precio' => 379.00,
            'clase'  => 'frasco--dorado',
            'stock'  => 25,
        ],
        [
            'id'     => 'selva-esmeralda',
            'numero' => 'No. III',
            'nombre' => 'SELVA ESMERALDA',
            'notas'  => 'Vetiver · Hoja de higuera · Almizcle blanco',
            'precio' => 329.00,
            'clase'  => 'frasco--esmeralda',
            'stock'  => 25,
        ],
        [
            'id'     => 'pulso-carmin',
            'numero' => 'No. IV',
            'nombre' => 'PULSO CARMÍN',
            'notas'  => 'Rosa turca · Canela · Sándalo',
            'precio' => 359.00,
            'clase'  => 'frasco--carmin',
            'stock'  => 25,
        ],
    ];
}

/** Busca un producto por id. Devuelve null si no existe. */
function s7_producto(string $id): ?array {
    foreach (s7_catalogo() as $p) {
        if ($p['id'] === $id) return $p;
    }
    return null;
}

function s7_formato_precio(float $precio): string {
    return 'S/ ' . number_format($precio, 2);
}
