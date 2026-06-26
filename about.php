<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/components/nav-bar.php';
?>

<main>
    <section class="page-section about-hero">
        <div class="about-hero">
            <h1>About AIS</h1>
            <p>
                Association for International Students (AIS) at Keio SFC is a student-led community focused on helping international students thrive.
                We provide practical guidance, social events, and peer support so newcomers can feel at home in campus life.
            </p>

            <div class="hero-grid">
                <div class="hero-card">
                    <h2>Community</h2>
                    <p>We connect students through events, activities, and shared experiences across cultures.</p>
                </div>
                <div class="hero-card">
                    <h2>Support</h2>
                    <p>We help with course registration, campus resources, and navigating student life in Japan.</p>
                </div>
                <div class="hero-card">
                    <h2>Shaping GIGA</h2>
                    <p>We collect feedback and insights from GIGA students, and report to Gakuji to improve GIGA programs.</p>
                </div>
            </div>

            <div class="hero-actions">
                <a href="contact.php" class="primary-btn">Contact Us</a>
                <a href="/hub/" class="secondary-btn">Visit AIS Hub</a>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/components/organization-chart.php'; ?>

    <footer class="footer">
        <div class="footer-container">
            <img class="ais-logo-footer" src="/img-resources/AIS-logo.png" alt="AIS logo">
            <div class="footer-selection">
                <a class="footer-link" href="/hub/">AIS Hub</a>
                <a class="footer-link" href="/todo/">Dashboard</a>
                <a class="footer-link" href="/portal/">AIS portal</a>
            </div>
        </div>
        <p class="copyright">©AIS 2026. All Rights Reserved</p>
    </footer>
</main>

<?php require_once __DIR__ . '/includes/footer.php';
