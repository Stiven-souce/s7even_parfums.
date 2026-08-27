<footer class="footer">
  <div class="footer__grid">
    <img src="<?= $base ?? '' ?>assets/logo.png" alt="S7even Parfums" class="footer__logo">
    <nav class="footer__links">
      <a href="<?= $base ?? '' ?>index.php#manifiesto">Manifiesto</a>
      <a href="<?= $base ?? '' ?>tienda.php">Tienda</a>
      <a href="<?= $base ?? '' ?>index.php#contacto">Contacto</a>
    </nav>
    <p class="footer__copy">&copy; <span id="year"></span> S7even Parfums. Todos los derechos reservados.</p>
  </div>
</footer>

<button class="to-top" id="toTop" aria-label="Volver arriba">↑</button>

<script src="<?= $base ?? '' ?>js/script.js"></script>
</body>
</html>
