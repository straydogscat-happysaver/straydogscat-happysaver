<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != 'admin'){
    echo "Access Denied!";
    exit();
}

include "db.php";
include "navbar.php";

/* =========================
   UPDATE USER ROLE
========================= */

if(isset($_POST['update_role'])){

    $user_id = $_POST['user_id'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET role='$role' WHERE id='$user_id'";

    if($conn->query($sql)){
        echo "<script>alert('User role updated successfully');</script>";
    }
}

/* =========================
   DELETE USER
========================= */

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    // Prevent deleting self
    if($delete_id != $_SESSION['user_id']){

        $conn->query("DELETE FROM users WHERE id='$delete_id'");

        echo "<script>alert('User deleted successfully');</script>";
    }
}

/* =========================
   GET USERS
========================= */

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Settings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .box{
            background:#fff;
            padding:25px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

    </style>

</head>
<body>

<div class="container mt-5">

    <div class="box">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>⚙️ Admin Settings</h2>

            <a href="dashboard.php" class="btn btn-secondary">
                Back
            </a>

        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th width="250">Action</th>

                </tr>

            </thead>

            <tbody>

            <?php while($row = $users->fetch_assoc()){ ?>

                <tr>

                    <td>
                        <?php echo $row['id']; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['email']); ?>
                    </td>

                    <td>

                        <form method="POST" class="d-flex">

                            <input type="hidden"
                                   name="user_id"
                                   value="<?php echo $row['id']; ?>">

                            <select name="role"
                                    class="form-select form-select-sm me-2">

                                <option value="user"
                                <?php if($row['role']=='user') echo 'selected'; ?>>
                                    User
                                </option>

                                <option value="lgu"
                                <?php if($row['role']=='lgu') echo 'selected'; ?>>
                                    LGU
                                </option>

                                <option value="admin"
                                <?php if($row['role']=='admin') echo 'selected'; ?>>
                                    Admin
                                </option>

                            </select>

                            <button type="submit"
                                    name="update_role"
                                    class="btn btn-primary btn-sm">

                                Save

                            </button>

                        </form>

                    </td>

                    <td>
                        <?php echo date("M d, Y", strtotime($row['created_at'])); ?>
                    </td>

                    <td>

                        <?php if($row['id'] != $_SESSION['user_id']){ ?>

                            <a href="admin_settings.php?delete=<?php echo $row['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Delete this user?')">

                               Delete

                            </a>

                        <?php } else { ?>

                            <span class="badge bg-success">
                                Current User
                            </span>

                        <?php } ?>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>