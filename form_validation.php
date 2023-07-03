<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <?php

    $nameErr = $emailErr = $mobileErr = $websiteErr = $genderErr = $agreeErr = "";
    $name = $email = $mobile = $website = $gender = $agree = "";

    // Validations
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //empty error 
        //String Validation  
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = input_data($_POST["name"]);
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only alphabets and white space are allowed";
            }
        }

        //Email Validation  
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = input_data($_POST["email"]);
            // check that the e-mail address is well-formed  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        //Mobile Number Validation
        if (empty($_POST["mobile"])) {
            $mobileErr = "Mobile number is required";
        } else {
            $mobile = input_data($_POST["mobile"]);
            // check if mobile no is well-formed  
            if (!preg_match("/^[0-9]*$/", $mobile)) {
                $mobileErr = "Only numeric value is allowed.";
            }
            //check mobile no length should not be less and greator than 10  
            elseif (strlen($mobile) != 10) {
                $mobileErr = "Mobile number must contain 10 digits.";
            }
        }

        //URL Validation      
        if (empty($_POST["website"])) {
            $websiteErr = "Website URL is required";
        } else {
            $website = input_data($_POST["website"]);
            // check if URL address syntax is valid  
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $websiteErr = "Invalid URL";
            }
        }

        //Gender Validation  
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = input_data($_POST["gender"]);
        }

        //Checkbox Validation  
        if (!isset($_POST['agree'])) {
            $agreeErr = "Accept terms of services before submit.";
        } else {
            $agree = input_data($_POST["agree"]);
        }
    }

    function input_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>


    <span class="error">*Required Fields</span><br><br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <input type="text" name="name" placeholder="Name">
        <span class="error">* <?php echo $nameErr; ?> </span><br><br>

        <input type="email" name="email" id="email" placeholder="Email">
        <span class="error">* <?php echo $emailErr; ?> </span><br><br>

        <input type="text" name="mobile" placeholder="Mobile no.">
        <span class="error">* <?php echo $mobileErr; ?> </span><br><br>

        <input type="text" name="website" placeholder="Website">
        <span class="error">* <?php echo $websiteErr; ?> </span><br><br>

        Gender: <br><br>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="others">Others
        <span class="error">* <?php echo $genderErr; ?> </span><br><br>

        <input type="checkbox" name="agree" id="">Agree terms and conditions.
        <span class="error">* <?php echo $agreeErr; ?> </span><br><br>

        <input type="submit" value="Submit" name="submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        if ($nameErr == "" && $emailErr == "" && $mobileErr == "" && $genderErr == "" && $websiteErr == "" && $agreeErr == "") {
            echo "<h3 color = #FF0001> <b>You have sucessfully registered.</b> </h3>";
            echo "<h2>Your Input:</h2>";
            echo "Name: " . $name;
            echo "<br>";
            echo "Email: " . $email;
            echo "<br>";
            echo "Mobile No: " . $mobile;
            echo "<br>";
            echo "Website: " . $website;
            echo "<br>";
            echo "Gender: " . $gender;
        } else {
            echo "<h3> <b>You didn't filled up the form correctly.</b> </h3>";
        }
    }
    ?>
</body>

</html>
