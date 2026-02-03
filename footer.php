<footer class="site-footer">
  <div class="footer-inner">

    <div class="footer-brand">
      <span class="footer-title">Bordeaux Gastronomie</span>
      <span class="footer-separator"></span>
      <p class="footer-tagline">
        Le regard gourmand sur la scène bordelaise
      </p>
    </div>

    <div class="footer-bottom">
      <p>
        &copy; 2026 Bordeaux Gastronomie — Tous droits réservés
      </p>
    </div>

  </div>
</footer>

<!-- JS -->
<script src="/functions/motsCles.js"></script>

<script>
  const burger = document.getElementById("burger");
  if (burger) {
    burger.addEventListener("click", function () {
      document.getElementById("navbar")?.classList.toggle("open");
    });
  }
</script>

</body>
</html>
