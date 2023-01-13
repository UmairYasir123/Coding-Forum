<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDisccus - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<?php require("partials/_header.php");
$showAlert = false;
?>
<?php require("partials/_dbconnect.php"); ?>
<?php
$id = $_GET['threadid'];


$sql = "SELECT * FROM `threads` WHERE thread_id=$id";

$result = mysqli_query($conn, $sql);

$num = mysqli_fetch_assoc($result);

?>
<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $content = $_POST['comment'];
    $sno = $_POST['sno'];
    
    $sql = "SELECT * FROM `comments` WHERE comment_content='$content'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo ("error" . mysqli_error($conn));
    }
    $num1 = mysqli_num_rows($result);
    if (($content != null) && ($num1 == null)) {
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$content', '$id','$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo ("errorm" . mysqli_error($conn));
        } else {
            $showAlert = true;
            if ($showAlert) {

                echo ('
        <div class="alert alert-success" role="alert">
          congrats! your thread has been added
        </div>
        ');
            }
        }
    }
}


?>

<div class="container my-3  ">
    <div class="row-md-6 ">
        <div class="h-100 p-5 bg-light border  ">
            <h2>Welcome To <?php echo ($num["thread_title"]); ?> Forums</h2>
            <p>
                <?php echo ($num["thread_desc"]); ?>.The source HTML here as we've adjusted the alignment and sizing
                of
                both
                column's content for equal-height.
            </p>
            <div class="container">
                <hr>
            </div>
            <p>Be respectful towards other forum members. Don't be offensive, abusive or cause harassment. Do not post
                content that is not safe for work. This includes sexual, hateful, racist, homophobic, sexist,
                provocative or vulgar content</p>
            <button class="ml-2 btn btn-primary" type="button">Learn More</button>
        </div>
    </div>
</div>
<div class="container">
    <hr>
</div>
<div class="container">

    <h1>Comment</h1>
    <?php
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
        echo ('
        <form action="' . $_SERVER["REQUEST_URI"] . ' "method="post">
        <div class="form-floating mb-4">
            <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment"
                style="height: 100px"></textarea>
            <label for="floatingTextarea2">Write a Comment</label>
            <input type="hidden" name="sno" value="' . $_SESSION['id'] . '">
        </div>
        <button class="ml-2 btn btn-primary" type="submit">Post Comment</button>
    </form>
        ');
    } else {
        echo ('
        <form action="' . $_SERVER["REQUEST_URI"] . '"method="post">
        <div class="form-floating mb-4">
            <textarea disabled class="form-control" placeholder="Login in in order to comment" id="comment" name="comment"
                style="height: 100px"></textarea>
            <label for="floatingTextarea2">Write a Comment</label>
        </div>
        <button class="ml-2 btn btn-primary" type="submit">Post Comment</button>
    </form>
        ');
    }
    ?>

</div>
<div class="container ">
    <div class="container">
        <hr>
    </div>
    <h1>Discussion</h1>

    <?php
    $sql = "SELECT * FROM `comments` WHERE thread_id='$id'";
    $result = mysqli_query($conn, $sql);
    $no_result = true;
    $date = (date("d F, Y (l)"));
    while ($array = mysqli_fetch_assoc($result)) {
        $no_result = false;
        $comment = $array['comment_content'];
        $user = $array['comment_by'];
        $sql2 = "SELECT user_email FROM `usertable` WHERE `S.no`='$user'";
        $result2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result2);
        $mail = $row['user_email'];
        echo ('
        <div class="d-flex  my-4">
        <div class="flex-shrink-0">
            <img src="Images/user.png" alt="..." width="50px">
        </div>
        <div class="flex-grow-1 ms-3 ">
            <h5 class="mb-0">' . $mail . ' ' . $date . '</h5>
            <p class="mb-0">' . $comment . '  </p>

        </div>
        </div>');
    }
    if ($no_result) {
        echo ('<div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
          <h1 class="display-4">No Question</h1>
          <p class="lead">Be the first one to ask the question.</p>
        </div>
      </div>');
    }
    echo ('<nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav>');
    ?>

</div>
<?php require("partials/_footer.php"); ?>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

</body>

</html>