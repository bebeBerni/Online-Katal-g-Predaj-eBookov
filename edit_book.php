<?php
require_once ('_inc/classes/Database.php');
require_once ('_inc/classes/Book.php');

$db = new Database();
$book = new Book($db);

if (!isset($_GET['id'])) {
    header("Location: manage_books.php?error=No book ID provided.");
    exit;
}

$id = $_GET['id'];
$bookData = $book->show($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    if ($book->edit($id, $title, $author, $price)) {
        header("Location: manage_books.php?success=Book updated successfully!");
        exit;
    } else {
        $errorMessage = "Failed to update book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Book</h1>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($bookData['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($bookData['author']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($bookData['price']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="manage_books.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>