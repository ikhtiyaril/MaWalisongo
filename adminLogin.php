<?php
session_start();
$dsn = "mysql:host=localhost;port=3306;dbname=DbMaWalisongo";
$pdo = new PDO($dsn, 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid login credentials";
    }
}
?>
