<?php
require("_dbconnect.php");

?>
<nav class="navbar  bg-dark navbar-expand-lg  ">
    <div class="container-fluid ">
    <img id="chiragh" src="/forums/images/chiragh.jpg" alt="">
        <a class="navbar-brand text-light" href="#">  Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle text-light" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"> Top Categories</a>

                    <ul class="dropdown-menu bg-light">
                        <?PHP
                        $sql = "SELECT category_name, category_id FROM `categories`  ";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        while ($row != null) {

                            $id = $row['category_id'];
                            echo ('
                            <li><a class="dropdown-item text-dark" href="/forums/threadslist.php?catid=' . $id . '">' . $row["category_name"] . '</a></li>
                            
                        ');
                            $row = mysqli_fetch_assoc($result);
                        }
                        ?>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="contact.php">Contact</a>
                </li>

            </ul>

            <?php
            session_start();
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

                echo ('
                </div>
            <form class=" d-flex" action="/forums/partials/_search.php" method="get" role="search">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="  btn btn-outline-primary" type="submit">Search</button>
                <p class="text-light mx-2 mt-2">Welcome' . $_SESSION["email"] . '</p>
                <a role="button" href="/forums/partials/_logout.php" class=" mx-2 btn btn-primary ">Logout</a>
            </form>

                ');

            } else {
                echo '
                <div class="mx-2">
                <button class="ml-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class=" mx-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal" >SignUp</button>
            </div>
            <form class=" d-flex" role="search" action="/forums/partials/_search.php" method="get">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="  btn btn-outline-primary" type="submit">Search</button>
            </form>
            ';
            }

            ?>


        </div>
    </div>
</nav>

<?php


require("_loginModal.php");
require("_signupModal.php");

?>