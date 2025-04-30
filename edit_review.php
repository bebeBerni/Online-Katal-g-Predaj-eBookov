<?php
require_once ('_inc/classes/Database.php');
require_once ('_inc/classes/Review.php');

$db = new Database();
$review = new Review($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_review'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if ($review->edit($id, $name, $email, $message)) {
        $successMessage = "Review updated successfully!";
    } else {
        $errorMessage = "Failed to update review.";
    }
}

$reviews = $review->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Manage Reviews</h1>

        <div class="mb-4">
            <a href="manage_reviews.php" class="btn btn-secondary">Back to Manage Reviews</a>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $r): ?>
                    <tr>
                        <td><?php echo $r['id']; ?></td>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td><?php echo htmlspecialchars($r['email']); ?></td>
                        <td><?php echo htmlspecialchars($r['message']); ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="editReview(<?php echo htmlspecialchars(json_encode($r)); ?>)">Edit</button>
                            <a href="manage_reviews.php?delete_id=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulár na úpravu recenzie -->
        <div class="mt-5">
            <h2>Edit Review</h2>
            <form method="POST" action="">
                <input type="hidden" name="id" id="edit-id">
                <div class="mb-3">
                    <label for="edit-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="edit-name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="edit-email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="edit-message" class="form-label">Message</label>
                    <textarea class="form-control" id="edit-message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" name="edit_review" class="btn btn-success">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        function editReview(review) {
            document.getElementById('edit-id').value = review.id;
            document.getElementById('edit-name').value = review.name;
            document.getElementById('edit-email').value = review.email;
            document.getElementById('edit-message').value = review.message;
        }
    </script>
</body>
</html>