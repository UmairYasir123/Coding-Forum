<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require("_dbconnect.php");
    $email = $_POST['email'];
   
    $password = $_POST['password'];
    $sql = "SELECT * FROM `usertable` WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    
   

    $fetch = mysqli_fetch_assoc($result);
    $id1 = $fetch['S.no'];
    $hash = $fetch['user_pass'];
    if (($password && $email != null)) {
        if ($row == 1) {
            if (password_verify($password, $hash)) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $id1;
                header("location:/forums/index.php");
            } else {
                echo '
                <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
                <strong>sorry!S</strong>password does not match
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }

        } else {
            echo '
            <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
            <strong>sorry!</strong> email does not match
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    } else {
        echo ("error");
        // echo '
        // <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
        // <strong>sorry!</strong> Password should not be empty
        // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        // </div>
        // ';
    }



}



?>