<?php
require_once "../admin/config.php";

// Define variables and initialize with empty values
$full_name=  $email =$password = $confirm_password ="";
$full_name_err  = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate first name
    $input_full_name = trim($_POST["full_name"]);
    if (empty($input_full_name)) {
        $full_name_err = "Please enter a full name.";
        $error= "Please enter a full name.";

    } elseif (!filter_var($input_full_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $full_name_err = "Please enter a valid full name.";
        $error= "Please enter a valid full name.";

    } else {
        $full_name = $input_full_name;
    }


    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email.";
        $error="Please enter a email";
    } else {
        $email = $input_email;
    }

// Check for password
    if (empty(trim($_POST['password']))) {
        $error= $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 4) {
        $error= $password_err = "Password cannot be less than 4 characters";
    } else {
        $password = trim($_POST['password']);
    }

// Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $error= $password_err = "Passwords should match";
    }



    if (empty($full_name_err)  && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {



        $sql = "INSERT INTO patients (full_name, email, age, gender, address,  city, phone, password ) VALUES (?, ?, ?, ?,?,?,?,?)";


        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssisssis", $full_name, $email, $age, $gender , $address, $city, $phone, $param_password);

            // Set parameters
            $full_name = trim($_POST['full_name']);
            $email = trim($_POST['email']);
            $age = trim($_POST['age']);
            $gender = trim($_POST['gender']);
            $address=trim($_POST['address']);
            $city=trim($_POST['city']);
            $phone=trim($_POST['phone']);
            $param_password = password_hash($password, PASSWORD_DEFAULT);


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);

            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial;
            font-size: 17px;
            padding: 8px;
        }

        * {
            box-sizing: border-box;
        }

        .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }



        .col-50 {
            -ms-flex: 50%; /* IE10 */
            flex: 50%;
        }

        .col-75 {
            -ms-flex: 75%; /* IE10 */
            flex: 75%;
        }

        .col-25,
        .col-50,
        .col-75 {
            padding: 0 16px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        input[type=text], input[type=email], input[type=number], input[type=password], select{
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            margin-bottom: 10px;
            display: block;
        }


        .btn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        a {
            color: #2196F3;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }


    </style>
</head>
<body>

<h2 style="text-align: center;">Patient Detail Form:</h2>
<p style="text-align: center; color: deepskyblue;"> Please fill out the form!!</p>
<div class="row" style="width:75%; margin-left: 100px;">
    <div class="col-75">
        <div class="container">
            <form action="register.php" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-50">
                        <h3>Form</h3>
                        <label for="full_name"><i class="fa fa-user"></i> Full Name</label>
                        <input type="text" id="full_name" name="full_name">
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input type="email" id="email" name="email"><br><br>
                        <div class="row">
                            <div class="col-50">
                                <label for="age">Age</label>
                                <input type="number" id="age" name="age" ">
                            </div>
                            <div class="col-50">
                                <label for="gender"> Gender</label>
                                <select name="gender">
                                    <option value="none" selected>     </option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                        </div><br>
                        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="address" name="address">
                        <label for="city"><i class="fa fa-institution"></i> City</label>
                        <input type="text" id="city" name="city">

                        <div class="row">
                            <div class="col-50">
                                <label for="phone"><i class="fa fa-phone"></i>  Phone</label>
                                <input type="text" id="phone" name="phone">
                            </div>
                        </div>
                    </div>

                    <div class="col-50">

                        <img src="img.png" alt=" " width="100%x"; >
                    </div>
                    <div class="row">
                        <div class="col-50">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="col-50">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password">
                        </div>
                    </div>

                </div>
                <input type="submit" value="register" class="btn">
            </form>
        </div>
    </div>

</div>

</body>