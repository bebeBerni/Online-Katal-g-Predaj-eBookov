<?php
require_once('_inc/classes/Database.php');
require_once('_inc/classes/Authenticate.php');

$db = new Database();
$auth = new Authenticate($db);

if (!isset($_GET['id'])) {
    header('Location: manage_users.php');
    exit;
}

$id = $_GET['id'];

// Získaj údaje používateľa
$stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: manage_users.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $db->getConnection()->prepare("UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: manage_users.php');
        exit;
    } else {
        $errorMessage = "Failed to update user.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Edit User</h1>
    <div class="mb-4">
        <a href="manage_users.php" class="btn btn-secondary">Back to Manage Users</a>
    </div>
    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="0" <?php if ($user['role'] == 0) echo 'selected'; ?>>Admin</option>
                <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>User</option>
            </select>
        </div>
        <button type="submit" name="edit_user" class="btn btn-primary">Update User</button>
    </form>
</div>
</body>
</html>