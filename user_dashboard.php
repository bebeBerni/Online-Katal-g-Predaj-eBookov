<?php
require_once ('_inc/classes/Authenticate.php');
require_once ('_inc/classes/Database.php');
require_once ('partials/header.php');

$db = new Database();
$auth = new Authenticate($db);

$auth->requireUser();

$stmt = $db->getConnection()->prepare("SELECT * FROM ebooks");
$stmt->execute();
$ebooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ebookId = $_POST['ebook_id'];
    if (isset($_POST['add_to_cart'])) {
        $_SESSION['cart'][$ebookId] = true; 
    } elseif (isset($_POST['remove_from_cart'])) {
        unset($_SESSION['cart'][$ebookId]); 
    }
}
?>

<body>
    <main>

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
                        <a href="cart.php" class="btn custom-btn custom-border-btn btn-naira btn-inverted me-2">
                            <i class="btn-icon bi-cart"></i>
                            <span>Cart</span>
                        </a>
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
            <h1 class="mb-4">Welcome, User!</h1>
            <p>This is your dashboard. Below is the list of available ebooks:</p>

            <!-- Tabuľka kníh -->
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
                    <?php foreach ($ebooks as $ebook): ?>
                        <tr>
                            <td><?php echo $ebook['id']; ?></td>
                            <td><?php echo htmlspecialchars($ebook['title']); ?></td>
                            <td><?php echo htmlspecialchars($ebook['author']); ?></td>
                            <td><?php echo htmlspecialchars($ebook['price']); ?> €</td>
                            <td>
                                <?php if (!isset($_SESSION['cart'][$ebook['id']])): ?>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="ebook_id" value="<?php echo $ebook['id']; ?>">
                                        <button type="submit" name="add_to_cart" class="btn btn-success btn-sm">Add to Cart</button>
                                    </form>
                                <?php else: ?>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="ebook_id" value="<?php echo $ebook['id']; ?>">
                                        <button type="submit" name="remove_from_cart" class="btn btn-danger btn-sm">Remove from Cart</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>