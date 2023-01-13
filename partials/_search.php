<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDisccus - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        #main-container {

            min-height: 81vh;
        }
      
    </style> 
</head>
<?php include("_header.php"); ?>

<?php require("_dbconnect.php"); ?>

<div class="container my-3" id="main-container" >
<h1 >search results for<?php echo " " . $_GET['search'] ?></h1>
<?php
$showAlert = true;
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $search = $_GET['search'];
    
    $sql = "SELECT * FROM threads WHERE MATCH(`thread_title`,`thread_desc`) against('$search')";
    $result = mysqli_query($conn, $sql);
  
    while($row=mysqli_fetch_assoc($result)){
        $showAlert = false;
        $title = $row['thread_title'];
        $description = $row['thread_desc'];
        $thread_id = $row['thread_id'];
        $url = "/forums/threads.php?threadid=$thread_id";
        echo ('
        <div class="results"> 
        <a href="'.$url.'" class="text-dark text-decoration-none" > <h4>'.$title.'</h4></a>
        <p>'.$description.'</p>
     </div>');
    }
    if($showAlert){
        echo ('
        <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
          <h1 class="display-4">No Results Found</h1>
         <p class="lead">Suggestions:
         <ul>
         <li>make sure that all words are spelled correctly.</li>
         <li>try some other keywords.</li>
         <li>try more general keywords.</li>
         </u>
         </p>
        </div>
      </div>');
    }
}
?> 
</div>
<?php require("_footer.php"); ?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>