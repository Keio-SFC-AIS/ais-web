<?php
require_once __DIR__ . '/includes/header.php';

require_once __DIR__ . '/components/nav-bar.php';
?>

<main class="contact-main">
    <section class="contact-page">
        <div class="contact-page-heading">
            <h1>Have a question?</h1>
        </div>

        <div class="contact-intro">
            <p>Whether you are an incoming freshman looking for guidance, a student group wanting to collaborate, or an alumnus looking to reconnect—we are here to help. Drop us a message!</p>
        </div>

        <!-- <div class="contact-section-header">
            <h2>Contact Options</h2>
            <p>Choose the best way to reach us below.</p>
        </div> -->

        <div class="contact-grid">
            <a class="contact-card contact-card-link" href="https://www.instagram.com/aiskeiosfc/" target="_blank" rel="noopener noreferrer">
                <div class="contact-card-header">
                    <span class="contact-card-icon instagram-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <linearGradient id="instaGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#f58529" />
                                <stop offset="50%" stop-color="#dd2a7b" />
                                <stop offset="100%" stop-color="#515bd4" />
                            </linearGradient>
                            <rect x="2" y="2" width="20" height="20" rx="6" fill="url(#instaGrad)" />
                            <path d="M7.5 7.5h9v9h-9z" fill="none" stroke="#fff" stroke-width="1.5" />
                            <circle cx="12" cy="12" r="2.7" fill="none" stroke="#fff" stroke-width="1.5" />
                            <circle cx="17.5" cy="6.5" r="1" fill="#fff" />
                        </svg>
                    </span>
                    <h2>Instagram DM</h2>
                </div>
                <p>We're highly active on Instagram — fastest for student-to-student or event queries.</p>
                <span class="contact-link-text">@aiskeiosfc</span>
            </a>

            <!-- <div class="contact-card">
                <h2>LINE Group</h2>
                <p>Join our LINE group to connect with peers and get Newsletter updates.</p>
                <a class="contact-link" href="#" id="line-group-link">Join LINE Group</a>
                <div class="line-qr">
                    <img src="img-resources/line-qr.png" alt="LINE group QR code (replace with your QR)" />
                </div>
            </div> -->

            <a class="contact-card contact-card-link" href="mailto:ais-pub-group@keio.jp">
                <div class="contact-card-header">
                    <span class="contact-card-icon email-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <rect x="2" y="5" width="20" height="14" rx="3" fill="#0d6efd" />
                            <polyline points="3,7 12,13 21,7" fill="none" stroke="#fff" stroke-width="1.8" />
                            <path d="M3 7v10a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V7" fill="none" stroke="#fff" stroke-width="1.8" />
                        </svg>
                    </span>
                    <h2>Official Email</h2>
                </div>
                <p>For formal inquiries, collaborations, or university correspondences (Gakuji), email us:</p>
                <span class="contact-link-text">ais-pub-group@keio.jp</span>
            </a>
        </div>

        <!-- <div class="contact-help-grid">
            <div class="contact-help-card">
                <h3>Need help faster?</h3>
                <p>Use the embedded chat widget at the bottom corner for quick answers, or reach out via Instagram and email.</p>
                <ul>
                    <li>Instagram DM: best for fast peer support</li>
                    <li>Official email: good for formal or administrative requests</li>
                </ul>
            </div>
            <div class="contact-help-card">
                <h3>We can help with</h3>
                <ul>
                    <li>Event participation and club collaboration</li>
                    <li>Campus guidance and student life questions</li>
                    <li>University procedures and communications</li>
                </ul>
            </div>
        </div> -->

        <!-- <div class="ai-section">
            <div class="ai-info">
                <h3>Quick help — AI Assistant</h3>
                <p>If you have common questions, try our AI assistant powered by Anything LLM. It can answer FAQs instantly.</p>
                <button id="open-ai" class="ai-button" data-ai-url="#">Ask our AI</button>
                <p class="ai-note">Suggestion: a floating chat bubble is great for quick lookups; a full section is better for browsable FAQs. We added both a bubble and a section here — pick what fits best.</p>
            </div>
        </div> -->

        <!--
        Paste this script at the bottom of your HTML before the </body> tag.
        See more style and config options on our docs
        https://github.com/Mintplex-Labs/anythingllm-embed/blob/main/README.md
        -->
        <script
          data-embed-id="10924585-6918-4243-af21-9a46cdf25d58"
          data-base-api-url="https://anythingllm.tianyibrad.com/api/embed"
          data-greeting="Welcome to AIS Website Assistant! How can I help you today?"
          data-brand-image-url="https://ais-official.sfc.keio.ac.jp/img-resources/AIS-logo.png"
          data-no-sponsor="true"
          data-assistant-name="AIS AI Assistant"
          data-assistant-icon="https://ais-official.sfc.keio.ac.jp/img-resources/AIS-logo.png"
          src="https://anythingllm.tianyibrad.com/embed/anythingllm-chat-widget.min.js">
        </script>
        <!-- AnythingLLM (https://anythingllm.com) -->

    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
