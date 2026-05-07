<?php
session_start();
include "db.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])){

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            header("Location: dashboard.php");

        } else {
            echo "Invalid Password";
        }

    } else {
        echo "User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="col-md-4 mx-auto">

        <h2>Login</h2>

        <form method="POST">

            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <button type="submit" name="login" class="btn btn-success w-100">
                Login
            </button>

        </form>

        <a href="register.php">Register Here</a>

    </div>
</div>

</body>
</html>