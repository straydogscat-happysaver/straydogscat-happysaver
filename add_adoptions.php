<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "db.php";

if(isset($_POST['submit'])){

    $user_id = $_SESSION['user_id'];

    $pet_name = $_POST['pet_name'];
    $description = $_POST['description'];
    $contact = $_POST['contact'];

    // IMAGE UPLOAD
    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

        $image = time() . "_" . $_FILES['image']['name'];

        $tmp_name = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp_name, "uploads/" . $image);
    }

    $sql = "INSERT INTO adoptions
    (user_id, pet_name, description, image, contact)
    VALUES
    ('$user_id', '$pet_name', '$description', '$image', '$contact')";

    if($conn->query($sql)){

        header("Location: adoptions.php");
        exit();

    } else {

        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Adoption</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .form-box{
            background:#fff;
            padding:30px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

    </style>

</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="form-box">

                <h2 class="mb-4 text-center">
                    🐾 Add Pet for Adoption
                </h2>

                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">

                        <label class="form-label">
                            Pet Name
                        </label>

                        <input type="text"
                               name="pet_name"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description"
                                  class="form-control"
                                  rows="5"
                                  required></textarea>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Contact Information
                        </label>

                        <input type="text"
                               name="contact"
                               class="form-control"
                               placeholder="Phone Number or Facebook"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Upload Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept="image/*">

                    </div>

                    <button type="submit"
                            name="submit"
                            class="btn btn-success w-100">

                        Save Adoption Post

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>