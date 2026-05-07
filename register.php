<?php
include "db.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name,email,password)
            VALUES('$name','$email','$password')";

    if($conn->query($sql)){
        echo "Registered Successfully";
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="col-md-4 mx-auto">

        <h2>Register</h2>

        <form method="POST">

            <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>

            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <button type="submit" name="register" class="btn btn-primary w-100">
                Register
            </button>

        </form>

        <a href="login.php">Login Here</a>

    </div>
</div>

</body>
</html>