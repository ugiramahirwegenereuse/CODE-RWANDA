<?php
require_once 'database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        $sql = "SELECT * FROM tbl_users WHERE user_email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['user_password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_firstname'] = $user['user_firstname'];
            echo "Login successful! Welcome " . $user['user_firstname'];
        } else {
            echo "Invalid email or password!";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>