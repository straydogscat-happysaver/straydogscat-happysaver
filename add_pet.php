<?php
session_start();
include "db.php";

if(isset($_POST['submit'])){

    $user_id = $_SESSION['user_id'];

    $animal_type = $_POST['animal_type'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$image);

    $sql = "INSERT INTO pets
    (user_id,animal_type,title,description,image,latitude,longitude)
    VALUES
    ('$user_id','$animal_type','$title','$description','$image','$latitude','$longitude')";

    if($conn->query($sql)){
        echo "Pet Report Added";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Pet</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-4">

<h2>Report Stray Pet</h2>

<form method="POST" enctype="multipart/form-data">

<select name="animal_type" class="form-control mb-3">
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
</select>

<input type="text" name="title" class="form-control mb-3" placeholder="Title">

<textarea name="description" class="form-control mb-3"></textarea>

<input type="text" name="latitude" class="form-control mb-3" placeholder="Latitude">

<input type="text" name="longitude" class="form-control mb-3" placeholder="Longitude">

<input type="file" name="image" class="form-control mb-3">

<button type="submit" name="submit" class="btn btn-primary">
Submit
</button>

</form>

</div>

</body>
</html>