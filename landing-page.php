<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="landing-page.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">

    <title>AIS Homepage</title>
</head>

<body>
    <?php include 'nav-bar.php'; ?>
    <section class="title">
        <div class="title-text">
            <h1>
                Association <span class="small-text">for</span>
            </h1>
            <h1>
                International Students
            </h1>
        </div>
        <div class="logo">
            <img class="logo" src="img-resources/AIS-logo.png" alt="AIS logo">
        </div>

    </section>
    <section class="who-we-are">
        <div class="intro-description">
            <h1>Who <span class="we">We</span> Are</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Amet quos dolore omnis explicabo facilis itaque
                ut quaerat cumque illum error a, natus accusamus consectetur velit rerum maiores ratione assumenda
                expedita! Adipisci dolor quia eum ipsum exercitationem quos dicta a aperiam! Nisi, veritatis animi nam
                officia nulla aliquam eos velit obcaecati sapiente nobis cupiditate quo debitis sit vero hic saepe
                excepturi eveniet expedita voluptatibus! Magni, sequi. Velit quia rerum ratione tenetur obcaecati magnam
                ad reiciendis quas.</p>
        </div>
        <div class="scroll-window">
            <div class="scroll-wrapper">

                <div class="column col-1">
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                </div>

                <div class="column col-2">
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                </div>

                <div class="column col-3">
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                    <div class="img-1"></div>
                </div>

            </div>
        </div>
    </section>
    <section class="how-we-operate">
        <h1>How <span class="we">We</span> Operate</h1>
        <ul class="division-carousel">
            <li class="division-item events">
                <div class="card-content">
                    <h2>Executive Team</h2>
                    <h3>"Ideas meet execution (and chaos)"</h3>
                    <div class="view-more">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error maxime quae quisquam facere adipisci repudiandae.</p>
                        <a href="" class="view-more-btn">View more</a>
                    </div>
                </div>
            </li>
            <li class="division-item web">
                <div class="card-content">
                    <h2>Web Team</h2>
                    <h3>"Code? Sleek. Website? Functional."</h3>
                    <div class="view-more">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error maxime quae quisquam facere adipisci repudiandae.</p>
                        <a href="" class="view-more-btn">View more</a>
                    </div>
                </div>
            </li>
            <li class="division-item sns">
                <div class="card-content">
                    <h2>Events Team</h2>
                    <h3>"Events never plan themselves"</h3>
                    <div class="view-more">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error maxime quae quisquam facere adipisci repudiandae.</p>
                        <a href="" class="view-more-btn">View more</a>
                    </div>
                </div>
            </li>
        </ul>
        <div class="pagination">
            <span class="dot active" data-index="0"></span>
            <span class="dot" data-index="1"></span>
            <span class="dot" data-index="2"></span>
        </div>
    </section>
    <script src="script.js" defer></script>
</body>

</html>