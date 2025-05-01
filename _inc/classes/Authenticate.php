<?php

class Authenticate {

    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Nastavenie session premenných
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                return true;
            }
        }
        return false;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy(); // Zrušenie session
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['id']);
    }

    public function getUserRole() {
        return $_SESSION['role'] ?? null;
    }

    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header("Location: login.php");
            exit;
        }
    }

    public function requireAdmin() {
        if ($this->getUserRole() !== 0) { 
            header("Location: admin.php"); 
            exit;
        }
    }

    public function requireUser() {
        if ($this->getUserRole() !== 1) { 
            header("Location: user_dashboard.php"); 
            exit;
        }
    }
}
?>