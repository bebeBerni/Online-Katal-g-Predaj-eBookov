<?php 
    include('partials/header.php');
?>
    <body>
        <main>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <i class="navbar-brand-icon bi-book me-2"></i>
                        <span>ebook</span>
                    </a>
                </div>
            </nav>
            
            <section class="hero-section d-flex justify-content-center align-items-center text-center" id="section_1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">

                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $contact_name = $_POST['ebook-form-name'];

                        if (empty($contact_name)) {
                        echo "";
                        } else {
                            echo '<h1 class="text-white mb-4">Ďakujeme ' . $contact_name . '!</h1>';
                        }
                 
                        }  
                    ?>
                            <p class="text-white">Vaša požiadavka bola prijatá. Vážíme si váš záujem!</p>
                            <a href="index.php" class="btn custom-btn mt-1">Späť na hlavnú stránku</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    <?php 
        include('partials/footer.php');
    ?>
