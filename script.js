const carousel = document.querySelector('.division-carousel');
const items = document.querySelectorAll('.division-item');
const dots = document.querySelectorAll('.dot');

let currentIndex = 0;

function updateCarousel() {
    items.forEach(item => item.classList.remove('active', 'prev', 'next'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    const prevIndex = (currentIndex - 1 + items.length) % items.length;
    const nextIndex = (currentIndex + 1) % items.length;
    
    items[currentIndex].classList.add('active');
    items[prevIndex].classList.add('prev');
    items[nextIndex].classList.add('next');
    
    dots[currentIndex].classList.add('active');
}

if (carousel && items.length > 0) {
    updateCarousel();

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
        });
    });

    items.forEach((item, index) => {
        item.addEventListener('click', () => {
            if (index !== currentIndex) {
                currentIndex = index;
                updateCarousel();
            }
        });
    });

    let startX = 0;
    let endX = 0;

    carousel.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });

    carousel.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });

    let isDragging = false;

    carousel.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.clientX;
        carousel.style.cursor = 'grabbing';
    });

    carousel.addEventListener('mouseup', (e) => {
        if (!isDragging) return;
        isDragging = false;
        endX = e.clientX;
        carousel.style.cursor = 'default';
        handleSwipe();
    });

    carousel.addEventListener('mouseleave', () => {
        if (!isDragging) return;
        isDragging = false;
        carousel.style.cursor = 'default';
    });

    function handleSwipe() {
        const threshold = 50; 
        const diff = startX - endX;

        if (diff > threshold) {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel();
        } else if (diff < -threshold) {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            updateCarousel();
        }
    }
}

const navBar = document.querySelector('.nav-bar');
const navToggle = document.querySelector('.nav-toggle');
const navLinks = document.querySelectorAll('.nav-list li a');

if (navToggle && navBar) {
    navToggle.addEventListener('click', (event) => {
        event.stopPropagation();
        const isOpen = navBar.classList.toggle('nav-open');
        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navBar.classList.contains('nav-open')) {
                navBar.classList.remove('nav-open');
                navToggle.setAttribute('aria-expanded', 'false');
            }
        });
    });

    document.addEventListener('click', (event) => {
        if (!navBar.contains(event.target) && navBar.classList.contains('nav-open')) {
            navBar.classList.remove('nav-open');
            navToggle.setAttribute('aria-expanded', 'false');
        }
    });
}

    /* PJAX-like nav */
    (function () {
        const mainSelector = 'main';

        function isInternalLink(anchor) {
            try {
                const url = new URL(anchor.href, location.origin);
                return url.origin === location.origin;
            } catch (e) {
                return false;
            }
        }

        async function fetchFragment(url) {
            const res = await fetch(url, { headers: { 'X-PJAX': 'true' } });
            if (!res.ok) throw new Error('Network response was not ok');
            const text = await res.text();
            return text;
        }

        function parseHTML(html) {
            const parser = new DOMParser();
            return parser.parseFromString(html, 'text/html');
        }

        function extractMain(doc) {
            return doc.querySelector(mainSelector);
        }

        function executeScripts(container) {
            const scripts = Array.from(container.querySelectorAll('script'));
            scripts.forEach(oldScript => {
                const newScript = document.createElement('script');
                if (oldScript.src) {
                    newScript.src = oldScript.src;
                    newScript.async = false;
                } else {
                    newScript.textContent = oldScript.textContent;
                }
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });
        }

        async function navigateTo(href, addToHistory = true) {
            try {
                const html = await fetchFragment(href);
                const doc = parseHTML(html);
                const newMain = extractMain(doc);
                if (!newMain) {
                    location.href = href; // fallback to full load if main not found
                    return;
                }

                const currentMain = document.querySelector(mainSelector);
                if (currentMain) {
                    currentMain.replaceWith(newMain);
                } else {
                    document.body.appendChild(newMain);
                }

                // update title
                const newTitle = doc.querySelector('title');
                if (newTitle) document.title = newTitle.textContent;

                // run scripts inside the new main
                executeScripts(newMain);

                if (addToHistory) history.pushState({ url: href }, '', href);
                if (window.onPJAXLoad && typeof window.onPJAXLoad === 'function') window.onPJAXLoad();
            } catch (err) {
                console.error('PJAX navigation failed:', err);
                location.href = href; // fallback
            }
        }

        // Delegate clicks on links
        document.addEventListener('click', (e) => {
            const a = e.target.closest('a');
            if (!a) return;
            if (a.target === '_blank' || a.hasAttribute('download') || a.getAttribute('href')?.startsWith('#')) return;
            if (!isInternalLink(a)) return;
            // Prevent PJAX for asset links
            const href = a.href;
            e.preventDefault();
            navigateTo(href, true);
        });

        // Handle popstate
        window.addEventListener('popstate', (e) => {
            const url = (e.state && e.state.url) || location.href;
            navigateTo(url, false);
        });

        // Provide a hook for re-initialization after PJAX content load
        window.onPJAXLoad = function () {
            // Init
            const navBar = document.querySelector('.nav-bar');
            const navToggle = document.querySelector('.nav-toggle');
            if (navToggle && navBar) {
                navToggle.setAttribute('aria-expanded', navBar.classList.contains('nav-open') ? 'true' : 'false');
            }
        };

    })();