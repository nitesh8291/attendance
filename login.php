<?php
session_start();
include 'db.php';

$error = "";

if(isset($_POST['login'])){
    $type = $_POST['type'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // 🎓 STUDENT LOGIN + SAVE
    if($type == 'student'){

        $check = $conn->query("SELECT * FROM users WHERE username='$user'");

        if($check->num_rows == 0){
            $conn->query("INSERT INTO users (username,password,role)
                          VALUES ('$user','$pass','student')");
        }

        $_SESSION['student'] = $user;
        header("Location: student.php");
        exit;
    }

    // 🧑‍💼 ADMIN LOGIN
    if($type == 'admin'){
        $q = $conn->query("SELECT * FROM users 
                          WHERE username='$user' 
                          AND password='$pass' 
                          AND role='admin'");

        if($q->num_rows > 0){
            $_SESSION['admin'] = $user;
            header("Location: admin.php");
            exit;
        } else {
            $error = "Wrong Admin Login";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Login</h2>

<p style="color:red;"><?php echo $error; ?></p>

<form method="POST">

<select name="type" required>
<option value="">Select</option>
<option value="student">Student</option>
<option value="admin">Admin</option>
</select>

<input type="email" name="username" placeholder="Gmail" required>

<input type="password" name="password" placeholder="Password (8-12 digits)" required>

<button name="login">Login</button>

</form>
</div>

</body>
</html>