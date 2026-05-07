<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "db.php";
include "navbar.php";

$sql = "
SELECT posts.*, users.name
FROM posts
LEFT JOIN users ON posts.user_id = users.id
ORDER BY posts.id DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Community Posts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .post-card{
            border:none;
            border-radius:15px;
            overflow:hidden;
        }

        .post-image{
            height:300px;
            object-fit:cover;
        }

    </style>

</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>📢 Community Posts</h2>

        <a href="add_post.php" class="btn btn-primary">
            + Add Post
        </a>

    </div>

    <?php while($row = $result->fetch_assoc()){ ?>

        <div class="card shadow-sm mb-4 post-card">

            <?php if(!empty($row['image'])){ ?>

                <img src="uploads/<?php echo $row['image']; ?>"
                     class="card-img-top post-image">

            <?php } ?>

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <h3>
                        <?php echo htmlspecialchars($row['title']); ?>
                    </h3>

                    <span class="badge bg-info text-dark">
                        <?php echo ucfirst($row['category']); ?>
                    </span>

                </div>

                <p class="text-muted">

                    Posted by:
                    <strong>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </strong>

                    |
                    <?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?>

                </p>

                <p>
                    <?php echo nl2br(htmlspecialchars($row['content'])); ?>
                </p>

                <?php
                $post_id = $row['id'];

                $comment_sql = "
                SELECT comments.*, users.name
                FROM comments
                LEFT JOIN users ON comments.user_id = users.id
                WHERE post_id='$post_id'
                ORDER BY comments.id DESC
                ";

                $comments = $conn->query($comment_sql);
                ?>

                <hr>

                <h6>💬 Comments</h6>

                <?php while($comment = $comments->fetch_assoc()){ ?>

                    <div class="border rounded p-2 mb-2 bg-light">

                        <strong>
                            <?php echo htmlspecialchars($comment['name']); ?>
                        </strong>

                        <small class="text-muted">
                            <?php echo date("M d, Y h:i A", strtotime($comment['created_at'])); ?>
                        </small>

                        <p class="mb-0">
                            <?php echo htmlspecialchars($comment['comment']); ?>
                        </p>

                    </div>

                <?php } ?>

                <!-- COMMENT FORM -->
                <form method="POST" action="comments.php">

                    <input type="hidden"
                           name="post_id"
                           value="<?php echo $row['id']; ?>">

                    <div class="input-group mt-3">

                        <input type="text"
                               name="comment"
                               class="form-control"
                               placeholder="Write a comment..."
                               required>

                        <button type="submit"
                                name="submit_comment"
                                class="btn btn-success">

                            Send

                        </button>

                    </div>

                </form>

                <?php if($_SESSION['role'] == 'admin' || $_SESSION['user_id'] == $row['user_id']){ ?>

                    <div class="mt-3">

                        <a href="delete_post.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this post?')">

                           Delete Post

                        </a>

                    </div>

                <?php } ?>

            </div>

        </div>

    <?php } ?>

</div>

</body>
</html>