<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDisccus - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <style>
            #chiragh{
                height: 80px;
                width: 80px;
                background-color: black;
            }
        </style>
</head>


<?php require("partials/_header.php"); ?>
<?php
// if($show){
//     echo '
//     <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
//     <strong>congrats</strong> Your account has been creatd
//     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//     </div>
//     ';
// }
?>
<?php require("partials/_dbconnect.php"); ?>

<!-- //slider starts _header -->
<div id="carouselExampleIndicators" class="carousel slide ">

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://source.unsplash.com/2400x700/?apple,code" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/2400x700/?coding,apple" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/2400x700/?coding,python" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
   
</div>

<div class="container my-3">
    <h1 class="text-center">welcome to iDiscuss- Coding Forums</h1>
    <div class="row">

        
    <?php
$sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);

while ($row= mysqli_fetch_assoc($result)) {

    $cat = $row["category_name"];
    $id = $row["category_id"];
        
    echo (' <div class="col-md-4 my-3">
    <div class="card" style="width: 18rem;">
        <img src="https://source.unsplash.com/500x400/?'.$cat.',coding" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><a href="threadslist.php?catid='. $id .' " > ' .$cat . '</a></h5>
            <p class="card-text">'.$row["category_desc"].'</p>
            <a href="threadslist.php?catid='. $id .' "  class="btn btn-primary">View Threads</a>
        </div>
    </div>
</div>

   ');
    

}

?>
        
    </div>

</div>

<?php require("partials/_footer.php"); ?>


<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>