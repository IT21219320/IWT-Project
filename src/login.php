<?php
    include_once 'config.php'
?>
<?php

    session_start();

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $accType = $_POST['accType'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pwd' AND accType='$accType'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if($result->num_rows>0){

        $_SESSION['Email'] = $email;
        $_SESSION['Pwd'] = $pwd;
        $_SESSION['AccType'] = $accType;
        $_SESSION['LoginStat'] = true;

        echo "<script>alert('Login Successfull!');</script>";

        if($row['accType'] == 'buyer'){
            $_SESSION['BuyerSignedIn'] = true;
            echo "<script>window.location.replace('buyerDash.php')</script>";
        }
        elseif($row['accType'] == 'seller'){
            $_SESSION['SellerSignedIn'] = true;
            echo "<script>window.location.replace('sellerDash.php')</script>";
        }
        elseif($row['accType'] == 'staff'){
            $_SESSION['StaffSignedIn'] = true;
            echo "<script>window.location.replace('staffDash.php')</script>";
        }
    }
    else{

        $_SESSION['LoginStat'] = false;
        $_SESSION['BuyerSignedIn'] = false;
        $_SESSION['SellerSignedIn'] = false;
        $_SESSION['StaffSignedIn'] = false;
        echo "<script>
                alert('Invalid email/password!');
                window.location.replace('loginHTML.php');
                </script>";
    }

    mysqli_close($conn);

?>