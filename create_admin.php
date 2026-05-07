<?php

include "db.php";

$password = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "INSERT INTO users(name,email,password,role)
VALUES(
'Admin',
'dcabejero@gmail.com',
'$password',
'admin'
)";

if($conn->query($sql)){
    echo "Admin Created";
} else {
    echo $conn->error;
}

?>