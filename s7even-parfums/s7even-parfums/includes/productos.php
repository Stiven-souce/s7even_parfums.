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
            'id'          => 'Hawas-ice',
            'numero'      => 'No. VI',
            'nombre'      => 'HAWAS ICE',
            'notas'       => 'Manzana helada · Bergamota · Cardamomo',
            'descripcion' => 'Hawas Ice es una ráfaga de frescura extrema y vitalidad. Inicia con un acorde helado de manzana, bergamota y menta que despierta los sentidos al instante. En su evolución, las notas florales y especiadas suaves aportan elegancia, cerrando con un fondo cálido de musgo, ámbar y madera que asegura una presencia limpia, moderna y altamente adictiva.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_ice.png',
        ],
       [
            'id'          => 'Hawas-for-him',
            'numero'      => 'No. VII',
            'nombre'      => 'HAWAS FOR HIM',
            'notas'       => 'Manzana · Bergamota · Canela · Ámbar gris',
            'descripcion' => 'Hawas For Him es una fragancia magnética y llena de vitalidad. Destaca por una salida vibrante de manzana, bergamota y canela que se funde con un corazón acuático y fresco. Su fondo de ámbar gris, almizcle y maderas le da una fijación excepcional, logrando un aroma seductor, versátil y con una presencia imponente.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_for_him.png',
        ],
                [
            'id'          => 'Hawas-black',
            'numero'      => 'No. VIII',
            'nombre'      => 'HAWAS BLACK',
            'notas'       => 'Piña · Bergamota · Pachulí · Liquen de roble',
            'descripcion' => 'Hawas Black es la interpretación más oscura, intensa y sofisticada de la colección. Inicia con un estallido potente de piña, bergamota y pomelo que da paso a un corazón ahumado de jazmín y pachulí. Su base de musgo de roble, ámbar y maderas oscuras crea una firma olfativa imponente, moderna y con una fijación extraordinaria.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_black.png',
        ],

        [
            'id'          => 'Hawas-tropical',
            'numero'      => 'No. IX',
            'nombre'      => 'HAWAS TROPICAL',
            'notas'       => 'Mango · Coco · Fruta de la pasión · Ámbar cálido',
            'descripcion' => 'Hawas Tropical es una explosión exótica y vibrante de frescura. Abre con refrescante agua de coco, hojas de higuera y un toque picante de jengibre, dando paso a un corazón veraniego de coco, higo y menta fresca. Su fondo amaderado y cremoso de sándalo, haba tonka y almizcle aporta un secado sofisticado, masculino y muy seductor.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_tropical.png',
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
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_kobra.png',
        ],

        [
            'id'          => 'Hawas-fire',
            'numero'      => 'No. X',
            'nombre'      => 'HAWAS FIRE',
            'notas'       => 'Pimienta roja · Canela · Ámbar incandescente · Madera quemada',
            'descripcion' => 'Hawas Fire es una fragancia cálida, intensa y seductora. Abre con una potente combinación de especias picantes y notas cítricas que encienden los sentidos, dando paso a un corazón amaderado y resinoso. Su fondo rico en ámbar, vainilla y notas ahumadas crea una estela envolvente, profunda y de altísima duración, ideal para destacar.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_fire.png',
        ],

        [
            'id'          => 'Hawas-elixir',
            'numero'      => 'No. XI',
            'nombre'      => 'HAWAS ELIXIR',
            'notas'       => 'Miel dorada · Ámbar resinoso · Vainilla ahumada · Maderas preciosas',
            'descripcion' => 'Hawas Elixir representa la máxima opulencia y concentración de la saga. Inicia con notas cálidas de especias finas y toques frutales dorados que se entrelazan con un corazón de resinas preciosas. Su fondo amaderado, enriquecido con ámbar y vainilla, ofrece una estela profunda, ultra duradera y verdaderamente lujosa.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_elixir.png',
        ],

        [
            'id'          => 'Hawas-malibu',
            'numero'      => 'No. XII',
            'nombre'      => 'HAWAS MALIBU',
            'notas'       => 'Brisa marina · Lima ácida · Coco fresco · Madera flotante',
            'descripcion' => 'Hawas Malibu es la viva esencia del verano costero y la brisa marina. Destaca por una apertura efervescente de cítricos jugosos y notas acuáticas que transmiten frescura inmediata. Su corazón floral y mentolado descansa sobre un fondo de madera de deriva, almizcle y ámbar claro, logrando un aroma limpio, vibrante y sumamente versátil.',
            'precio'      => 175.00,
            'clase'       => 'frasco--onix',
            'stock'       => 25,
            'categoria'   => 'arabes',
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_malibu.png',
        ],

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
            'marca'       => 'RASASI',
            'imagen'      => 'assets/hawas_lavagold.png',
        ],

                /**
 * PERFUMES DE LA MARCA AFNAN.
 */
        
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
