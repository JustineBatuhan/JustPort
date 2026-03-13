// ── Portfolio JavaScript ──────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {

    // Navbar shrink on scroll
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        navbar?.classList.toggle('scrolled', window.scrollY > 50);
        scrollTopBtn?.classList.toggle('visible', window.scrollY > 400);
    });

    // Mobile nav toggle
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    navToggle?.addEventListener('click', () => navLinks?.classList.toggle('open'));
    document.querySelectorAll('.nav-links a').forEach(a => a.addEventListener('click', () => navLinks?.classList.remove('open')));

    // Smooth active link highlight
    const sections = document.querySelectorAll('section[id]');
    const navAnchors = document.querySelectorAll('.nav-links a');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                navAnchors.forEach(a => {
                    a.classList.toggle('active', a.getAttribute('href') === '#' + entry.target.id);
                });
            }
        });
    }, { threshold: 0.4 });
    sections.forEach(s => observer.observe(s));

    // Skill bar animation on scroll (handles both old .skill-fill and new .skill-card-fill)
    const skillFills = document.querySelectorAll('.skill-fill, .skill-card-fill');
    const skillObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                el.style.width = el.dataset.level + '%';
                skillObserver.unobserve(el);
            }
        });
    }, { threshold: 0.3 });
    skillFills.forEach(el => skillObserver.observe(el));

    // Typed text effect in hero
    const typedEl = document.getElementById('typed-text');
    if (typedEl) {
        const texts = ['IT Student', 'Web Developer', 'Problem Solver', 'Laravel Enthusiast'];
        let tIdx = 0, cIdx = 0, deleting = false;
        function type() {
            const current = texts[tIdx];
            typedEl.textContent = deleting ? current.slice(0, cIdx--) : current.slice(0, cIdx++);
            let delay = deleting ? 60 : 120;
            if (!deleting && cIdx > current.length) { delay = 1800; deleting = true; }
            else if (deleting && cIdx < 0) { deleting = false; tIdx = (tIdx + 1) % texts.length; delay = 400; }
            setTimeout(type, delay);
        }
        type();
    }

    // Scroll-to-top button
    const scrollTopBtn = document.querySelector('.scroll-top');
    scrollTopBtn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // Fade-in on scroll
    const fadeEls = document.querySelectorAll('.project-card, .skill-card, .skill-group, .about-detail');
    const fadeObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity = '1';
                e.target.style.transform = 'translateY(0)';
                fadeObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });
    fadeEls.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        fadeObs.observe(el);
    });

    // Contact form validation feedback
    const form = document.getElementById('contact-form');
    form?.addEventListener('submit', (e) => {
        const btn = form.querySelector('button[type=submit]');
        if (btn) { btn.disabled = true; btn.textContent = 'Sending...'; }
    });

    // Admin sidebar active
    const currentPath = window.location.pathname;
    document.querySelectorAll('.admin-nav a').forEach(a => {
        if (a.getAttribute('href') === currentPath) a.classList.add('active');
    });

    // ── Hero Particle System ──────────────────────────────────
    const canvas = document.getElementById('hero-particles');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let W, H, particles = [];

        function resize() {
            W = canvas.width = canvas.offsetWidth;
            H = canvas.height = canvas.offsetHeight;
        }
        resize();
        window.addEventListener('resize', () => { resize(); });

        const COLORS = ['rgba(168,85,247,', 'rgba(6,182,212,', 'rgba(255,255,255,'];
        const COUNT = 70;

        for (let i = 0; i < COUNT; i++) {
            particles.push({
                x: Math.random() * W,
                y: Math.random() * H,
                vx: (Math.random() - 0.5) * 0.4,
                vy: (Math.random() - 0.5) * 0.4,
                r: Math.random() * 1.5 + 0.5,
                c: COLORS[Math.floor(Math.random() * COLORS.length)],
                a: Math.random() * 0.5 + 0.2,
            });
        }

        function drawParticles() {
            ctx.clearRect(0, 0, W, H);
            particles.forEach(p => {
                // Move
                p.x += p.vx; p.y += p.vy;
                if (p.x < 0 || p.x > W) p.vx *= -1;
                if (p.y < 0 || p.y > H) p.vy *= -1;

                // Draw dot
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = p.c + p.a + ')';
                ctx.fill();
            });

            // Draw connecting lines
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 120) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.strokeStyle = `rgba(168,85,247,${0.12 * (1 - dist / 120)})`;
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(drawParticles);
        }
        drawParticles();
    }

    // ── Skills Connected Particle System ───────────────────────
    const skillsCanvas = document.getElementById('skills-connected-bg');
    if (skillsCanvas) {
        const ctxS = skillsCanvas.getContext('2d');
        let Sw, Sh, sParticles = [];

        function sResize() {
            Sw = skillsCanvas.width = skillsCanvas.offsetWidth;
            Sh = skillsCanvas.height = skillsCanvas.offsetHeight;
        }
        sResize();
        window.addEventListener('resize', sResize);

        const S_COLORS = ['rgba(6,182,212,', 'rgba(168,85,247,', 'rgba(255,255,255,'];
        const S_COUNT = 55;

        for (let i = 0; i < S_COUNT; i++) {
            sParticles.push({
                x: Math.random() * Sw,
                y: Math.random() * Sh,
                vx: (Math.random() - 0.5) * 0.35,
                vy: (Math.random() - 0.5) * 0.35,
                r: Math.random() * 1.8 + 0.6,
                c: S_COLORS[Math.floor(Math.random() * S_COLORS.length)],
                a: Math.random() * 0.4 + 0.15
            });
        }

        function drawSkillsParticles() {
            ctxS.clearRect(0, 0, Sw, Sh);

            sParticles.forEach(p => {
                p.x += p.vx; p.y += p.vy;
                if (p.x < 0 || p.x > Sw) p.vx *= -1;
                if (p.y < 0 || p.y > Sh) p.vy *= -1;

                ctxS.beginPath();
                ctxS.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctxS.fillStyle = p.c + p.a + ')';
                ctxS.fill();
            });

            for (let i = 0; i < sParticles.length; i++) {
                for (let j = i + 1; j < sParticles.length; j++) {
                    const dx = sParticles[i].x - sParticles[j].x;
                    const dy = sParticles[i].y - sParticles[j].y;
                    const d = Math.sqrt(dx * dx + dy * dy);
                    if (d < 150) {
                        ctxS.beginPath();
                        ctxS.moveTo(sParticles[i].x, sParticles[i].y);
                        ctxS.lineTo(sParticles[j].x, sParticles[j].y);
                        ctxS.strokeStyle = `rgba(6,182,212,${0.1 * (1 - d / 150)})`;
                        ctxS.lineWidth = 0.6;
                        ctxS.stroke();
                    }
                }
            }
            requestAnimationFrame(drawSkillsParticles);
        }
        drawSkillsParticles();
    }

    // ── Skills Category Shuffle ─────────────────────────────
    const filterTabs = document.querySelectorAll('.filter-tab');
    const skillCards = document.querySelectorAll('.skill-card-wrapper');

    if (filterTabs.length > 0 && skillCards.length > 0) {
        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Update active tab
                filterTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const filter = tab.dataset.filter;

                skillCards.forEach(card => {
                    const category = card.dataset.category;

                    if (filter === 'all' || category === filter) {
                        card.classList.remove('filtered-out');
                        card.classList.add('filtered-in');
                    } else {
                        card.classList.remove('filtered-in');
                        card.classList.add('filtered-out');
                    }
                });
            });
        });

        // Initialize state
        skillCards.forEach(card => card.classList.add('filtered-in'));
    }

    // ── About Me Terminal Typer ─────────────────────────────
    const terminal = document.getElementById('about-terminal');
    if (terminal) {
        const content = terminal.querySelector('.terminal-content');
        const bioText = terminal.dataset.bio;
        let isTyping = false;

        const typeText = (text, element, speed = 30) => {
            let i = 0;
            element.textContent = '';

            const typing = setInterval(() => {
                if (i < text.length) {
                    element.textContent += text.charAt(i);
                    i++;
                    // Scroll to bottom if content exceeds height
                    terminal.scrollTop = terminal.scrollHeight;
                } else {
                    clearInterval(typing);
                }
            }, speed);
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !isTyping) {
                    isTyping = true;
                    // Start with a small system command delay
                    content.textContent = '> initiating bio.sh...\n';
                    setTimeout(() => {
                        typeText(bioText, content);
                    }, 1000);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(terminal);
    }

    // ── Journey Timeline Logic ─────────────────────────────
    const timelineProgress = document.getElementById('journey-progress');
    const timelineNodes = document.querySelectorAll('.timeline-node');
    const journeyTimeline = document.querySelector('.journey-timeline');

    if (timelineProgress && journeyTimeline) {
        window.addEventListener('scroll', () => {
            const rect = journeyTimeline.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Calculate progress based on how much of the timeline is scrolled past
            // Start filling when the top enters the bottom of the screen
            // Full when the bottom enters the bottom of the screen (or better, center)
            const scrollStart = rect.top - windowHeight;
            const scrollEnd = rect.bottom - windowHeight;
            const totalScroll = rect.height;

            let progress = 0;
            if (rect.top < windowHeight * 0.8) {
                const scrolled = (windowHeight * 0.8) - rect.top;
                progress = Math.min(100, Math.max(0, (scrolled / totalScroll) * 100));
            }

            timelineProgress.style.height = `${progress}%`;
        });

        // Use IntersectionObserver to activate nodes
        const nodeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.8 });

        timelineNodes.forEach(node => nodeObserver.observe(node));
    }

    // ── Data Pulse Field Animation ─────────────────────────
    const pulseCanvas = document.getElementById('contact-pulse-canvas');
    if (pulseCanvas) {
        const ctx = pulseCanvas.getContext('2d');
        let width, height;
        let particles = [];
        let pulses = [];
        const spacing = 40;

        const resize = () => {
            width = pulseCanvas.width = pulseCanvas.offsetWidth;
            height = pulseCanvas.height = pulseCanvas.offsetHeight;
            initGrid();
        };

        const initGrid = () => {
            particles = [];
            for (let x = 0; x < width; x += spacing) {
                for (let y = 0; y < height; y += spacing) {
                    particles.push({
                        x, y,
                        originalX: x,
                        originalY: y,
                        size: 1.5,
                        baseOpacity: 0.15,
                        opacity: 0.15
                    });
                }
            }
        };

        const createPulse = (startX, startY) => {
            pulses.push({
                x: startX,
                y: startY,
                radius: 0,
                maxRadius: Math.max(width, height) * 1.2,
                speed: 10,
                opacity: 1
            });
        };

        const animate = () => {
            ctx.clearRect(0, 0, width, height);

            // Update and draw pulses
            pulses = pulses.filter(p => {
                p.radius += p.speed;
                p.opacity -= 0.01;
                return p.opacity > 0;
            });

            // Draw grid dots
            particles.forEach(p => {
                let currentOpacity = p.baseOpacity;

                // React to pulses
                pulses.forEach(pulse => {
                    const dx = p.x - (pulse.x || width / 2);
                    const dy = p.y - (pulse.y || height / 2);
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (Math.abs(dist - pulse.radius) < 100) {
                        const strength = 1 - Math.abs(dist - pulse.radius) / 100;
                        currentOpacity += strength * pulse.opacity * 0.5;
                    }
                });

                ctx.fillStyle = `rgba(124, 58, 237, ${currentOpacity})`;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fill();
            });

            requestAnimationFrame(animate);
        };

        // Interaction: Form Focus/Type triggers pulse
        const forms = document.querySelectorAll('#contact-form input, #contact-form textarea');
        forms.forEach(input => {
            input.addEventListener('input', () => {
                const rect = input.getBoundingClientRect();
                const canvasRect = pulseCanvas.getBoundingClientRect();
                const x = rect.left - canvasRect.left + rect.width / 2;
                const y = rect.top - canvasRect.top + rect.height / 2;
                createPulse(x, y);
            });
            input.addEventListener('focus', () => {
                const rect = input.getBoundingClientRect();
                const canvasRect = pulseCanvas.getBoundingClientRect();
                const x = rect.left - canvasRect.left + rect.width / 2;
                const y = rect.top - canvasRect.top + rect.height / 2;
                createPulse(x, y);
            });
        });

        window.addEventListener('resize', resize);
        resize();
        animate();
    }
});
