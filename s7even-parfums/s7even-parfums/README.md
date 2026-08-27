# S7even Parfums — Sitio + Tienda en PHP

Sitio completo con **carrito de compras y pedidos reales en PHP** (sin
frameworks, sin `composer`, sin base de datos obligatoria). Listo para abrir
en VS Code y luego subir a un hosting con PHP.

## Qué incluye

- Página de inicio (`index.php`) con tu identidad de marca.
- Tienda (`tienda.php`) con los 4 perfumes, cada uno con su carrito.
- Carrito (`carrito.php`) — editar cantidades, quitar productos.
- Checkout (`checkout.php`) — datos del cliente + método de pago.
- Confirmación (`gracias.php`) — número de pedido + botón directo a WhatsApp.
- Panel privado (`admin/`) — ver todos los pedidos y cambiar su estado
  (pendiente → pagado → enviado).
- Pedidos guardados en `data/pedidos.json` (no necesitas MySQL para empezar).

### Importante: qué tipo de "comprar" es este

Este sistema **no cobra tarjetas online** — eso requiere una pasarela de pago
certificada (Culqi, Mercado Pago o Niubiz en Perú; Stripe fuera de Perú), que
exige verificación de tu negocio y no se puede dejar "lista" sin tus
credenciales reales. Lo que sí hace, y es como arrancan la mayoría de marcas
pequeñas: el cliente arma su pedido, confirma sus datos, y ve al instante tus
números de **Yape/Plin o cuenta bancaria** para pagar — tú confirmas el pago
por WhatsApp con un solo clic. Cuando tu marca crezca, puedes agregar Culqi o
Mercado Pago sin rehacer el sitio; solo se conecta en `procesar-pedido.php`.

## Estructura
```
s7even-parfums/
├── index.php                  → página de inicio
├── tienda.php                 → catálogo completo
├── carrito.php                → ver / editar carrito
├── carrito-agregar.php        → agrega un producto (recibe el formulario)
├── carrito-actualizar.php     → cambia cantidad o quita un producto
├── checkout.php               → formulario de datos + resumen
├── procesar-pedido.php        → valida y guarda el pedido
├── gracias.php                → confirmación + link de WhatsApp
├── includes/
│   ├── config.php             → tus datos: WhatsApp, Yape, cuenta, admin
│   ├── productos.php          → EDITA AQUÍ tu catálogo (nombre, precio, notas)
│   ├── carrito.php            → funciones del carrito (sesión)
│   ├── pedidos.php            → guardar/leer pedidos en JSON
│   ├── header.php / footer.php→ plantilla compartida
│   └── .htaccess              → bloquea el acceso directo a esta carpeta
├── admin/
│   ├── login.php              → acceso al panel
│   ├── pedidos.php            → lista de pedidos, cambiar estado
│   └── logout.php
├── data/
│   ├── pedidos.json           → aquí se guardan los pedidos
│   └── .htaccess              → bloquea que alguien lo abra desde el navegador
├── css/style.css
├── js/script.js
└── assets/logo.png
```

## Cómo verlo en tu computadora (VS Code)

Este sitio necesita un servidor con PHP corriendo — no funciona con doble
clic ni con Live Server (ese es solo para HTML/CSS/JS puro). Dos formas
rápidas:

**Opción A — servidor embebido de PHP (recomendada, no instala nada extra)**
1. Instala PHP en tu computadora: [windows.php.net](https://windows.php.net/download/) (Windows) o `brew install php` (Mac) o `sudo apt install php` (Linux).
2. En VS Code, abre una terminal dentro de la carpeta `s7even-parfums`.
3. Ejecuta:
   ```
   php -S localhost:8000
   ```
4. Abre `http://localhost:8000` en tu navegador.

**Opción B — XAMPP / Laragon (todo en uno, con interfaz)**
1. Instala [XAMPP](https://www.apachefriends.org/) o [Laragon](https://laragon.org/).
2. Copia la carpeta `s7even-parfums` dentro de `htdocs` (XAMPP) o `www` (Laragon).
3. Inicia Apache desde el panel de control.
4. Abre `http://localhost/s7even-parfums`.

## Primeros ajustes antes de publicar

1. **`includes/config.php`** — pon tu número real de WhatsApp, tu Yape/Plin,
   tu cuenta bancaria y **cambia la contraseña del panel admin** (instrucciones
   dentro del archivo).
2. **`includes/productos.php`** — edita nombre, notas y precio de cada
   perfume. Para agregar uno nuevo, copia un bloque y cambia el `id` (sin
   espacios ni tildes).
3. **Panel admin**: entra en `/admin/login.php` — usuario `admin`, contraseña
   por defecto `s7even2026`. Cámbiala antes de publicar el sitio.

## Subir a un hosting gratis con PHP

Dato honesto primero: **ya no existen registradores de dominios gratis
reales** (Freenom, que ofrecía `.tk` `.ml` `.ga` `.cf` `.gq`, cerró en 2024).
Lo que sí puedes tener gratis es un **subdominio** del hosting
(`s7evenparfums.infinityfreeapp.com`, por ejemplo) mientras validas tu marca,
y más adelante comprar tu propio `.com` o `.pe` (~$10–15 USD al año) cuando
quieras verte 100% profesional.

Hostings gratuitos que sí soportan PHP + escritura de archivos (necesaria
para guardar los pedidos):

| Hosting | Espacio | Notas |
|---|---|---|
| **InfinityFree** | 5 GB | El más recomendable para este proyecto: sin anuncios, PHP y MySQL incluidos, buen panel. Límite de 50,000 visitas/día, más que suficiente para empezar. |
| **x10Hosting** | 500 MB | Buen panel (DirectAdmin), pero borra tu cuenta si no inicias sesión en 30 días — revisa tu panel seguido. |
| **GoogieHost** | 1 GB | Requiere aprobación manual, puede tardar. |

**Pasos generales (InfinityFree como ejemplo):**
1. Crea tu cuenta y tu subdominio gratis en su panel.
2. Sube toda la carpeta `s7even-parfums` por el **Administrador de archivos**
   o por FTP (te dan usuario/clave FTP) dentro de `htdocs/`.
3. Verifica que la carpeta `data/` tenga permisos de escritura (755 o 775) —
   si no, los pedidos no se guardarán. Se ajusta desde el mismo administrador
   de archivos, clic derecho → Permisos/CHMOD.
4. Entra a tu subdominio: la tienda ya debería funcionar igual que en local.

Cuando quieras un dominio propio (`s7evenparfums.com` o `.pe`), lo compras en
cualquier registrador (Namecheap, GoDaddy, NIC.pe) y lo apuntas al mismo
hosting desde su panel — no hay que tocar el código.

## Siguiente nivel (opcional, cuando el negocio crezca)

- **Cobro con tarjeta real**: integrar Culqi o Mercado Pago (Perú) en
  `procesar-pedido.php`.
- **Base de datos**: si el catálogo crece mucho, cambiar `data/pedidos.json`
  por MySQL — solo se reemplaza `includes/pedidos.php`, el resto del sitio
  no cambia.
- **Notificaciones automáticas**: enviar el pedido por correo o Telegram
  además de WhatsApp.
