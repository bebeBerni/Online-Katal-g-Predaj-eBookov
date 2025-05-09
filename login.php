<?php

session_start(); 

require_once('partials/header.php');
require_once ('_inc/classes/Database.php');
require_once ('_inc/classes/Authenticate.php');

$db = new Database();
$auth = new Authenticate($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($auth->login($email, $password)) {
        if ($auth->getUserRole() === 0) {
            header('Location: admin.php'); 
        } else {
            header('Location: user_dashboard.php'); 
        }
        exit;
    } else {
        $error = 'Incorrect email or password.';
    }
}
?>

<body>

    <main>

        <!-- Navigačná lišta -->
        <nav class="navbar navbar-expand-lg" style="background-color:rgb(34, 39, 44);">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <i class="navbar-brand-icon bi-book me-2"></i>
                    <span>ebook</span>
                </a>
            </div>
        </nav>          

        <!-- Prihlasovací formulár -->
        <section class="container mt-5">
            <h2 class="mb-4">Log In</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST" class="custom-form">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>
            </form>

            <div class="mt-4 text-center">
                <p>Don't have an account?</p>
                <a href="register.php" class="btn btn-secondary">Sign In/Register</a>
            </div>
        </section>
    </main>
    <?php
        echo '<footer style="background-color: #f8c471; padding: 20px; text-align: center; color: white; margin-top: 30px;">';
        echo '<p>&copy; 2025 Ebook Platform. All rights reserved.</p>';
        echo '</footer>';
    ?>
</body>