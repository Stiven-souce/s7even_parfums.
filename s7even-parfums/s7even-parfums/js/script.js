// ==========================================================================
// S7EVEN PARFUMS — interactions
// ==========================================================================

document.addEventListener('DOMContentLoaded', () => {

  // Footer year
  const yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  // ---- Nav: shrink + blur on scroll ----
  const nav = document.getElementById('nav');
  const toTop = document.getElementById('toTop');

  const onScroll = () => {
    const scrolled = window.scrollY > 40;
    nav.classList.toggle('is-scrolled', scrolled);
    toTop.classList.toggle('is-visible', window.scrollY > 600);
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  toTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // ---- Mobile burger menu ----
  const burger = document.getElementById('burger');
  burger.addEventListener('click', () => {
    nav.classList.toggle('is-open');
  });
  // close mobile menu after tapping a link
  document.querySelectorAll('.nav__links a').forEach(a => {
    a.addEventListener('click', () => nav.classList.remove('is-open'));
  });

  // ---- Scroll reveal for sections & cards ----
  const revealTargets = document.querySelectorAll(
    '.manifiesto__text, .manifiesto__visual, .nota-card, .frasco-card, .cita blockquote, .contacto__info, .contacto__form'
  );
  revealTargets.forEach(el => el.classList.add('reveal'));

  const s7Mark = document.querySelector('.s7-mark');

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.18 });

  revealTargets.forEach(el => io.observe(el));
  if (s7Mark) io.observe(s7Mark);

  // ---- Contact form (demo submit — wire to your backend / mailto / API) ----
  const form = document.getElementById('contactForm');
  const status = document.getElementById('formStatus');

  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const data = new FormData(form);
      const nombre = data.get('nombre');

      // TODO: reemplaza esto por tu integración real (fetch a tu API,
      // Formspree, EmailJS, etc.)
      status.textContent = `Gracias, ${nombre}. Te contactaremos pronto.`;
      form.reset();

      setTimeout(() => { status.textContent = ''; }, 5000);
    });
  }

});
