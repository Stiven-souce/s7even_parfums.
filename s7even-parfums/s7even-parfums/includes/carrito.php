<?php
/**
 * Carrito de compras — guardado en la sesión PHP.
 * Estructura: $_SESSION['carrito'] = [ 'onix-nocturno' => 2, 'oro-salvaje' => 1 ]
 */

function s7_carrito_iniciar(): void {
    if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
}

function s7_carrito_agregar(string $id, int $cantidad = 1): bool {
    s7_carrito_iniciar();
    if (!s7_producto($id) || $cantidad < 1) return false;

    $actual = $_SESSION['carrito'][$id] ?? 0;
    $_SESSION['carrito'][$id] = $actual + $cantidad;
    return true;
}

function s7_carrito_actualizar(string $id, int $cantidad): void {
    s7_carrito_iniciar();
    if ($cantidad <= 0) {
        unset($_SESSION['carrito'][$id]);
    } else {
        $_SESSION['carrito'][$id] = $cantidad;
    }
}

function s7_carrito_quitar(string $id): void {
    s7_carrito_iniciar();
    unset($_SESSION['carrito'][$id]);
}

function s7_carrito_vaciar(): void {
    $_SESSION['carrito'] = [];
}

/** Devuelve los items del carrito con su información de producto y subtotal. */
function s7_carrito_items(): array {
    s7_carrito_iniciar();
    $items = [];
    foreach ($_SESSION['carrito'] as $id => $cantidad) {
        $producto = s7_producto($id);
        if (!$producto) continue; // producto eliminado del catálogo
        $items[] = [
            'producto'  => $producto,
            'cantidad'  => $cantidad,
            'subtotal'  => $producto['precio'] * $cantidad,
        ];
    }
    return $items;
}

function s7_carrito_total(): float {
    $total = 0.0;
    foreach (s7_carrito_items() as $item) {
        $total += $item['subtotal'];
    }
    return $total;
}

function s7_carrito_contador(): int {
    s7_carrito_iniciar();
    return array_sum($_SESSION['carrito']);
}
