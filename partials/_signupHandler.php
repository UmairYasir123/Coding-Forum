<?php
$show = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require("_dbconnect.php");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $sql = "SELECT * FROM `usertable` WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);

    if (($cpassword == $password)) {
        if ($row == null) {
            if (($password && $cpassword != null) && ($email!=null)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `usertable` ( `user_email`, `user_pass`, `time_stamp`) VALUES ( '$email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                $show = true;
                header("location:/forums/index.php?show=true");
                
                // header("location:/forums/index.php?signup=true");
            }
            else{
                // echo '
                // <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
                // <strong>sorry!</strong> Password should not be empty
                // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                // </div>
                // ';
            }

        } else {
            echo '
            <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
            <strong>sorry!</strong> email already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }

    } else {
        echo ('
        <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>sorry!</strong> password does not match
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');

    }


}


?>