<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $sql = "INSERT INTO tbl_users (user_firstname, user_lastname, user_gender, user_email, user_password) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstname, $lastname, $gender, $email, $password]);
        
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>