document.documentElement.classList.add('js');

const ready = (fn) => (document.readyState !== 'loading' ? fn() : document.addEventListener('DOMContentLoaded', fn));

ready(() => {
    // Icons (Lucide is loaded from the CDN in the layout).
    if (window.lucide) {
        window.lucide.createIcons({ attrs: { 'stroke-width': 1.8 } });
    }

    // Sticky header style on scroll.
    const header = document.querySelector('[data-header]');
    const onScroll = () => header?.classList.toggle('is-scrolled', window.scrollY > 24);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    // Mobile navigation.
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    const setNav = (open) => {
        panel?.classList.toggle('hidden', !open);
        toggle?.setAttribute('aria-expanded', String(open));
        document.body.classList.toggle('overflow-hidden', open);
    };
    toggle?.addEventListener('click', () => setNav(toggle.getAttribute('aria-expanded') !== 'true'));
    panel?.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setNav(false)));
    document.addEventListener('keydown', (event) => event.key === 'Escape' && setNav(false));

    // Scroll reveal.
    const revealItems = document.querySelectorAll('[data-reveal]');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
        );
        revealItems.forEach((item) => observer.observe(item));
    } else {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    }

    // Count-up numbers.
    const counters = document.querySelectorAll('[data-count]');
    const countObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = Number(el.dataset.count);
            const start = performance.now();
            const duration = 1400;
            const tick = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                el.textContent = Math.round(target * (1 - Math.pow(1 - progress, 3))).toString();
                if (progress < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
            countObserver.unobserve(el);
        });
    }, { threshold: 0.6 });
    counters.forEach((el) => countObserver.observe(el));

    // Subtle tilt on hero cards (pointer devices only).
    if (window.matchMedia('(hover: hover) and (prefers-reduced-motion: no-preference)').matches) {
        document.querySelectorAll('[data-tilt]').forEach((card) => {
            card.addEventListener('pointermove', (event) => {
                const rect = card.getBoundingClientRect();
                const x = (event.clientX - rect.left) / rect.width - 0.5;
                const y = (event.clientY - rect.top) / rect.height - 0.5;
                card.style.transform = `perspective(900px) rotateY(${x * 6}deg) rotateX(${-y * 6}deg)`;
            });
            card.addEventListener('pointerleave', () => (card.style.transform = ''));
        });
    }

    // Disable submit button while the enquiry form is sending.
    document.querySelectorAll('form[data-enquiry-form]').forEach((form) => {
        form.addEventListener('submit', () => {
            const button = form.querySelector('button[type="submit"]');
            if (button) {
                button.disabled = true;
                button.classList.add('opacity-70');
                button.querySelector('[data-label]').textContent = 'Sending...';
            }
        });
    });
});
