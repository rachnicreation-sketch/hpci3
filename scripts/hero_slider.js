/**
 * HPCI Hero Slider — compatible with TotalEnergies-style layout
 * Handles slides, dots, prev/next arrows, and auto-play.
 */
document.addEventListener('DOMContentLoaded', () => {
    const slides       = document.querySelectorAll('.hero-slide');
    const dotsContainer = document.getElementById('heroDots');
    const prevBtn      = document.getElementById('heroPrev');
    const nextBtn      = document.getElementById('heroNext');

    if (!slides.length) return;

    let current = 0;
    let timer;

    /* ── Build dots (skip if already populated by inline script) ── */
    if (dotsContainer && dotsContainer.children.length === 0) {
        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.className = 'hero-dot' + (i === 0 ? ' active' : '');
            dot.setAttribute('aria-label', `Diapositive ${i + 1}`);
            dot.addEventListener('click', () => goTo(i));
            dotsContainer.appendChild(dot);
        });
    }

    function getDots() {
        return dotsContainer ? dotsContainer.querySelectorAll('.hero-dot') : [];
    }

    function goTo(n) {
        const dots = getDots();
        slides[current].classList.remove('active');
        if (dots[current]) dots[current].classList.remove('active');

        current = (n + slides.length) % slides.length;

        slides[current].classList.add('active');
        if (dots[current]) dots[current].classList.add('active');

        resetTimer();
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(() => goTo(current + 1), 6500);
    }

    /* ── Arrow listeners ── */
    if (prevBtn) prevBtn.addEventListener('click', () => goTo(current - 1));
    if (nextBtn) nextBtn.addEventListener('click', () => goTo(current + 1));

    /* ── Keyboard navigation ── */
    document.addEventListener('keydown', e => {
        if (e.key === 'ArrowLeft')  goTo(current - 1);
        if (e.key === 'ArrowRight') goTo(current + 1);
    });

    /* ── Pause on hover ── */
    const sliderEl = document.querySelector('.hero-slider');
    if (sliderEl) {
        sliderEl.addEventListener('mouseenter', () => clearInterval(timer));
        sliderEl.addEventListener('mouseleave', () => resetTimer());
    }

    /* ── Init ── */
    slides[0].classList.add('active');
    resetTimer();
});
