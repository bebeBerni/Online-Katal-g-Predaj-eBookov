<?php
require_once ('_inc/classes/Authenticate.php');
require_once ('_inc/classes/Database.php');
require_once ('partials/header.php');

$db = new Database();
$auth = new Authenticate($db);

// Len používateľ má prístup
$auth->requireUser();

// Inicializácia košíka, ak ešte neexistuje
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Načítanie kníh z košíka
$cartItems = [];
$totalPrice = 0; // Inicializácia celkovej sumy
if (!empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $stmt = $db->getConnection()->prepare("SELECT * FROM ebooks WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($_SESSION['cart']));
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Výpočet celkovej sumy
    foreach ($cartItems as $item) {
        $totalPrice += $item['price'];
    }
}

// Odstránenie knihy z košíka
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $ebookId = $_POST['ebook_id'];
    unset($_SESSION['cart'][$ebookId]);
    header("Location: cart.php");
    exit;
}
?>

<body>
    <main>
        <!-- Navigačná lišta -->
        <nav class="navbar navbar-expand-lg" style="background-color:rgb(34, 39, 44);">
            <div class="container">
                <a class="navbar-brand" href="user_dashboard.php">
                    <i class="navbar-brand-icon bi-book me-2"></i>
                    <span>ebook</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="d-none d-lg-block ms-auto">
                        <a href="logout.php" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                            <i class="btn-icon bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Obsah stránky -->
        <section class="container mt-5">
            <h1 class="mb-4">Your Cart</h1>

            <?php if (empty($cartItems)): ?>
                <p>Your cart is empty. <a href="user_dashboard.php">Go back to browse ebooks.</a></p>
            <?php else: ?>
                <!-- Tabuľka kníh v košíku -->
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['id']); ?></td>
                                <td><?php echo htmlspecialchars($item['title']); ?></td>
                                <td><?php echo htmlspecialchars($item['author']); ?></td>
                                <td><?php echo htmlspecialchars($item['price']); ?> €</td>
                                <td>
                                    <form method="POST" action="cart.php">
                                        <input type="hidden" name="ebook_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" name="remove_from_cart" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Celková suma -->
                <div class="mt-4">
                    <h4>Total Price: <?php echo number_format($totalPrice, 2); ?> €</h4>
                </div>

                <div class="mt-4">
                    <a href="user_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
                </div>

            <?php endif; ?>
        </section>
    </main>
    <?php
        echo '<footer style="background-color: #f8c471; padding: 20px; text-align: center; color: white; margin-top: 20px;">';
        echo '<p>&copy; 2025 Ebook Platform. All rights reserved.</p>';
        echo '</footer>';
    ?>
</body>