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
$id = $_GET['catid'];


$sql = "SELECT * FROM `categories` WHERE category_id=$id";

$result = mysqli_query($conn, $sql);

$num = mysqli_fetch_assoc($result);

?>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT * FROM `threads`";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    $sno1 = $_POST['sno'];
    $description = $_POST['desc'];
    $title5 = $_POST['title'];
    if (($title5 && $description) != null && ($title5 != $rows['thread_title'])) {
        str_replace("<", "&lt;", "$description");
        str_replace(">", "gt;", "$description");
        str_replace("<", "&lt;", "$title5");
        str_replace(">", "gt;", "$title5");
        
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_catid`, `thread_userid`, `timestamp`) VALUES ( '$title5', '$description', '$id', '$sno1', current_timestamp())";
        $result = mysqli_query($conn, $sql);
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
?>

<div class="container my-3  ">
    <div class="row-md-6 ">
        <div class="h-100 p-5 bg-light border  ">
            <h2>Welcome To <?php echo ($num["category_name"]); ?> Forums</h2>
            <p> <?php echo ($num["category_desc"]); ?>.The source HTML here as we've adjusted the alignment and sizing
                of
                both
                column's content for equal-height.</p>
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
    <h1>Ask a Question</h1>
    <?php
    
    if(isset($_SESSION['loggedin'])&&($_SESSION['loggedin']==true)){
        echo ('
        <form action="'.$_SERVER["REQUEST_URI"].'"method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Problem Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                placeholder="Enter Title">
            <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp as possible.</small>
        </div>
        <div class="form-group my-3">
            <label for="exampleInputPassword1">Elaborate your problem</label>
            <input type="text" class="form-control" id="desc" name="desc" placeholder="Description">
        </div>
        <input type="hidden" name="sno" id="sno" value=' . $_SESSION['id'] . '>
        <button type="submit" class="btn btn-primary my-3">Submit</button>
    </form>
        ');
    }
    else{
        echo ('
        <form action="'.$_SERVER["REQUEST_URI"].'"method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Problem Title</label>
            <input disabled type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                placeholder="Login To ask a question">
            <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp as possible.</small>
        </div>
        <div class="form-group my-3">
            <label for="exampleInputPassword1">Elaborate your problem</label>
            <input type="text" disabled class="form-control" id="desc" name="desc" placeholder="Description">
        </div>
        
        <button type="submit" class="btn btn-primary my-3">Submit</button>
    </form>
        ');
    }
    ?>
    
</div>

<div class="container ">
    <div class="container">
        <hr>
    </div>
    <h1>Browse Questions</h1>
    <?php
    $sql = "SELECT * FROM `threads` WHERE thread_catid='$id'";
    $result = mysqli_query($conn, $sql);
    $no_result = true;
    while ($array = mysqli_fetch_assoc($result)) {
        $no_result = false;
        $thread_id = $array['thread_id'];
        $title = $array['thread_title'];
        $thread_desc = $array['thread_desc'];
        $thread_user_id = $array['thread_userid'];
        $sql2 = "SELECT user_email FROM `usertable` WHERE `S.no`='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2); 
        $row = mysqli_fetch_assoc($result2);
        $mail=$row['user_email'];
        echo ('
    <div class="d-flex  my-4">
        <div class="flex-shrink-0">
            <img src="Images/user.png" alt="..." width="50px">
        </div>
        <div class="flex-grow-1 ms-3 ">
        <p class="font-weight-bold my-0">'. $mail.'</p>
        <h5 class="mb-0"><a class="text-dark" href="threads.php?threadid=' . $thread_id . '">' . $title . ' </a>   </h5>
        ' . $thread_desc . '   

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
    ?>

</div>
<?php require("partials/_footer.php"); ?>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

</body>

</html>