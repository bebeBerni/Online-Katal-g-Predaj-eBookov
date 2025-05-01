<?php 
    include('partials/header.php');
    require_once ('_inc/classes/Database.php');
    require_once ('_inc/classes/Review.php');
    require_once ('_inc/classes/Authenticate.php');
    
    $db = new Database();

    $auth = new Authenticate($db);
    $auth->requireAdmin(); 
    ?>

    
    <body>

        <main>

            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="admin.php">
                        <i class="navbar-brand-icon bi-gear me-2"></i>
                        <span>Admin Panel</span>
                    </a>

                    <div class="d-lg-none ms-auto me-3">
                        <a href="logout.php" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                            <i class="btn-icon bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                        <div class="d-none d-lg-block">
                            <a href="logout.php" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                                <i class="btn-icon bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                    </div>
                </div>
            </nav>
            
            <section class="hero-section d-flex justify-content-center align-items-center" id="admin_dashboard">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h1  class="text-white mb-4" >Welcome, Admin!</h1>
                            <h6>Welcome to Admin Panel</h6>
                            <h1 class="text-white mb-4">Manage Your Ebook Website</h1>
                        </div>

                    </div>
                </div>
            </section>

            <section class="admin-section section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-12">
                            <div class="admin-card">
                                <h5>Manage Users</h5>
                                <p>View, edit, or delete user accounts.</p>
                                <a href="manage_users.php" class="btn custom-btn">Go to Users</a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="admin-card">
                                <h5>Manage Books</h5>
                                <p>Add, edit, or delete books in the catalog.</p>
                                <a href="manage_books.php" class="btn custom-btn">Go to Books</a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="admin-card">
                                <h5>Manage Reviews</h5>
                                <p>Approve or delete user reviews.</p>
                                <a href="manage_reviews.php" class="btn custom-btn">Go to Reviews</a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>

    <?php 
        include('partials/footer.php');
        echo '<footer style="background-color: orange; padding: 20px; text-align: center; color: white;">';
        echo '© 2025 Ebook Admin Panel';
        echo '</footer>';
    ?>