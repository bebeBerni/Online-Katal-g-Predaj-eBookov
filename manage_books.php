<?php
require_once ('_inc/classes/Database.php');
require_once ('_inc/classes/Book.php');

$db = new Database();
$book = new Book($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_book'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    if ($book->edit($id, $title, $author, $price)) {
        $successMessage = "Book updated successfully!";
    } else {
        $errorMessage = "Failed to update book.";
    }
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    if ($book->destroy($deleteId)) {
        $successMessage = "Book deleted successfully!";
    } else {
        $errorMessage = "Failed to delete book.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    if ($book->create($title, $author, $price)) {
        $successMessage = "Book added successfully!";
    } else {
        $errorMessage = "Failed to add book.";
    }
}

$books = $book->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Manage Books</h1>
        
        <div class="mb-4">
            <a href="admin.php" class="btn btn-secondary">Back to Admin Panel</a>
        </div>

        <div class="mb-4">
            <h2>Add New Book</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <button type="submit" name="add_book" class="btn btn-success">Add Book</button>
            </form>
        </div>

        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $b): ?>
                    <tr>
                        <td><?php echo $b['id']; ?></td>
                        <td><?php echo htmlspecialchars($b['title']); ?></td>
                        <td><?php echo htmlspecialchars($b['author']); ?></td>
                        <td><?php echo htmlspecialchars($b['price']); ?></td>
                        <td>
                            <a href="edit_book.php?id=<?php echo $b['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="manage_books.php?delete_id=<?php echo $b['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>