<?php
require_once __DIR__ . '/includes/header.php';

require_once __DIR__ . '/components/nav-bar.php';
?>

<main class="snap-container">
    <?php include __DIR__ . '/components/landing.php'; ?>
    <?php include __DIR__ . '/components/org-goals.php'; ?>
    <?php include __DIR__ . '/components/about-us.php'; ?>
    <!-- <?php include __DIR__ . '/components/organization-chart.php'; ?> -->
    <?php include __DIR__ . '/components/joinus.php'; ?>
    
    <footer class="footer">
        <div class="footer-container">
            <img class="ais-logo-footer" src="img-resources/AIS-logo.png" alt="ais logo">
            <div class="footer-selection">
                <a class="footer-link" href="/hub/">AIS Hub</a>
                <a class="footer-link" href="/todo/">Dashboard</a>
                <a class="footer-link" href="/portal/">AIS portal</a>
            </div>
        </div>
        <!-- <div class="borderline"></div> -->
        <p class="copyright">©AIS 2026. All Rights Reserved</p>
    </footer>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
