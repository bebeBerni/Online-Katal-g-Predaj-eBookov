<?php
require_once ('_inc/classes/Database.php');
require_once ('partials/header.php');

$db = new Database();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Overenie hesla
    if ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        // Kontrola, či už e-mail existuje
        $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error = 'Email is already registered.';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = 1; 

            $stmt = $db->getConnection()->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $success = 'Account created successfully! You can now log in.';
            } else {
                $error = 'Failed to create account. Please try again.';
            }
        }
    }
}
?>


<body>
    <main>

    <nav class="navbar navbar-expand-lg" style="background-color:rgb(34, 39, 44);">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <i class="navbar-brand-icon bi-book me-2"></i>
                    <span>ebook</span>
                </a>
            </div>
        </nav>

        <section class="container mt-5">
            <h2 class="mb-4">Register</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="custom-form">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <div class="mt-4 text-center">
                <p>Already have an account?</p>
                <a href="login.php" class="btn btn-secondary">Log In</a>
            </div>
        </section>
    </main>

    <footer style="background-color: #f8c471; padding: 20px; text-align: center; color: white; margin-top: 30px;">
        <p>&copy; 2025 Ebook Platform. All rights reserved.</p>
    </footer>
</body>
</html>