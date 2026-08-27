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
define('WHATSAPP_NUMERO', '51900000000');           // sin "+", solo dígitos
define('CORREO_CONTACTO', 'hola@s7evenparfums.com');
define('YAPE_PLIN_NUMERO', '900 000 000');
define('CUENTA_BANCARIA', 'BCP — Cuenta Soles 000-000000-0-00');

// ---- Panel admin ----
// Contraseña por defecto: "s7even2026" — CÁMBIALA antes de publicar el sitio.
// La contraseña se guarda como SHA-256(contraseña + ADMIN_SALT), nunca en texto plano.
// Para generar tu propio hash, ejecuta en tu terminal (con PHP instalado):
//   php -r "echo hash('sha256', 'tu-nueva-clave' . 's7even_salt_2026');"
// y reemplaza el valor de ADMIN_PASSWORD_HASH de abajo.
define('ADMIN_USUARIO', 'admin');
define('ADMIN_SALT', 's7even_salt_2026');
define('ADMIN_PASSWORD_HASH', '197b77af24594b0590e4cad2f84648e2c89a0d0f6b75fc454b579f1448e6ed28'); // = "s7even2026"

// ---- Almacenamiento de pedidos ----
define('PEDIDOS_FILE', __DIR__ . '/../data/pedidos.json');
