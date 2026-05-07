<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "db.php";
include "navbar.php";

$sql = "
SELECT adoptions.*, users.name
FROM adoptions
LEFT JOIN users ON adoptions.user_id = users.id
ORDER BY adoptions.id DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Adoptions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f5f5;
        }

        .card img{
            height:250px;
            object-fit:cover;
        }

        .status-badge{
            font-size:14px;
            padding:5px 10px;
            border-radius:20px;
        }
    </style>

</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>🐾 Pet Adoptions</h2>

        <a href="add_adoption.php" class="btn btn-success">
            + Add Adoption
        </a>

    </div>

    <div class="row">

    <?php while($row = $result->fetch_assoc()){ ?>

        <div class="col-md-4">

            <div class="card shadow-sm mb-4">

                <?php if($row['image']){ ?>

                    <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top">

                <?php } else { ?>

                    <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top">

                <?php } ?>

                <div class="card-body">

                    <h4>
                        <?php echo htmlspecialchars($row['pet_name']); ?>
                    </h4>

                    <p>
                        <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                    </p>

                    <p>
                        <strong>Contact:</strong>
                        <?php echo htmlspecialchars($row['contact']); ?>
                    </p>

                    <p>
                        <strong>Posted By:</strong>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </p>

                    <p>
                        <strong>Status:</strong>

                        <?php if($row['status'] == 'available'){ ?>

                            <span class="badge bg-success status-badge">
                                Available
                            </span>

                        <?php } else { ?>

                            <span class="badge bg-secondary status-badge">
                                Adopted
                            </span>

                        <?php } ?>
                    </p>

                    <?php if($_SESSION['role'] == 'admin' || $_SESSION['user_id'] == $row['user_id']){ ?>

                        <a href="mark_adopted.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-warning btn-sm">

                           Mark Adopted
                        </a>

                        <a href="delete_adoption.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this adoption post?')">

                           Delete
                        </a>

                    <?php } ?>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

</body>
</html>