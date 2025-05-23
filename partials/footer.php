<?php
require_once ('_inc/classes/Database.php');
require_once ('_inc/classes/Review.php');
require_once ('_inc/classes/Menu.php');

$db = new Database();
$review = new Review($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $message = $_POST['message'] ?? null;

    if ($name && $email && $message) {
        if ($review->create($name, $email, $message)) {
            echo "<script>window.location.href = 'thankyou.php';</script>";
            exit;
        } else {
            echo "<p>Error saving your review. Please try again.</p>";
        }
    } else {
        echo "<p>All fields are required.</p>";
    }
}
?>
<section class="contact-section section-padding" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 col-12 mx-auto">
                            <form class="custom-form ebook-download-form bg-white shadow" action ="thankyou.php" method="POST" role="form">
                                <div class="text-center mb-5">
                                    <h2 class="mb-1">Rate your ebook</h2>
                                </div>

                                <div class="ebook-download-form-body">
                                    <div class="input-group mb-4">
                                        <input type="text" name="name" class="form-control" aria-label="ebook-form-name" aria-describedby="basic-addon1" placeholder="Your Name" required>

                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="custom-form-icon bi-person"></i>
                                        </span>
                                    </div>

                                    <div class="input-group mb-4">
                                        <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="your@company.com" aria-label="ebook-form-email" aria-describedby="basic-addon2" required="">

                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="custom-form-icon bi-envelope"></i>
                                        </span>
                                    </div>

                                    <div class="input-group mb-4">
                                            <textarea name="message" class="form-control" rows="2" placeholder="Your Message" aria-label="ebook-form-message" aria-describedby="basic-addon3"></textarea>
                                        <span class="input-group-text" id="basic-addon3">
                                            <i class="custom-form-icon bi-chat-text"></i>
                                        </span>
                                    </div>

                                    <div class="col-lg-8 col-md-10 col-8 mx-auto">
                                        <button type="submit" class="form-control">Rate ebook</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 col-12">
                            <h6 class="mt-5">Say hi and talk to us</h6>

                            <h2 class="mb-4">Contact</h2>

                            <p class="mb-3">
                                <i class="bi-geo-alt me-2"></i>
                                London, United Kingdom
                            </p>

                            <p class="mb-2">
                                <a href="tel: 010-020-0340" class="contact-link">
                                    010-020-0340
                                </a>
                            </p>

                            <p>
                                <a href="mailto:info@company.com" class="contact-link">
                                    info@company.com
                                </a>
                            </p>

                            <h6 class="site-footer-title mt-5 mb-3">Social</h6>

                        <?php   
                            echo Menu::getSocials();
                        ?>

                            <p class="copyright-text">Copyright © 2048 ebook company
                            <br><br><a rel="nofollow" href="https://templatemo.com" target="_blank">designed by templatemo</a></p>
                        </div>

                    </div>
                </div>
            </section>
        </main>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>