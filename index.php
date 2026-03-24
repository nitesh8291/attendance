<?php
session_start();
include 'db.php';

$error = "";

if(isset($_POST['login'])){
    $type = $_POST['type'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // 🎓 STUDENT LOGIN (free)
    if($type == 'student'){
        $_SESSION['student'] = $user;
        header("Location: student.php");
        exit;
    }

    // 🧑‍💼 ADMIN LOGIN (DB check)
    if($type == 'admin'){
        $q = $conn->query("SELECT * FROM users WHERE username='$user' AND password='$pass' AND role='admin'");

        if($q && $q->num_rows > 0){
            $_SESSION['admin'] = $user;
            header("Location: admin.php");
            exit;
        } else {
            $error = "❌ Wrong Admin Login";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Login System</h2>

<?php if($error != ""){ ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php } ?>

<form method="POST" onsubmit="return validateForm()">

<select name="type" id="type" required>
<option value="">Select Login Type</option>
<option value="student">🎓 Student</option>
<option value="admin">🧑‍💼 Admin</option>
</select>

<input type="email" name="username" id="email" placeholder="Enter Gmail" required>

<input type="password" name="password" id="password" placeholder="Password (8-12 digits)" required>

<button name="login">Login</button>

</form>

</div>

<script>
function validateForm(){
    let email = document.getElementById("email").value;
    let pass = document.getElementById("password").value;
    let type = document.getElementById("type").value;

    if(type == ""){
        alert("❌ Select Login Type");
        return false;
    }

    if(!email.endsWith("@gmail.com")){
        alert("❌ Enter valid Gmail");
        return false;
    }

    if(pass.length < 8 || pass.length > 12){
        alert("❌ Password must be 8-12 digits");
        return false;
    }

    if(!/^[0-9]+$/.test(pass)){
        alert("❌ Password must be numbers only");
        return false;
    }

    return true;
}
</script>

</body>
</html>