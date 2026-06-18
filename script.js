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