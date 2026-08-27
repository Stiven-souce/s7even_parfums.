<?php
/**
 * S7EVEN PARFUMS — Configuración general
 * Cambia estos valores por los datos reales de tu negocio.
 */

// Zona horaria para que las fechas de pedidos salgan correctas
date_default_timezone_set('America/Lima');

// Sesión (carrito, login admin) — debe ir antes de cualquier salida HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---- Datos de contacto / pago ----
define('SITE_NAME', 'S7even Parfums');
define('WHATSAPP_NUMERO', '51982424158');           // sin "+", solo dígitos
define('CORREO_CONTACTO', 'hola@s7evenparfums.com');
define('YAPE_PLIN_NUMERO', '982 424 158');
define('CUENTA_BANCARIA', 'BCP — Cuenta Soles 000-000000-0-00');

// ---- Panel admin ----
define('ADMIN_USUARIO', 's7even');
define('ADMIN_SALT', 's7even14');
define('ADMIN_PASSWORD_HASH', '6fa7dd60f38b4382572b93475c40cf14bd32b8faae2bb686a3d906e57930aa07'); // = "s7even14"

// ---- Almacenamiento de pedidos ----
define('PEDIDOS_FILE', __DIR__ . '/../data/pedidos.json');
