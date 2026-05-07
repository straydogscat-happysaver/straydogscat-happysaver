<?php
include "db.php";
include "navbar.php";

$result = $conn->query("SELECT * FROM pets ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Pets</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.card-img-top {
    object-fit: cover;
}
</style>

</head>
<body>

<div class="container mt-4">

<a href="add_pet.php" class="btn btn-success mb-3">
➕ Add Pet Report
</a>

<div class="row">

<?php if ($result->num_rows > 0) { ?>

    <?php while($row = $result->fetch_assoc()){ ?>

        <?php
        $image = !empty($row['image']) ? "uploads/" . $row['image'] : "assets/no-image.png";
        $title = htmlspecialchars($row['title']);
        $desc = htmlspecialchars($row['description']);
        $status = htmlspecialchars($row['status']);
        $lat = $row['latitude'];
        $lng = $row['longitude'];
        ?>

        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">

                <img src="<?= $image ?>" height="250" class="card-img-top">

                <div class="card-body">

                    <h5><?= $title ?></h5>

                    <p><?= $desc ?></p>

                    <p>
                        <strong>Status:</strong>
                        <span class="badge bg-info"><?= $status ?></span>
                    </p>

                    <?php if (!empty($lat) && !empty($lng)) { ?>
                        <a target="_blank"
                           href="https://www.google.com/maps?q=<?= $lat ?>,<?= $lng ?>"
                           class="btn btn-primary btn-sm">
                            📍 View Map
                        </a>
                    <?php } else { ?>
                        <span class="text-muted">No location</span>
                    <?php } ?>

                </div>
            </div>
        </div>

    <?php } ?>

<?php } else { ?>

    <div class="col-12">
        <div class="alert alert-warning text-center">
            No pets reported yet.
        </div>
    </div>

<?php } ?>

</div>

</div>

</body>
</html>