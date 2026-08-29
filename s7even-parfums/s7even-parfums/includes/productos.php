<?php
require_once __DIR__ . '/config.php';

/**
 * Catálogo de productos.
 */
function s7_catalogo(): array {
    return [
        /**
 * PERFUMES DE LA MARCA HAWAS.
 */
        [
            'id'          => 'Hawas-lavagold',
            'numero'      => 'No. I',
            'nombre'      => 'HAWAS LAVA GOLD',
            'notas'       => 'Oud · Cuero · Pimienta negra',
            'descripcion' => 'Hawas Lava Gold es la encarnación del lujo misterioso y la fuerza masculina. Inicia con un contraste vibrante de piña y manzana sobre un corazón dominante de cuero y especias oscuras. Su fondo de ámbar dulce y madura madera de oud deja una huella dorada, cálida e inolvidable a tu paso.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'HAWAS',
            'imagen'      => 'assets/hawas_lavagold.png',
        ],
       [
            'id'          => 'Hawas-ice',
            'numero'      => 'No. VI',
            'nombre'      => 'HAWAS ICE',
            'notas'       => 'Manzana helada · Bergamota · Cardamomo',
            'descripcion' => 'Hawas Ice es una ráfaga de frescura extrema y vitalidad. Inicia con un acorde helado de manzana, bergamota y menta que despierta los sentidos al instante. En su evolución, las notas florales y especiadas suaves aportan elegancia, cerrando con un fondo cálido de musgo, ámbar y madera que asegura una presencia limpia, moderna y altamente adictiva.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'HAWAS',
            'imagen'      => 'assets/hawaas_ice.png',
        ],
        [
            'id'          => 'selva-esmeralda',
            'numero'      => 'No. III',
            'nombre'      => 'SELVA ESMERALDA',
            'notas'       => 'Vetiver · Hoja de higuera · Almizcle blanco',
            'descripcion' => 'Una esencia fresca, verdosa y vibrante inspirada en la naturaleza virgen. Aporta una proyección elegante, limpia y relajante.',
            'precio'      => 329.00,
            'clase'       => 'frasco--esmeralda',
            'stock'       => 25,
            'categoria'   => 'nichos',
            'marca'       => 'S7EVEN',
            'imagen'      => '',
        ],
        [
            'id'          => 'pulso-carmin',
            'numero'      => 'No. IV',
            'nombre'      => 'PULSO CARMÍN',
            'notas'       => 'Rosa turca · Canela · Sándalo',
            'descripcion' => 'Una composición seductora y apasionada que fusiona la riqueza floral de la rosa con especias cálidas y un fondo de sándalo cremoso.',
            'precio'      => 359.00,
            'clase'       => 'frasco--carmin',
            'stock'       => 25,
            'categoria'   => 'disenador',
            'marca'       => 'S7EVEN',
            'imagen'      => '',
        ],
        [
            'id'          => 'Hawas-kobra',
            'numero'      => 'No. V',
            'nombre'      => 'HAWAS KOBRA',
            'notas'       => 'Menta · Lavanda · Notas especiadas',
            'descripcion' => 'Hawas Kobra refleja un carácter oscuro, misterioso y magnético. Inicia con un estallido fresco de especias vibrantes que se entrelazan rápidamente con un corazón amaderado y herbal. Su fondo denso de cuero, incienso y ámbar proyecta una masculinidad sofisticada, imponente y llena de peligro seductor.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'HAWAS',
            'imagen'      => 'assets/hawas_kobra.png',
        ],
    ];
}

/** Busca un producto por id. */
function s7_producto(string $id): ?array {
    foreach (s7_catalogo() as $p) {
        if (strcasecmp($p['id'], $id) === 0) return $p;
    }
    return null;
}

function s7_formato_precio(float $precio): string {
    return 'S/ ' . number_format($precio, 2);
}
