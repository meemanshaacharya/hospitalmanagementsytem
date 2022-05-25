<?php

session_start();

require_once "../admin/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM doctor WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $_SESSION['id'];
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
            if (password_verify($_POST['currentPassword'], $row['password'])) {
                $sql = "UPDATE doctor set password=? WHERE id=?";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
                    $param_password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                    $param_id = $_SESSION['id'];

                    if (mysqli_stmt_execute($stmt)) {
                       //echo "password changed";
                        header("location: profile.php");

                    }
                }
            } else {
                echo "Password not changed.";
            }
        }
    }
}

?>
<html>
<head>
    <title>Change password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            text-align: center;
        }
        form {
            display: inline-block;
        }
        label{
            margin: 20px 30px;
        }
        input[type=password], select {
            width: 75%;
            padding: 12px 20px;
            margin: 10px 30px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 25%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 10px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }



    </style>

</head>

<body><br><br>
<h3 style="text-align: center; color: green; font-family: SansSerif;"> Change Password:
    <i class="fa fa-lock" style="font-size:34px"> </i>
</h3>

<form method="post" action="" style="background-color: #b1dcfb; width: 70%; margin-right: 10px; ">
  <br> <label> Current Password:</label><br>
    <input type="password" name="currentPassword">
    <br>
    <label>New Password:</label><br>
    <input type="password" name="newPassword">
    <br>
    <label>Confirm Password:</label><br>
    <input type="password" name="confirmPassword">
    <br>
    <input type="submit">


</form>

</body>
</html>