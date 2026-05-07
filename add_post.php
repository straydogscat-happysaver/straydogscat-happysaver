<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "db.php";

if(isset($_POST['submit'])){

    $user_id = $_SESSION['user_id'];

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    /* =========================
       IMAGE UPLOAD
    ========================= */

    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

        $image = time() . "_" . $_FILES['image']['name'];

        $tmp_name = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp_name, "uploads/" . $image);
    }

    /* =========================
       INSERT POST
    ========================= */

    $sql = "INSERT INTO posts
    (user_id, title, content, image, category)
    VALUES
    ('$user_id', '$title', '$content', '$image', '$category')";

    if($conn->query($sql)){

        header("Location: posts.php");
        exit();

    } else {

        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Post</title>

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

        <div class="col-md-7">

            <div class="form-box">

                <h2 class="mb-4 text-center">
                    📢 Create Community Post
                </h2>

                <form method="POST" enctype="multipart/form-data">

                    <!-- TITLE -->

                    <div class="mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               required>

                    </div>

                    <!-- CATEGORY -->

                    <div class="mb-3">

                        <label class="form-label">
                            Category
                        </label>

                        <select name="category"
                                class="form-select"
                                required>

                            <option value="pet">
                                Pet
                            </option>

                            <option value="tourism">
                                Tourism
                            </option>

                            <option value="announcement">
                                Announcement
                            </option>

                        </select>

                    </div>

                    <!-- CONTENT -->

                    <div class="mb-3">

                        <label class="form-label">
                            Content
                        </label>

                        <textarea name="content"
                                  class="form-control"
                                  rows="6"
                                  required></textarea>

                    </div>

                    <!-- IMAGE -->

                    <div class="mb-3">

                        <label class="form-label">
                            Upload Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept="image/*">

                    </div>

                    <!-- BUTTON -->

                    <button type="submit"
                            name="submit"
                            class="btn btn-primary w-100">

                        Publish Post

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>